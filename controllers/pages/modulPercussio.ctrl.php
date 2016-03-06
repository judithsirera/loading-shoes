<?php
/**
 * Home Controller: Controller example.

 */
class PagesModulPercussioController extends Controller
{
	protected $view = 'pages/percussio.tpl';


	protected $errorview = 'error/error404.tpl';
	private $obj;
	private $limit_instruments;
	private $type = 'Percussio';


	public function build()
	{

		$this->setLayout( $this->view );

		$this->obj = $this->getClass('PagesPractica3Model');

		$this->limit_instruments = $this->obj->getTotalInstruments()[0]['total'];

		$info = $this->getParams();

		//Guardar el numero ID
		$id = $this->getIdFromUrl($info);


		$this->setInstruments($id);

	}



	private function getIdFromUrl($info){
		$id = 1;

		if(isset($info['url_arguments'][0])){
			$id = $info['url_arguments'][0];
		}
		return $id;
	}

	private function setInstruments($id){

		$data = $this->obj->getDataByType($this->type);


		for ($i = 0; $i < 3; $i++){
			$plus = ($id - 1) * 3;

			if(isset($data[$i * $id + $plus])){
				$url_imatge[$i] = $data[$i * $id + $plus]['url'];
			}else{
				$url_path = $url['global'];
				$url_imatge[$i] = "$url_path/imag/nomore.png";
			}

		}

		$this->assign('url_imatge', $url_imatge);



	}



}