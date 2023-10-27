<?php 
include("../views/conexion.php");

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

require_once "../models/Rpt_votos.php";
$BDobj = new Rpt_votos();

$rspta = $BDobj->listar_agrupacion_voto();
 
$rspta_count = $BDobj->count();
$reg_count=$rspta_count->fetch_object();
$count=$reg_count->total;

$rspta_1 = $BDobj->listar_ie();
$reg_1=$rspta_1->fetch_object();
$nombre=$reg_1->nombre;
$anio=$reg_1->anio;
$logo=$reg_1->logo;
$departamento=$reg_1->departamento;
$provincia=$reg_1->provincia;
$distrito=$reg_1->distrito;


require_once __DIR__ . '/../resource/others/dompdf/vendor/autoload.php';

use Dompdf\Dompdf;
$dompdf = new Dompdf();


$html="";
$html.='
<link rel="stylesheet" href="styles.css">
<table  class="tbl_report " >
        <tr>
            <td class="border" width="100%" style="padding: 10px;">

    <table  class="tbl_report" align="">
        <tr>
            <td class=" left" rowspan="2" width="70px"><img src="../resource/files/ie/1571748729.png" height="70px" width="70px"> </td>
            <td class=" center"> ELECCION DEL MUNICIPIO ESCOLAR<br>'.$nombre.'</td>
            <td class="" rowspan="2" width="70px" > </td>

        </tr>

        <tr>
            <td class=" center"><b>CONSOLIDADO</b> </td>
        </tr>
    </table>







        <table  class="tbl_report color" style="margin-top: 5px;">
            <tr>
                <td class=" center" colspan="4" style="padding-top: 7px;">ESCRUTINIO</td>
            </tr>
            <tr>
                <td class=" center" colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td class=" center" colspan="4">Cifra Repartidora: '.$cifrarepar.'</td>
            </tr>
            <tr>
                <td class=" center">&nbsp;</td>                 
                <td class=" center">Votos</td>
                <td class=" center">N° Regidores</td>
                <td class=" center">(%)</td>
            </tr>';
 $i = 1;
$suma=0;
while ($reg=$rspta->fetch_object()) {    
                $id=$i;
                $img='<img src="../resource/files/lista/'.$reg->logo.'" height="40px" width="40px" >'; 

$html.=

            '<tr>
                <td class=" center">
                    <table  class="tbl_report color " style="margin-left: 8px;margin-right: 5px; padding-bottom:2px;">
                        <tr>';
            if ($reg->idagrupacion<>1) {
                $sql4 = mysqli_query($cn,"SELECT idagrupacion, COUNT(idagrupacion) AS votos FROM voto WHERE idagrupacion = $reg->idagrupacion");
                $r4 = mysqli_fetch_array($sql4);
                
                $ganador = mysqli_query($cn,"SELECT v.idagrupacion, COUNT(v.idagrupacion) AS votos FROM voto v, agrupacion a WHERE v.idagrupacion = a.idagrupacion GROUP BY v.idagrupacion ORDER BY votos DESC LIMIT 0,1");
                $rganador = mysqli_fetch_array($ganador);

                //$escanos = ($r4["votos"])/$cifrarepar; 
                if($r4["idagrupacion"]==$rganador["idagrupacion"])
                {
                  $mostrar = "5";
                }
                else{
                  if($r4["idagrupacion"]==1){
                    $mostrar = "0 (0)";
                  }
                  else{
                    $escanos = ($r4["votos"])/$cifrarepar; 
                    $mostrar = (int)$escanos.' ('.round($escanos,2).')';
                  }                                                                            
                }
$html.=                  '<td class="color_tab padding-left  left">Lista<br>'.$reg->lista.'</td>
                        <td class="color_tab  center" width="110px">'.$img.'</td>';
                        }else{
$html.=                  '<td class="color_tab padding-left left" colspan="2" height="40px">&nbsp;<br>'.$reg->lista.'</td>';
                        }
 $html.=                '
                        </tr>
                    </table>
                </td>

                <td class=" center">
                    <table  class="tbl_report color " style="margin-right: 5px;">
                        <tr>
                            <td class="color_tab  center" height="40px" style="font-size:18px;color: #2F5AB1;">'.$reg->votos.'</td>
                        </tr>
                    </table>
                </td>';
                if ($reg->idagrupacion<>1) {
                $html.='<td class=" center">
                    <table  class="tbl_report color " style="margin-right: 5px;">
                        <tr>
                            <td class="color_tab  center" height="40px" style="font-size:18px;color: #2F5AB1;">'.$mostrar.'</td>
                        </tr>
                    </table>
                </td>';
                }
                else{
                  $html.='<td class=" center">
                    <table  class="tbl_report color " style="margin-right: 5px;">
                        <tr>
                            <td class="color_tab  center" height="40px" style="font-size:18px;color: #2F5AB1;">0</td>
                        </tr>
                    </table>
                </td>';
                }
                $html.='
                <td class=" center">
                    <table  class="tbl_report color " style="margin-right: 5px;">
                        <tr>
                            <td class="color_tab  center" height="40px" style="font-size:16px;color: #2F5AB1;">'.round(($reg->votos*100)/$count).' %</td>
                        </tr>
                    </table>
                </td>
            </tr>';

 $i++;  
                }



 $html.=       '


            <tr>
                <td class=" center">
                <table  class="tbl_report color " style="margin-left: 8px;margin-right: 5px; padding-bottom:2px;">
                    <tr>
                        <td class="color_tab padding-left  left" height="29px" colspan="2">Total de votos emitidos</td>
                    </tr>
                </table>
                </td>
                <td class=" center">
                    <table  class="tbl_report color " style="margin-right: 5px;">
                    <tr>
                        <td class="color_tab  center" height="29px" style="font-size:18px;color: #2F5AB1;">'.$count.'</td>
                    </tr>
                    </table>
                </td>
                <td class=" center">
                    <table  class="tbl_report color " style="margin-right: 5px;">
                    <tr>
                        <td class="color_tab  center" height="29px" style="font-size:18px;color: #2F5AB1;">7</td>
                    </tr>
                    </table>
                </td>

                <td class=" center">
                    <table  class="tbl_report color " style="margin-right: 5px;">
                    <tr>
                        <td class="color_tab  center" height="29px" style="font-size:18px;color: #2F5AB1;">'.round(($count*100)/$count).' %</td>
                    </tr>
                    </table>
                </td>
            </tr>
        </table>


        <table  class="tbl_report color">
             <tr>
                <td >
                        <table  class="color" >
                        <tr>
                            <td>&nbsp;</td>
                        </tr>

                        </table>
                </td>
            </tr>
        </table>
















<br>';



/*$dompdf->setPaper( array(0,0,247,156));*/
$dompdf->setPaper('A4', 'portrait');
$dompdf ->set_option('defaultFont','Courier');
$dompdf->set_option('isHtml5ParserEnabled', true);
$dompdf->loadHtml($html);
$dompdf->render();
$dompdf->stream('invoice.pdf',array("Attachment"=>false));


 ?>

