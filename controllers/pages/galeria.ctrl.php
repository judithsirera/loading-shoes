<?php
/**
 * Home Controller: Controller example.

 */
class PagesGaleriaController extends Controller
{
	protected $view = 'pages/formulari.tpl';
	private $tipus_instrument = '';
	private $limit_instruments = 2;

	public function build()
	{
		$this->setLayout( $this->view );

		$info = $this->getParams();

		$this->goRight($info);

		$this->goLeft($info);

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
				$seguent_instrument = 'corda';
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
				$anterior_instrument = $this->tipus_instrument;
				$ant_num = 1;
				$this->assign('hidden_class_left', 'hidden');
			}
		}

		$this->assign('hidden_class_right', '');
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
	public function loadModules() {
		$modules['head']	= 'SharedHeadController';
		$modules['footer']	= 'SharedFooterController';
		return $modules;
	}
}