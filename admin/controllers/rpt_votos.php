<?php
require_once "../models/Rpt_votos.php";
$BDobj=new Rpt_votos();
switch ($_GET["op"]){

    case 'listar':
    $rspta = $BDobj->listar();
    $data = array();
    $i = 1;
    while ($reg=$rspta->fetch_object()) {
        $data[]=array(
            "0"=>$i,
            "1"=>$reg->nombre,         
            "2"=>$reg->apellidos,
            "3"=>$reg->dni,
            "4"=>$reg->grado,
            "5"=>$reg->seccion,
            "6"=>$reg->mesa,
            "7"=>$reg->hora,
            "8"=>($reg->condicion_voto)?'<label class="label label-success"><i class="icofont icofont-tick-mark"> </i> Voto</label>':'<label class="label label-danger"><i class="icofont icofont-close"> </i> Anulado</label>',
        );
        $i++;
    }
    $results = array(
        "sEcho"=>1, 
        "iTotalRecords"=>count($data), 
        "iTotalDisplayRecords"=>count($data), 
        "aaData"=>$data);
    echo json_encode($results);
    break;
 
    case 'listarmesa':
    $mesa_num=$_REQUEST["mesa"];
    $rspta = $BDobj->listar_persona($mesa_num);
    $data = array();
    $i = 1;
    while ($reg=$rspta->fetch_object()) {
        $data[]=array(
            "0"=>$i,
            "1"=>$reg->nombre,         
            "2"=>$reg->apellidos,
            "3"=>$reg->dni,
            "4"=>$reg->grado,
            "5"=>$reg->seccion,
            "6"=>$reg->mesa,

        );
        $i++;
    }
    $results = array(
        "sEcho"=>1, 
        "iTotalRecords"=>count($data), 
        "iTotalDisplayRecords"=>count($data), 
        "aaData"=>$data);
    echo json_encode($results);
    break;

case 'listarend': 
    $rspta_count = $BDobj->count();
    $reg_count=$rspta_count->fetch_object();
    $total=$reg_count->total;

    $rspta = $BDobj->listar_agrupacion_voto();
    $data = array();
    $i = 1;

    while ($reg=$rspta->fetch_object()) {
        $data[]=array(
            "0"=>$i,
            "1"=>'<a href="../resource/files/lista/'.$reg->logo.'" data-lighter>
            <img src="../resource/files/lista/'.$reg->logo.'" height="35px" width="35px"> </a>',
            "2"=>$reg->lista,         
            "3"=>$reg->votos, 
            "4"=>round(($reg->votos*100)/$total).'%',
        );
        $i++; 
    }
    $results = array(
        "sEcho"=>1, 
        "iTotalRecords"=>count($data), 
        "iTotalDisplayRecords"=>count($data), 
        "aaData"=>$data);
    echo json_encode($results);
    break;

    case 'selectmesa':
        $rspta = $BDobj->listar_num_mesa();
        echo '<option value="">SELECCIONE LA MESA...</option>';
        while ($reg = $rspta->fetch_object())
                {
                    echo '<option value=' . $reg->mesa . '>Mesa N°' . $reg->mesa . '</option>';
                }
    break;

    case 'selectmesa_acta':
        $rspta = $BDobj->listar_num_mesa_acta();
        echo '<option value="">SELECCIONE LA MESA...</option>';
        while ($reg = $rspta->fetch_object())
                {
                    echo '<option value=' . $reg->mesa . '>Mesa N°' . $reg->mesa . '</option>';
                }
    break;
}
?>