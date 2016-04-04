{$modules.head}

	<!-- This is an HTML comment -->
	{* This is a Smarty comment *}

	<div id="success">Welcome to Salle's framework!</div>

	<div class="block">

		<div class="inner-block">

            <h2>This is an example of a form</h2>

	{	if $user_name }
		<p>Welcome to Projectes Web, <strong>{$user_name}</strong>!</p>
	{	else }
		<p>Hello! What's your name? </p>
		<form action="" method="POST">
			<input type="text" name="user_name">
			<input type="submit" name="submit" value="Enviar">
		</form>
	{	/if}

		</div>

	</div>

	
<div class="clear"></div>
{$modules.footer}