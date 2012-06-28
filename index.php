<?php
/* Simple serial relay script for turning my sprinkler system on 
and off from the web!

Utilizes the PHP Serial class by Rémy Sanchez <thenux@gmail.com> 
(Thanks you rule!!) to communicate with the QK108/CK1610 
serial relay board!
*/


//check the GET action var to see if an action is to be performed
if (isset($_GET['action'])) {
    //Action required
    
    //Load the serial port class
    require("bichito.class.php");
    
    //Initialize the class
    $serial = new bichito();
    $serial -> bichitoDefaultCOM();

    //Specify the serial port to use... in this case COM1 <> ACM0 es el usb supuestamente
    //$serial->deviceSet("ACM0");
    
    //Set the serial port parameters. The documentation says 9600 8-N-1, so
    //$serial->confBaudRate(9600); //Baud rate: 9600
    //$serial->confParity("none");  //Parity (this is the "N" in "8-N-1")
    //$serial->confCharacterLength(8); //Character length (this is the "8" in "8-N-1")
    //$serial->confStopBits(1);  //Stop bits (this is the "1" in "8-N-1")
    //$serial->confFlowControl("none");
	//Device does not support flow control of any kind, 
	//so set it to none.

    //Now we "open" the serial port so we can write to it
    $serial->deviceOpen();

    //Issue the appropriate command according to the serial relay 
    //board documentation
    if ($_GET['action'] == "on") {
        $direccion = 1;
        $output_address = 0;
        $output_value = 1;		// 1 = Encendido
        
        $serial -> write_single_coil($direccion, $output_address, $output_value);
    
    } else if ($_GET['action'] == "off") {
        $direccion = 1;
        $output_address = 0;
        $output_value = 0;		// 0 = Apagado
        
        //to turn relay number 1 off, we issue this command
        $serial -> write_single_coil($direccion, $output_address, $output_value);
    }
    
    //We're done, so close the serial port again
    $serial->deviceClose();
} 
?>
<!doctype html>  
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
  
	<title>Bichitos</title>

	<link rel="shortcut icon" href="favicon.ico">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="estilos.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.5.3/modernizr.min.js"></script>

</head>

<body class="cf">

  <header class="span2">
  	<div class="inner cf">
  		<h1 class="alt span1 head">
  			<img src="img/bug128.png" class="bug" />
  			Bichitos para Todos
  		</h1>
  	<!--
		<nav class="span1 col">
				<ul class="cf">
					<li><a class="alt" href="#">nav item</a></li>
					<li><a class="alt" href="#">nav item</a></li>
					<li><a class="alt" href="#">nav item</a></li>
				</ul>
		</nav>
	-->
	</div>
  </header>

	<div id="container" class="cf">  
		<article class="span1">
			<section>
				<h1>¡Prendé la luz!</h1>
				<p>
					<a href="<?=$_SERVER['PHP_SELF'] . "?action=on" ?>">
						<img src="img/lamparita_on.svg" class="lamparita" />
					</a>
				</p>
			</section>
		</article>
		<aside class="span1 col">
			<h1>¡Apagá la luz!</h1>
			<p>
				<a href="<?=$_SERVER['PHP_SELF'] . "?action=off" ?>">
					<img src="img/lamparita_off.svg" class="lamparita" />
				</a>
			</p>
		</aside>
 		<div id="mensaje">
			<?php 
				if (isset($_GET['action'])) {
					if ($_GET['action'] == "on") {
			?>
						<h3>Haz hecho clic sobre <span class="resaltar">Prender</span>, la luz debería estar prendida ahora.</h3>
			<?php
					} elseif ($_GET['action'] == "off") {
			?>
						<h3>Haz hecho clic sobre <span class="resaltar">Apagar</span>, la luz debería estar apagada ahora.</h3>
			<?php
					}
				} else {
			?>
					<h3>¡Bienvenido! Para empezar a jugar, haz clic sobre una lamparita...</h3>
			<?php
				}
			?>
		</div>
	</div> <!--! end of #container -->
  <footer>
		<div class="inner cf">
		<h1>
		<img src="img/elefante a colores.svg" class="elefante" />
  		Colectivo Libre :: 2012</h1>
  	<!--
		<nav class="span1 col">
				<ul class="cf">
					<li><a class="alt" href="#">nav item</a></li>
					<li><a class="alt" href="#">nav item</a></li>
					<li><a class="alt" href="#">nav item</a></li>
				</ul>
		</nav>
	-->
		</div>
  </footer>

</body>
</html>

