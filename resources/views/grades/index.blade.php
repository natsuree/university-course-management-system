@extends('layouts.app')

@section('title', 'Grades')
@section('page-title', 'Grades')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#gradeModal">
            <i class="fas fa-plus"></i> Submit Grade
        </button>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="table-card">
            <div class="table-card-header">
                <h5><i class="fas fa-file-alt"></i> Grade Records</h5>
            </div>
            <div class="table-card-body">
                @if(isset($grades) && $grades->count() > 0)
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Student ID</th>
                                <th>Student Name</th>
                                <th>Subject</th>
                                <th>Grade</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($grades as $grade)
                                <tr>
                                    <td>{{ $grade->student->student_id ?? 'N/A' }}</td>
                                    <td><strong>{{ $grade->student->name ?? 'N/A' }}</strong></td>
                                    <td>{{ $grade->subject ?? 'N/A' }}</td>
                                    <td><span class="badge bg-primary">{{ $grade->grade ?? 'N/A' }}</span></td>
                                    <td>{{ $grade->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="p-4 text-center text-muted">
                        <i class="fas fa-file-pdf fa-2x mb-2 d-block"></i>
                        <p>No grades recorded yet</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Grade Modal -->
<div class="modal fade" id="gradeModal" tabindex="-1" aria-labelledby="gradeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="gradeModalLabel">Submit Grade</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('grades.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="student_id" class="form-label">Student</label>
                        <select class="form-select" id="student_id" name="student_id" required>
                            <option value="">Select Student</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" class="form-control" id="subject" name="subject" required>
                    </div>
                    <div class="mb-3">
                        <label for="grade" class="form-label">Grade</label>
                        <input type="number" class="form-control" id="grade" name="grade" step="0.01" min="0" max="100" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit Grade</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection