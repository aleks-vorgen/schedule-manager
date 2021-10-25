<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $id
     * @return JsonResponse
     */
    public function index()
    {
        if(!empty($_GET['id'])) {
            $id = $_GET['id'];
            $students = DB::table('students')
                ->selectRaw('id')
                ->selectRaw('name')
                ->selectRaw('surname')
                ->where('group_id', '=', $id)
                ->get();
            return response()->json($students);
        }
        else {
            $students = DB::table('students')
            ->leftJoin('groups', 'students.group_id', '=', 'groups.id')
            ->select([
                'students.id',
                'students.name',
                'students.surname',
                'groups.title as group_title'
            ])->get();
            return response()->json($students);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StudentRequest $request
     * @return JsonResponse
     */
    public function store(StudentRequest $request)
    {
        $student = Student::create($request->validated());
        return response()->json($student);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $student = DB::table('students')
            ->leftJoin('groups', 'students.group_id', '=', 'groups.id')
            ->selectRaw('students.id')
            ->selectRaw('students.name')
            ->selectRaw('students.surname')
            ->selectRaw('groups.title as group_title')
            ->where('students.id', '=', $id)
            ->get()->first();

        return response()->json($student);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function edit($id)
    {
        $student = Student::find($id);
        return response()->json($student);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StudentRequest $request
     * @param Student $student
     * @return JsonResponse
     */
    public function update(StudentRequest $request, Student $student)
    {
        $student->fill($request->validated())
            ->save();

        return response()->json($student);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Student $student
     * @return JsonResponse
     */
    public function destroy(Student $student)
    {
        $student->forceDelete();
        return response()->json([
            'message' => 'Студент успешно удалён'
        ]);
    }
}
