<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\GameTypeService;
use Illuminate\Http\Request;

/**
 * Class for Game type controller
 * @package App\Http\Controllers\Api
 */
class GameTypeController extends Controller
{
    /**
     * @var GameTypeService
     */
    private $gameTypeService;

    /**
     * @param GameTypeService $gameTypeService
     */
    public function __construct(GameTypeService $gameTypeService)
    {
        $this->gameTypeService = $gameTypeService;
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd('d');

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

    }
}
