<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroupRequest;
use App\Models\Group;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $groups = Group::all('id', 'title');
        return response()->json($groups);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param GroupRequest $request
     * @return JsonResponse
     */
    public function store(GroupRequest $request)
    {
        $group = Group::create($request->validated());
        return response()->json($group);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View|JsonResponse
     */
    public function edit($id)
    {
        $group = Group::findOrFail($id);
        return response()->json($group);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param GroupRequest $request
     * @param Group $group
     * @return JsonResponse
     */
    public function update(GroupRequest $request, Group $group)
    {
        $group->fill($request->validated())
              ->save();

        return response()->json($group);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Group $group
     * @return JsonResponse
     */
    public function destroy(Group $group)
    {
        $group->forceDelete();
        return response()->json([
            'message' => 'Группа успешно удалена'
        ]);
    }
}
