<?php
include_once( PATH_CONTROLLERS . 'pages/logged.ctrl.php' );

/**
 * Home Controller: Controller example.

 */
class PagesDeleteController extends PagesLoggedController
{
	private $obj;
	private $usuari_bbdd;
	private $id;

	public function build()
	{

		if($this->isLogged()){
			$this->obj = $this->getClass('PagesProductModel');

			$this->getUserBBDD();

			if($this->username == $this->usuari_bbdd){
				$this->deleteProduct();
				header('Location: '.URL_ABSOLUTE.'/myProducts');
		}
		}else{
			$this->setLayout($this->error403);
		}

	}

	private function getUserBBDD()
	{
		$this->id = $this->getParams()['url_arguments'][1];
		$this->id = explode('=',$this->id);

		$this->usuari_bbdd = $this->obj->getUserById($this->id[1])[0]['usuari'];
	}
	
	private function deleteProduct()
	{
		$this->obj->deleteProduct($this->id[1]);
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