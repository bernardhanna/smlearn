@extends('app')

@section('content')
    <div class="container">
        <h1>Create New Course</h1>

        <form action="{{ route('admin.courses.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="course_name">Course Name</label>
                <input type="text" class="form-control" id="course_name" name="course_name" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>

            <div class="form-group">
                <label for="difficulty">Difficulty</label>
                <input type="text" class="form-control" id="difficulty" name="difficulty">
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" class="form-control" id="category" name="category">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
