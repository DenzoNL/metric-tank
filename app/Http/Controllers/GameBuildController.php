<?php

namespace App\Http\Controllers;

use App\GameBuild;
use Illuminate\Http\Request;

class GameBuildController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store($game_id, Request $request)
    {
        $build = new GameBuild;
        $build->game_id = $game_id;
        $build->fill($request->all());
        $build->save();

        return redirect()->back();
    }

}
