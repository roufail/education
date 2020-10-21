<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Answer;
use App\Models\Question;
use App\Models\MainQuestion;

use App\Http\Requests\Admin\Exams\ExamRequest;
use App\Http\Requests\Admin\Exams\QuestionRequest;
use App\Http\Requests\Admin\Exams\MainQuestionRequest;




class ExamsController extends Controller
{

    public function profile()
    {
       return 'profile';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exams = Exam::latest()->paginate(10);
        return view('admin.exams.list',compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $exam = new Exam();
        return view('admin.exams.form',compact('exam'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExamRequest $request)
    {

        $exam_ar = $request->validated();
        $exam_ar['on'] = $request->get('on', false);
        if($exam = Exam::create($exam_ar)) {
            return redirect()->route('admin.exams.edit',$exam->id)->with(['success' => ' تم اضافه الامتحان  بنجاح']);
        }
        return redirect()->back()->withErrors(['error' => 'حدث خطأ ما يرجي اعاده المحاوله لاحقاً']);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        return view('admin.exams.form',compact('exam'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExamRequest $request, Exam $exam)
    {

        $exam_ar = $request->validated();
        $exam_ar['on'] = $request->get('on', false);

        if($exam->update($exam_ar)) {
            return redirect()->route('admin.exams.edit',$exam->id)->with(['success' => ' تم تعديل الامتحان  بنجاح']);
        }

        return redirect()->back()->withErrors(['error' => 'حدث خطأ ما يرجي اعاده المحاوله لاحقاً']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        if($exam->delete()) {
            return redirect()->back()->with(['success' => ' تم حذف الامتحان ' . $exam->name. ' بنجاح']);
        }
        return redirect()->back()->withErrors(['error' => 'حدث خطأ ما يرجي اعاده المحاوله لاحقاً']);
    }

    public function get_main_questions(Request $request) {
            $exam = Exam::find($request->id);
            if(!$exam) {
            return response()->json(['error' => 'exam not found'], 500);
            }
            $questions = $exam->main_questions()->with(['questions' => function($q) {
                $q->orderby("order","asc")->get();
            },'questions.answers'])->orderby("order","asc")->get();
            return response()->json(['questions' => $questions], 200);
    }

    public function add_main_question(MainQuestionRequest $request) {
        $exam = Exam::find($request->exam);
        if(!$exam) {
          return response()->json(['error' => 'exam not found'], 500);
        }
        $question = $exam->main_questions()->create([
            'question'	=> $request->question,
            'notes'       => $request->notes,
        ]);
        return response()->json(['mainquestion' => $question->load('questions')], 200);

    }




    public function get_questions(Request $request) {
        $exam = Exam::find($request->id);
        if(!$exam) {
          return response()->json(['error' => 'exam not found'], 500);
        }
        $questions = $exam->questions()->with('answers')->orderby("order","asc")->get();
        return response()->json(['questions' => $questions], 200);
    }

    public function add_question(QuestionRequest $request) {
        $exam = Exam::find($request->exam);
        if(!$exam) {
          return response()->json(['error' => 'exam not found'], 500);
        }
        $question = $exam->questions()->create([
            'main_question_id' => $request->main_question_id,
            'question'	=> $request->question,
            'degree'	=> $request->degree,
            'order'	    => $request->order,
            'category_id' => $request->category_id,
            'visible'     => $request->visible ? true : false,
            'notes'       => $request->notes,
        ]);

        $answers = [];

        foreach($request->answers as $answer) {
            $answers[] = new Answer([
                'answer' => $answer['answer'],
                'right'  => $answer['right'],
            ]);
        }
        $question->answers()->saveMany($answers);
        return response()->json(['question' => $question->load('answers')], 200);
    }


    public function delete_question(Request $request) {
        $question = Question::find($request->id);
        if(!$question) {
          return response()->json(['error' => 'exam not found'], 500);
        }
        $question->delete();
        return response()->json(['question_id' => $question->id,'main_question_id' => $question->main_question_id], 200);
    }

    public function update_question(QuestionRequest $request,Question $question) {
        if(!$question) {
          return response()->json(['error' => 'question not found'], 500);
        }

        $request->merge(['visible'=>$request->visible ? 1 : 0]);
        $question->update($request->validated());


        $answers = [];
        $question->answers()->delete();
        foreach($request->answers as $answer) {
            $answers[] = new Answer([
                'answer' => $answer['answer'],
                'right'  => $answer['right'],
            ]);
        }
        $question->answers()->saveMany($answers);

        return response()->json(['question' => $question->load('answers')], 200);
    }


    public function update_question_order(Request $request) {
        foreach ($request->questions as $question) {
            Question::where('id',$question['id'])->update(['order'=>$question['order']]);
        }
    }



    public function update_main_question_order(Request $request) {
        foreach ($request->questions as $question) {
            MainQuestion::where('id',$question['id'])->update(['order'=>$question['order']]);
        }
    }

    public function update_main_question(MainQuestionRequest $request) {
        $question = MainQuestion::find($request->id);
        $question->update($request->validated());
        return response()->json(['question' => $question->load('questions')], 200);
    }


    public function delete_main_question(Request $request) {
        $question = MainQuestion::find($request->id);
        if(!$question) {
          return response()->json(['error' => 'Main question not found'], 500);
        }
        $question->delete();
        return response()->json(['main_question_id' => $question->id], 200);
    }


}
