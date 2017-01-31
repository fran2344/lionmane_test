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
     $consulta='select * from movie order by id desc limit 1;';
     $users = DB::select($consulta);
     foreach ($users as $user) {
       $msg=$user->id.','.$user->name.','.$user->description.','.$user->image;
     }
     return response()->json(array('msg'=> $msg));
  }

  public function eliminar(Request $request){
     $ident = $request->input('identificador');
     $msg = 'delete from movie where id='.$ident.";";
     DB::delete($msg);
     return response()->json(array('msg'=> $msg));
  }

  public function buscar(Request $request){
    $ident = $request->input('identificador');
    $msg = 'select * from movie where id='.$ident.";";
    $users = DB::select($msg);
    foreach ($users as $user) {
      $msg=$user->id.','.$user->name.','.$user->description;
    }
    return response()->json(array('msg'=> $msg));
  }

  public function modificar(Request $request){
    $id = $request->input('upd_hid');
    $nombre = $request->input('upd_nombre');
    $descripcion=$request->input('upd_descripcion');
    $file = $request->file('upd_archivo');
    $consulta='update movie set name="'.$nombre.'" ,description="'.$descripcion.'" where id='.$id.';';
    $docu ="";
    if ($file!=""){
      $destinationPath = 'uploads';
      $file->move($destinationPath,$file->getClientOriginalName());
      $consulta='update movie set name="'.$nombre.'" ,description="'.$descripcion.'" ,image="'.$file->getClientOriginalName().'" where id='.$id.';';
      $docu =$file->getClientOriginalName();
    }
    DB::update($consulta);
    $msg=$id.','.$nombre.','.$descripcion.','.$docu;
    return response()->json(array('msg'=> $msg));
  }

}
