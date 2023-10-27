<?php 

ob_start();
session_start();

if (!isset($_SESSION["nombre_usuario"])){
  header("Location: login.php");
}else{
 require 'header.php';    ?>

<div class="row">
    <div class="col-sm-4 col-xl-4 m-b-30">
        <select class="js-data-example-ajax col-sm-12 " id="mesa" name="mesa">
        </select>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="card-header-left" >           
            <button class="btn btn-primary btn-sm" onclick="report_mesa_pdf();"><i style="font-size: 14px;" class="icofont icofont-file-pdf"></i>IMPRIMIR ACTA</button>
        </div>
    </div>

    <div class="card-block ">

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                <div class="table-responsive ">
                    <table  id="tbllistado"  class="table display compact  table-hover  nowrap" >
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>DNI</th>
                                <th>Grado</th>
                                <th>Seccion</th>
                                <th>Mesa</th>
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
<script type="text/javascript" src="scripts/rpt_votos_mesa.js"></script>

  <script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    }); 



    </script>


<?php 
}
ob_end_flush();
?>
