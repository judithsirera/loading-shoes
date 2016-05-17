<?php
include_once( PATH_CONTROLLERS . 'pages/logged.ctrl.php' );

/**
 * Home Controller: Controller example.

 */
class PagesForgotController extends PagesLoggedController
{
	protected $view = 'pages/forgot.tpl';
	private $obj;
	private $user_name="";
	private $user_nom = "";
	private $password="";
	private $byEmail;
	private $error_msg;
	private $mail;

	public function build()
	{

		$error = $this->getParams()['url_arguments'][0];


		$this->setLayout( $this->view );

		if ($error)
		{
			$this->setLayout('error/error404.tpl');
		}else{
			$this->initVars();
			$this->getData();


			if(!empty($this->user_name)){

				if($this->checkUserName())
				{
					$this->createAndSendEmail();
					$this->assign('to_active', "Check your mail box and your spam folder.");

					//header('Location: '.URL_ABSOLUTE.'/home');
				}else{
					$this->assign("error_msg", $this->error_msg);
				}
			}
		}




	}



	public function getData(){

		$this->user_name = Filter::getEmail('user_name');

		//comprovem si es mail
		if(!$this->user_name) {
			$this->user_name = Filter::getString('user_name');
			$this->byEmail = false;
		}

		//$this->password = Filter::getString('password');
	}


	//comprovem si existeix el nom/mail entrat
	public function checkUserName()
	{
		//si es mail
		if($this->obj->getUsernameByEmail($this->user_name) || $this->obj->getUserByUsername($this->user_name)){
			$this->setMail($this->byEmail);
			return true;
		}else{
			$this->error_msg = "User doesn't exists.";
			return false;
		}

	}

	public function initVars()
	{
		$this->byEmail = true;
		$this->obj = $this->getClass('PagesUserModel');
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

	/*public function checkPassword(){

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
	}*/


	/*public function saveLogin()
	{
		if($this->byEmail)
		{
			$this->user_name = $this->obj->getUsernameByEmail($this->user_name)[0]['username'];
		}
		Session::getInstance()->set('username', $this->user_name);
		Session::getInstance()->set('money', $this->obj->getUserByUsername($this->user_name)[0]['money']);
		Session::getInstance()->set('isLogged', true);

	}*/

	public function setMail($byEmail){
		if($byEmail){
			$this->mail = $this->user_name;
			$this->user_nom = $this->obj->getUsernameByEmail($this->user_name)[0]['username'];

		}else{
			$this->mail = $this->obj->getUserByUsername($this->user_name)[0]['email'];
			$this->user_nom = $this->user_name;
		}
		//echo $this->mail;
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


	private function createAndSendEmail($link){
		$to = $this->mail;
		$from = "From: Loading Shoes <productionsloading@gmail.com>";
		$subject = "Password restablishment in Loading shoes";
		$content = "Content-Type: text/html; charset=ISO-8859-1";
		$headers = $from . "\r\n" . $content;


		$body = "<html>
                  <head>
                    <title>Password restablishment on Loading shoes</title>
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
                                <h3>To finalize your password restablishment
                                click here: <a href='" .URL_ABSOLUTE ."/password-establishment/$this->user_nom'>new password</a></h3>
                          </div>
                        </div>
                      </div>
                    </div>
                    <script type='text/javascript' src='https://code.jquery.com/jquery-2.1.1.min.js'></script>
                    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
                  </body>
                </html>";


		mail($to, $subject, $body, $headers);

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