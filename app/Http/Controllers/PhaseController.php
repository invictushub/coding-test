<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePhaseRequest;
use App\Http\Requests\UpdatePhaseRequest;
use App\Models\Phase;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Psy\Util\Json;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class PhaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePhaseRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Phase $phase)
    {
        return $phase->load('tasks.user')->toJson();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Phase $phase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePhaseRequest $request, Phase $phase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Phase $phase): JsonResponse
    {
        //We can use an observer here, but I am not a big fan of observer because did not provide information to code viewer
        $phase->tasks()->delete();
        $phase->delete();

        return response()->json([], ResponseAlias::HTTP_OK);
    }
}
