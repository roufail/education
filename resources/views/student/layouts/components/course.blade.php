<div class="col-lg-4 col-12">

    <div class="course-widget">
        <a href="{{ route('student.course',$course->id) }}">
            <h6>{{ $course->title }}<h6>
                    <img width="325px" height="190px" src="{{ Storage::disk('courses')->url($course->image) }}" />
                    <ul class="list-group list-group-horizontal">
                        <li class="list-group-item"><i class="fa fa-users"></i>&nbsp; 1200</li>
                    </ul>
        </a>
    </div>

</div>
