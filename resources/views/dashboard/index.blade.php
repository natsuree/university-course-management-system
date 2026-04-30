@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="row mb-4">
    <!-- Total Students Card -->
    <div class="col-md-6 col-lg-3">
        <div class="stat-card students">
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <h5>Total Students</h5>
            <div class="value">{{ $totalStudents }}</div>
        </div>
    </div>

    <!-- Total Courses Card -->
    <div class="col-md-6 col-lg-3">
        <div class="stat-card courses">
            <div class="stat-icon">
                <i class="fas fa-book"></i>
            </div>
            <h5>Total Courses</h5>
            <div class="value">{{ $totalCourses }}</div>
        </div>
    </div>

    <!-- Total Enrollments Card -->
    <div class="col-md-6 col-lg-3">
        <div class="stat-card enrollments">
            <div class="stat-icon">
                <i class="fas fa-clipboard-list"></i>
            </div>
            <h5>Enrollments</h5>
            <div class="value">{{ $totalEnrollments }}</div>
        </div>
    </div>

    <!-- Today's Payments Card -->
    <div class="col-md-6 col-lg-3">
        <div class="stat-card payments">
            <div class="stat-icon">
                <i class="fas fa-money-bill-wave"></i>
            </div>
            <h5>Today's Payments</h5>
            <div class="value">₱{{ number_format($todayPayments, 2) }}</div>
        </div>
    </div>
</div>

<!-- Recent Enrollments Table -->
<div class="row mt-5">
    <div class="col-12">
        <div class="table-card">
            <div class="table-card-header">
                <h5><i class="fas fa-list"></i> Recent Enrollments</h5>
            </div>
            <div class="table-card-body">
                @if($recentEnrollments->count() > 0)
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Student</th>
                                <th>Course</th>
                                <th>Status</th>
                                <th>Enrolled Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentEnrollments as $enrollment)
                                <tr>
                                    <td>
                                        <strong>{{ $enrollment->student->name ?? 'N/A' }}</strong>
                                    </td>
                                    <td>{{ $enrollment->course->course_name ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge bg-success">{{ $enrollment->status }}</span>
                                    </td>
                                    <td>{{ $enrollment->created_at->format('M d, Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="p-4 text-center text-muted">
                        <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                        <p>No enrollments yet</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection