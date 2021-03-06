<?php

namespace App\Http\Resources\Exams;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionsResource extends JsonResource
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
            'id'       => $this->id,
            'question' => $this->question,
            'notes'    => $this->notes,
            'degree'    => $this->degree,
            'answers'  => AnswersResource::collection($this->answers),
        ];
    }
}
