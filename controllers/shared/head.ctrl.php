<?php

class SharedHeadController extends PagesLoggedController
{
	public function build( )
	{
		$this->setLayout( 'shared/head.tpl' );

		$this->assign('isLogged', $this->isLogged());
	}
}


?>
