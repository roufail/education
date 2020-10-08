<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Result;
class ResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = Result::with(['exam','student'])->latest()->paginate(10);
        return view('admin.exams.results',compact('results'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Result $result)
    {
      $result->load(['exam.questions_answers.answer','student','exam.main_questions.questions.answers']);
      $answers = $result->exam->questions_answers->mapWithKeys(function($answer){
            return [
                $answer->question_id => [
                    'answer_id' => $answer->answer_id,
                    'question_id' => $answer->question_id,
                    'right' => $answer->right,
                ]
                ];
      })->toArray();
      return view('admin.exams.result', compact('result','answers'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
