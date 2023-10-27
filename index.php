

<style>
   #cuerpo{
    padding-left: 15rem;
    padding-right: 15rem;
   } 

   body[themebg-pattern="pattern2"] { background: #2092EB; }



</style>
<?php
require_once "models/Agrupacion.php";
$BDobj = new Agrupacion();
$rspta_1 = $BDobj->listarie();
$reg_1=$rspta_1->fetch_object();
$nombre=$reg_1->nombre;
$anio=$reg_1->anio;
$logo=$reg_1->logo;
$departamento=$reg_1->departamento;
$provincia=$reg_1->provincia;
$distrito=$reg_1->distrito;

 require 'header.php';    ?>

<div class="pcoded-wrapper">
    <div class="pcoded-content">
        <div class="pcoded-inner-content">
            <div class="main-body">
                <div class="page-wrapper" style="padding-left: 10px;padding-right: 10px;">
                    <div class="row">
                        <div class="col-lg-3">
                        </div>
                        <div class="col-lg-6">                     
                            <div class="page-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 "  style="border: 3px #D8D8D8 solid; padding:12px; background-color: #fff; ">
                                                <div class="card widget-chat-box" style="border: 1px #D8D8D8 solid;border-radius: 20px;background-color: #f6f6f6;">
                                                    <div class="card-header" style="border-bottom:0px solid rgba(0,0,0,.125);">
                                                        <div class="row">                                                            
                                                            <div class="col-sm-12 text-center mt-3">
                                                                <h3><b>
                                                                 ELECCIÓN DEL MUNICIPIO ESCOLAR <?php echo $anio;  ?><br><?php echo $nombre;  ?>
                                                                </b></h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-block ">
                                                        <div class="row ">
                                                            <div class="col-sm-12 col-md-12 col-xl-12 ">
                                                                <div class="card widget-profile-card-2 text-center user-card " >
                                                                    <div class="card-footer bg-inverse">
                                                                        <div class="row text-center">
                                                                            <div class="col-sm-12 text-center">
                                                                                <h5 style="color: #fff">ACCESO A LA CÉDULA DE VOTACIÓN
                                                                                </h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="card-block text-center">
                                                                        <div class="row">
                                                                            <div class="col-lg-5">
                                                                                <img class="img-fluid"  src="admin/resource/assets/images/votoelectronico.jpg" alt="card-style-1" style="height: 100%;width: 100%; ">
                                                                            </div>
                                                                            <div class="col-lg-7">
                                                                                <form id="formulario" name="formulario" method="post" autocomplete="off">
                                                                                <div class="card-block">
                                                                                    <div class="form-group">
                                                                                        <input type="text" id="dni" name="dni" class="form-control" placeholder="INGRESE DNI" style="font-size: 1.2em; margin-bottom:0.5em" maxlength="8">
                                                                                        <!-- <input type="text" id="dni" name="dni" class="form-control" placeholder="INGRESE CLAVE" style="font-size: 1.2em;" maxlength="20"> -->
                                                                                    </div>                                                                                    
                                                                                </div>
                                                                                <div class="card-footer text-center">
                                                                                    <button type="submit" id="btnGuardar" class="btn btn-success btn-square"><i class="icofont icofont-tick-mark"></i> ACCEDER</button>
                                                                                </div>
                                                                                </form>
                                                                            </div>
                                                                         </div>                                                                     
                                                                        
                                                                    </div>
                                                                </div>                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>
                        <div class="col-lg-3">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require 'footer.php';    ?>
<h6 align="center" style="color:white;">Copyright &copy; <a href="https://racengineerspro.com/" target="_blank" style="color:white;">RAC ENGINEERS</a> - <a href="admin/" style="color: #FFFFFF; background: #E2341F; padding: 0.2em; border-radius:4px;" target="_blank">ADMINISTRAR</a></h6>
 <script type="text/javascript" src="admin/views/scripts/loginvotacion.js"></script>