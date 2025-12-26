<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use App\Models\Subject;
use Auth;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;


class StudentController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum', except: ['index', 'show', 'addSubjectsToStudent', 'getStudentSubjects', 'getSubjectStudents'])
        ];
    }
    public function addSubjectsToStudent(Request $request, $studentID)
    {
        $student = Student::findOrFail($studentID);
        $student->subjects()->attach($request->subject_id);
        return response()->json('subject attached successfuly', 200, );

    }

    public function getStudentSubjects($studentID)
    {
        $subjects = Student::findOrFail($studentID)->subjects;
        return response()->json($subjects, 200);
    }
    public function getSubjectStudents($subjectID)
    {
        $students = Subject::findOrFail($subjectID)->students;
        return response()->json($students, 200);
    }






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
        // $student_data = Student::create($data);
        $student_data = Student::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'age' => $data['age'],
            'user_id' => Auth()->id()
        ]);
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
        \Illuminate\Support\Facades\Gate::authorize('modify', $id);
        $data = $request->validated();
        $student_data = Student::find($id);
        if (!$student_data) {
            return response()->json(['message' => 'student not found'], 404);
        }
        $student_data->update(array_filter([
            'name' => $data['name'] ?? $student_data->name,
            'email' => $data['email'] ?? $student_data->email,
            'age' => $data['age'] ?? $student_data->age,
        ]));
        return response()->json($student_data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        \Illuminate\Support\Facades\Gate::authorize('modify', $id);

        $data = Student::find($id);
        $data->delete();
        return response()->json($data, 204);
    }
}
