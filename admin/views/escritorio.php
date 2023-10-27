<?php 
include("conexion.php");

$contar = mysqli_num_rows(mysqli_query($cn,"SELECT * FROM agrupacion"))-2;
$total = mysqli_num_rows(mysqli_query($cn,"SELECT * FROM voto"));
$sql = mysqli_query($cn,"SELECT * FROM agrupacion LIMIT 1,10");

$datosVotos = array();
while($r = mysqli_fetch_array($sql)){
  $id = $r["idagrupacion"];
  $sql2 = mysqli_query($cn,"SELECT idagrupacion, COUNT(idagrupacion) AS votos FROM voto WHERE idagrupacion = $id");
  $r2 = mysqli_fetch_array($sql2);
  
  $cod = $r2["idagrupacion"];
  $votos = $r2["votos"];

  $datosVotos[] = array($cod,$votos); 

}
//tamaño
if($contar == 2){
  $A1 = ($datosVotos[0][1])/1;  $B1 = ($datosVotos[1][1])/1;
  $A2 = ($datosVotos[0][1])/2;  $B2 = ($datosVotos[1][1])/2;
  
  
  $array = array($A1, $A2, $B1, $B2);
  $max = max($array);
  rsort($array);
  $cifrarepar = $array[1];
}
else if($contar = 3){
  $A1 = ($datosVotos[0][1])/1;  $B1 = ($datosVotos[1][1])/1; $C1 = ($datosVotos[2][1])/1;
  $A2 = ($datosVotos[0][1])/2;  $B2 = ($datosVotos[1][1])/2; $C2 = ($datosVotos[2][1])/2;
  $A3 = ($datosVotos[0][1])/3;  $B3 = ($datosVotos[1][1])/3; $C3 = ($datosVotos[2][1])/3;
    
  $array = array($A1, $A2, $A3, $B1, $B2, $B3, $C1, $C2, $C3);
  $max = max($array);
  rsort($array);
  $cifrarepar = $array[1];
}
else if($contar = 4){
  $A1 = ($datosVotos[1][0])/1;  $B1 = ($datosVotos[1][1])/1; $C1 = ($datosVotos[2][1])/1; $D1 = ($datosVotos[3][1])/1;
  $A2 = ($datosVotos[1][0])/2;  $B2 = ($datosVotos[1][1])/2; $C2 = ($datosVotos[2][1])/2; $D2 = ($datosVotos[3][1])/2;
  $A3 = ($datosVotos[1][0])/3;  $B3 = ($datosVotos[1][1])/3; $C3 = ($datosVotos[2][1])/3; $D3 = ($datosVotos[3][1])/3;
  $A4 = ($datosVotos[1][0])/4;  $B4 = ($datosVotos[1][1])/4; $C4 = ($datosVotos[2][1])/4; $D4 = ($datosVotos[3][1])/4;
    
  $array = array($A1, $A2, $A3, $A4, $B1, $B2, $B3, $B4, $C1, $C2, $C3, $C4, $D1, $D2, $D3, $D4);
  $max = max($array);
  rsort($array);
  $cifrarepar = $array[1];
}
//OTROS
ob_start();
session_start();

if (!isset($_SESSION["nombre_usuario"])){
  header("Location: login.php");
}else{
    require_once "../models/Count_voto.php";
    $BDobj = new Count_voto();
    $rspta_persona = $BDobj->listar_persona();
    $row_count_persona=$rspta_persona->fetch_object();

    $rspta_voto = $BDobj->listar_voto();
    $row_count_voto=$rspta_voto->fetch_object();
    $count_voto=$row_count_voto->idvoto;


    $rspta_ie = $BDobj->listar_ie();
    $row_count_ie=$rspta_ie->fetch_object();

    $rspta_voto_lista = $BDobj->voto_lista();
    $fetch=$rspta_voto_lista->fetch_object();

    if ( $count_voto!=0) {
        $acts_proc=($count_voto)*100/( $count_voto);
    }else{
        $acts_proc=0;
    }
   
    $poblacion_nopart=($row_count_persona->idpersona)-$row_count_voto->idvoto;

    $rspta_agrupacion = $BDobj->listar_agrupacion();


    $rspta_listar_mesa = $BDobj->listar_mesas();
    $row_count_mesas=$rspta_listar_mesa->fetch_object();
    $total_mesa=0;
    $total_mesa= $row_count_mesas->total_mesa;
  require 'header.php';
?>

<style>
#chartdiv {
  width: 100%;
  height: 260px;
}

#chartdiv_pie {
  width: 100%;
  height: 250px;
}

.bg-primary{
    background-color:#E9E9E9 !important;
}

.table-bordered td{
    border:0.5px solid #ddd;
}
.card h5{
    font-size: 14px;
}
.card{
    box-shadow: 0 0px 0px rgba(0, 0, 0, 0.05);

}
.card-block-big{
    padding:1.2em;
}

/*.large-widget-card{
    border:0px;
}*/

</style>

<!-- Default card start -->
<div class="row" > 
                                    <div class="col-md-12 col-xl-12" >
                                        <div class="card table-card widget-primary-card" >
                                            <div class="row-table" >
                                                <div class="col-sm-12 card-block-big" style="border-left: #8AA3C2 13px solid; background-color: #3E679B;  ">
                                                     <h6 align="left">Resultado de Elecciones Municipio Escolar <?php echo $row_count_ie->anio; ?></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                        <div class="col-sm-8">
                                            <div class="card large-widget-card">
                                                <div class="">
                                                    <div class="card-footer" style="background-color: #E9E9E9;padding-bottom:  0px; padding-top: 0px; padding-left: -20px;font-size: 10px; margin-left: -6px; margin-right: -5px;">
                                                        <div class="row text-center">
                                                            <div class="col-sm-4" style="border-left: #8AA3C2 13px solid; border-top: #8AA3C2 0.5px solid;border-bottom: #8AA3C2 0.5px solid; background-color: #fff; color:#000; ">
                                                                <div class="social-media" align="left">
                                                                    
                                                                    <p><h5 style="color:#000;"><?php echo $row_count_ie->nombre; ?></h5><br>Resultado Elecciones Municipio Escolar</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-2" style="border-left: #8AA3C2 0.5px solid;border-top: #8AA3C2 0.5px solid; background-color: #fff;border-bottom: #8AA3C2 0.5px solid;padding-left: 0px;padding-right: 0px;">
                                                                <div class="social-media">
                                                                    
                                                                    <p><h5 style="color:#000;"><?php echo $row_count_persona->idpersona; ?></h5><br>Electores Hábiles</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-2" style="border-left: #8AA3C2 0.5px solid;border-top: #8AA3C2 0.5px solid; background-color: #fff;border-bottom: #8AA3C2 0.5px solid;padding-left: 0px;padding-right: 0px;">
                                                                <div class="social-media">
                                                                    
                                                                    <p><h5 style="color:#000;"><?php echo $row_count_voto->idvoto; ?></h5><br>Participación Estudiantil</p>
                                                                </div>
                                                            </div>
                                                             <div class="col-sm-2" style="border-left: #8AA3C2 0.5px solid;border-top: #8AA3C2 0.5px solid; background-color: #fff;border-bottom: #8AA3C2 0.5px solid; padding-left: 0px;padding-right: 0px;">
                                                                <div class="social-media">
                                                                    
                                                                    <p><h5 style="color:#000;"><?php echo round(($count_voto*100)/$row_count_persona->idpersona); ?> %</h5><br>(%) Participación Estudiantil</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-2" style="border-left: #8AA3C2 0.5px solid;border-top: #8AA3C2 0.5px solid; background-color: #3E679B;color:#fff;border-bottom: #8AA3C2 0.5px solid;border-right:  #8AA3C2 0.5px solid;padding-left: 0px;padding-right: 0px;">
                                                                <div class="social-media">
                                                                    
                                                                    <p><h5 style="color:#fff;"><?php echo $acts_proc; ?> %</h5><br>Votos Procesados</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card large-widget-card">
                                                <div class="">
                                                    <div id="chartdiv" class="row-table" style="border: #8AA3C2 0.5px solid; background-color: #fff"></div>
                                                </div>
                                            </div>
                                            <div class="card large-widget-card">
                                                <div class="">
                                                    <div class="card-footer" style="background-color: #E9E9E9;padding-bottom:  0px; padding-top: 0px; padding-left: -20px;font-size: 10px; margin-left: -6px; margin-right: -5px;">
                                                        <div class="row text-center">
                                                            <div class="col-sm-4" style="border-left: #8AA3C2 13px solid; border-top: #8AA3C2 0.5px solid;border-bottom: #8AA3C2 0.5px solid; background-color: #fff; color:#000; ">
                                                                <div class="social-media" align="left">
                                                                    
                                                                    <p><h5 style="color:#000;"><?php echo $row_count_ie->nombre; ?></h5><br>Resultado Elecciones Municipio Escolar</p>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-sm-2" style="border-left: #8AA3C2 0.5px solid;border-top: #8AA3C2 0.5px solid; background-color: #3E679B;color:#fff;border-bottom: #8AA3C2 0.5px solid;border-right:  #8AA3C2 0.5px solid;padding-left: 0px;padding-right: 0px;">
                                                                <div class="social-media">
                                                                    
                                                                    <p><h5 style="color:#fff;"><?php echo round($cifrarepar,2); ?></h5><br>Cifra Repartidora</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card  large-widget-card" style="background-color: #E9E9E9;">
                                                <div class="table-responsive" >
                                                    
                                                
                                                <table id="" class="table table-bordered table-striped" style="background-color: #fff; font-size: 1em;">
                                                        <tr>
                                                            <td></td>
                                                            <td><b>LISTAS PARTICIPANTES</b></td>
                                                            <td><b>TOTAL</b></td>
                                                            <td><b>N° REGIDORES</b></td>
                                                            <td><b>% VOTOS EMITIDOS</b></td>
                                                        </tr>

                                                        <?php 
                                                         $total_voto_agrupacion=0;
                                                         $total_porc=0;
                                                            while ($row_count_agrupacion= $rspta_agrupacion->fetch_object()) {
                                                                     $idlistaragrupacion=$row_count_agrupacion->idagrupacion;
                                                                     $nombreagrupacion=$row_count_agrupacion->lista;
                                                                     $logo=$row_count_agrupacion->logo;

                                                                    echo '
                                                                    <tr>
                                                                        <td class="center"><img src="../resource/files/lista/'.$logo.'" alt="" width="30px" height="30px"></td>
                                                                        <td>'.$nombreagrupacion.'</td>';
                                                                        if ($fetch=='0') {
                                                                           echo '<td>0</td>
                                                                                <td>0 %</td>';
                                                                        }else{
                                                                    echo '<td>';
                                                                                foreach ($rspta_voto_lista as $r) {
                                                                                      $idagrupacion= $r['idlistaragrupacion'];
                                                                                      $total_voto_agrupacion= $r['total_voto_agrupacion'];

                                                                                      if ($idlistaragrupacion==$idagrupacion) {
                                                                                        echo $total_voto_agrupacion;
                                                                                     }else{
                                                                                        echo "";
                                                                                     }



                                                                                    }

                                                                     echo '</td>
                                                                        <td>';
                                                                        
                                                                          $sql4 = mysqli_query($cn,"SELECT idagrupacion, COUNT(idagrupacion) AS votos FROM voto WHERE idagrupacion = $idlistaragrupacion");

                                                                          $ganador = mysqli_query($cn,"SELECT v.idagrupacion, COUNT(v.idagrupacion) AS votos FROM voto v, agrupacion a WHERE v.idagrupacion = a.idagrupacion GROUP BY v.idagrupacion ORDER BY votos DESC LIMIT 0,1");
                                                                          $rganador = mysqli_fetch_array($ganador);
                                                                          
                                                                          $r4 = mysqli_fetch_array($sql4);

                                                                          if($r4["idagrupacion"]==$rganador["idagrupacion"])
                                                                          {
                                                                            echo "5";
                                                                          }
                                                                          else{
                                                                            if($r4["idagrupacion"]==1){
                                                                              echo "0 (0)";
                                                                            }
                                                                            else{
                                                                              $escanos = ($r4["votos"])/$cifrarepar; 
                                                                              echo (int)$escanos.' ('.round($escanos,2).')';
                                                                            }                                                                            
                                                                          }
                                                                          
                                                                        echo '</td>
                                                                        <td>';
                                                                            foreach ($rspta_voto_lista as $row_porc) {
                                                                                      $idagrupacion_porc=  $row_porc['idlistaragrupacion'];
                                                                                      $total_voto_agrupacion=  $row_porc['total_voto_agrupacion'];
                                                                                      
                                                                                         if ($idlistaragrupacion==$idagrupacion_porc) {
                                                                                        $total_porc=round(($total_voto_agrupacion*100)/$count_voto);
                                                                                            echo $total_porc.' %';
                                                                                     }else{
                                                                                        echo "";
                                                                                     }                                                                           
                                                                                }
                                                                        '</td>';}
                                                                    echo '</tr>
                                                                    ';

                                                                }
                                                         ?>
                                                        <tr>
                                                            <td></td>
                                                            <td>TOTAL DE VOTOS EMITIDOS</td>
                                                            <td><?php echo $count_voto; ?></td>
                                                            <td>7</td>
                                                            <td>100 %</td>
                                                        </tr>
                                                </table>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-sm-4">
                                            <div class="card bg-primary large-widget-card" style="margin-bottom: 0PX; ">
                                                <div class="card table-card widget-primary-card" >
                                                    <div class="row-table" >
                                                        <div class="col-sm-12 card-block-big" style="border-left: #D0B479 13px solid; background-color: #B38320;  ">
                                                           <h6 align="left" style="font-size: 10PX;">PARTICPACIÓN ESTUDIANTIL</h6>
                                                       </div>
                                                   </div>

                                                   <div class="row-table" >
                                                        <div class="col-sm-12 card-block-big" style=" background-color: #FFF; border-left: #8AA3C2 0.5px solid;border-top: #8AA3C2 0.5px solid; background-color: #fff;border-bottom: #8AA3C2 0.5px solid; ">
                                                           <div id="chartdiv_pie"></div>
                                                       </div>
                                                   </div>

                                               </div>
                                           </div>

                                               <div class="card  large-widget-card" style="background-color: #E9E9E9;" >
                                                             <table id="" class="table table-bordered table-striped" style="background-color: #fff;font-size: 1em;">
                                                                <tr style="background-color: #B38320;color:#fff">
                                                                    <td align="center" colspan="2">INFORMACION REFERENCIAL</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Mesas Instaladas</td>
                                                                    <td><?php echo $total_mesa; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Mesas no Instaladas</td>
                                                                    <td>0</td>
                                                                </tr>
                                                                
                                                              </table>
                                                    
                                                </div>
                                    </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="progress">
                                            <div class="progress-bar progress-xl progress-bar-primary" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>


                                            


<?php include "footer.php";  ?>
<?php  ?>

<script>
am4core.ready(function() {
am4core.useTheme(am4themes_animated);
var chart = am4core.create("chartdiv", am4charts.XYChart);
chart.data = [ 
                <?php 
                foreach ($rspta_voto_lista  as $key ) {
                    $lista= $key['lista'];
                    $total_voto_agrupacion= $key['total_voto_agrupacion'];
                    $logo= $key['logo'];?>
                        { 
                        "name": "<?php echo $lista; ?>",
                        "points":<?php echo $total_voto_agrupacion; ?>,
                        "color": chart.colors.next(),
                        "bullet": "../resource/files/lista/<?php echo $logo;?>"
                        },
                 <?php }  ?>             
            ];

var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "name";
categoryAxis.renderer.grid.template.disabled = true;
categoryAxis.renderer.minGridDistance = 30;
categoryAxis.renderer.inside = true;
categoryAxis.renderer.labels.template.fill = am4core.color("#fff");
categoryAxis.renderer.labels.template.fontSize = 12;

var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.renderer.grid.template.strokeDasharray = "2,2";
valueAxis.renderer.labels.template.disabled = true;
valueAxis.min = 0;

chart.maskBullets = false;

chart.paddingBottom = 0;
var series = chart.series.push(new am4charts.ColumnSeries());
series.dataFields.valueY = "points";
series.dataFields.categoryX = "name";
series.columns.template.propertyFields.fill = "color";
series.columns.template.propertyFields.stroke = "color";
series.columns.template.column.cornerRadiusTopLeft = 15;
series.columns.template.column.cornerRadiusTopRight = 15;
series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/b]";

var bullet = series.bullets.push(new am4charts.Bullet());
var image = bullet.createChild(am4core.Image);
image.horizontalCenter = "middle";
image.verticalCenter = "bottom";
image.dy = -5;
image.y = am4core.percent(100);
image.propertyFields.href = "bullet";
image.tooltipText = series.columns.template.tooltipText;
image.propertyFields.fill = "color";
image.filters.push(new am4core.DropShadowFilter());
chart.exporting.menu = new am4core.ExportMenu();
});
</script>


<script >
am4core.useTheme(am4themes_animated);
var chart = am4core.create("chartdiv_pie", am4charts.PieChart);
chart.data = [{
    "country": "Asistentes",
    "litres": <?php echo $row_count_voto->idvoto; ?>
}, {
    "country": "Ausentes",
    "litres": <?php echo $poblacion_nopart; ?>
}];

var series = chart.series.push(new am4charts.PieSeries());
series.dataFields.value = "litres";
series.dataFields.category = "country";
series.hiddenState.properties.opacity = 1;
series.hiddenState.properties.endAngle = -90;
series.hiddenState.properties.startAngle = -90;

chart.legend = new am4charts.Legend();
</script>

<?php 
}
ob_end_flush();
?>

<script type="text/javascript">
    $('#title-inicio').hide();
    $('#mresultados').addClass("active pcoded-trigger");
    $('#lresultados').addClass("active"); 
</script>