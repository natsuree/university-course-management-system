<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Student;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index()
    {
        try {
            $grades = Grade::with('student')->get();
            return view('grades.index', compact('grades'));
        } catch (\Exception $e) {
            return back()->with('error', 'Error loading grades: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'student_id' => 'required|numeric',
                'subject' => 'required|string',
                'grade' => 'required|numeric|min:0|max:100'
            ]);

            Grade::create([
                'student_id' => $request->student_id,
                'subject' => $request->subject,
                'grade' => $request->grade
            ]);

            return back()->with('success', 'Grade submitted successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Error submitting grade: ' . $e->getMessage());
        }
    }
}