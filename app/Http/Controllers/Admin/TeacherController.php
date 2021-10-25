<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherRequest;
use App\Models\Teacher;
use Illuminate\Http\JsonResponse;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $teachers = Teacher::all('id', 'name', 'surname', 'lesson_title');

        return response()->json($teachers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TeacherRequest $request
     * @return JsonResponse
     */
    public function store(TeacherRequest $request)
    {
        $teacher = Teacher::create($request->validated());
                return response()->json($teacher);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $teacher = Teacher::find($id);
        return response()->json($teacher);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function edit($id)
    {
        $teacher = Teacher::find($id);
        return response()->json($teacher);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TeacherRequest $request
     * @param Teacher $teacher
     * @return JsonResponse
     */
    public function update(TeacherRequest $request, Teacher $teacher)
    {
        $teacher->fill($request->validated())
            ->save();

        return response()->json($teacher);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Teacher $teacher
     * @return JsonResponse
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->forceDelete();
        return response()->json([
            'message' => 'Преподаватель успешно удалён'
        ]);
    }
}
