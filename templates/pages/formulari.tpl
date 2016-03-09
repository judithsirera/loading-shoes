{$modules.head}

	<!-- This is an HTML comment -->
	{* This is a Smarty comment *}

<html>
<head><title>Practica 2</title></head>
<body>


<h2>Practica 2</h2>
<h3>Registre d'un instrument</h3>
<span class="message-error">{$msg}</span>

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
		<a href="{$url.global}/p3_galeria">
			Galeria
		</a>
	</div>

</form>

<section>
	<div class="container">
		<div class="container">
			<div class="row">
				<div class="col s7">
					<h5 class="title">Instruments ({$numInstruments})</h5>
					<div id="scrollItem" class="collection">
						{foreach from=$instruments item=i}
							<a href="{$url.global}/galeria/{$i.id}" class="collection-item {$i.type}">{$i.name}</a>
						{/foreach}
					</div>
				</div>
				<div class="col s4">
					<h5 class="title">Legend</h5>
					<ul class="collection">
						<li class="collection-item legend"><i id="corda" class="material-icons">label</i>Corda</li>
						<li class="collection-item legend"><i id="vent" class="material-icons">label</i>Vent</li>
						<li class="collection-item legend"><i id="percussio" class="material-icons">label</i>Percussio</li>
						<li class="collection-item legend"><i id="electronic" class="material-icons">label</i>Electronic</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>


</body>
</html>


{$modules.footer}