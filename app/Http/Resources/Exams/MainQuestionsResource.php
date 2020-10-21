<?php

namespace App\Http\Resources\Exams;

use Illuminate\Http\Resources\Json\JsonResource;

class MainQuestionsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return  [
            'id'        => $this->id,
            'question'  => $this->question,
            'notes'     => $this->notes,
            'questions' => QuestionsResource::collection($this->questions->filter(function($quest){
                return $quest->visible;
            })->sortBy('order')->load('answers'))
        ];
    }
}
