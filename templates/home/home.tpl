{$modules.head}

	<!-- This is an HTML comment -->
	{* This is a Smarty comment *}

	<section>
		<div class="container">
			<div class="text-center">
				<h1>practiques</h1>
			</div>
		</div>
		<div class="container-fluid">
			<div id="effect-overlay" class="effects clearfix practiques-section">
				<div class="row">
					<div class="img practica-item">
						<img src="{$url.global}/imag/instruments.jpg" alt="">
						<div class="overlay">
							<a href="{$url.global}/vent/1" class="expand">Practica 1</a>
						</div>
					</div>
					<div class="img practica-item">
						<img src="{$url.global}/imag/instruments.jpg" alt="">
						<div class="overlay">
							<a href="{$url.global}/practica2" class="expand">Practica 2</a>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="img practica-item">
						<img src="{$url.global}/imag/instruments.jpg" alt="">
						<div class="overlay">
							<a href="{$url.global}/practica3" class="expand">Practica 3</a>
						</div>
					</div>
					<div class="img practica-item">
						<img src="{$url.global}/imag/instruments.jpg" alt="">
						<div class="overlay">
							<a href="{$url.global}/practica4" class="expand">Practica 4</a>
						</div>
					</div>
				</div>
			</div>
	</section>


	<section id="members">
		<div class="container">
			<div class="container">
				<div class="text-center">
					<h1>Group members</h1>
				</div>

				<!-- JUDITH SIRERA-->
				<div class="col s12 m8 offset-m2 l6 offset-l3">
					<div class="card-panel orange-light-color lighten-5 z-depth-1">
						<div class="row valign-wrapper">
							<div class="col s2">
								<img src="{$url.global}/imag/Judith.jpg" alt="" class="circle responsive-img"> <!-- notice the "circle" class -->
							</div>
							<div class="col s10">
							  <span class="member">
								JUDITH SIRERA
							  </span>
								<p>ls28999 <br>
									Multimedia Engineering, La Salle
								</p>
							</div>
						</div>
					</div>
				</div>

				<!-- LLUIS CORNELLA-->
				<div class="col s12 m8 offset-m2 l6 offset-l3">
					<div class="card-panel orange-light-color lighten-5 z-depth-1">
						<div class="row valign-wrapper">
							<div class="col s2">
								<img src="{$url.global}/imag/Lluis.jpg" alt="" class="circle responsive-img"> <!-- notice the "circle" class -->
							</div>
							<div class="col s10">
							  <span class="member">
								LLUIS CORNELLA
							  </span>
								<p>ls29025 <br>
									Multimedia Engineering, La Salle
								</p>
							</div>
						</div>
					</div>
				</div>

				<!-- JORDI RICART-->
				<div class="col s12 m8 offset-m2 l6 offset-l3">
					<div class="card-panel orange-light-color lighten-5 z-depth-1">
						<div class="row valign-wrapper">
							<div class="col s2">
								<img src="{$url.global}/imag/Jordi.jpg" alt="" class="circle responsive-img"> <!-- notice the "circle" class -->
							</div>
							<div class="col s10">
							  <span class="member">
								JORDI RICART
							  </span>
								<p>ls28873<br>
									Multimedia Engineering, La Salle
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

{$modules.footer}