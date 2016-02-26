{$modules.head}

	<!-- This is an HTML comment -->
	{* This is a Smarty comment *}

	<section>
		<div class="container">
			<div class="container">
				<h2 class="center">Practica 1</h2>
				<div class="row">
					<h5 class="center">{$tipus_instrument}</h5>
					<div class="thumbnail thumbnail-width center">
						<img src="{$url.global}/imag/instruments/{$tipus_instrument}_{$num}.jpg" alt="" />
					</div>
				</div>
				<div class="row">
					<div class="col s2 offset-s5">
						<div class="col s6">
							<a class = "{$hidden_class_left}" href="{$url.global}/{$anterior_instrument}/{$ant_num}">
								<img src="{$url.global}/imag/left.png" alt="" class="img-responsive" />
							</a>
						</div>
						<div class="col s6">
							<a class = "{$hidden_class_right}" href="{$url.global}/{$seguent_instrument}/{$seg_num}">
								<img src="{$url.global}/imag/right.png" alt="" class="img-responsive" />
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

{$modules.footer}