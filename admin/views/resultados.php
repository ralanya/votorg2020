<?php 

ob_start();
if (strlen(session_id()) < 1){
    session_start();//Validamos si existe o no la sesión
}

if (!isset($_SESSION["nombre_usuario"])){
  header("Location: login.php");
}else{
 require 'header.php';    ?>
<style >
    .j-wrapper{
        padding: 0px;
    }

    .j-wrapper-640{
        max-width: 100%;
    }
</style>





<div class="card">
    <div class="card-header">
        <span></span>
        <div class="card-header-right">
            <i class="icofont icofont-rounded-down"></i>
            <i class="icofont icofont-refresh"></i>

        </div>
    </div>

    <div class="card-block ">

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                <div class="sub-title">LISTADO DE VOTOS REALIZADOS</div>
                <div class="table-responsive ">
                    <table  id="tbllistado_r"  class="table display compact  table-hover  nowrap" >
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Voto</th>
                                <th>Hora</th>
                                <th>Nombre Apellidos</th>
                                <th><a href="#" id="delsel" onclick="eliminarsel()"><i class="icofont icofont-trash" style="color: red;" data-toggle="tooltip" title="Eliminar"></i></a></i><input type="checkbox" id="checkall">
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>


                </div><br>

            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                <div class="sub-title">LISTADO DE VOTOS FALTANTES</div>

                <div class="table-responsive ">
                    <table  id="tbllistado_f"  class="table display compact  table-hover  nowrap" >
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre Apellidos</th>
                                <th>DNI</th>
                                <th>Grado</th>
                                <th>Seccion</th>
                                <th>Estado Voto</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>


<?php require 'footer.php';    ?>
 <script type="text/javascript" src="scripts/resultados.js"></script>

  <script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });  
    </script>


<?php 
}
ob_end_flush();
?>