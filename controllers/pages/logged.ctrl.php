<?php
/**
 * Home Controller: Controller example.

 */
class PagesLoggedController extends Controller
{
	protected $errorView = 'error/error403.tpl';
	protected $session;

	public function build(){}

	protected function isLogged()
	{
		$this->session = Session::getInstance();
		$isLogged = $this->session->get('isLogged');
		if($isLogged)
		{
			return true;
		}else{
			return false;
		}
	}

}