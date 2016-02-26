{$modules.head}

	<!-- This is an HTML comment -->
	{* This is a Smarty comment *}

<html>
<head><title>Practica 2</title></head>
<body>


<h2>Practica 2</h2>
<h3>Registre d'un instrument</h3>

<form action="" method="post">
	<div class="div_form">
		<label> Nom de l'instrument: </label>
		<input class="input" type="text" name="nom_instrument" value="" />
		<br/>
	</div>
	<div class="form-group div_form">
		<label for="sel1">Tipus d'instrument:</label>
		<select name="tipus_instrument" class="form-control" id="sel1">
			<option>Vent</option>
			<option>Corda</option>
			<option>Percussio</option>
			<option>Electronic</option>
		</select>
	</div>
	<div class="div_form">
		<label> URL: </label>
		<input id="input_url"class="input" type="text" name="URL_instrument" value="" />
		<br/>
	</div>

	<div class="send_button_inserir">
		<input type="submit" value="Inserir instrument" />
	</div>

	<div class="send_button_galeria">
		<a href="{$url.global}/galeria">
			Galeria
		</a>
	</div>

</form>

</body>
</html>


{$modules.footer}