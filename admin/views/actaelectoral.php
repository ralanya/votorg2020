<?php 

ob_start();
session_start();

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

    .txt-input{
        font-size: 12px;
    }

    

    .txt-span{
        font-size: 10px;
    }

    .j-gap-bottom-25{
       margin-bottom: 25px;
    }

    .j-divider{
        border-top: 1px solid red;
        width: 0;
    }


fieldset{
    border:1px solid #ddd !important;
    margin:0;
    xmin-width:0;
    padding: 10px;
    position: relative;
    border-radius: 4px;
    background-color: #f5f5f5;
    padding-left: 10px!important;
    margin-bottom: 7px;
}

legend{
    font-size: 14px;
    font-weight: bold;
    margin-bottom: 0px;
    width: 35%;
    border:1px solid #ddd;
    border-radius: 4px;
    padding: 5px 5px 5px 50px;
    background-color: #ffffff;
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
        </div>


        <div class="table-responsive ">
            <table  id="tbllistado"  class="table display compact  table-hover  nowrap" >
                <thead>
                    <tr>
                        <th>Mesa</th>
                        <th>Fecha </th>
                        <th>Instalación</th>
                        <th>Fin Escrutinio</th>
                        <th>Presidente</th>
                        <th>Secretario</th>
                        <th>Vocal</th>
                        <th>N° Personeros</th>
                        <th><input type="checkbox" id="checkall" > <a href="#" id="delsel" onclick="eliminarsel()"><i class="icofont icofont-ui-delete" style="color: red;" data-toggle="tooltip" title="Eliminar"></i></a> </th>
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
        <form name="formulario" id="formulario" method="POST">
                <div class="modal-body ui-front">
                    
                        <fieldset class="col-lg-12">
                        <legend>Instalación</legend>
                    <div class="row">
                                    <div class="col-sm-3">
                                        <div class="input-group input-group-inverse">
                                            <span class="input-group-addon txt-span">
                                       N° Mesa
                                       </span>
                                       <input type="hidden"  id="idactaelectoral" name="idactaelectoral">
                                       <select class="form-control txt-input" id="mesa" name="mesa" >
                                           
                                        </select>
                                      
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="input-group input-group-inverse">
                                            <span class="input-group-addon">
                                       <i class="icofont icofont-ui-calendar"></i>
                                       </span>
                                            <input type="date" class="form-control txt-input" id="fecha" name="fecha">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="input-group input-group-inverse">
                                            <span class="input-group-addon ">
                                       <i class="icofont icofont-ui-clock"></i>
                                       </span>
                                            <input type="time" class="form-control txt-input" id="horainicio" name="horainicio">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="input-group input-group-inverse">
                                        <span class="input-group-addon ">
                                       <i class="icofont icofont-ui-clock"></i>
                                       </span>
                                            <input type="time" class="form-control txt-input" id="horafin" name="horafin" readonly>
                                        </div>
                                    </div>

                    </div>
                    </fieldset>

                    
                    <fieldset class="col-lg-12">
                        <legend>Personeros</legend>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="input-group input-group-inverse">
                                    <span class="input-group-addon txt-span">Presidente</span>
                                    <input type="hidden" name="idpersonap" id="idpersonap" class="form-control txt-input" >
                                    <input type="text" name="pnombre" id="pnombre" class="form-control txt-input" placeholder="Nombre" >
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="input-group input-group-inverse">
                                    <span class="input-group-addon txt-span">Grado</span>
                                    <input type="text" name="pgrado" id="pgrado" class="form-control txt-input" placeholder="grado" readonly>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="input-group input-group-inverse">
                                    <span class="input-group-addon txt-span">Seccion</span>
                                    <input type="text" name="pseccion" id="pseccion" class="form-control txt-input" placeholder="Seccion" readonly>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="input-group input-group-inverse">
                                    <span class="input-group-addon txt-span">Secretaria</span>
                                    <input type="hidden" name="idpersonas" id="idpersonas" class="form-control txt-input" >
                                    <input type="text" name="snombre" id="snombre" class="form-control txt-input" placeholder="Nombre" >
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="input-group input-group-inverse">
                                    <span class="input-group-addon txt-span">Grado</span>
                                    <input type="text" name="sgrado" id="sgrado" class="form-control txt-input" placeholder="grado" readonly>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="input-group input-group-inverse">
                                    <span class="input-group-addon txt-span">Seccion</span>
                                    <input type="text" name="sseccion" id="sseccion" class="form-control txt-input" placeholder="Seccion" readonly>
                                </div>
                            </div>


                            <div class="col-sm-4">
                                <div class="input-group input-group-inverse">
                                    <span class="input-group-addon txt-span">Vocal</span>
                                    <input type="hidden" name="idpersonav" id="idpersonav" class="form-control txt-input" >
                                    <input type="text" name="vnombre" id="vnombre" class="form-control txt-input" placeholder="Nombre" >
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="input-group input-group-inverse">
                                    <span class="input-group-addon txt-span">Grado</span>
                                    <input type="text" name="vgrado" id="vgrado" class="form-control txt-input" placeholder="grado" readonly>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="input-group input-group-inverse">
                                    <span class="input-group-addon txt-span">Seccion</span>
                                    <input type="text" name="vseccion" id="vseccion" class="form-control txt-input" placeholder="Seccion" readonly>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="input-group input-group-inverse">
                                    <span class="input-group-addon txt-span">Personeros</span>
                                    <input type="number" name="personeros" id="personeros" class="form-control txt-input" placeholder="Cantidad" >
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    
                </div>

                <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger waves-effect " data-dismiss="modal" onclick="cancelarform()">Cancelar</button>
                                                        <button type="submit" id="btnGuardar" name="btnGuardar" class="btn btn-primary waves-effect waves-light ">Guardar</button>
                                                    </div>

            </form>
        </div>
    </div>
</div>



<?php require 'footer.php';    ?>
 <script type="text/javascript" src="scripts/actaelectoral.js"></script>

  <script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });  
    </script>


<?php 
}
ob_end_flush();
?>
