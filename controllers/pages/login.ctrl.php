<?php
/**
 * Home Controller: Controller example.

 */
class PagesLoginController extends Controller
{
	protected $view = 'pages/login.tpl';

	public function build()
	{

		$this->obj = $this->getClass('PagesUserModel');

		$this->setLayout( $this->view );

		$this->getNameOrMail();
	}

	private function getNameOrMail(){

		$user_name = Filter::getEmail('first_name');
		$password= Filter::getString('password');

		if($user_name== false){
			$user_name = Filter::getString('first_name');

		}
		$passwordbd = getPasswordByName($)
		if(
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