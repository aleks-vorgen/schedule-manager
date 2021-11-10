<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleRequest;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
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
            ->selectRaw('teachers.lesson_title as lesson_title')
            ->get();
        return response()->json($schedule);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ScheduleRequest $request
     * @return JsonResponse
     */
    public function store(ScheduleRequest $request)
    {
        $schedule = Schedule::create($request->validated());
        $date_time_end = Carbon::parse($request['time_begin'])->addHours(1)->addMinutes(20)->toTimeString();
        $date_time_end = Carbon::createFromFormat('H:i:s', $date_time_end)->toTimeString();
        $changes = [
            'date_time_begin' => $request['date'].' '.$request['time_begin'],
            'date_time_end' => $request['date'].' '.$date_time_end,
        ];
        $schedule->fill($changes)->save();

        return response()->json($schedule);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function edit($id)
    {
        $item = Schedule::findOrFail($id);

        $time_begin = date('H:i', strtotime($item['date_time_begin']));
        $date = date('Y-m-d', strtotime($item['date_time_begin']));
        $schedule = [
            'date' => $date,
            'time_begin' => $time_begin,
            'group_id' => $item['group_id'],
            'teacher_id' => $item['teacher_id']
        ];
        return response()->json($schedule);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ScheduleRequest $request
     * @param Schedule $schedule
     * @return JsonResponse
     */
    public function update(ScheduleRequest $request, Schedule $schedule)
    {
        $schedule->fill($request->validated());
        $date_time_end = Carbon::parse($request['time_begin'])->addHours(1)->addMinutes(20)->toTimeString();
        $date_time_end = Carbon::createFromFormat('H:i:s', $date_time_end)->toTimeString();
        $changes = [
            'date_time_begin' => $request['date'].' '.$request['time_begin'],
            'date_time_end' => $request['date'].' '.$date_time_end
        ];
        $schedule->fill($changes)->save();

        return response()->json($schedule);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Schedule $schedule
     * @return JsonResponse
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->forceDelete();
        return response()->json([
            'message' => 'Расписание успешно удалено',
        ]);
    }
}
