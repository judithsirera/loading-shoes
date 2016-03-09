<?php
/**
 * Home Controller: Controller example.

 */
class PagesBorrarController extends Controller
{
	protected $view = 'pages/formulari.tpl';
	protected $obj;

	public function build()
	{

		$this->obj = $this->getClass('PagesPractica3Model');

		$this->setLayout( $this->view );

		$this->insertInstrument();
		$this->showInstrument();
	}

	private function insertInstrument(){

		$nom_instrument = Filter::getString('nom_instrument');
		$tipus_instrument = Filter::getString('tipus_instrument');
		$url_photo = Filter::getString('URL_instrument');

		if(!empty($nom_instrument) && !empty($tipus_instrument) && !empty($url_photo)){

			$this->obj->insertInstrument($nom_instrument,$tipus_instrument,"$url_photo");
			$this->assign('msg', "S'ha inserit correctament");
		}else{
			$this->assign('msg', "Omple tots els parametres");
		}
	}

	private function showInstrument(){

		$inst = $this->obj->getAllDataOrderById();
		$this->assign('instruments', $inst);
	}

	/**
	 * With this method you can load other modules that we will need in our page. You will have these modules availables in your template inside the "modules" array (example: {$modules.head}).
	 * The sintax is the following:
	 * $modules['name_in_the_modules_array_of_Smarty_template'] = Controller_name_to_load;
	 *
	 * @return array
	 */
	public function loadModules() {

		$modules['head']		= 'SharedHeadController';
		$modules['footer']		= 'SharedFooterController';


		return $modules;
	}
}