<?php
/**
 * Home Controller: Controller example.

 */
class PagesLoggedController extends Controller
{
	protected $errorView = 'error/error403.tpl';
	protected $session;
	protected $username;
	protected $money;

	public function build(){}

	protected function isLogged()
	{
		$this->session = Session::getInstance();
		$isLogged = $this->session->get('isLogged');
		if($isLogged)
		{
			$this->username = $this->session->get('username');
			$this->money = $this->session->get('money');

			return true;
		}else{
			return false;
		}
	}

	protected function updateMoney()
	{
		Session::getInstance()->set('money', $this->money);
	}

}