
<!DOCTYPE html>
<html lang="en">

<head> 
    <title>VOTO ELECTRÓNICO</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Phoenixcoded">
    <meta name="keywords" content=", Flat ui, Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="Phoenixcoded">
    <!-- Favicon icon -->
    <link rel="icon" href="../resource/assets/images/insigniaRG.png" type="image/x-icon">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="../resource/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="../resource/assets/icon/themify-icons/themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="../resource/assets/icon/icofont/css/icofont.css">
    <!-- flag icon framework css -->
    <link rel="stylesheet" type="text/css" href="../resource/assets/pages/flag-icon/flag-icon.min.css">
    <!-- Menu-Search css -->
    <link rel="stylesheet" type="text/css" href="../resource/assets/pages/menu-search/css/component.css">

    <link rel="stylesheet" href="../resource/bower_components/select2/dist/css/select2.min.css" />


    <!--forms-wizard css-->
    <link rel="stylesheet" type="text/css" href="../resource/bower_components/jquery.steps/demo/css/jquery.steps.css">


    <link rel="stylesheet" type="text/css" href="../resource/bower_components/sweetalert/dist/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="../resource/others/galeria/jquery.lighter.css">

    <link rel="stylesheet" type="text/css" href="../resource/others/jquery-uiV1.12/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="../resource/others/ThemeRoller/css/dataTables.jqueryui.min.css">
    <link rel="stylesheet" type="text/css" href="../resource/others/ThemeRoller/css/responsive.dataTables.min.css">

    
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="../resource/assets/css/style.css">
    <!--color css-->
    <link rel="stylesheet" type="text/css" href="../resource/assets/css/color/color-1.css" id="color"/>
    <link rel="stylesheet" type="text/css" href="../resource/assets/css/linearicons.css" >
    <link rel="stylesheet" type="text/css" href="../resource/assets/css/simple-line-icons.css">
    <link rel="stylesheet" type="text/css" href="../resource/assets/css/ionicons.css">
    <link rel="stylesheet" type="text/css" href="../resource/assets/css/jquery.mCustomScrollbar.css">
</head>
<!-- Menu sidebar static layout -->
<body>
        <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div></div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            <nav class="navbar header-navbar pcoded-header" header-theme="theme4">
                <div class="navbar-wrapper">
                    <div class="navbar-logo">
                        <a class="mobile-menu" id="mobile-collapse" href="#!">
                            <i class="ti-menu"></i>
                        </a>
                        <a class="mobile-search morphsearch-search" href="#">
                            <i class="ti-search"></i>
                        </a>
                        <a href="#">
                           <H3>intranet</H3>
                        </a>
                        <a class="mobile-options">
                            <i class="ti-more"></i>
                        </a>
                    </div>
                    <div class="navbar-container container-fluid">
                        <div>
                            <ul class="nav-left">
                                <li>
                                    <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
                                </li>
                                
                                <li>
                                    <a href="#!" onclick="javascript:toggleFullScreen()">
                                        <i class="ti-fullscreen"></i>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav-right">
                                
                                <li class="header-notification">
                                    <a href="#!">
                                        <i class="ti-bell"></i>
                                        <?php 
                                            require_once "../models/Count_voto.php";
                                            $BDobj = new Count_voto();
                                            $rspta = $BDobj->voto_lista();

                                            $rspta_voto = $BDobj->listar_voto();
                                            $row_count_voto=$rspta_voto->fetch_object();
                                            $count_voto=$row_count_voto->idvoto;

                                            echo '<span class="badge">'.$count_voto.'</span>';

                                         ?>
                                        
                                    </a>
                                    <ul class="show-notification">
                                        <li>
                                            <h6>Notificaciones</h6>
                                            <label class="label label-danger">Nueva</label>
                                        </li>

                                        <?php 
                                            
                                            while ($reg=$rspta->fetch_object()) {
                                                echo '<li>
                                            <div class="media">
                                                <img class="d-flex align-self-center" src="../resource/files/lista/'.$reg->logo.'" alt="Generic placeholder image">
                                                <div class="media-body">
                                                    <h5 class="notification-user">'.$reg->lista.'</h5>
                                                    <p class="notification-msg">'.$reg->alcalde.'</p>
                                                    <span class="notification-time">'.$reg->total_voto_agrupacion.' votos</span>
                                                </div>
                                            </div>
                                        </li>';


                                            }

                                         ?>
                                        


                                    </ul>
                                </li>
                                
                                <li class="user-profile header-notification">
                                    <a href="#!">
                                        <img src="../resource/assets/images/user.png" alt="User-Profile-Image">
                                        <span><?php echo $_SESSION["nombre_usuario"] ?></span>
                                        <i class="ti-angle-down"></i>
                                    </a>
                                    <ul class="show-notification profile-notification">
                                        <li>
                                            <a href="../controllers/usuario.php?op=salir">
                                                <i class="ti-layout-sidebar-left"></i> Cerrar
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <!-- search -->
                            <div id="morphsearch" class="morphsearch">
                                <form class="morphsearch-form">
                                    <input class="morphsearch-input"  type="search" placeholder="Search..." />
                                    <button class="morphsearch-submit" type="submit">Search</button>
                                </form>
                                
                                <!-- /morphsearch-content -->
                                <span class="morphsearch-close"><i class="icofont icofont-search-alt-1"></i></span>
                            </div>
                            <!-- search end -->
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Sidebar inner chat start-->

            <!-- Sidebar inner chat end-->
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <nav class="pcoded-navbar" pcoded-header-position="relative">
                        <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
                        <div class="pcoded-inner-navbar main-menu">
                            <div class="">
                                <div class="main-menu-header">
                                    <img class="img-40" src="../resource/assets/images/user.png" alt="User-Profile-Image">
                                    <div class="user-details">
                                        <span><?php echo "Bienvenido: ".$_SESSION["nombre_usuario"] ?></span>
                                        <!--<span id="more-details"><?php echo $_SESSION["login"] ?><i class="ti-angle-down"></i></span>-->
                                    </div>
                                </div>
                                <div class="main-menu-content">
                                    <ul>
                                        <li class="more-details">
                                            <a href="../controllers/usuario.php?op=salir"><i class="ti-layout-sidebar-left"></i>Salir</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation" menu-title-theme="theme5" >MENU PRINCIPAL</div>
                            <ul class="pcoded-item pcoded-left-item">

                                <li class="pcoded-hasmenu" id="mresultados">
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="ti-home"></i></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Escritorio</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                    <ul class="pcoded-submenu" id="mescritorio">
                                        <li class="" id="lresultados">
                                            <a href="escritorio.php">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.dash.default">Inicio</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                       
                                    </ul>
                                </li>


                                <li class="pcoded-hasmenu" id="mconfiguracion">
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="ti-settings"></i></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Configuraciones</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class="" id="lIe">
                                            <a href="ie.php">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.dash.default">I.E</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class="" id="lfecha_apertura">
                                            <a href="apertura.php" >
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.dash.default">Fecha Apertura</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class="" id="lacta_electoral">
                                            <a href="actaelectoral.php" >
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.dash.default">Acta Electoral</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class="" id="lusuario">
                                            <a href="usuario.php">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.dash.default">Usuario</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class=" " id="magrupacion">
                                    <a href="agrupacion.php" data-i18n="nav.form-masking.main">
                                        <span class="pcoded-micon"><i class="ti-layout-list-thumb"></i></span>
                                        <span class="pcoded-mtext">Listas</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li  class="pcoded-hasmenu" id="mpadron">
                                    <a href="javascript:void(0)" data-i18n="nav.form-masking.main">
                                        <span class="pcoded-micon"><i class="ti-calendar"></i></span>
                                        <span class="pcoded-mtext">Padron Electoral</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class="" id="lpadron">
                                            <a href="padron.php">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.dash.default">Listado Padron</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    </ul>

                                </li>

                                <li class="pcoded-hasmenu" id="mvotos">
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="ti-home"></i></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Votos</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class="" id="lvotos">
                                            <a href="resultados.php">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.dash.default">Listado Votos</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="pcoded-hasmenu" id="mreportes">
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="ti-bar-chart"></i></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Reportes</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class="" id="lconsolidado">
                                            <a href="reporte_end.php">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.dash.default">Consolidado</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class="" id="lmesa">
                                            <a href="reporte_mesa.php">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.dash.default">Mesa</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class="" id="lpadron_mesa">
                                            <a href="reporte_padron.php">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.dash.default">Padron</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class=" ">

                                    <a href="https://www.facebook.com/richardalanyachavez" target="_blank" data-i18n="nav.widget.main">
                                    <span class="pcoded-micon"><i class="icofont icofont-info"></i></span>
                                        <span class="pcoded-mtext">Ayuda</span>
                                        
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>                        
                        </div>
                    </nav>
                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body" >
                                <div class="page-wrapper">
                                    <!-- Page header start -->
                                    <div class="page-header" id="title-inicio">
                                        <div class="page-header-title">
                                            <h4></h4>
                                        </div>
                                        <div class="page-header-breadcrumb">
                                            <ul class="breadcrumb-title">
                                                <li class="breadcrumb-item"  id="item-home">
                                                    <a href="escritorio.php">
                                                        <i class="icofont icofont-home"></i>
                                                    </a>
                                                </li>
                                                <li class="breadcrumb-item" id="item-menu">
                                                </li>
                                                <li class="breadcrumb-item" id="item-submenu">
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- Page header end -->
                                    <!-- Page body start -->
                                    <div class="page-body">
                                        <div class="row">
                                            <div class="col-lg-12">