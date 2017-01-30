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

  public function insertar(Request $request){

     $nombre = $request->input('nombre');
     $descripcion = $request->input('descripcion');
     $file = $request->file('archivo');
     $destinationPath = 'uploads';
     $file->move($destinationPath,$file->getClientOriginalName());
     $image = $file->getClientOriginalName();
     $msg = 'insert into movie(name, description, image) values("'.$nombre.'","'.$descripcion.'","'.$image.'");';
     DB::insert($msg);
     $msg=$nombre.','.$descripcion.','.$image;
     return response()->json(array('msg'=> $msg));
  }

  public function eliminar(Request $request){
     $ident = $request->input('identificador');
     $msg = 'delete from movie where id='.$ident.";";
     DB::delete($msg);
     return response()->json(array('msg'=> $msg));
  }
}
