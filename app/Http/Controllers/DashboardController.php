<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Payment;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'totalStudents' => Student::count(),
            'totalCourses' => Course::count(),
            'totalEnrollments' => Enrollment::count(),
            'todayPayments' => Payment::whereDate('created_at', now())->sum('amount'),
            'recentEnrollments' => Enrollment::with(['student', 'course'])->latest()->take(10)->get()
        ]);
    }
}