<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $schedule = DB::table('schedules')
            ->leftJoin('groups', 'schedules.group_id', '=', 'groups.id')
            ->leftJoin('teachers', 'schedules.teacher_id', '=', 'teachers.id')
            ->selectRaw('schedules.id')
            ->selectRaw('TIME(date_time_begin) AS time_begin')
            ->selectRaw('TIME(date_time_end) AS time_end')
            ->selectRaw('DATE(date_time_begin) AS date')
            ->selectRaw('DAYNAME(date_time_begin) AS day')
            ->selectRaw('groups.title AS group_title')
            ->selectRaw("CONCAT(teachers.name, ' ', teachers.surname) AS teacher_name")
            //->selectRaw('teachers.name AS teacher_name')
            //->selectRaw('teachers.surname AS teacher_surname')
            ->selectRaw('teachers.lesson_title as lesson_title')
            ->get();
        return response()->json($schedule);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
