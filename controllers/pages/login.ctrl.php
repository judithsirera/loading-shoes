<?php
/**
 * Home Controller: Controller example.

 */
class PagesLoginController extends Controller
{
	protected $view = 'pages/login.tpl';
	private $obj;
	private $username="";
	private $password="";
	private $byEmail = true;

	public function build()
	{


		$this->obj = $this->getClass('PagesUserModel');

		$this->setLayout( $this->view );

		$this->getData();

		if(!empty($this->username)){
			if($this->checkUserName() && $this->checkPassword()){
				$this->saveLogin();
				header('Location: '.URL_ABSOLUTE.'/home');
			}
		}


	}

	private function getData(){

		$this->username = Filter::getEmail('user_name');

		//comprovem si es mail
		if(!$this->username){
			$this->username = Filter::getString('user_name');
			$this->byEmail = false;
		}

		$this->password= Filter::getString('password');
	}


	//comprovem si existeix el nom/mail entrat
	private function checkUserName()
	{
		//si es mail
		if($this->obj->getUsernameByEmail($this->username) || $this->obj->getUserByUsername($this->username)){
			return true;
		}else{
			$this->assign("error_msg", "User doesn't exists.");
			return false;
		}

	}

	private function checkPassword(){
		if(!$this->byEmail){
			$passwordbbdd = $this->obj->getPasswordByName($this->username);
			$passwordbbdd = $passwordbbdd[0]['password'];
		}else{
			$passwordbbdd = $this->obj->getPasswordByEmail($this->username);
			$passwordbbdd = $passwordbbdd[0]['password'];
		}


		if($passwordbbdd != $this->password){
			$this->assign("error_msg", "The password is wrong.");
		}else{
			return true;
		}
	}


	private function saveLogin()
	{
		if($this->byEmail)
		{
			$this->username = $this->obj->getUsernameByEmail($this->username)[0]['username'];
		}
		Session::getInstance()->set('username', $this->username);
		Session::getInstance()->set('money', $this->obj->getUserByUsername($this->username)[0]['money']);
		Session::getInstance()->set('isLogged', true);

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