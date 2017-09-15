<?php

ini_set('max_execution_time', 2400000);

$apepat = "humala";
$apemat = "tasso";
$nombre = "ollanta";
$dia = "27";
$mes = "06";
$anioi = "1940";
$aniof = "1980";
$galletita = "JSESSIONID=2899ae2ade7802477fba337fa77eb03e127dc1a6deca2a3497d53a0a332c6c1c.e34Mb3uKahmMai0Mah8SbxuTa3uQe0";


echo "Sujeto Investigado: ";

echo chr(ord($apepat)-32).substr($apepat, 1)." ".chr(ord($apemat)-32).substr($apemat, 1)." ".chr(ord($nombre)-32).substr($nombre, 1)."</br>";


for ($anio = $anioi ; $anio <= $aniof ; $anio++){

	valid($apepat,$apemat,$nombre,$dia,$mes,$anio,$galletita);

}

function valid($apepat,$apemat,$nombre,$dia,$mes,$anio,$galletita){

$data = array (	'accion'=>'continuar',
				'etapa'=>'5',
				'etapaAux'=>'4',
				'caso'=>'',
				'tipActa'=>'01',
				'priApeTitular1'=>$apepat,
				'segApeTitular1'=>$apemat,
				'preNomTitular1'=>$nombre,
				'fecDiaActa'=>$dia,
				'fecMesActa'=>$mes,
				'fecAnioActa'=>$anio,
				'bot_prot_continuar11.x'=>'88',
				'bot_prot_continuar11.y'=>'27'	);


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
if( strpos($content, "encontr&oacute;") > 0){
	echo "El Nacimiento es el $dia / $mes / $anio ";
}
}

?>
