<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Movie;

class moviecontroller extends Controller
{
  public function index(){
    $movies = Movie::all();
    return view('movielist',array('movies' => $movies));
  }

  public function insertar(Request $request){
     $nombre = $request->input('nombre');
     $descripcion = $request->input('descripcion');
     $file = $request->file('archivo');
     $destinationPath = 'uploads';
     $file->move($destinationPath,$file->getClientOriginalName());
     $image = $file->getClientOriginalName();
     
     $movie = new Movie();
     $movie->name = $nombre;
     $movie->description = $descripcion;
     $movie->image = $image;
     $movie->save();

     $msg = $movie->id.','.$movie->name.','.$movie->description.','.$movie->image;
     return response()->json(array('msg'=> $msg));
  }

  public function eliminar(Request $request){
     $ident = $request->input('identificador');
     $movie = Movie::findOrFail($ident);
     $movie->delete();
     return response()->json(array('msg'=> 'Eliminado'));
  }

  public function buscar(Request $request){
    $ident = $request->input('identificador');
    $movie = Movie::findOrFail($ident);
    $msg = $movie->id.','.$movie->name.','.$movie->description.','.$movie->image;
    return response()->json(array('msg'=> $msg));
  }

  public function modificar(Request $request){
    $id = $request->input('upd_hid');
    $nombre = $request->input('upd_nombre');
    $descripcion=$request->input('upd_descripcion');
    $file = $request->file('upd_archivo');
    $movie = Movie::findOrFail($id);
    $movie->name = $nombre;
    $movie->description = $descripcion;
    
    $consulta='update movie set name="'.$nombre.'" ,description="'.$descripcion.'" where id='.$id.';';
    if ($file!=""){
      $destinationPath = 'uploads';
      $file->move($destinationPath,$file->getClientOriginalName());
      $movie->image = $file->getClientOriginalName();
    }
    $movie->save();
    $msg = $movie->id.','.$movie->name.','.$movie->description.','.$movie->image;
    return response()->json(array('msg'=> $msg));
  }

}
