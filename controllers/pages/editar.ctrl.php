<?php
/**
 * Home Controller: Controller example.

 */
class PagesEditarController extends Controller
{
	protected $view = 'pages/formulari.tpl';
	protected $obj;

	public function build()
	{

		$this->obj = $this->getClass('PagesPractica3Model');

		$this->setLayout( $this->view );

		$info = $this->getParams();

		//Guardar el numero ID
		$id = $this->getIdFromUrl($info);

		$this->mostraDadesInstrument($id);
		$this->editarInstrument($id, $name, $type, $url);

		$this->comprovaURL($info);
	}

	private function getIdFromUrl($info){
		$id = 1;

		if(isset($info['url_arguments'][0])){
			$id = $info['url_arguments'][0];
		};
		return $id;
	}

	private function mostraDadesInstrument($id){
		$data = $this->obj->getData($id);
		$this->assign('name', $data[0]['name']);
		$this->assign('type', $data[0]['type']);
		$this->assign('url', $data[0]['url']);
	}

	private function editarInstrument($id, $name, $type, $url){
		$this->obj->editarInstrument($id, $name, $type, $url);
	}

	public function comprovaURL($info){

		if(isset($info['url_arguments'][0])){
			if($info['url_arguments'][0]> $this->limit_instruments){
				$this->setLayout($this->errorview);
			}
		}
	}


	/**
	 * With this method you can load other modules that we will need in our page. You will have these modules availables in your template inside the "modules" array (example: {$modules.head}).
	 * The sintax is the following:
	 * $modules['name_in_the_modules_array_of_Smarty_template'] = Controller_name_to_load;
	 *
	 * @return array
	 */
	public function loadModules() {

		$modules['head']		= 'SharedHeadController';
		$modules['footer']		= 'SharedFooterController';


		return $modules;
	}
}