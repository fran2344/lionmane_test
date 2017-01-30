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
        resultado=data.msg;
        datos=resultado.split(",");
        $('#tabla_ajax tr:last').after('<tr><td class="text-center">'+datos[0]+'</td><td class="text-center">'+datos[1]+'</td><td class="text-center">'+datos[2]+'</td></tr>');
        alert("Movie successfully added");
     }
  });
}
