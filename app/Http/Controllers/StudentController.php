<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use App\Models\StudentCard;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = Student::select(['name', 'email', 'age'])->get();
        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
        $data = $request->validated();
        $student_data = Student::create($data);
        return response()->json($student_data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $data = Student::find($student);
        if (!$data) {
            return response()->json(['message' => 'student not found'], 404);
        } else {
            return response()->json($data, 200);
        }

    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, $id)
    {
        $data = $request->validated();
        $student = Student::find($id);
        if (!$student) {
            return response()->json(['message' => 'student not found'], 404);
        }
        $student->update(array_filter([
            'name' => $data['name'] ?? $student->name,
            'email' => $data['email'] ?? $student->email,
            'age' => $data['age'] ?? $student->age,
        ]));
        return response()->json($student, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Student::find($id);
        $data->delete();
        return response()->json($data, 204);
    }
}
