<?php
include_once( PATH_CONTROLLERS . 'pages/logged.ctrl.php' );

/**
 * Home Controller: Controller example.

 */
class PagesLoginController extends PagesLoggedController
{
	protected $view = 'pages/login.tpl';
	private $obj;
	private $user_name="";
	private $password="";
	private $byEmail;

	public function build()
	{

		if (!$this->isLogged())
		{
			$this->byEmail = true;
			$this->obj = $this->getClass('PagesUserModel');

			$this->setLayout( $this->view );

			$this->getData();

			if(!empty($this->user_name)){
				if($this->checkUserName() && $this->checkIsActive() && $this->checkPassword() ){
					$this->saveLogin();
					header('Location: '.URL_ABSOLUTE.'/home');
				}
			}
		}else {
			header('Location: '. URL_ABSOLUTE . '/home');
		}

	}

	private function getData(){

		$this->user_name = Filter::getEmail('user_name');

		//comprovem si es mail
		if(!$this->user_name) {
			$this->user_name = Filter::getString('user_name');
			$this->byEmail = false;
		}

		$this->password = Filter::getString('password');
	}


	//comprovem si existeix el nom/mail entrat
	private function checkUserName()
	{
		//si es mail
		if($this->obj->getUsernameByEmail($this->user_name) || $this->obj->getUserByUsername($this->user_name)){
			return true;
		}else{
			$this->assign("error_msg", "User doesn't exists.");
			return false;
		}

	}

	private function checkIsActive()
	{
		if($this->byEmail)
		{
			$username = $this->obj->getUsernameByEmail($this->user_name)[0]['username'];
		}else {
			$username = $this->user_name;
		}

		$isActive = $this->obj->getUserByUsername($username)[0]['isActive'];

		if($isActive == 0)
		{
			$this->assign("error_msg", "This user has not validate the account");
			return false;
		}
		return true;

	}

	private function checkPassword(){

		if(!$this->byEmail){
			$passwordbbdd = $this->obj->getPasswordByName($this->user_name);
		}else{
			$passwordbbdd = $this->obj->getPasswordByEmail($this->user_name);
		}

		$passwordbbdd = $passwordbbdd[0]['password'];

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
			$this->user_name = $this->obj->getUsernameByEmail($this->user_name)[0]['username'];
		}
		Session::getInstance()->set('username', $this->user_name);
		Session::getInstance()->set('money', $this->obj->getUserByUsername($this->user_name)[0]['money']);
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