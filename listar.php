<?php 
ob_start();
session_start();

if (!isset($_SESSION["nombre_v"])){
  header("Location: index.php");
}else{

require 'header.php';
require_once "models/Agrupacion.php";
$BDobj=new Agrupacion();
$rspta = $BDobj->listar();
$rspta_ie = $BDobj->listarie();
$row=$rspta_ie->fetch_object();
$anio=$row->anio;
 
  ?>
<style>
    h4{
        float: center;
    }

       body[themebg-pattern="pattern2"] { background-image: url("admin/resource/assets/images/pattern3.png"); }
  
  img.zoom {
    width: 150px;
    height: 50px;
    -webkit-transition: all .2s ease-in-out;
    -moz-transition: all .2s ease-in-out;
    -o-transition: all .2s ease-in-out;
    -ms-transition: all .2s ease-in-out;
}
 
.transition {
    -webkit-transform: scale(1.8); 
    -moz-transform: scale(1.8);
    -o-transform: scale(1.8);
    transform: scale(1.8);
}

#zoom:hover {
   background-image: url('admin/resource/files/ie/marca.png');
   width: [IMAGE_WIDTH_IN_PIXELS]200px;
   height: [IMAGE_HEIGHT_IN_PIXELS]200px;
}
</style>
<div class="pcoded-wrapper">
    <div class="pcoded-content">
            <div class="pcoded-inner-content">
                    <div class="main-body" >
                            <div class="page-wrapper" style="padding-left: 10px;padding-right: 10px;">
                                    <div class="page-header">
                                        <div class="page-header-title">
                                            <h4>CÉDULA DE VOTACIÓN</h4>
                                        </div>
                                        <div class="page-header-breadcrumb">
                                            <ul class="breadcrumb-title">
                                                <li class="breadcrumb-item" data-toggle="tooltip" title="Regresar Atras"><a href="index.php"><i class="icofont icofont-arrow-left"></i></a>
                                                </li>
                                                <li class="breadcrumb-item">
                                                    <a href="#">
                                                        <i class="icofont icofont-user-suited"></i>
                                                    </a>
                                                </li>
                                                <li class="breadcrumb-item"><a href="#!"><?php echo $_SESSION['nombre_v'] ." ".$_SESSION['apellidos_v'] ?></a>
                                                </li>
                                                <li class="breadcrumb-item"><a href="#!"><?php echo $_SESSION['dni_v'] ?></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
      
                                    <div class="page-body">
                                        <div class="row">
                                            <div class="col-lg-12">

                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 z-depth-0 "  style="border: 3px #D8D8D8 solid; padding:12px; background-color: #fff; ">

                                                    <div class="card widget-chat-box" style="border: 1px #D8D8D8 solid;border-radius: 20px;background-color: #f6f6f6;">
                                                        <div class="card-header" style="border-bottom:0px solid rgba(0,0,0,.125);">
                                                            <div class="row">
                                                                <div class="col-sm-2">
                                                                    <img class="img-fluid"  src="admin/resource/assets/images/circle.png"  style="height: 100%;width: 30%; ">

                                                                </div>
                                                                <div class="col-sm-8 text-center">
                                                                    <h5>
                                                                     ELECCIÓN DEL MUNICIPIO ESCOLAR <?php echo $anio;  ?><br><?php echo $row->nombre; ?>   
                                                                    </h5>
                                                                </div>
                                                                 <div class="col-sm-2 text-right">
                                                                    
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  "  >
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  "  style="border: 1px #D8D8D8 solid;padding-top:5px;padding-bottom: 5px; margin-bottom: 6px; background-color: #d2d4de;margin-top: 15px;">
                                                                        <div class="col-sm-12 text-center">
                                                                            <h6>
                                                                             <strong>Marque con un clic en el botón <button class="btn btn-inverse btn-outline-inverse btn-sm" style="background-color: #fff;"><i class="icofont icofont-tick-mark"></i> Votar</button> que contiene el <br>símbolo de la lista de su preferencia</strong>
                                                                            </h6>
                                                                        </div>
                                                                       </div>
                                                                   </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-block">
                                                            <div class="row">
                                                                <?php 
                                                                    while ($reg=$rspta->fetch_object()){

                                                                        echo '
                                                                            <div class="col-sm-12 col-md-6 col-xl-4" >
                                                                            <div class="card widget-profile-card-2 text-center user-card"  style="margin-bottom:1em;">
                                                                                <div class="card-footer bg-inverse">
                                                                                    <div class="row text-center">
                                                                                        <div class="col-sm-12">
                                                                                            <h5 style="color: #fff">'.$reg->lista.' 
                                                                                            </h5>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="card-block text-center" style="padding-bottom:0rem">
                                                                                    <img class="img-fluid img-responsive" id="zoom" src="admin/resource/files/lista/'.$reg->logo.'"   style=" width:170px; height:170px; border: 4px skyblue solid; border-radius:6px;">
                                                                                    <div style="height:0.5em;"></div>
                                                                                    <h6><b>Alcalde:</b></h6>
                                                                                    <p style="font-size:1.2em;">'.$reg->alcalde.'</p>
                                                                                </div>
                                                                                <div class="card-footer">
                                                                                    <button class="btn btn-inverse btn-square" onclick="confirvoto(\''.$reg->idagrupacion.'\',\''.$_SESSION['idpersona_v'].'\',\''.$reg->lista.'\')"><i class="icofont icofont-tick-mark"></i> Votar</button>
                                                                                </div> 
                                                                            </div>
                                                                        </div>
                                                                        ';

                                                                    }

                                                                 ?>
                                                            </div>
                                                        </div>
                                                    
                                                </div>


                                                </div>


                                            </div>
                                        </div>
                                    </div><!-- page-body -->
                            </div>
                    </div>
            </div>
    </div>
</div>
<?php require 'footer.php';    ?>
 <script type="text/javascript" src="admin/views/scripts/loginvotacion.js"></script>
<script>
$(document).ready(function(){
    $('.zoom').hover(function() {
        $(this).addClass('transition');
    }, function() {
        $(this).removeClass('transition');
    });

});
</script>

 <?php 
}
ob_end_flush();
?>
