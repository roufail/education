<?php

namespace App\Http\Resources\Exams;

use Illuminate\Http\Resources\Json\JsonResource;

class ExamQuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $array =  [
            'id'  => $this->id,
            'title'  => $this->title,
            'doctor' => $this->doctor,
            'started_at' => $this->started_at,
            'ended_at' => $this->ended_at,
            'result' => $this->when(request()->result , $this->result)
        ];

        if(request()->result){
            $array['main_questions'] = $this->when(request()->result , MainQuestionsResource::collection($this->main_questions));
        }else {
            $array['main_questions'] = $this->when(!request()->result ,new MainQuestionsCollection($this->main_questions()->paginate(1)));
        }
        return $array;
    }
}
