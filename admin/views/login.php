<?php 
    require_once "../models/Ie.php";
    $BDobj=new Ie();
    $rspta = $BDobj->listar();
    $row=$rspta->fetch_object();

 ?>
<!DOCTYPE html>
<html lang="en">
    <meta content="text/html;charset=utf-8" http-equiv="content-type"/>
    <head>
        <title>
            Iniciar Sesión | Voto electronico
        </title>
        <meta charset="utf-8"/>
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <link href="../resource/assets/images/insigniaRG.png" rel="icon" type="image/png"/>
        <link href="../resource/others/Login_v1/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../resource/others/Login_v1/fonts/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="../resource/others/Login_v1/vendor/animate/animate.css" rel="stylesheet" type="text/css"/>
        <link href="../resource/others/Login_v1/css/util.css" rel="stylesheet" type="text/css"/>
        <link href="../resource/others/Login_v1/css/main.css" rel="stylesheet" type="text/css"/>
        <link href="../resource/bower_components/sweetalert/dist/sweetalert2.min.css" rel="stylesheet" type="text/css"/>
    </head>
<body>
    <div class="limiter">
            <div class="container-login100">
                <div class="wrap-login100">
                    <div class="login100-pic js-tilt" data-tilt="">
                    <?php echo '<img alt="IMG" width="316px" height="289px" src="../resource/files/ie/'.$row->logo.'">'; ?>
        </div>
<form class="login100-form validate-form" id="frmacceso" method="POST" name="frmacceso" autocomplete="off">
    <span class="login100-form-title">
        ACCESO AL SISTEMA
    </span>
    <div class="wrap-input100 validate-input">
        <input class="input100" id="logina" name="logina" placeholder="Usuario" type="text">
            <span class="focus-input100">
            </span>
            <span class="symbol-input100">
                <i aria-hidden="true" class="fa fa-user">
                </i>
            </span>
        </input>
    </div>
    <div class="wrap-input100 validate-input">
        <input class="input100" id="clavea" name="clavea" placeholder="Password" type="password">
            <span class="focus-input100">
            </span>
            <span class="symbol-input100">
                <i aria-hidden="true" class="fa fa-lock">
                </i>
            </span>
        </input>
    </div>
    <div class="container-login100-form-btn">
        <button class="login100-form-btn" id="btnGuardar" type="submit">
            Acceder
        </button>
    </div>
    <div class="text-center p-t-136">
        <a class="txt2" target="_blank" href="https://racengineerspro.com/">
            Derechos de Autor: RAC ENGINEERS 2021
            <i aria-hidden="true" class="fa fa-long-arrow-right m-l-5">
            </i>
        </a>
    </div>
</form>

    </div>
            </div>
        </div>
<script src="../resource/others/Login_v1/vendor/jquery/jquery-3.2.1.min.js">
</script>
<script src="../resource/bower_components/sweetalert/dist/sweetalert2.min.js" />
</script>
<script src="../resource/others/Login_v1/vendor/tilt/tilt.jquery.min.js" >
</script>


<script data-cf-settings="6f59cafce0969dddb7fd5f97-|49" defer="" src="../resource/others/Login_v1/js/rocket-loader.min.js">
</script>
<script src="../resource/others/Login_v1/js/jquery.validate.min.js">
</script>
<script src="scripts/login.js" type="text/javascript">
</script>

    </body>
</html>
