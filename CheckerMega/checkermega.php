<title>Mega Checker V 1.0</title>
<h1><center>Mega Checker V 1.0</center></h1><br>
<h2><center>Coded by Desdes</center></h2><br><br>

<form method="post">
	<center><p>Ingrese aqui el link: <input type="text" name="link" /></p></center>
	<center><p><input type="submit" /></p></center>
</form>

<center>(Funciona para zeldas de la forma: https://mega.nz/#!xxxxxxxx!xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx)</center><br><br>


<?php
	
	if (isset($_POST['link'])) {

		$link = $_POST['link'];

			$lugar[2] = "";
			$j = 0 ;
			for ( $i = 0 ; $i < strlen($link) ; $i++) {


				if ( $link[$i] == "!"){

					$lugar[$j] = $i;
					$j++;

				}

			}

			$code = substr( $link , $lugar[0] + 1 , $lugar[1] - $lugar[0] - 1 );

			$key = substr( $link , $lugar[1] + 1 , strlen($link) - $lugar[1] - 1 );

			function getLinkInfos($code, $key)
			{
			        $sequence_number = mt_rand(1,99999999999);
        			$ch = curl_init("https://g.api.mega.co.nz/cs?id=".$sequence_number);
 
       				$data = array(array("a" => "g", "p" => $code));                                                                    
        			$data_string = json_encode($data);
 
        			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
       				curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        			curl_setopt($ch, CURLOPT_VERBOSE, 1);
        			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                    
        			curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
 
        			$output = curl_exec($ch);
 
        			$res = json_decode(curl_exec($ch),true);
 
        			if(!isset($res[0]['s']) || !isset($res[0]['at']))
        			{
        			        return false;
        			}
        			else
        			{
        			        $key = base64_decode($key);
 
        			        $size = $res[0]['s'];
        			        $name = $res[0]['at'];
 
        			        // HOW TO DECRYPT "at" ?
 
        			        return array('size' => $size,
        			                'name' =>  $name );
        			}
			}
			$r = getLinkInfos($code, $key);

			echo "<center>---------------------------------------------------------------------------------</center><br>";
			echo "<center>Resultado<br><br></center>";
			if ( $r == NULL){

			       echo "<center>El Link esta caido :c</center><br><br>";
			}
			else{
			       echo "<center>El Link esta en pie \ ^_^ /</center><br><br>";
			}
			echo "<center>---------------------------------------------------------------------------------</center><br>";
	} else {
		$link = "";
	}
?>