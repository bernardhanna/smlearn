@extends('app')

@section('content')
    <div class="container">
        <h1>Course Details</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $course->course_name }}</h5>
                <p class="card-text"><strong>Description:</strong> {{ $course->description }}</p>
                <p class="card-text"><strong>Difficulty:</strong> {{ $course->difficulty }}</p>
                <p class="card-text"><strong>Category:</strong> {{ $course->category }}</p>

                <a href="{{ route('admin.courses.index') }}" class="btn btn-primary">Back to Courses</a>
            </div>
        </div>
    </div>
@endsection
