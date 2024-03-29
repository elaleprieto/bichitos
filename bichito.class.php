<?php
require("php_serial.class_cl.php");

/**
 * Serial port control class
 *
 * THIS PROGRAM COMES WITH ABSOLUTELY NO WARANTIES !
 * USE IT AT YOUR OWN RISKS !
 *
 * @author Rémy Sanchez <thenux@gmail.com>
 * @thanks Aurélien Derouineau for finding how to open serial ports with windows
 * @thanks Alec Avedisyan for help and testing with reading
 * @copyright under GPL 2 licence
 */
class bichito extends phpSerial {
	
	/**
	 * Constructor. Perform some checks about the OS and setserial
	 *
	 * @return phpSerial
	 */
	//public function bichito() {
	public function __construct() {
       parent::__construct();
	}
	
	/**
	 * Constructor. Perform some checks about the OS and setserial
	 *
	 * @return phpSerial
	 */
	public function bichitoDefaultACM() {
		//Specify the serial port to use... in this case COM1 <> ACM0 es el usb supuestamente
		$this -> deviceSet("ACM0");
		
		//Set the serial port parameters. The documentation says 9600 8-N-1, so
		$this -> confBaudRate(9600); 		//Baud rate: 9600
		$this -> confParity("none");  		//Parity (this is the "N" in "8-N-1")
		$this -> confCharacterLength(8); 	//Character length (this is the "8" in "8-N-1")
		$this -> confStopBits(1);  			//Stop bits (this is the "1" in "8-N-1")
		$this -> confFlowControl("none");	//Device does not support flow control of any kind, so set it to none.
	}
	
	/**
	 * Constructor. Perform some checks about the OS and setserial
	 *
	 * @return phpSerial
	 */
	public function bichitoDefaultCOM() {
		//Specify the serial port to use... in this case COM1 <> ACM0 es el usb supuestamente
		$this -> deviceSet("COM1");
		
		//Set the serial port parameters. The documentation says 9600 8-N-1, so
		$this -> confBaudRate(9600); 		//Baud rate: 9600
		$this -> confParity("none");  		//Parity (this is the "N" in "8-N-1")
		$this -> confCharacterLength(8); 	//Character length (this is the "8" in "8-N-1")
		$this -> confStopBits(1);  			//Stop bits (this is the "1" in "8-N-1")
		$this -> confFlowControl("none");	//Device does not support flow control of any kind, so set it to none.
	}
	
	public function asignar_direccion($address) {
		# Significado de los valores:
		# 255     -> Dirección actual del dispositivo
		# 70      -> Comando para asignar dirección
		# 0       -> Hay que ponerlo
		# address -> Dirección nueva
		
		// ComPort1.WriteStr(Chr(255)+Chr(70)+Chr(0)+Chr(address));
		$this -> sendMessage(chr(255) . chr(70) . chr(0) . chr($address));
	}

	//procedure TForm1.MODBUS_write_single_coil(address,output_address,output_value:Integer);
	public function write_single_coil($address, $output_address, $output_value) {
		# Significado de los valores:
		# address         -> Direccion del dispositivo esclavo
		# 5               -> Comando para escribir salida
		# 0               -> Hay que ponerlo
		# output_address  -> Direccion del pin de salida del 0 al 3
		# output_value    -> Encendido o apagado 1 o 0
		
		// ComPort1.WriteStr(Chr(address) + Chr(5) + Chr(0) + Chr(output_address) + Chr(output_value));
		$this -> sendMessage(chr($address) . chr(5) . chr(0) . chr($output_address) . chr($output_value));
	}
	
	/**
	 * accionar(): similar a write_single_coil pero más humanizada
	 * @param $direccion
	 * @param $pin
	 * @param $accion
	 */
	 public function accionar($direccion, $accion, $pin = 0) {
	 	# function write_single_coil($address, $output_address, $output_value) {
		# 	Significado de los valores:
		# 		address         -> Direccion del dispositivo esclavo
		# 		5               -> Comando para escribir salida
		# 		0               -> Hay que ponerlo
		#		output_address  -> Direccion del pin de salida del 0 al 3
		# 		output_value    -> Encendido o apagado 1 o 0
		
		// ComPort1.WriteStr(Chr(address) + Chr(5) + Chr(0) + Chr(output_address) + Chr(output_value));
		$this -> sendMessage(chr($direccion) . chr(5) . chr(0) . chr($pin) . chr($accion));
	 }
	 
	 
	 
	 //procedure TForm1.MODBUS_write_single_register(address,output_address,output_value:Integer);
	public function write_single_register($address, $output_address, $output_value) {
		//address         -> Direccion del dispositivo esclavo
		//6               -> Comando para escribir registro
		//0               -> Hay que ponerlo
		//output_address  -> Direccion del pin de salida del 0 al 3
		//Output_value    -> Valor del PWM de 0 a 255
		
		// ComPort1.WriteStr(Chr(address) + Chr(6) + Chr(0) + Chr(output_address) + Chr(output_value));
		$this -> sendMessage(chr($address) . chr(6) . chr(0) . chr($output_address) . chr($output_value));
	}
	 
	 
	/**
	 * colorear(): similar a write_single_register pero más humanizada
	 * @param $direccion
	 * @param $pin
	 * @param $color
	 */
	 public function colorear($direccion, $color, $pin = 0) {
	 	# function write_single_coil($address, $output_address, $output_value) {
		# 	Significado de los valores:
		# 		address         -> Direccion del dispositivo esclavo
		# 		6               -> Comando para escribir registro
		# 		0               -> Hay que ponerlo
		#		output_address  -> Direccion del pin de salida del 0 al 3
		# 		output_value    -> Valor del PWM de 0 a 255
		
		// ComPort1.WriteStr(Chr(address) + Chr(5) + Chr(0) + Chr(output_address) + Chr(output_value));
		$this -> sendMessage(chr($direccion) . chr(5) . chr(0) . chr($pin) . chr($color));
	 }
}
?>
