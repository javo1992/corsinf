
function activar()
{
	$('#').addClass('Active');
}

function restriccion()
  {
  	var pag = location.href;
    
       $.ajax({
         data:  {pagina:pag},
         url:   '../controlador/loginC.php?restriccion=true',
         type:  'post',
         dataType: 'json',
         /*beforeSend: function () {   
              var spiner = '<div class="text-center"><img src="../../img/gif/proce.gif" width="100" height="100"></div>'     
            $('#tabla_').html(spiner);
         },*/
           success:  function (response) {

              // console.log(response);

           if(response.ver!=0)
           { 
              $('#dba').val(response.dba);
              $('#ver').val(response.ver);
              $('#editar').val(response.editar);                
              $('#eliminar').val(response.eliminar);

              if(response.ver ==1 && response.editar==0)
              {
                $('#btn_editar').hide();
                $('#subir_imagen').hide();
              }
              if(response.ver ==1 && response.eliminar==0)
              {
                $('#btn_eliminar').hide();
              }
              // console.log(mod);
              console.log(response.mod);
              if(response.sistema != mod && response.pag!='index.php')
              {
                 Swal.fire('Se a cambiado de modulo','','info').then(function()
                  {
                     location.href = 'modulos_sistema.php';
                  });
              }
            }else
            {
                if(response.pag!='pagina_error.php')
                {
                    // location.href = 'inicio.php?acc=pagina_error';
                }
            }

          } 
          
       });
  }

   function formato_fecha(date) {
      var formattedDate = new Date(date);
      var d = formattedDate.getDate();
      var m = formattedDate.getMonth();
      m += 1; // javascript months are 0-11
      if (m < 10) {
        m = '0' + m;
      }
      if (d < 10) {
        d = '0' + d;
      }
      var y = formattedDate.getFullYear();
      var Fecha = y + "-" + m + "-" + d;
      console.log(Fecha);
      return Fecha;
    }