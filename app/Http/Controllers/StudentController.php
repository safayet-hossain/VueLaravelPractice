<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller



{
    public function index()
    {
        return response()->json(Student::all());
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'student_id' => 'required|unique:students,student_id',
            'class' => 'required|string|max:5',
        ]);

        Student::create($request->all());
        return response()->json(['message' => 'Student created successfully!'], 201);
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'student_id' => 'required|unique:students,student_id,' . $student->id,
            'class' => 'required|string|max:5',
        ]);

        $student->update($request->all());
        return response()->json(['message' => 'Student updated successfully!']);
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return response()->json(['message' => 'Student deleted successfully!']);
    }
}
