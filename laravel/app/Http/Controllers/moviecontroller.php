<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;

class moviecontroller extends Controller
{
  public function index(){
    $users = DB::select('select * from pokemon;');
    return view('movielist',array('users' => $users));
  }
}
