{$modules.head}

	<!-- This is an HTML comment -->
	{* This is a Smarty comment *}

	<section>
		<div class="container">
			<div class="container">
				<h2>Practica 2</h2>
				<div class="row">
					<h5 class="center">{$tipus_instrument}</h5>
					<div class="thumbnail thumbnail-width center">
						<img src="{$url_imatge}" alt="" />
					</div>
				</div>
				<div class="row">
					<div class="col s2 offset-s5">
						<div class="col s6">
							<a class = "{$hidden_class_left}" href="{$url.global}/galeria/{$ant_num}">
								<img src="{$url.global}/imag/left.png" alt="" class="img-responsive" />
							</a>
						</div>
						<div class="col s6">
							<a class = "{$hidden_class_right}" href="{$url.global}/galeria/{$seg_num}">
								<img src="{$url.global}/imag/right.png" alt="" class="img-responsive" />
							</a>
						</div>
					</div>
				</div>
				<div class="send_button_galeria">
					<a href="{$url.global}/practica2">
						Registrar instrument
					</a>
				</div>
			</div>
		</div>
	</section>

{$modules.footer}