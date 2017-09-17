<style>
    body {
  color: green;
  background-color: black;
    }

 </style>

<title>Actas de Nacimiento (Perú)</title>
<h1><center>Actas de Nacimiento V 1.2</center></h1><br>
<h2><center>Coded by Desdes</center></h2><br>

<form method="post">
    <center><p>Apellido Paterno: <input type="text" name="apepat" value= "humala"/></p></center>
    <center><p>Apellido Materno: <input type="text" name="apemat" value= "tasso"/></p></center>
    <center><p>Nombre: <input type="text" name="nombre" value= "ollanta"/></p></center>
    <center><p>Dia: <input type="text" size="1" name="dia" value="27"/>  Mes: <input type="text" size="1" name="mes" value="06"/></p></center>
    <center><p>Rango Años: <input type="text" size="1" name="anioi" value="1940"/> - <input type="text" size="1" name="aniof" value="1980"/></p></center>
    <center><p><input type="submit" /></p></center>
</form>


<?php
//error_reporting(E_ALL); //Cuando programas
error_reporting(0); //Cuando ya esta listo
ini_set('display_errors', 1);

ini_set('max_execution_time', 2400000);





if (isset($_POST['apepat']) && isset($_POST['apemat']) && isset($_POST['nombre']) && isset($_POST['dia']) && isset($_POST['mes']) && isset($_POST['anioi']) && isset($_POST['aniof'])) {
    
    $apepat = $_POST['apepat'];
    $apemat = $_POST['apemat'];
    $nombre = $_POST['nombre'];
    $dia    = $_POST['dia'];
    $mes    = $_POST['mes'];
    $anioi  = $_POST['anioi'];
    $aniof  = $_POST['aniof'];
    
    
    //$apepat = "humala";
    //$apemat = "tasso";
    //$nombre = "ollanta";
    //$dia = "27";
    //$mes = "06";
    //$anioi = "1940";
    //$aniof = "1980";
    $galletita = cookie();
    
    
    echo "<center>Sujeto Investigado: ";
    
    echo chr(ord($apepat) - 32) . substr($apepat, 1) . " " . chr(ord($apemat) - 32) . substr($apemat, 1) . " " . chr(ord($nombre) - 32) . substr($nombre, 1) . "</center></br>";
    
    ini($galletita);
    
    $r = 0;
    $f = 0;

    for ($anio = $anioi; $anio <= $aniof; $anio++) {
        
        $r = Val($apepat, $apemat, $nombre, $dia, $mes, $anio, $galletita);
        if($r == 1){
            $f = 1;
        }
        
    }
    if ($f == 0){
        echo "<center>No se encontró resultados.</center>";
    }    
    
}

function ini($galletita)
{
    
    $data = array(
        'accion' => 'continuar',
        'etapa' => '3',
        'etapaAux' => '2',
        'caso' => '',
        'tipActa' => '01',
        'bot_prot_continuar11.x' => '88',
        'bot_prot_continuar11.y' => '27'
    );
    
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://www.reniec.gob.pe/concer/concer.do");
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SAFE_UPLOAD, true);
    curl_setopt($ch, CURLOPT_COOKIE, $galletita);
    $content2 = curl_exec($ch);
    curl_close($ch);
}

function Val($apepat, $apemat, $nombre, $dia, $mes, $anio, $galletita)
{
    $c = 0;
    $data = array(
        'accion' => 'continuar',
        'etapa' => '5',
        'etapaAux' => '4',
        'caso' => '',
        'tipActa' => '01',
        'priApeTitular1' => $apepat,
        'segApeTitular1' => $apemat,
        'preNomTitular1' => $nombre,
        'fecDiaActa' => $dia,
        'fecMesActa' => $mes,
        'fecAnioActa' => $anio,
        'bot_prot_continuar11.x' => '88',
        'bot_prot_continuar11.y' => '27'
    );
    
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://www.reniec.gob.pe/concer/concer.do");
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SAFE_UPLOAD, true);
    curl_setopt($ch, CURLOPT_COOKIE, $galletita);
    $content = curl_exec($ch);
    curl_close($ch);
    
    //echo $content;
    if (strpos($content, "encontr&oacute;") > 0) {
        echo "<center>El Nacimiento es el $dia / $mes / $anio </center>";
        $c = 1;
    }
    return $c;
}

function cookie(){

$url = 'https://www.reniec.gob.pe/concer/concer.do';

$h = get_headers($url);
$c = $h["4"];

for ($i = 0; $i <= strlen($c); $i++){

    if ($c[$i] == " "){
        $c[$i] = ";";
    }
}

$porciones = explode(";", $c);

return $porciones[1];

}

?>
