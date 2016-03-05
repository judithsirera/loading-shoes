<?php
/**
 * Home Controller: Controller example.

 */
class PagesPractica3_galeriaController extends Controller
{
	protected $view = 'pages/galeria3x3.tpl';
	protected $obj;

	public function build()
	{
<<<<<<< HEAD
		$this->obj = $this->getClass('PagesPractica3Model');
=======

        $this->obj = $this->getClass('PagesPractica3Model');
>>>>>>> 603114f74b072391f19dfda3b75c982790352b23

        $this->setLayout( $this->view );

<<<<<<< HEAD
	}

=======
		//FLEXETES

		//CONTROLAR NUM MAX

	}
>>>>>>> 603114f74b072391f19dfda3b75c982790352b23

	/**
	 * With this method you can load other modules that we will need in our page. You will have these modules availables in your template inside the "modules" array (example: {$modules.head}).
	 * The sintax is the following:
	 * $modules['name_in_the_modules_array_of_Smarty_template'] = Controller_name_to_load;
	 *
	 * @return array
	 */
	public function loadModules() {
<<<<<<< HEAD
		$modules['head']		= 'SharedHeadController';
		$modules['footer']		= 'SharedFooterController';
		$modules['corda']		= 'PagesModulCordaController';
		$modules['vent']		= 'PagesModulVentController';
=======
		$modules['head']	    = 'SharedHeadController';
		$modules['footer']	    = 'SharedFooterController';
		$modules['corda']	    = 'PagesModulCordaController';
		$modules['vent']	    = 'PagesModulVentController';
>>>>>>> 603114f74b072391f19dfda3b75c982790352b23
		$modules['percussio']	= 'PagesModulPercussioController';
		$modules['electronic']	= 'PagesModulElectronicController';
		return $modules;
	}
}