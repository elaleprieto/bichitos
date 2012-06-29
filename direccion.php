<?php
include ("header.php");
?>
<fieldset>
	<legend>Inicio</legend>
	<article class="span1">
		<section>
			<form id="formulario">
				<div class="atributo">
					<label for="puerto">Selecciona un dispositivo</label>
					<select name="puerto" class="atributo">
						<option value="0">ACM0</option>
						<option value="1">COM1</option>
					</select>
				</div>
				<div class="atributo">
					<label for="direccion">Escribe una dirección</label>
					<input placeholder="Dirección" type="text" name="direccion" class="atributo" id="direccion" />
				</div>
				<div class="atributo">
					<button type="button" id="boton_direccion" class="atributo">
						¡Asignar Dirección!
					</button>
				</div>
			</form>
		</section>
	</article>
	<aside class="span1 col">
		<p>
			<img src="img/lamparita_on.svg" class="lamparita" id="lamparita"/>
		</p>
	</aside>
	
	<div id="mensaje">
		<h3>¡Bienvenido! Para empezar a jugar, haz clic sobre una lamparita...</h3>
	</div>
	<div id="loading">
		<img src="img/load.gif"/>
	</div>
</fieldset>
<?php
include ("footer.php");
?>