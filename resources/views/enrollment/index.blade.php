@extends('layouts.app')

@section('title', 'Enrollments')
@section('page-title', 'Enrollments')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#enrollModal">
            <i class="fas fa-plus"></i> New Enrollment
        </button>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="table-card">
            <div class="table-card-header">
                <h5><i class="fas fa-users-class"></i> Enrollment List</h5>
            </div>
            <div class="table-card-body">
                @if($enrollments->count() > 0)
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Student ID</th>
                                <th>Student Name</th>
                                <th>Course</th>
                                <th>Status</th>
                                <th>Enrolled Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($enrollments as $enrollment)
                                <tr>
                                    <td>{{ $enrollment->student->student_id ?? 'N/A' }}</td>
                                    <td><strong>{{ $enrollment->student->name ?? 'N/A' }}</strong></td>
                                    <td>{{ $enrollment->course->course_name ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge bg-success">{{ $enrollment->status }}</span>
                                    </td>
                                    <td>{{ $enrollment->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="p-4 text-center text-muted">
                        <i class="fas fa-empty-set fa-3x mb-3 d-block"></i>
                        <p>No enrollments found</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Enrollment Modal -->
<div class="modal fade" id="enrollModal" tabindex="-1" aria-labelledby="enrollModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="enrollModalLabel">New Enrollment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('enrollments.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="student_id" class="form-label">Student</label>
                        <select class="form-select" id="student_id" name="student_id" required>
                            <option value="">Select Student</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="course_id" class="form-label">Course</label>
                        <input type="text" class="form-control" id="course_id" name="course_id" placeholder="e.g., BSIT" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Enroll</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection