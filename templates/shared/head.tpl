<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Loading shoes to sell and buy">
	<meta name="author" content="Loading productions">

	<title>Loading shoes</title>

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="{$url.global}/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
	<link rel="stylesheet" href="{$url.global}/css/materialize.min.css" media="screen" title="no title" charset="utf-8">
	<link rel="stylesheet" href="{$url.global}/css/main.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="{$url.global}/css/preset.css" media="screen" title="no title" charset="utf-8">
	<link rel="stylesheet" href="{$url.global}/css/jquery-ui.min.css">

	<link rel="shortcut icon" href="{$url.global}/imag/LOADING_ico.png">

</head>
<body>

<header>
	<nav class="orange-bgColor">
		<div class="container">
			<div class="nav-wrapper">
				<a href="{$url.global}" class="brand-logo">
					<img class="img-responsive logo" src="{$url.global}/imag/LOADING_logo.png" alt="" />
				</a>
				<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
				<ul class="right hide-on-med-and-down">
					<li><a href="{$url.global}/new-product"><i class="material-icons">add_circle_outline</i></a></li>
					{if $isLogged}
                        <li><a href="{$url.global}/my-products"><i class="material-icons">list</i></a></li>
                        <li><a href="{$url.global}/my-purchases"><i class="material-icons">shopping_cart</i></a></li>
						<li><a href="{$url.global}">300<i class="material-icons">attach_money</i></a></li>
						<li><a href="{$url.global}/logout"><i class="material-icons">power_settings_new</i></a></li>

					{else}
						<li><a href="{$url.global}/signup">Sign up</a></li>
						<li><a href="{$url.global}/login">Log in</a>
					{/if}
				</ul>
				<ul class="side-nav" id="mobile-demo">
					<li><a href="{$url.global}/new-product"><i class="material-icons">add_circle_outline</i></a></li>
					{if $isLogged}
                        <li><a href="{$url.global}/my-products"><i class="material-icons">list</i></a></li>
                        <li><a href="{$url.global}/my-purchases"><i class="material-icons">shopping_cart</i></a></li>
						<li><a href="{$url.global}">300<i class="material-icons">attach_money</i></a></li>
						<li><a href="{$url.global}/logout"><i class="material-icons">power_settings_new</i></a></li>
					{else}
						<li><a href="{$url.global}/signup">Sign up</a></li>
						<li><a href="{$url.global}/login">Log in</a>
					{/if}
				</ul>
			</div>
		</div>
	</nav>
</header>

