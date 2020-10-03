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
        return [
            'id'  => $this->id,
            'title'  => $this->title,
            'doctor' => $this->doctor,
            'started_at' => $this->started_at,
            'ended_at' => $this->ended_at,
            'main_questions' => new MainQuestionsCollection($this->main_questions()->paginate(1))
        ];
    }
}
