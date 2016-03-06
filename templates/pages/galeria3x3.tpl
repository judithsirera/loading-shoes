{$modules.head}

<section>
	<div class="container">
		<div class="container">
			<h2>Practica 3</h2>

            {$modules.corda}
            {$modules.vent}
            {$modules.percussio}
            {$modules.electronic}




            <div class="left-arrow">
				<a class = "{$hidden_class_left}" href="{$url.global}/p3_galeria/{$ant_num}">
					<img src="{$url.global}/imag/left.png" alt="" class="img-responsive" />
				</a>
			</div>
			<div class="right-arrow">
				<a class = "{$hidden_class_right}" href="{$url.global}/p3_galeria/{$seg_num}">
					<img src="{$url.global}/imag/right.png" alt="" class="img-responsive" />
				</a>
			</div>

            <div class="send_button_galeria">
                <a href="{$url.global}/practica3">
                    Registrar instrument
                </a>
            </div>
		</div>
	</div>
</section>



{$modules.footer}