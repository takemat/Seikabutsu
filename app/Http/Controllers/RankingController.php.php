<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RankingController extends Controller
{
  public function index()
{
    $ranking = ReadersRanking::orderByDesc('points')->get();

    return view('ranking.index', compact('ranking'));
}  
}
