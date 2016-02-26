<?php
/**
 * Home Controller: Controller example.

 */
class PagesPractica2Controller extends Controller
{
	protected $view = 'pages/formulari.tpl';

	public function build()
	{
		$this->setLayout( $this->view );

		$nom_instrument = Filter::getString('nom_instrument');
		$tipus_instrument = Filter::getString('tipus_instrument');
		$url_photo = Filter::getString('URL_instrument');

		$obj = $this->getClass('PagesFormulariModel');
		$obj->insertInstrument($nom_instrument,$tipus_instrument,$url_photo);
	}

	/**
	 * With this method you can load other modules that we will need in our page. You will have these modules availables in your template inside the "modules" array (example: {$modules.head}).
	 * The sintax is the following:
	 * $modules['name_in_the_modules_array_of_Smarty_template'] = Controller_name_to_load;
	 *
	 * @return array
	 */
	public function loadModules() {
		$modules['head']	= 'SharedHeadController';
		$modules['footer']	= 'SharedFooterController';
		return $modules;
	}
}