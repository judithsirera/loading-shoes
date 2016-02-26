<?php
/**
 * Home Controller: Controller example.

 */
class PagesCordaController extends Controller
{
	protected $view = 'pages/practica1.tpl';
	protected $errorView = 'error/error404.tpl';
	private $tipus_instrument = 'corda';
	private $limit_instruments = 4;

	public function build()
	{
		$this->setLayout( $this->view );

		$info = $this->getParams();

		$this->comprovaURL($info);

		$this->goRight($info);

		$this->goLeft($info);

		$this->comprovaURL($info);

	}

	private function goRight($info){
		$num = 1;

		if(isset($info['url_arguments'][0])){
			$num = $info['url_arguments'][0];
		}

		$seguent_instrument =  $this->tipus_instrument;
		$seg_num = $num + 1;

		if($num <= $this->limit_instruments){
			$this->assign('tipus_instrument', $this->tipus_instrument);

			if($num == $this->limit_instruments){
				$seguent_instrument = 'percussio';
				$seg_num = 1;
			}
		}

		$this->assign('seguent_instrument', $seguent_instrument);
		$this->assign('num', $num);
		$this->assign('seg_num', $seg_num);
	}


	private function goLeft($info){
		$num = 1;

		if(isset($info['url_arguments'][0])){
			$num = $info['url_arguments'][0];
		}

		$anterior_instrument =  $this->tipus_instrument;
		$ant_num = $num - 1;

		if($num >= 1){
			$this->assign('tipus_instrument', $this->tipus_instrument);

			if($num == 1){
				$anterior_instrument = 'vent';
				$ant_num = 2;
			}
		}

		$this->assign('anterior_instrument', $anterior_instrument);
		$this->assign('num', $num);
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
			if($info['url_arguments'][0] != '1' && $info['url_arguments'][0] != '2' && $info['url_arguments'][0] != '3' && $info['url_arguments'][0] != '4'){
				$this->setLayout($this->errorView);
				return;
			}

		}
	}

	public function loadModules() {
		$modules['head']	= 'SharedHeadController';
		$modules['footer']	= 'SharedFooterController';
		return $modules;
	}
}