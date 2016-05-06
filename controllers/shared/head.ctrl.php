<?php
include_once( PATH_CONTROLLERS . 'pages/logged.ctrl.php' );
include_once( PATH_CONTROLLERS . 'pages/login.ctrl.php' );


class SharedHeadController extends PagesLoggedController
{
	private $loginClass;
	private $user_name;
	private $password;

	public function build( )
	{
		$this->setLayout( 'shared/head.tpl' );

		$this->assign('isLogged', $this->isLogged());
		$this->assign('username', strtoupper($this->username));
		$this->assign('money', $this->money);

		$this->login();
	}

	private function login()
	{
		if (!$this->isLogged())
		{
			$this->loginClass = new PagesLoginController();

			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$this->loginClass->initVars();
				$this->getData();
				$this->loginClass->setUserName($this->user_name);
				$this->loginClass->setPassword($this->password);

				if($this->loginClass->checkUserName() && $this->loginClass->checkIsActive() && $this->loginClass->checkPassword()){
					$this->loginClass->saveLogin();
					header('Location: '. URL_ABSOLUTE .'/home');
				}else{
					header('Location: '. URL_ABSOLUTE .'/login/error');
				}

			}
		}
	}

	private function getData(){

		$this->user_name = Filter::getEmail('uHeader');

		//comprovem si es mail
		if(!$this->user_name) {
			$this->user_name = Filter::getString('uHeader');
			$this->loginClass->setByEmail(false);
		}
		$this->password = Filter::getString('pswHeader');
	}


}


?>
