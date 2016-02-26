<?php

class ErrorError404Controller extends Controller
{
	public function build( )
	{
		$this->setLayout( 'error/error404.tpl' );
	}

	public function loadModules()
	{
		$modules['head']	= 'SharedHeadController';
		$modules['footer']	= 'SharedFooterController';

		return $modules;
	}
}


?>