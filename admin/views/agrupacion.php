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

                                <div class="card-block ">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  "  style="border: 1px #D8D8D8 solid; border-radius: 5px; padding-top:5px;padding-bottom: 5px; margin-bottom: 6px;">
                                            <button type="button" class=" btn btn-info btn-round  btn-sm " data-toggle="modal" data-target="#default-Modal"><i class="icofont icofont-ui-add"></i> AGREGAR</button>
                                        </div>


                                        <div class="dt-responsive table-responsive ">
                                            <table  id="tbllistado"  class="table display compact table-striped table-hover table-bordered nowrap" >
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Lista</th>
                                                        <th>Logo</th>
                                                        <th>Alcalde</th>
                                                        <th>Foto</th>
                                                        <th>Teniente Alcalde</th>
                                                        <th>Regidores</th>
                                                        <th>Condicion</th>
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
                    <div class="row">
                        <div class="col-md-12">
                            <div id="wizard">
                                <section>
                                    <form class="wizard-form" id="verticle-wizard" name="verticle-wizard"  method="POST">
                                        <h3> Lista </h3>
                                        <fieldset>
                                            <div class="form-group row">
                                                <div class="col-sm-2 col-lg-4">
                                                    <label for="userName-2" class="block">Nombre *</label>
                                                </div>
                                                <div class="col-sm-8 col-lg-10">
                                                    <input id="idagrupacion" name="idagrupacion" type="hidden">
                                                    <input id="lista" name="lista" type="text" required class="form-control" >
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-2 col-lg-4">
                                                    <label for="email-2" class="block">Logo *</label>
                                                </div>
                                                <div class="col-sm-8 col-lg-10">
                                                    <input id="logo" name="logo" type="file"  class="form-control" onchange="return validarlogo(this)" >
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-sm-5 " align="center">
                                                    <div  style="border: 1px #D8D8D8 solid; border-radius: 5px; margin-top: 5px; padding-top:5px">
                                                      <p align="center">Nuevo logo /<a href="#"  onclick="clearlogo()"> Cancelar </a></p>
                                                      <div id="vistalogo"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-5" align="center" id="mostraractuallogo">
                                                    <div  style="border: 1px #D8D8D8 solid; border-radius: 5px;margin-top: 5px; margin-left: 5px; padding-top:5px;">
                                                      <p align="center">Imagen Actual</p>
                                                      <input type="hidden" name="logoactual" id="logoactual">
                                                      <img src="" width="150px" height="120px"  id="logomuestra">
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <h3> Alcalde </h3>
                                        <fieldset>
                                            <div class="form-group row">
                                                <div class="col-sm-2 col-lg-4">
                                                    <label for="name-2" class="block">Nombre*</label>
                                                </div>
                                                <div class="col-sm-8 col-lg-10">
                                                    <input id="alcalde" name="alcalde" type="text" class="form-control required" >
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-2 col-lg-4">
                                                    <label for="surname-2" class="block">Foto </label>
                                                </div>
                                                <div class="col-sm-8 col-lg-10">
                                                    <input id="foto" name="foto" type="file" class="form-control" onchange="return validarfoto(this)">
                                                </div>
                                           </div>

                                           <div class="form-group row">
                                                <div class="col-sm-5 " align="center">
                                                    <div  style="border: 2px #D8D8D8 solid; border-radius: 5px; margin-top: 5px; padding-top:5px">
                                                      <p align="center">Nueva foto /<a href="#"  onclick="clearfoto()"> Cancelar </a></p>
                                                      <div id="vistafoto"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-5" align="center" id="mostraractualfoto">
                                                    <div  style="border: 2px #D8D8D8 solid; border-radius: 5px;margin-top: 5px; margin-left: 5px; padding-top:5px">
                                                      <p align="center">Imagen Actual</p>
                                                      <input type="hidden" name="fotoactual" id="fotoactual">
                                                      <img src="" width="150px" height="120px"  id="fotomuestra">
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <h3> Regidores </h3>
                                        <fieldset>
                                            <div class="form-group row">
                                                <div class="col-sm-2 col-lg-4">
                                                    <label for="University-2" class="block">Teniente Alcalde(sa)</label>
                                                </div>
                                                <div class="col-sm-8 col-lg-10">
                                                    <input id="teniente_alcalde" name="teniente_alcalde" type="text" class="form-control required">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-2 col-lg-12">
                                                    <label for="Country-2" class="block">Regidor(a) de Educacion, Cultura, Recreacion y Deporte</label>
                                                </div>
                                                <div class="col-sm-8 col-lg-10">
                                                    <input id="regidor_ecrd" name="regidor_ecrd" type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-2 col-lg-12">
                                                    <label for="Country-2" class="block">Regidor(a) de salud y ambiente</label>
                                                </div>
                                                <div class="col-sm-8 col-lg-10">
                                                    <input id="regidor_sa" name="regidor_sa" type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-2 col-lg-12">
                                                    <label for="Country-2" class="block">Regidor(a) de emprendimiento y actividades productivas</label>
                                                </div>
                                                <div class="col-sm-8 col-lg-10">
                                                    <input id="regidor_eap" name="regidor_eap" type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-2 col-lg-12">
                                                    <label for="Country-2" class="block">Regidor(a) de derechos del niño, niña y adolescente</label>
                                                </div>
                                                <div class="col-sm-8 col-lg-10">
                                                    <input id="regidor_dna" name="regidor_dna" type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-2 col-lg-12">
                                                    <label for="Country-2" class="block">Regidor(a) de comunicación y tecnologías de la información</label>
                                                </div>
                                                <div class="col-sm-8 col-lg-10">
                                                    <input id="regidor_cti" name="regidor_cti" type="text" class="form-control">
                                                </div>
                                            </div>
                                        </fieldset>
                                </section>
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

<div class="modal fade" id="default-Regidores" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3e5871; color:#fff">
                <h4 class="modal-title" >REGIDORES </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12 col-lg-12">
                    <h6 class="sub-title" id="titulo" ></h6>
                    <ul class="basic-list">
                        <li class="">
                            <h6>Regidor(a) de Educacion, Cultura, Recreacion y Deporte</h6>
                            <p id="reg1" style="color: blue;" ></p>

                        </li>
                        <li class="">
                            <h6>Regidor(a) de salud y ambiente</h6>
                            <p id="reg2" style="color: blue;"></p>
                        </li>
                        <li class="">
                            <h6>Regidor(a) de emprendimiento y actividades productivas</h6>
                            <p id="reg3" style="color: blue;"></p>
                        </li>
                        <li class="">
                            <h6>Regidor(a) de derechos del niño, niña y adolescente</h6>
                            <p id="reg4" style="color: blue;"></p>
                        </li>
                        <li class="">
                            <h6>Regidor(a) de comunicación y tecnologías de la información</h6>
                            <p id="reg5" style="color: blue;"></p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-round waves-effect " data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<?php require 'footer.php';    ?>
 <script type="text/javascript" src="scripts/agrupacion.js"></script>
  <script>


    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });

    $(document).ready(function() {
        $('[data-toggle="popover"]').popover({
            html: true,
            content: function() {
                return $('#primary-popover-content').html();
            }
        });
    });

    

    </script>


<?php 
}
ob_end_flush();
?>