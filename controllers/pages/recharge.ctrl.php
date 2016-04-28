<?php
include_once( PATH_CONTROLLERS . 'pages/logged.ctrl.php' );
/**
 * Home Controller: Controller example.

 */
class PagesRechargeController extends PagesLoggedController
{
	protected $view = 'pages/recharge.tpl';
	private $obj;
	private $itsDone = false;
	private $quantity = 0;
	private $method;

	public function build()
	{
		if($this->isLogged())
		{
			$this->setLayout( $this->view );

			$this->obj = $this->getClass('PagesUserModel');

			$this->getData();
			$this->makeTransaction();
			$this->updateMoney();
			$this->setTemplate();
		}else
		{
			$this->setLayout( $this->errorView );
		}

	}

	private function getData()
	{
		$this->quantity = Filter::getInteger('money');
		$this->method = Filter::getBoolean('method');


	}

	private function makeTransaction()
	{
		if (!empty($this->quantity) && !empty($this->method))
		{
			$this->obj->updateMoney($this->username, $this->money+$this->quantity);
			$this->money = $this->money + $this->quantity;
			$this->itsDone = true;
		}
	}

	private function setTemplate()
	{
		$this->assign('my_money', $this->money);
		$this->assign('itsDone', $this->itsDone);
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