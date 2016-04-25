<?php
include_once( PATH_CONTROLLERS . 'pages/logged.ctrl.php' );

/**
 * Home Controller: Controller example.

 */
class PagesMyProductsController extends PagesLoggedController
{
	protected $view = 'pages/myProducts.tpl';
	private $obj;




	public function build()
	{
		if($this->isLogged())
		{
			$this->setLayout( $this->view );

			$this->obj = $this->getClass('PagesUserModel');

			$this->assign("product_name", "User doesn't exists.");
			$this->assign("product_name", "User doesn't exists.");


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