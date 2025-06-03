<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grade;
use Illuminate\Support\Facades\Auth;

class GradesController extends Controller
{
    public function index()
    {
        $grades = Grade::where('student_id', Auth::id())
                      ->with(['subject', 'student'])
                      ->orderBy('created_at', 'desc')
                      ->paginate(10);

        return view('student.grades.index', compact('grades'));
    }
} 