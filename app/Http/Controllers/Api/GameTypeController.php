<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GameType\GameTypeResource;
use App\Http\Resources\GameType\GameTypeResourceCollection;
use App\Services\GameTypeService;
use Illuminate\Http\Request;

/**
 * Class for Game type controller
 * @package App\Http\Controllers\Api
 */
class GameTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index(GameTypeService $service)
    {
        return $this->resource('collection', $service->paginate());
    }

    /**
     * Display a listing of the resource as a table.
     *
     * @return \Illuminate\Http\Response
     */
    public function tables()
    {

    }

    /**
     * Store a newly created resource in storage.
     * @return \Illuminate\Http\Response
     */
    public function store()
    {

    }

    /**
     * Display the specified resource.
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update()
    {

    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {

    }

    /**
     * @return \Illuminate\Http\Response
     */
    private function resource($method, $data)
    {
        return ($method === 'collection')
            ? new GameTypeResourceCollection($data)
            : new GameTypeResource($data);
    }
}
