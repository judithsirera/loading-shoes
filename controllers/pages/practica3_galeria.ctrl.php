<?php
/**
 * Home Controller: Controller example.

 */
class PagesPractica3_galeriaController extends Controller
{
	protected $view = 'pages/galeria3x3.tpl';
    protected $errorview = 'error/error404.tpl';
    protected $limit_pages;

    protected $obj;

	public function build()
	{
		$this->obj = $this->getClass('PagesPractica3Model');

        $this->getLimitPages();

        $this->setLayout( $this->view );

        $info = $this->getParams();

        $id = $this->getIdFromUrl($info);

        $this->goRight($id);

        $this->goLeft($id);

        $this->comprovaURL($info);

        //FLEXETES

		//CONTROLAR NUM MAX

	}

    private function getLimitPages(){
        $numVent = $this->obj->getNumInstrumentsByType('Vent')[0]['num'];
        $numCorda = $this->obj->getNumInstrumentsByType('Corda')[0]['num'];
        $numPercussio = $this->obj->getNumInstrumentsByType('Percussio')[0]['num'];
        $numElectronic = $this->obj->getNumInstrumentsByType('Electronic')[0]['num'];

        $this->limit_pages = max($numCorda,$numElectronic,$numPercussio,$numVent);

        $this->limit_pages = $this->limit_pages/3;

        if(!is_int($this->limit_pages)){
            $this->limit_pages = floor($this->limit_pages);
            $this->limit_pages++;
        }



    }

    private function getIdFromUrl($info){
        $id = 1;

        if(isset($info['url_arguments'][0])){
            $id = $info['url_arguments'][0];
        };
        return $id;
	}


    private function goRight($id){

        $seg_num = $id + 1;

        if($id == $this->limit_pages) {
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

        }elseif ($id != $this->limit_pages) {
            $this->assign('hidden_class_right', '');
        }

        $this->assign('ant_num', $ant_num);
    }

    public function comprovaURL($info){

        if(isset($info['url_arguments'][0])){
            if($info['url_arguments'][0] > $this->limit_pages){
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
		$modules['corda']		= 'PagesModulCordaController';
		$modules['vent']		= 'PagesModulVentController';
		$modules['percussio']	= 'PagesModulPercussioController';
		$modules['electronic']	= 'PagesModulElectronicController';
		return $modules;
	}
}