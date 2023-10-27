<?php 

ob_start();
session_start();

if (!isset($_SESSION["nombre_usuario"])){
  header("Location: login.php");
}else{
 require 'header.php';    ?>

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
        <table id="tbllistado" class="table compact  table-bordered nowrap ">
            <thead>
                <tr>
                    <th>#</th>
                    <th>IE</th>
                    <th>Ensignia</th>
                    <th>Año</th>
                    <th>Departamento</th>
                    <th>Provincia</th>
                    <th>Distrito</th>
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
                                <span class="input-group-addon" id="basic-addon8">Nombre</span>
                                <input type="hidden" id="idie" name="idie" >
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Digite..">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group input-group-sm  input-group-default">
                                <span class="input-group-addon" id="basic-addon8">Año</span>
                                <input type="text" class="form-control" id="anio" name="anio" placeholder="Digite..">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group input-group-sm input-group-default">
                                <span class="input-group-addon" id="basic-addon8">Departamento</span>
                                <input type="text" class="form-control" id="departamento" name="departamento" placeholder="Digite..">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group input-group-sm  input-group-default">
                                <span class="input-group-addon" id="basic-addon8">Provincia</span>
                                <input type="text" class="form-control" id="provincia" name="provincia" placeholder="Digite..">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group input-group-sm  input-group-default">
                                <span class="input-group-addon" id="basic-addon8">Distrito</span>
                                <input type="text" class="form-control" id="distrito" name="distrito" placeholder="Digite..">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group input-group-sm input-group-default">
                                <span class="input-group-addon" id="basic-addon8">Ensignia</span>
                                <input type="file" class="form-control" id="logo" name="logo" onchange="return validarExt(this)">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 " align="center">
                            <div  style="border: 2px #D8D8D8 solid; border-radius: 5px; margin-top: 5px; padding-top:5px">
                              <p align="center"><a href="#"  onclick="clearimg()"> Cancelar </a></p>
                              <div id="visorArchivo"></div>
                            </div>
                        </div>
                        <div class="col-sm-6" align="center">
                            <div  style="border: 2px #D8D8D8 solid; border-radius: 5px;margin-top: 5px; margin-left: 5px; padding-top:5px">
                              <p align="center">Imagen Actual</p>
                              <input type="hidden" name="imagenactual" id="imagenactual">
                              <img src="" width="150px" height="120px"  id="imagenmuestra">
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

<?php require 'footer.php';    ?>
 <script type="text/javascript" src="scripts/ie.js"></script>

 <?php 
}
ob_end_flush();
?>