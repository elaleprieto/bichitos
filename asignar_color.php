<?php
	# Se verifica que las variables requeridas estén definidas
	if(isset($_POST["puerto"]) && isset($_POST["direccion"]) && isset($_POST['color'])) {
	    # Se carga la clase requerida
	    require("bichito.class.php");

		# Definición de variables
		$puerto = $_POST["puerto"];
		$direccion = $_POST["direccion"];
		$color = $_POST["color"];
		$pin = (isset($_POST["pin"]) && ($_POST["pin"] >= 0) && ($_POST["pin"] <= 3)) ? $_POST["pin"] : 0;
		
		# Se verifican los valores de las variables
		if(($puerto >= 0) && ($direccion >= 0)  && ($color >= 0) && ($color <= 255)) {
			# Se inicializa la clase	    
		    $serial = new bichito();
			
			# Definición del Puerto de Salida
			# puerto = 0 >> ACM0 // puerto = 1 >> COM1
		    $puerto == 0 ? $serial -> bichitoDefaultACM() : $serial -> bichitoDefaultCOM();
			
			# Se abre una conexión con el dispositivo para escritura
		    $serial -> deviceOpen();
			
			# Se le envía la acción
			$serial -> colorear($direccion, $color, $pin);
		
			# Se cierra la conexión con el dispositivo
		    $serial->deviceClose();
	    }
	}
?>