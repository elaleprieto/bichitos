<?php
    //Load the serial port class
    require("bichito.class.php");
    
	# Verficiación de variables
	if(isset($_POST["puerto"]) && isset($_POST["direccion"])) {
		# Definición de variables
		$puerto = $_POST["puerto"];
		$direccion = $_POST["direccion"];
		
		# Se verifican los valores de las variables
		if(($puerto >= 0) && ($direccion >= 0)) {
			# Initialización de la clase
		    $serial = new bichito();
		    
			# Definición del Puerto de Salida
			# puerto = 0 >> ACM0 // puerto = 1 >> COM1
		    $puerto == 0 ? $serial -> bichitoDefaultACM() : $serial -> bichitoDefaultCOM(); 
		
		    # Se abre una conexión con el dispositivo para escritura
		    $serial -> deviceOpen();
			
			# Se le envía el mensaje, en este caso la dirección
			$serial -> asignar_direccion($direccion);
		    
			# Se cierra la conexión con el dispositivo
		    $serial->deviceClose();
		}
	}
?>
