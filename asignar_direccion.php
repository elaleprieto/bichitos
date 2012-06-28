<?php
    //Load the serial port class
    require("bichito.class.php");
    
	# Definición de variables
	$direccion = 24;
	
    //Initialize the class
    $serial = new bichito();
    $serial -> bichitoDefaultACM();

    //Now we "open" the serial port so we can write to it
    $serial -> deviceOpen();

	echo $serial -> asignar_direccion($direccion);
    
    //We're done, so close the serial port again
    $serial->deviceClose();
?>
