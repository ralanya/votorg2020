<?php 

require_once "../models/Rpt_votos.php";
$BDobj = new Rpt_votos();
$mesa=$_REQUEST["mesa"];

$rspta = $BDobj->listar_agrupacion_voto();

$rspta_count = $BDobj->total_votos_mesa($mesa);
$reg_count=$rspta_count->fetch_object();
$count=$reg_count->votos_mesa;


$consulta = $BDobj->listar_contador($mesa);

$query = $BDobj->listar_acta($mesa);
$row=$query->fetch_object();


$mesa_vot=$row->mesa_ac;
$fecha=$row->fecha;
$horainicio=$row->horainicio;
$personeros=$row->personeros;
$nombrep=$row->nombrep;
$apellidosp=$row->apellidosp;
$gradop=$row->gradop;
$seccionp=$row->seccionp;
$nombres=$row->nombres;
$apellidoss=$row->apellidoss;
$grados=$row->grados;
$seccions=$row->seccions;
$nombrev=$row->nombrev;
$apellidosv=$row->apellidosv;
$gradov=$row->gradov;
$seccionv=$row->seccionv;




$rspta_1 = $BDobj->listar_ie();
$reg_1=$rspta_1->fetch_object();
$nombre=$reg_1->nombre;
$anio=$reg_1->anio;
$logo=$reg_1->logo;
$departamento=$reg_1->departamento;
$provincia=$reg_1->provincia;
$distrito=$reg_1->distrito;



require_once __DIR__ . '/../resource/others/domPdf/vendor/autoload.php';

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
            <td class=" center"><b>ACTA ELECTORAL</b> </td>
        </tr>
    </table>


    <table  class="tbl_report" align="">
        <tr>
            <td class=" left" width="6%">Fecha:</td>
            <td class=" center color_input" colspan="2">'.$fecha.'</td>
            <td class=" center">&nbsp;</td>
            <td class=" center">&nbsp;</td>

            <td class=" center">&nbsp;</td>
            <td class=" center">&nbsp;</td>
            
            <td class=" right">Mesa N°:</td>
            <td class=" center color_input" colspan="2">'.$mesa_vot.'</td>

        </tr>
    </table>

    <table  class="tbl_report color" style="margin-top: 5px;">
        <tr>
            <td class=" center pd_titulo border_left" width="50%" >INSTALACION</td>
            <td class=" center pd_titulo"  width="50%">SUFRAGIO</td>
        </tr>
        <tr>
            <td class="center border_left">
                <table  class="tbl_report  color" style="margin-bottom: 10px;margin-top: 5px; margin-right: 5px;margin-left: 5px;">
                    <tr>
                        <td class=" left" width="170px">Hora de instalación<br> de la mesa:</td>
                        <td class=" center color_input " width="100px" >'.$horainicio.'</td>
                    
                    </tr>
                </table>
            </td>
 

            <td class="center">
                <table  class="tbl_report color" style="margin-bottom: 10px;margin-top: 5px; margin-right: 10px;margin-left: 5px;">
                    <tr>
                        <td class=" left" width="195px">Cantidad de alumnos que votaron<br>(Número de firmas en el padrón):</td>
                        <td class=" center color_input ">'.$count.'</td>

                    </tr>
                </table>
            </td>
        </tr>
    </table>


        <table  class="tbl_report color" style="margin-top: 5px;">
            <tr>
                <td class=" center" colspan="2" style="padding-top: 7px;">ESCRUTINIO</td>
            </tr>
            <tr>
                <td class=" center" colspan="2">&nbsp;</td>
            </tr>

            <tr>
                <td class=" center">&nbsp;</td>
                
                <td class=" center">Votos</td>
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
                            <td class="color_tab  center" height="40px">';

                            foreach ($consulta as $key) {
                                $item= 0;
                                $item=  $key['item'];

                                if ($reg->idagrupacion==$item) {
                               $html.= $key['votosa'];
                                }elseif ($item==null) {
                                   $html.='0';
                                }  else{
                                    $html.='';
                                }
                            }
                 $html.=  '</td>
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
                        <td class="color_tab  center" height="29px">'.$count.'</td>
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



        <table  class="tbl_report color font_s" >
        <tr>
            <td class=" center" >_______________________________<br> Presidente de mesa</td>
            <td class=" center" >_______________________________<br> Secretario(a) de mesa</td>
            <td class=" center" >_______________________________<br> Vocal de mesa</td>
        </tr>
        </table>

<table  class="tbl_report color" >
        <tr>
            <td >
        <table  class="tbl_report color font_s"  style="margin-left:6px;">
        <tr>
            <td class="left"  width="90px">Nombres y apellidos: </td>
            <td class="left dashed" width="70px;" style="color:#0E77D0;">'.$nombrep.'</td>
            <td class="left" width="16px;">&nbsp;</td>
            
            <td class="left" width="90px" >Nombres y apellidos: </td>
            <td class="left dashed" width="70px;" style="color:#0E77D0;">'.$nombres.'</td>
            <td class="left" width="16px;">&nbsp;</td>

            <td class="left" width="90px" >Nombres y apellidos: </td>
            <td class="left dashed" width="70px;" style="color:#0E77D0;">'.$nombrev.'</td>
            <td class="left" >&nbsp;</td>
        </tr>

        <tr>
            <td class="left dashed" colspan="2"  width="90px" style="color:#0E77D0;">'.$apellidosp.'</td>
            <td class="left" width="16px;">&nbsp;</td>
            
            <td class="left dashed" colspan="2"  width="90px" style="color:#0E77D0;">'.$apellidoss.'</td>
            <td class="left" width="16px;">&nbsp;</td>

            <td class="left dashed" colspan="2"  width="90px" style="color:#0E77D0;">'.$apellidosv.'</td>
            <td class="left" >&nbsp;</td>
        </tr>

        <tr>
            <td class="left"  width="90px">Grado/seccion: </td>
            <td class="left dashed" width="70px;" style="color:#0E77D0;">'.$gradop.' "'.$seccionp.'"</td>
            <td class="left" width="16px;">&nbsp;</td>
            
            <td class="left" width="90px" >Grado/seccion: </td>
            <td class="left dashed" width="70px;" style="color:#0E77D0;">'.$grados.' "'.$seccions.'"</td>
            <td class="left" width="16px;">&nbsp;</td>

            <td class="left" width="90px" >Grado/seccion: </td>
            <td class="left dashed" width="70px;" style="color:#0E77D0;">'.$gradov.' "'.$seccionv.'"</td>
            <td class="left" >&nbsp;</td>
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


        <table  class="tbl_report color">
             <tr>';
              $w=0;
              $i=1;

              for(; ;){
                if ($i>$personeros) {
                    break;
                }             
$html.= '       
                <td class="center" style="padding-bottom:35px;" >_________________________<br> Personero</td> ';
$i++;
     if($i%2==1)
        {
            $html.='</tr>';
            $w++;
            }
        }
    $html.= '</table>
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

