@extends('app')

@section('content')
    <div class="container">
        <h1>Courses</h1>
        <a href="{{ route('admin.courses.create') }}">Add New Course</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Course Name</th>
                    <th>Description</th>
                    <th>Difficulty</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)
                    <tr>
                        <td>{{ $course->id }}</td>
                        <td>{{ $course->course_name }}</td>
                        <td>{{ $course->description }}</td>
                        <td>{{ $course->difficulty }}</td>
                        <td>{{ $course->category }}</td>
                        <td>
                            <a href="{{ route('admin.courses.show', $course->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('admin.courses.edit', $course->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
