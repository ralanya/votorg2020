<?php 

ob_start();
session_start();

if (!isset($_SESSION["nombre_usuario"])){
  header("Location: login.php");
}else{
 require 'header_form.php';    ?>
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
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  "  style="border: 1px #D8D8D8 solid; border-radius: 5px; padding-top:5px;padding-bottom: 5px; margin-bottom: 6px;">
            <button type="button" class=" btn btn-info btn-round  btn-sm " data-toggle="modal" data-target="#default-Modal"><i class="icofont icofont-ui-add"></i> AGREGAR</button> 
            <button class="btn btn-sm btn-inverse" data-toggle="modal" data-target="#default-Import"><i class="icofont icofont-database-add"></i>IMPORTAR</button>
        </div>


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
                        <th>Condicion</th>
                        <th><a href="#" id="delsel" onclick="eliminarsel()"><i class="icofont icofont-trash" style="color: red;" data-toggle="tooltip" title="Eliminar"></i></a></i><input type="checkbox" id="checkall">
                        </th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>



<div class="modal fade" id="default-Modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3e5871; color:#fff">
                <h6 class="modal-title" id="modda">Agregar Datos</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- <form name="formulario" id="formulario" method="POST"> -->
                <div class="modal-body">
                    <div class="j-wrapper j-wrapper-640">
                                    <form  method="post" class="j-pro" id="j-pro" name="jpro" enctype="multipart/form-data" novalidate>
                                        <!-- end /.header-->
                                        <div class="j-content">
                                            <!-- start name -->
                                            <div class="j-row">
                                                <div class="j-span6 j-unit">
                                                    <div class="j-input">
                                                        <label class="j-icon-left" for="first_name">
                                                            <i class="icofont icofont-ui-user"></i>
                                                        </label>
                                                        <input type="hidden" id="idpersona" name="idpersona" >
                                                        <input type="text" id="nombre" name="nombre" placeholder="nombre" class="name-group">
                                                    </div>
                                                </div>
                                                <div class="j-span6 j-unit">
                                                    <div class="j-input">
                                                        <label class="j-icon-left" for="last_name">
                                                            <i class="icofont icofont-ui-user"></i>
                                                        </label>
                                                        <input type="text" id="apellidos" name="apellidos" placeholder="apellidos" class="name-group">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end name -->
                                                <div class="j-divider j-gap-bottom-25"></div>
                                            <div class="j-row">
                                                <div class="j-span3 j-unit">
                                                    <div class="j-input">
                                                        <label class="j-icon-left" for="first_name">
                                                            <i class="icofont icofont-id-card"></i>
                                                        </label>
                                                        <input type="text" id="dni" name="dni" placeholder="DNI" class="name-group">
                                                    </div>
                                                </div>
                                                <div class="j-span3 j-unit">
                                                    <div class="j-input">
                                                        <label class="j-icon-left" for="last_name">
                                                            <i class="icofont icofont-layers"></i>
                                                        </label>
                                                        <input type="text" id="grado" name="grado" placeholder="grado" class="name-group">
                                                    </div>
                                                </div>
                                                <div class="j-span3 j-unit">
                                                    <div class="j-input">
                                                        <label class="j-icon-left" for="last_name">
                                                            <i class="icofont icofont-institution"></i>
                                                        </label>
                                                        <input type="text" id="seccion" name="seccion" placeholder="seccion" class="name-group">
                                                    </div>
                                                </div>
                                                <div class="j-span3 j-unit">
                                                    <div class="j-input">
                                                        <label class="j-icon-left" for="last_name">
                                                            <i class="icofont icofont-architecture-alt"></i>
                                                        </label>
                                                        <input type="text" id="mesa" name="mesa" placeholder="N° mesa" class="name-group">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="j-response"></div>
                                        </div>
                                        <!-- end /.content -->
                                        <div class="j-footer">
                                            <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light " id="btnGuardar"><i class="icofont icofont-ui-check"></i> GUARDAR</button>
                                            <button type="button" class="btn btn-sm btn-danger waves-effect m-r-20" data-dismiss="modal" onclick="cancelarform()"> <i class="icofont icofont-ui-close"></i>CANCELAR</button>
                                        </div>
                                    </form>
                                </div>
                </div>
        </div>
    </div>
</div>


<div class="modal fade" id="default-Import" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3e5871; color:#fff">
                <h6 class="modal-title">IMPORTAR CSV</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="formulario_import" id="formulario_import" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <P>SELECCIONE ARCHIVO CON FORMATO .CSV</P>
                            <div class="input-group input-group-sm input-group-default">
                                <span class="input-group-addon" id="basic-addon8">Importar</span>
                                <input type="file" class="form-control" id="fileimport" name="fileimport" onchange="return validarExt(this)" requerid>
                            </div>
                            <div id="resultados"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger waves-effect" data-dismiss="modal" onclick="cancelarImport()"><i class="icofont icofont-ui-close"></i>CANCELAR</button>
                    <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light " id="btnGuardarImport"><i class="icofont icofont-ui-check"></i> IMPORTAR</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php require 'footer.php';    ?>
 <script type="text/javascript" src="scripts/padron.js"></script>
 <script type="text/javascript" src="scripts/import.js"></script>

  <script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });  
    </script>


<?php 
}
ob_end_flush();
?>
