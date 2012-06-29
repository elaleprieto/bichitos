<?php
    /* Simple serial relay script for turning my sprinkler system on 
	and off from the web!
	
	Utilizes the PHP Serial class by Rémy Sanchez <thenux@gmail.com> 
	(Thanks you rule!!) to communicate with the QK108/CK1610 
	serial relay board!
	*/
	
	# Se verifica que las variables requeridas estén definidas
	if(isset($_POST["puerto"]) && isset($_POST["direccion"]) && isset($_POST['accion'])) {
	    # Se carga la clase requerida
	    require("bichito.class.php");

		# Definición de variables
		$puerto = $_POST["puerto"];
		$direccion = $_POST["direccion"];
		$accion = $_POST["accion"];
		$pin = (isset($_POST["pin"]) && ($_POST["pin"] >= 0) && ($_POST["pin"] <= 3)) ? $_POST["pin"] : 0;
		
		# Se verifican los valores de las variables
		if(($puerto >= 0) && ($direccion >= 0)  && ($accion >= 0) && ($accion <= 1)) {
			# Se inicializa la clase	    
		    $serial = new bichito();
			
			# Definición del Puerto de Salida
			# puerto = 0 >> ACM0 // puerto = 1 >> COM1
		    $puerto == 0 ? $serial -> bichitoDefaultACM() : $serial -> bichitoDefaultCOM();
			
			# Se abre una conexión con el dispositivo para escritura
		    $serial -> deviceOpen();
			
			# Se le envía la acción
			$serial -> accionar($direccion, $accion, $pin);
		
			# Se cierra la conexión con el dispositivo
		    $serial->deviceClose();
	    }
	}
?>