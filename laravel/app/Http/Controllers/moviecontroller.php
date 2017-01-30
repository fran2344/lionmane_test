<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;

class moviecontroller extends Controller
{
  public function index(){
    $users = DB::select('select * from movie;');
    return view('movielist',array('users' => $users));
  }

  public function ejemplo(Request $request){

     $nombre = $request->input('nombre');
     $descripcion = $request->input('descripcion');
     $file = $request->file('archivo');
     $image = $file->getClientOriginalName();
     $msg = 'insert into movie(name, description, image) values("'.$nombre.'","'.$descripcion.'","'.$image.'");';
     DB::insert($msg);


     $msg=$nombre.','.$descripcion.','.$image;
     return response()->json(array('msg'=> $msg));
  }
}
