<?php
/**
 * Home Controller: Controller example.

 */
class PagesSignupController extends Controller
{
	private $user_name = "";
	private $email = "";
	private $password = "";
	private $twitter = "";
	private $obj;


	protected $view = 'pages/signup.tpl';

	public function build()
	{
		$this->obj = $this->getClass(PagesUserModel);

		$this->getUserData();

		$this->insertUserData();


		$this->setLayout( $this->view );

	}

	private function getUserData()
	{
		$this->user_name = Filter::getString('user_name');
		$this->email = Filter::getEmail('user_email');
		$this->password = Filter::getString('user_password');
		$this->twitter = Filter::getString('user_twitter');

    }

	private function insertUserData()
	{
		if ($this->checkUserName() && $this->checkPassword() && $this->checkEmail())
		{
			$this->obj->insertNewUser($this->user_name, $this->email, $this->password, $this->twitter);
            $active_link = $this->generateActiveLink();
            $this->assign('active_link', $active_link);
		}
	}

	private function checkUserName()
	{
        if(empty($this->user_name))
        {
            return false;
        }
		if($this->obj->getUserByUsername($this->user_name))
        {
			$this->assign("error_msg", "This username already exists");
			return false;
		}
		return true;
	}

	private function checkPassword()
	{
        if(empty($this->password))
        {
            return false;
        }
		if(strlen($this->password) > 0 && strlen($this->password) < 6)
        {
			$this->assign("error_msg", "The password is to short. 6 characters min.");
			return false;
		}
		if(strlen($this->password) > 10)
        {
			$this->assign("error_msg", "The password is to long. 10 characters max.");
			return false;
		}
		return true;

	}

	private function checkEmail()
	{
        if(empty($this->email))
        {
           return false;
        }
		if($this->obj->getUsernameByEmail($this->email))
        {
			$this->assign("error_msg", "This email already has an account");
			return false;
		}
		return true;
	}

    private function generateActiveLink()
    {
        $id = $this->obj->getUserByUsername($this->user_name);
        $id = $id[0]['id_user'];
        return URL_ABSOLUTE ."/activateuser/user-id/$id";
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