<?php
include_once( PATH_CONTROLLERS . 'pages/logged.ctrl.php' );

class SharedHeadController extends PagesLoggedController
{
	public function build( )
	{
		$this->setLayout( 'shared/head.tpl' );

		$this->assign('isLogged', $this->isLogged());
		$this->assign('username', strtoupper($this->username));
		$this->assign('money', $this->money);
	}
}


?>
