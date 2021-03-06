function getToken(){
  return $('#csrf_token').val();
}

function insertar(){
  var forminfo = new FormData($('#idForm')[0]);
  var resultado;
  var datos;
  $.ajax({
     type:'POST',
     url:'/getmsg',
     data: forminfo,
     processData: false,
     contentType: false,
     success:function(data){
        $("#msg").html(data.msg);
        resultado=data.msg;
        datos=resultado.split(",");
        $('#tabla_ajax tr:last').after(
          //'<tr id="tr'+datos[0]+'" name="tr{{$user->id}}">'+
          '<tr id="tr'+datos[0]+'" name="tr'+datos[0]+'">'+
          '<td id="tdn'+datos[0]+'" name="tdn'+datos[0]+'" class="text-center">'+datos[1]+'</td>'+
          '<td id="tdd'+datos[0]+'" name="tdd'+datos[0]+'" class="text-center">'+datos[2]+'</td>'+
          '<td id="tdf'+datos[0]+'" name="tdf'+datos[0]+'" class="text-center">'+
          '<img src="uploads/'+datos[3]+'" class="img-circle" alt="Cinque Terre" width="100" height="100">'+
          '</td>'+
          '<td>'+
          '<div class="col-xs-8">'+
          '<div class="col-xs-6">'+
          '<form method="post" name="upd_form'+datos[0]+'" id="upd_form'+datos[0]+'">'+
          '<input type="hidden" name="identificador" id="identificador" value="'+datos[0]+'">'+
          '<input type="hidden" name="_token" value="'+getToken()+'">'+
          '<button id="tdbe'+datos[0]+'" name="tdbe'+datos[0]+'" type="button" class="btn btn-info"'+
          'onclick="modificar('+datos[0]+')">'+
          '<span class="glyphicon glyphicons-edit"></span> Edit'+
          '</button>'+
          '</form>'+
          '</div>'+
          '<div class="col-xs-6">'+
          '<form method="post" name="del_form'+datos[0]+'" id="del_form'+datos[0]+'">'+
          '<input type="hidden" name="identificador" id="identificador" value="'+datos[0]+'">'+
          '<input type="hidden" name="_token" value="'+getToken()+'">'+
          '<button id="tdbe'+datos[0]+'" name="tdbe'+datos[0]+'" type="button"'+
          'class="btn btn-danger" onclick="eliminar('+datos[0]+');">'+
          '<span class="glyphicon glyphicons-bin"></span> Delete'+
          '</button> </form> </div> </div>'+
          '</td>  </tr>'
          ); //agregar fila x fila
        $('#favoritesModal').modal('hide');
        //alert("Movie successfully added");
     }
  });
}

function eliminar(numero){
  var str = $('#del_form'+numero).serialize();
  $.ajax({
    type:'POST',
    url: '/delmsg',
    data: str,
    success: function(data){
        //$("#msg").html(data.msg);
        $('#tabla_ajax tr#tr'+numero).remove();
        //alert("movie successfully delete");
    }
  });
}

function modificar(numero){
  var str = $('#upd_form'+numero).serialize();
  var resultado;
  var datos;
  $.ajax({
    type:'POST',
    url: '/findmsg',
    data: str,
    success: function(data){
        $("#msg").html(data.msg);
        resultado=data.msg;
        datos=resultado.split(",");
        $('#modifyModal').modal('show');
        $('#upd_hid').val(datos[0]);
        $('#upd_nombre').val(datos[1]);
        $('#upd_descripcion').val(datos[2]);
    }
  });
}

function confirmar(){
  var forminfo = new FormData($('#updForm')[0]);
  var resultado;
  var datos;
  $.ajax({
     type:'POST',
     url:'/updmsg',
     data: forminfo,
     processData: false,
     contentType: false,
     success:function(data){
        $("#msg").html(data.msg);
        resultado=data.msg;
        datos=resultado.split(",");
        $('<td id="tdn'+datos[0]+'" name="tdn'+datos[0]+'" class="text-center">'+datos[1]+'</td>').replaceAll( "#tdn"+datos[0] );
        $('<td id="tdd'+datos[0]+'" name="tdd'+datos[0]+'" class="text-center">'+datos[2]+'</td>').replaceAll( "#tdd"+datos[0] );
        if (datos[3]!=""){
          $('<td id="tdf'+datos[0]+'" name="tdf'+datos[0]+'" class="text-center"><img src="uploads/'+datos[3]+'" class="img-circle" alt="Cinque Terre" width="100" height="100"></td>').replaceAll( "#tdf"+datos[0] );
        }
        document.getElementById("upd_archivo").value = "";
        $('#modifyModal').modal('hide');
     }
  });
}
