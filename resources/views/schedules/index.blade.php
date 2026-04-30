@extends('layouts.app')

@section('title', 'Schedules')
@section('page-title', 'Schedules')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#scheduleModal">
            <i class="fas fa-plus"></i> New Schedule
        </button>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="table-card">
            <div class="table-card-header">
                <h5><i class="fas fa-calendar-alt"></i> Schedule List</h5>
            </div>
            <div class="table-card-body">
                @if($schedules->count() > 0)
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Course</th>
                                <th>Instructor</th>
                                <th>Room</th>
                                <th>Day</th>
                                <th>Time</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($schedules as $schedule)
                                <tr>
                                    <td><strong>{{ $schedule->course->course_name ?? 'N/A' }}</strong></td>
                                    <td>{{ $schedule->instructor ?? 'N/A' }}</td>
                                    <td>{{ $schedule->room ?? 'N/A' }}</td>
                                    <td><span class="badge bg-info">{{ $schedule->day ?? 'N/A' }}</span></td>
                                    <td>{{ $schedule->start_time ?? 'N/A' }} - {{ $schedule->end_time ?? 'N/A' }}</td>
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
                        <i class="fas fa-calendar fa-3x mb-3 d-block"></i>
                        <p>No schedules found</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Schedule Modal -->
<div class="modal fade" id="scheduleModal" tabindex="-1" aria-labelledby="scheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scheduleModalLabel">New Schedule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('schedules.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="course_id" class="form-label">Course</label>
                        <input type="text" class="form-control" id="course_id" name="course_id" placeholder="e.g., BSIT" required>
                    </div>
                    <div class="mb-3">
                        <label for="instructor" class="form-label">Instructor</label>
                        <input type="text" class="form-control" id="instructor" name="instructor" required>
                    </div>
                    <div class="mb-3">
                        <label for="room" class="form-label">Room</label>
                        <input type="text" class="form-control" id="room" name="room" required>
                    </div>
                    <div class="mb-3">
                        <label for="day" class="form-label">Day</label>
                        <select class="form-select" id="day" name="day" required>
                            <option value="">Select Day</option>
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                            <option value="Saturday">Saturday</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="start_time" class="form-label">Start Time</label>
                            <input type="time" class="form-control" id="start_time" name="start_time" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="end_time" class="form-label">End Time</label>
                            <input type="time" class="form-control" id="end_time" name="end_time" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Schedule</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection