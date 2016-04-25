<?php
include_once( PATH_CONTROLLERS . 'pages/logged.ctrl.php' );
/**
 * Home Controller: Controller example.

 */
class PagesMyPurchasesController extends PagesLoggedController
{
	protected $view = 'pages/myPurchases.tpl';
	private $obj;
	private $purchases;
	private $limitPages;
	private $actualPage;

	public function build()
	{
		if($this->isLogged())
		{
			$this->setLayout( $this->view );
			$this->obj = $this->getClass('PagesPurchasesModel');

			$this->actualPage = $this->getParams()['url_argument'];
			$this->getAllPurchases();

		}else
		{
			$this->setLayout( $this->errorView );
		}

	}

	private function getAllPurchases()
	{
		$this->purchases = $this->obj->getAllData();
		$this->limitPages = sizeof($this->purchases[0]) / 10;
		if (!is_int($this->limitPages))
		{
			$this->limitPages++;
		}
	}

	private function setTemplate()
	{
		$this->assign('page_num', $this->actualPage);
		$this->assign('data', $this->purchases);
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