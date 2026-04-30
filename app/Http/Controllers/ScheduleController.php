<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Course;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        try {
            $schedules = Schedule::with('course')->get();
            return view('schedules.index', compact('schedules'));
        } catch (\Exception $e) {
            return back()->with('error', 'Error loading schedules: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'course_id' => 'required|string',
                'room' => 'required|string',
                'instructor' => 'required|string',
                'day' => 'required|string',
                'start_time' => 'required',
                'end_time' => 'required'
            ]);

            // Find or create the course by course_code
            $course = Course::where('course_code', $request->course_id)->first();
            if (!$course) {
                $course = Course::create([
                    'course_code' => $request->course_id,
                    'course_name' => $request->course_id,
                    'units' => 3
                ]);
            }

            Schedule::create([
                'course_id' => $course->id,
                'room' => $request->room,
                'instructor' => $request->instructor,
                'day' => $request->day,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time
            ]);

            return back()->with('success', 'Schedule created successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Error creating schedule: ' . $e->getMessage());
        }
    }
}