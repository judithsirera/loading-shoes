<?php
include_once( PATH_CONTROLLERS . 'pages/logged.ctrl.php' );

/**
 * Home Controller: Controller example.

 */
class PagesPasswordController extends PagesLoggedController
{
	protected $view = 'pages/passwordestablishment.tpl';
	private $obj;
	private $user_name="";
	private $password="";
	private $byEmail;
	private $error_msg;
	private $password1 = "";
	private $password2 = "";
	private $est_Ok = false;

	public function build()
	{



		$this->user_name = $this->getParams()['url_arguments'][0];
		$this->initVars();


		if (!$this->user_name)
		{
			$this->setLayout('error/error404.tpl');

		}elseif(!$this->checkUserName()){
			$this->setLayout('error/userNoExist.tpl');
		}else
		{
			$this->setLayout( $this->view );



			$this->getData();

			//echo $this->user_name;


			if(!empty($this->password1) && !empty($this->password2)){

				if(($this->password1 == $this->password2))
				{
					//echo $this->password1;
					$hash_password = password_hash($this->password1, PASSWORD_DEFAULT);

					$this->obj->updatePasswordByName($this->user_name, $hash_password);
					$this->est_Ok = true;
					$this->assign("est_Ok",$this->est_Ok);

					//header('Location: '.URL_ABSOLUTE.'/home');
				}else if($this->password1 != $this->password2){
					$this->assign("error_msg", "passwords must be the same");
				}else if(!$this->checkUserName()){
					$this->assign("error_msg", "user doesn't exist");
				}
			}
		}


	}

	public function initVars()
	{
		$this->obj = $this->getClass('PagesUserModel');
	}

	public function getData(){

		$this->password1 = Filter::getString('user_password_1');
		$this->password2 = Filter::getString('user_password_2');

	}


	//comprovem si existeix el nom/mail entrat
	public function checkUserName()
	{
		//si es mail
		if($this->obj->getUsernameByEmail($this->user_name) || $this->obj->getUserByUsername($this->user_name)){
			return true;
		}else{
			$this->error_msg = "User doesn't exists.";
			return false;
		}

	}

	/*public function checkIsActive()
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
			$this->error_msg = "This user has not validate the account";
			return false;
		}
		return true;

	}*/

	public function checkPassword(){

		if(!$this->byEmail){
			$passwordbbdd = $this->obj->getPasswordByName($this->user_name);
		}else{
			$passwordbbdd = $this->obj->getPasswordByEmail($this->user_name);
		}

		$passwordbbdd = $passwordbbdd[0]['password'];

		if(!password_verify($this->password, $passwordbbdd))
		{
			$this->error_msg = "The password is wrong.";
		}else
		{
			return true;
		}
	}


	public function saveLogin()
	{
		if($this->byEmail)
		{
			$this->user_name = $this->obj->getUsernameByEmail($this->user_name)[0]['username'];
		}
		Session::getInstance()->set('username', $this->user_name);
		Session::getInstance()->set('money', $this->obj->getUserByUsername($this->user_name)[0]['money']);
		Session::getInstance()->set('isLogged', true);

	}

	public function getUserName()
	{
		return $this->user_name;
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function setUserName($user_name)
	{
		$this->user_name = $user_name;
	}

	public function setPassword($password)
	{
		$this->password = $password;
	}

	public function setByEmail($byEmail)
	{
		$this->byEmail = $byEmail;
	}


	/*private function createAndSendEmail($link){
		$to = $this->email;
		$from = "From: Loading Shoes <productionsloading@gmail.com>";
		$subject = "Registration in Loading shoes";
		$content = "Content-Type: text/html; charset=ISO-8859-1";
		$headers = $from . "\r\n" . $content;


		$body = "<html>
                  <head>
                    <title>Registration on Loading shoes</title>
                    <link href='http://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'><!-- Latest compiled and minified CSS -->
                    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'>
                    <style>
                        body{
                            font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif;
                        font-size: 14px;
                        line-height: 1.42857143;
                        color: #333;
                        background-color: #fff;
                      }
                      h1{
                            color: #852F06;
                        }
                      h3 {
                            color: #CC6B3C;
                            line-height: 1.5;
                      }
                      a{
                            color: #AC4D1F;
                        }
                      .box .a{
                            color: #AC4D1F;
                            font-size: 24px;
                            transform: translateX(-50%);
                            left: 50%;
                            position: absolute;
                      }
                      a:hover, a:active, a:focus{
                            text-decoration: none;
                            color: #852F06;
                      }
                      .box{
                            background-color: rgba(255,184,150,0.2);
                          border-radius: 10px;
                          padding: 30px 30px 30px 30px;
                          margin-top: 50px;
                          position: relative;
                          height: 260px;
                      }
                    </style>
                  </head>
                  <body>
                    <div class='container-fluid'>
                      <div class='row'>
                        <div class='col-md-3'></div>
                        <div class='col-md-6'>
                          <div class='box'>
                                <h1>Welcome " .$this->user_name ."</h1>
                                <h3>To finalize your registration on
                                <a href='" .URL_ABSOLUTE ."'>Loading Shoes</a>
                                you have to activate your account with this link:</h3>
                                <h2><a href='" .$link ."'>".$link ."</a></h2>
                          </div>
                        </div>
                      </div>
                    </div>
                    <script type='text/javascript' src='https://code.jquery.com/jquery-2.1.1.min.js'></script>
                    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
                  </body>
                </html>";


		mail($to, $subject, $body, $headers);

	}*/
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