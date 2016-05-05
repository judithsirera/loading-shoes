<?php
include_once( PATH_CONTROLLERS . 'pages/logged.ctrl.php' );

/**
 * Home Controller: Controller example.

 */
class PagesLogoutController extends PagesLoggedController
{

	public function build()
	{
		if($this->isLogged())
		{
			Session::getInstance()->delete('username');
			Session::getInstance()->delete('password');
			Session::getInstance()->set('isLogged', false);


			header('Location: '.URL_ABSOLUTE.'/home');
		}else {
			$this->setLayout($this->error403);
		}

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