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
             @foreach ($users as $user)
             <tr id="tr{{$user->id}}" name="tr{{$user->id}}">
                <td class="text-center">{{ $user->name }}</td>
                <td class="text-center">{{ $user->description }}</td>
                <td class="text-center">
                  <img src="uploads/{{ $user->image }}" class="img-circle" alt="Cinque Terre" width="100" height="100">
                </td>
                <td>
                  <div class="col-xs-8">
                    <div class="col-xs-6">
                      <form method="post">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <button type="button" class="btn btn-info" onclick="insertar();">
                          <span class="glyphicon glyphicons-edit"></span> Edit
                        </button>
                      </form>
                    </div>
                    <div class="col-xs-6">
                      <form method="post" name="del_form{{$user->id}}" id="del_form{{$user->id}}">
                        <input type="hidden" name="identificador" id="identificador" value="{{$user->id}}">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <button type="button" class="btn btn-danger" onclick="eliminar({{$user->id}});">
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


    <div id = 'msg'>This message will be replaced using Ajax.
   Click the button to replace the message.</div>
    <button
       type="button"
       class="btn btn-primary btn-lg"
       data-toggle="modal"
       data-target="#favoritesModal">
      Add to Favorites
    </button>

    <div class="modal fade" id="favoritesModal"
         tabindex="-1" role="dialog"
         aria-labelledby="favoritesModalLabel" id="clase_modal" name="clase_modal">
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
            <p>
            Please complete the information in the movie to add to your favorites list.
            </p>
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

   </body>
</html>
