<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatusRequest;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statuses = Status::all();

        return response()->json($statuses, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StatusRequest $request)
    {
        $status = Status::create($request->validated());

        return response()->json([
            'message' => 'Status criado com sucesso',
            'data' => $status,
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Status $status)
    {
        return response()->json($status, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StatusRequest $request, Status $status)
    {
        $status->update($request->validated());

        return response()->json([
            'message' => 'Status atualizado com sucesso',
            'data' => $status,
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Status $status)
    {
        $status->delete();

        return response()->json([
            'message' => 'Status apagado com sucesso',
        ], Response::HTTP_NO_CONTENT);
    }
}
