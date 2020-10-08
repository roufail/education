<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use  App\Models\ResultQuestion;
use  App\Models\Answer;
use  App\Models\Question;
use  App\Models\Result;
use App\Http\Resources\Exams\ExamQuestionResource;
class ExamsController extends Controller
{

    public function profile()
    {
       return 'profile';
    }


    public function exam($id)
    {
        $exam = Exam::FindOrFail($id);
        return view('student.exams.exam',compact('exam'));
    }

    public function get_exam($id)
    {

        $result = Result::where('exam_id',$id)->where('student_id',auth("students")->user()->id)->pluck('id');
        if(count($result) > 0) {
            return $this->error('تم اجتياز هذا الامتحان');
        }
        $exam = Exam::with(['main_questions' => function($main_questions){
            $main_questions->wherehas('questions')->with('questions.answers')->paginate(1);
        }])->FindOrFail($id);



        // $answers =  $exam->main_questions->pluck('questions')->flatten()->pluck('answers')->flatten()->pluck('id','question_id');


        $answers = auth()->user()->results_questions()->pluck('answer_id','question_id');
        return $this->response(['exam' => new ExamQuestionResource($exam),'answers' => $answers],'تم بدء الامتحان');
    }


    public function get_answers(Request $request){
        $answers = ResultQuestion::whereIn('question_id',$request->questions_ids)->where("student_id",auth("students")->user()->id)->pluck('answer_id','question_id');
        return $this->response(['answers' => $answers]);
    }

    public function save_answers(Request $request) {
        ResultQuestion::whereIn('question_id',$request->questions_ids)->where("student_id",auth("students")->user()->id)->delete();
        $answers_db = Answer::join('questions','answers.question_id','questions.id')->whereIn('answers.id',$request->answers)->get(['questions.id as question_id','answers.id as answer_id','exam_id','right','degree'])->toArray();
        auth()->user()->results_questions()->createMany($answers_db);

        // $answers = auth()->user()->results_questions()->pluck('answer_id','question_id');

        return $this->response([],'تم بدء الامتحان');
    }

    public function end_exam(Request $request) {
        $results = ResultQuestion::where('exam_id', $request->id)->where("student_id",auth("students")->user()->id)->get();

        $results_ids = $results->map(function($result){
            return $result->question_id;
        });


        $unanswered = Question::where('exam_id',$request->id)->whereNotIn("id",$results_ids)->pluck('id');

        if(count($unanswered) > 0){
            return $this->error('يوجد بعض الاسئله التي لم تجيب عليها',$unanswered);
        }else{
            // calculate exam
            $fullmark = $results->sum('degree');
            $degree   = $results->filter(function($result){
                return $result->right;
            })->sum('degree');
            auth("students")->user()->results()->updateOrCreate([
                'exam_id' => $request->id
                    ],
                    [
                       'exam_id'     =>  $request->id,
                       'fullmark'    =>  $fullmark,
                       'degree'      =>  $degree,
                       'percentage'  =>  ($degree / $fullmark) * 100,
                       'grade'       => 'a',
                       'result_date' => \Carbon\Carbon::now(),
                       'ended'       => 1,

                    ]
            );

            return $this->response($unanswered,'تم انهاء الامتحان');
        }
    }


    public function get_exam_result(Request $request){

        $exam = Exam::with(['result','main_questions.questions.result','main_questions.questions.answers'])->FindOrFail($request->id);

        if(!$exam) {
            return $this->response([],'نتيجه الامتحان');
        }

        $answers = ResultQuestion::where('exam_id',$exam->id)->where("student_id",auth("students")->user()->id)->get();

        $wrong = $answers->filter(function($answer){
            return !$answer->right;
        })->pluck('answer_id');


        $right = $answers->filter(function($answer){
            return $answer->right;
        })->pluck('answer_id');


        $answers = $answers->pluck('answer_id','question_id');

        return $this->response(["exam" =>  new ExamQuestionResource($exam),'answers' => $answers,'wrong' => $wrong,'right' => $right],'نتيجه الامتحان');
    }

}
