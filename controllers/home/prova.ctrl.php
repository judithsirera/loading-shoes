<?php
/**
 * Home Controller: Controller example.

 */
class HomeProvaController extends Controller
{
	protected $view = 'home/prova.tpl';

	public function build()
	{
		$this->setLayout($this->view);

		$params = $this->getParams();

		if ($params['url_arguments'][0] == '1') {
			$nom = "Jud";
		} else {
			$nom = "Classroom";
		}

		$this->assign("usuari", $nom);
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