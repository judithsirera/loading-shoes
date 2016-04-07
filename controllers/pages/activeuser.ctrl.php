<?php
/**
 * Home Controller: Controller example.

 */
class PagesActiveuserController extends Controller
{
	protected $view = 'error/error404.tpl';
    private $id;
    private $obj;

	public function build()
	{
        $this->obj = $this->getClass(PagesUserModel);
		$this->getIdFromUrl();

	}

    private function getIdFromUrl()
    {
        $info = $this->getParams();
        $typeInfo = $info['url_arguments'][0];
        if($typeInfo == 'user-id')
        {
            $this->id = $info['url_arguments'][1];
            $this->checkIdisActive();
        }else{
            $this->setLayout($this->view);
        }
    }

    private function checkIdisActive()
    {
        $user = $this->obj->getUserById($this->id);
        $isActive = $user[0]['isActive'];

        if(!$isActive)
        {
            $this->obj->activeAccount($this->id);
            header('Location: '.URL_ABSOLUTE.'/welcome');
        }else
        {
            echo "this account is already activated";
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
		$modules['head']	= 'SharedHeadController';
		$modules['footer']	= 'SharedFooterController';
		return $modules;
	}
}