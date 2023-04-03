<?php include('./header.php'); ?>

<script type="text/javascript">
    $( document ).ready(function() {  


     $("#btn_carga").on('click', function() {
      var id = $('#ddl_opcion').val();
      $('#txt_opcion').val(id);
      var fi = $('#file').val();
      if(id != '' && fi != '')
      {

            var formData = new FormData(document.getElementById("form_img"));
            $.ajax({
                url: '../controlador/subir_datosC.php?cargar_activos=true',
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                dataType:'json',             
                success: function(response) {
                  if(response == 1)
                  {
                   cargar_datos();
                  }else
                  {
                    Swal.fire( 'Formato del archivo incorrecto','asegurese que el archivo sea (.xlsx)','error');

                  }
                }
            });
      }else
      {
         Swal.fire( '','Destino o archivo no seleccionados','error');
      }
    });
  });
  
</script>

<script type="text/javascript">
	function cargar_datos(parte=1,partes=0,partes_de=0,total=0)
	{
     var id = $('#ddl_opcion').val();
     var op = $('#rbl_primera').prop('checked');
    // if (parte==1 && id==1 || parte==1 && id==7  || parte==1 && id==8 || parte==1 && id==6  || parte==1 && id==3 )
    //  {
    //   $('#reporte').html('');
      // $('#myModal').modal('show');
    //  }
		 var parametros=
     {
      'parte_actual':parte,
      'partes':partes,
      'partes_de':partes_de,
      'id':id,
      'primera_vez':op,
      'total':total,
      };
		 $.ajax({
         data:  {id:id,parametros:parametros},
         url:   '../lib/actualizar_tablas.php?plantilla_masiv=true',
         type:  'post',
         dataType: 'json',
          success:  function (response) {  

            console.log(response);
            if(response==1)
            {
              $('#loader_').css('width','100%');
             
              Swal.fire('Datos cargados','','success').then(function(){

              $('#pro_partes').html('<b>1/?</b>');
              $('#loader_').css('width','1%');

              });
              $('#myModal').modal('hide');
            }
            console.log(response);
          } 
          
       });
	
                //   $('#myModal').modal('hide');

	}
</script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1 class="m-0 text-dark">Cargar activos</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
      <div class="container-fluid">
      	<div class="row"> 
      		<div class="col-sm-6">
            <form enctype="multipart/form-data" id="form_img" method="post"> 
             <input type="hidden" id="txt_opcion" name="txt_opcion">     
              <input type="file" name="file" id="file" class="form-control">
            </form>
      	    </div>
      	    <div class="col-sm-3">
              <select class="form-control" id="ddl_opcion">
      			    <option value="">Seleccione destino de datos</option>               
      			    <option value="1">Cargar Activos</option>
      		    </select>
              <label><input type="checkbox" name="rbl_primera" id="rbl_primera"> Como primera vez</label>
      	    </div>
      	     <div class="col-sm-3">
      		    <button class="btn btn-primary" id="btn_carga">Actualizar archivos</button>
            </div>
      	</div>
        <div class="row">
          <br>
          <div class="col-sm-12" id="reporte">
            
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div id="cargar">
          <div class="text-center"><img src="../img/de_sistema/loader_puce.gif" width="100" height="100">SUBIENDO DATOS</div>
        </div>
        <div>
           <div class="progress-group" id="loader">
               <span class="progress-number" id="pro_partes"><b>1/?</b></span><div class="progress sm"><div class="progress-bar progress-bar-aqua" style="width: 1%" id="loader_"></div></div>
           </div>
        </div>        
      </div>      
    </div>
  </div>
</div>

<?php include('./footer.php'); ?>
