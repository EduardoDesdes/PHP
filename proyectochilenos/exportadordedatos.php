<?php
	
	///////////////////////////////////////////////////
	//
	// Importador de Datos Codeado por Desdes
	// Proceso:
	// 
	// 1. El programa  lista la carpeta en donde se encuentra este archivo
	// 2. Elimina las cabeceras y extrae los nombres, numero de identidad, sexo y domicilio
	// 3. Lo exporta a la base de datos
	//
	// *IMPORTANTE*
	// Que no exista otros archivos txt en la misma carpeta que este programa y que no sea para el uso del mismo
	//
	///////////////////////////////////////////////////


	function guardar_en_db($archivo){

	$db_host = "localhost";
	$db_name = "info_chilenitos";
	$db_user = "root";
	$db_password = "";

	$conexion = mysqli_connect($db_host,$db_user,$db_password);

	if (mysqli_connect_errno()){

		echo "Corrige los datos po wn :v";

		exit();

	}

	mysqli_select_db($conexion, $db_name) or die ("DB no encontrada :v");

	mysqli_set_charset ($conexion, "utf-8");

    	$archivo1 = $archivo;

		$i = 0;
		if(file_exists($archivo1)) {
        	$file = fopen($archivo1,'r');
        	while(!feof($file)) { 
            $name = fgets($file);
            $lineas[] = $name;
            $i++;
        }
        	fclose($file);
		}

		
		for ($j = 0 ; $j < $i ; $j++ ){

			if ( $j % 76 != 0 && $j % 76 != 1 && $j % 76 != 2 && $j % 76 != 3 && $j % 76 != 4 && $j % 76 != 5){
				$nombre = "";
				$ident = "";
				$sex = "";
				$domi = "";
				$k = 0 ;
					
				while($lineas[$j][$k] != " " || $lineas[$j][$k+1] != " "){
						$nombre = $nombre . $lineas[$j][$k];
						$k++;
				}
				while($lineas[$j][$k] == " "){
					$k++;
				}
				while($lineas[$j][$k - 2] != "-"){
						$ident = $ident . $lineas[$j][$k];
						$k++;
				}
				while($lineas[$j][$k] == " "){
					$k++;
				}
				while($lineas[$j][$k] != " "){
						$sex = $sex . $lineas[$j][$k];
						$k++;
				}
				while($lineas[$j][$k] == " "){
					$k++;
				}
				while($lineas[$j][$k] != " " || $lineas[$j][$k+1] != " " || $lineas[$j][$k+2] != " " || $lineas[$j][$k+3] != " "){
						$domi = $domi . $lineas[$j][$k];
						$k++;
				}

			$consulta = "INSERT INTO chilenitos (nombre, ident, sex, domi) VALUES ('$nombre', '$ident', '$sex', '$domi')";
			mysqli_query ($conexion,$consulta);

			}

		}
		echo "Archivo: ".$archivo." agregado a la base de datos satisfactoriamente<br>";

		mysqli_close($conexion);
	}


	$directorio = opendir(".");

	while ($archivo = readdir($directorio)) {
		$l = strlen($archivo);
    	if($l > 4 ){

    		if (substr($archivo, $l - 4, 4) == ".txt" ){
    			//echo $archivo."<br>";
    			guardar_en_db($archivo);
    		}

    	}
	
	}


?>