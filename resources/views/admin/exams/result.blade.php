@extends('admin.layouts.master')


@section('content')
<div class="col-lg-12">

    @include('admin.layouts.components.alerts')

    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5 class="m-0">نتيجه</h5>
        </div>

        الدرجه الكليه {{ $result->fullmark }}
        <br />
        الدرجه الطالب {{ $result->degree }}
        <br />
        النسبه المئويه % {{ $result->percentage }}
        <br />
        تاريخ انهاء الامتحان {{ $result->result_date }}


        <ul class="list-unstyled">
            @foreach ($result->exam->main_questions as $main_question)
            <li>{{ $main_question->question }}</li>

            <ul class="list-unstyled">
                @foreach ($main_question->questions as $question)
                <li>
                    {{ $question->question }}({{ $question->degree }} درجه)
                    <ul class="list-unstyled">
                        @foreach ($question->answers as $answer)
                        <li><input type="radio" disabled="disabled" name="question.{{ $question->id }}"
                                @if($answers[$question->id]['answer_id']
                            ==
                            $answer->id) checked @endif>


                            {{ $answer->answer }}


                            @if($answers[$question->id]['answer_id']
                            ==
                            $answer->id)

                            @if($answers[$question->id]['right'])
                            <span style="color:green">(اجابه صحيحه)</span>
                            @else
                            <span style="color:red">(اجابه خاطئه)</span>
                            @endif

                            @endif


                        </li>
                        @endforeach
                    </ul>
                </li>
                @endforeach
            </ul>


            @endforeach
        </ul>


    </div>
</div>
@endsection
