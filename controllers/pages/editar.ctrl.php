<?php
/**
 * Home Controller: Controller example.

 */
class PagesEditarController extends Controller
{
	protected $view = 'pages/edit_form.tpl';
    protected $errorview = 'error/error404.tpl';

	protected $obj;

	public function build()
	{

		$this->obj = $this->getClass('PagesPractica3Model');

		$this->setLayout( $this->view );

		$info = $this->getParams();

		//Guardar el numero ID
		$id = $this->getIdFromUrl($info);

		$this->mostraDadesInstrument($id);
		$this->editarInstrument($id);

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
		$this->assign('url_inst', $data[0]['url']);
	}

	private function editarInstrument($id){
        $nom_instrument = Filter::getString('nom_instrument');
        $tipus_instrument = Filter::getString('tipus_instrument');
        $url_photo = Filter::getString('URL_instrument');

        $this->assign('msg', "Edita l'instrument");


        if(!empty($nom_instrument) && !empty($tipus_instrument) && !empty($url_photo)){
            $this->obj->editarInstrument($id, $nom_instrument, $tipus_instrument, $url_photo);
            header('Location: ' .$url['global'] .'/practica4');
        }else if (empty($nom_instrument) || empty($tipus_instrument) || empty($url_photo)){
            $this->assign('msg', "Omple tots els parametres");
        }

	}

	public function comprovaURL($info){
		if(isset($info['url_arguments'][0])){
            $id = $info['url_arguments'][0];
            $arr = $this->obj->getData($id);
            if(!isset($arr[0])){
                $this->setLayout($this->errorview);

            }
        }else{
            $this->setLayout($this->errorview);

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