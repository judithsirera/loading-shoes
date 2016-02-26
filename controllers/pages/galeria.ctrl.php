<?php
/**
 * Home Controller: Controller example.

 */
class PagesGaleriaController extends Controller
{
	protected $view = 'pages/galeria.tpl';
	private $tipus_instrument = '';

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

		$seg_num = $num + 1;

		$this->assign('num', $num);
		$this->assign('seg_num', $seg_num);
	}


	private function goLeft($info){
		$num = 1;

		if(isset($info['url_arguments'][0])){
			$num = $info['url_arguments'][0];
		}

		$ant_num = $num - 1;

		if($num == 1){
			$ant_num = 1;
			$this->assign('hidden_class_left', 'hidden');

		}

		$this->assign('hidden_class_right', '');
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