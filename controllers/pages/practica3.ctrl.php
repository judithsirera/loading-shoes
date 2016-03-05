<?php
/**
 * Home Controller: Controller example.

 */
class PagesPractica3Controller extends Controller
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