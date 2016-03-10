<?php
/**
 * Home Controller: Controller example.

 */
class PagesBorrarController extends Controller
{
	protected $view = 'formulari.tpl';
	protected $obj;

	public function build()
	{

		$this->obj = $this->getClass('PagesPractica3Model');

		$this->setLayout( $this->view );

		$id = $this->getParams();

		$this->eliminarInstrument($id["url_arguments"][0]);
		header('Location: http://g4.dev/practica4/');
	}

	private function eliminarInstrument($id){

		$this->obj->borrarInstrument($id);


	}



	/**
	 * With this method you can load other modules that we will need in our page. You will have these modules availables in your template inside the "modules" array (example: {$modules.head}).
	 * The sintax is the following:
	 * $modules['name_in_the_modules_array_of_Smarty_template'] = Controller_name_to_load;
	 *
	 * @return array
	 */

}