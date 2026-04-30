<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Course;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index()
    {
        try {
            $enrollments = Enrollment::with(['student', 'course'])->get();
            return view('enrollment.index', compact('enrollments'));
        } catch (\Exception $e) {
            return back()->with('error', 'Error loading enrollments: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'student_id' => 'required|numeric',
                'course_id' => 'required|string'
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

            Enrollment::create([
                'student_id' => $request->student_id,
                'course_id' => $course->id,
                'status' => 'Enrolled'
            ]);

            return back()->with('success', 'Enrollment successful');
        } catch (\Exception $e) {
            return back()->with('error', 'Error creating enrollment: ' . $e->getMessage());
        }
    }
}