<?php
/**
 * Home Controller: Controller example.

 */
class PagesGaleriaController extends Controller
{
	protected $view = 'pages/galeria.tpl';


	protected $errorview = 'error/error404.tpl';
	private $obj;
	private $limit_instruments;

	public function build()
	{

		$this->setLayout( $this->view );

		$this->obj = $this->getClass('PagesGaleriaModel');
		$this->limit_instruments = $this->obj->getTotalInstruments()[0]['total'];

		$info = $this->getParams();

		//Guardar el numero ID
		$id = $this->getIdFromUrl($info);

		$this->setInstrument($id);

		$this->goRight($id);

		$this->goLeft($id);

		$this->comprovaURL($info);
	}



	private function getIdFromUrl($info){
		$id = 1;

		if(isset($info['url_arguments'][0])){
			$id = $info['url_arguments'][0];
		};
		return $id;
	}

	private function setInstrument($id){
		$data = $this->obj->getData($id);

		$type = $data[0]['type'];
		$url = $data[0]['url'];

		$this->assign('tipus_instrument', $type);
		$this->assign('url_imatge',$url);

	}

	private function goRight($id){

		$seg_num = $id + 1;

		if($id == $this->limit_instruments) {
			$seg_num = $id;
			$this->assign('hidden_class_right', 'hidden');
		}elseif($id != 1){
			$this->assign('hidden_class_left', '');
		}

		$this->assign('seg_num', $seg_num);
	}


	private function goLeft($id){

		$ant_num = $id - 1;

		if($id == 1){
			$ant_num = 1;
			$this->assign('hidden_class_left', 'hidden');

		}elseif ($id != $this->limit_instruments) {
			$this->assign('hidden_class_right', '');
		}

		$this->assign('ant_num', $ant_num);
	}

	/**
	 * With this method you can load other modules that we will need in our page. You will have these modules availables in your template inside the "modules" array (example: {$modules.head}).
	 * The sintax is the following:
	 * $modules['name_in_the_modules_array_of_Smarty_template'] = Controller_name_to_load;
	 *
	 * @return array
	 */
	public function comprovaURL($info){

		if(isset($info['url_arguments'][0])){
			if($info['url_arguments'][0]> $this->limit_instruments){
				$this->setLayout($this->errorview);
			}
		}
	}
	public function loadModules() {
		$modules['head']	= 'SharedHeadController';
		$modules['footer']	= 'SharedFooterController';
		return $modules;
	}
}