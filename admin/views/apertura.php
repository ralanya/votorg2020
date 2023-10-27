<?php 

ob_start();
session_start();

if (!isset($_SESSION["nombre_usuario"])){
  header("Location: login.php");
}else{


include "header.php";  ?>


<div class="card">
    <div class="card-header">
        <span></span>
        <div class="card-header-right">
            <i class="icofont icofont-rounded-down"></i>
            <i class="icofont icofont-refresh"></i>
            
        </div>
    </div>


    <div class="card-block">
        
       <div class="table-responsive">
        <table id="tbllistado" class="table compact  table-bordered nowrap">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Estado</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
</div>

<div class="modal fade" id="default-Modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3e5871; color:#fff">
                <h6 class="modal-title">Modificar Datos</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="formulario" id="formulario" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group input-group-sm input-group-default">
                                <span class="input-group-addon" id="basic-addon8">Fecha Inicio</span>
                                <input type="hidden" id="idapertura" name="idapertura" >
                                <input type="date" class="form-control" id="fecha_star" name="fecha_star">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group input-group-sm  input-group-default">
                                <span class="input-group-addon" id="basic-addon8">Fecha Fin</span>
                                <input type="date" class="form-control" id="fecha_end" name="fecha_end">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger waves-effect" data-dismiss="modal" onclick="cancelarform()"><i class="icofont icofont-ui-close"></i>CANCELAR</button>
                    <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light " id="btnGuardar"><i class="icofont icofont-ui-check"></i> GUARDAR</button>
                </div>
            </form>
        </div>
    </div>
</div>



                                            


<?php include "footer.php";  ?>

 <script type="text/javascript" src="scripts/apertura.js"></script>

<?php 
}
ob_end_flush();
?>