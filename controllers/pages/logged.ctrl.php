<?php
/**
 * Home Controller: Controller example.

 */
class PagesLoggedController extends Controller
{
	protected $errorView = 'error/error403.tpl';
	protected $session;
	protected $user_name;

	public function build(){}

	protected function isLogged()
	{
		$this->session = Session::getInstance();
		$isLogged = $this->session->get('isLogged');
		if($isLogged)
		{
			$this->user_name = $this->session->get('user_name');
			return true;
		}else{
			return false;
		}
	}

}