<!DOCTYPE html>
<html lang="en">

   <head>
       <meta charset="UTF-8">
       <title>Movie list</title>
       <link rel="stylesheet" href="css/bootstrap.css">
       <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
       <script src="js/bootstrap.min.js"></script>
       <script src="js/lionmane.js"></script>
        
   </head>


   <body>
     <input id="csrf_token" type="hide" value="<?php echo csrf_token(); ?>" />
<div class="container">
  <div class="page-header">
  <h1>Movie catalog <small>CRUD</small></h1>
</div>
     <div class="table-responsive" id="tabla_ajax" name="tabla_ajax" >
       <!--<script>renderizar();</script>-->
      <table class="table table-bordered">
            <thead>
             <tr>
                <th class="text-center"><b>Name</b></td>
                <th class="text-center"><b>description</b></td>
                <th class="text-center"><b>Image</b></td>
                <th class="text-center"><b>Acciones</b></td>
             </tr>
           </thead>
           <tbody>
             @foreach ($movies as $movie)
             <tr id="tr{{$movie->id}}" name="tr{{$movie->id}}">
                <td id="tdn{{$movie->id}}" name="tdn{{$movie->id}}" class="text-center">{{ $movie->name }}</td>
                <td id="tdd{{$movie->id}}" name="tdd{{$movie->id}}" class="text-center">{{ $movie->description }}</td>
                <td id="tdf{{$movie->id}}" name="tdf{{$movie->id}}" class="text-center">
                  <img src="uploads/{{ $movie->image }}" class="img-circle" alt="Cinque Terre" width="100" height="100">
                </td>
                <td>
                  <div class="col-xs-8">
                    <div class="col-xs-6">
                      <form method="post" name="upd_form{{$movie->id}}" id="upd_form{{$movie->id}}">
                        <input type="hidden" name="identificador" id="identificador" value="{{$movie->id}}">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <button id="tdbe{{$movie->id}}" name="tdbe{{$movie->id}}" type="button" class="btn btn-info"
                          onclick="modificar({{$movie->id}})">
                          <span class="glyphicon glyphicons-edit"></span> Edit
                        </button>
                      </form>
                    </div>
                    <div class="col-xs-6 the-icons">
                      <form method="post" name="del_form{{$movie->id}}" id="del_form{{$movie->id}}">
                        <input type="hidden" name="identificador" id="identificador" value="{{$movie->id}}">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <button id="tdbe{{$movie->id}}" name="tdbe{{$movie->id}}" type="button"
                          class="btn btn-danger" onclick="eliminar({{$movie->id}});">
                          <span class="glyphicon glyphicons-bin"></span> Delete
                        </button>
                      </form>
                  </div>
                </div>
                </td>
             </tr>
             @endforeach
          </tbody>
      </table>
    </div>


    <!--div id = 'msg'>This message will be replaced using Ajax.
   Click the button to replace the message.</div-->
    <button
       type="button"
       class="btn btn-primary btn-lg"
       data-toggle="modal"
       data-target="#favoritesModal">
      Add to Favorites
    </button>

    <div class="modal fade" id="favoritesModal"
         tabindex="-1" role="dialog"
         aria-labelledby="favoritesModalLabel" name="favoritesModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close"
              data-dismiss="modal"
              aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"
            id="favoritesModalLabel">Movie creation</h4>
          </div>
          <div class="modal-body">
            <p>Please complete the information in the movie to add to your favorites list.</p>
          </div>
          <div class="modal-footer">
            <form method="post" id="idForm" name="idForm" class="form-horizontal" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

              <div class="form-group">
                <label class="control-label col-sm-2" for="nombre">Name:</label>
                <div class="col-sm-4">
                  <input type="text" name="nombre" id="nombre">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="descripcion">Description:</label>
                <div class="col-sm-4">
                  <input type="text" name="descripcion" id="descripcion">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="archivo">File</label>
                <div class="col-sm-4">
                   <input type="file" name="archivo" id="archivo">
                </div>
              </div>
              <button type="button"
                 class="btn btn-default"
                 data-dismiss="modal">Close</button>
              <span class="pull-right">
                <button type="button" class="btn btn-primary" onclick="insertar();">
                  Add to Favorites
                </button>
              </span>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modifyModal" tabindex="-1" role="dialog"
         aria-labelledby="favoritesModalLabel" name="modifyModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close"
              data-dismiss="modal"
              aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"
            id="favoritesModalLabel">Modification of movielist</h4>
          </div>
          <div class="modal-body">
            <p>Please confirm the information.</p>
          </div>
          <div class="modal-footer">
            <form method="post" id="updForm" name="updForm" class="form-horizontal" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
              <input type="hidden" name="upd_hid" id="upd_hid">
              <div class="form-group">
                <label class="control-label col-sm-2" for="nombre">Name:</label>
                <div class="col-sm-4">
                  <input type="text" name="upd_nombre" id="upd_nombre">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="descripcion">Description:</label>
                <div class="col-sm-4">
                  <input type="text" name="upd_descripcion" id="upd_descripcion">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="archivo">File</label>
                <div class="col-sm-4">
                   <input type="file" name="upd_archivo" id="upd_archivo">
                </div>
              </div>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <span class="pull-right">
                <button type="button" class="btn btn-primary" onclick="confirmar();">
                  Save changes
                </button>
              </span>
            </form>
          </div>
        </div>
      </div>
    </div>
    </div>
   </body>
</html>
