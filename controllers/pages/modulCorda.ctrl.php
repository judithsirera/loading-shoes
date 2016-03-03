<?php
/**
 * Home Controller: Controller example.

 */
class PagesModulCordaController extends Controller
{
	protected $view = 'pages/modul1.tpl';


	protected $errorview = 'error/error404.tpl';
	private $obj;
	private $limit_instruments;

	public function build()
	{

		$this->setLayout( $this->view );

		$this->obj = $this->getClass('PagesPractica3Model');
		$this->limit_instruments = $this->obj->getTotalInstruments()[0]['total'];

		$info = $this->getParams();

		//Guardar el numero ID
		$id = $this->getIdFromUrl($info);

		$type = 'corda';

		$this->setInstruments($type, $info);

		$this->goRight($id);

		$this->goLeft($id);

		$this->comprovaURL($info);
	}



	private function getIdFromUrl($info){
		$id = 1;

		if(isset($info['url_arguments'][0])){
			$id = $info['url_arguments'][0];
		}
		return $id;
	}

	private function setInstruments($type,$info){

		$data = $this->obj->getDataByType($type);


		$type = $data['type'];

		$url = $data['url'];

		$u = $info['urlarguments'[0]];


		for ($i= 0,$i< 3,$i++){
			if(isset($data[$i])){
				$this->assign('url_imatge', $url[$i * $u]);
			}else{
				$this->assign('url_imatge', "htdocs/imag/nomore.png" );
			}
		}


	}

	private function goRight($id){

		$seg_trio = $id + 3;

		if($id == $this->limit_instruments) {
			$seg_trio = $id;
			$this->assign('hidden_class_right', 'hidden');
		}elseif($id != 1){
			$this->assign('hidden_class_left', '');
		}

		$this->assign('seg_trio', $seg_trio);
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