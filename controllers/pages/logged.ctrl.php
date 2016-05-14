<?php
//include_once (PATH_LIBS . 'Mandrill.php');
//require_once 'mandrill-api-php/src/Mandrill.php'; //Not required with Composer

/**
 * Home Controller: Controller example.

 */
class PagesLoggedController extends Controller
{
	protected $error403 = 'error/error403.tpl';
	protected $error404 = 'error/error404.tpl';
	protected $session;
	protected $username;
	protected $money;
	protected $mandrill;

	public function build(){}

	protected function isLogged()
	{
		$this->session = Session::getInstance();
		$isLogged = $this->session->get('isLogged');
		if($isLogged)
		{
			$this->username = $this->session->get('username');
			$this->money = $this->session->get('money');

			return true;
		}else{
			return false;
		}
	}

	protected function updateMoney()
	{
		Session::getInstance()->set('money', $this->money);
	}

	protected function sendMail()
	{
		try {
			$mandrill = new Mandrill('RsdeZp3FhJyJfdJn21khRg');
			$message = array(
				'html' => '<p>Example HTML content</p>',
				'text' => 'Example text content',
				'subject' => 'Sign up in Loading Shoes',
				'from_email' => 'productionsLoading@gmail.com',
				'from_name' => 'Productions Loading',
				'to' => array(
					array(
						'email' => 'judsirera@gmail.com',
						'name' => 'Judith Sirera',
						'type' => 'to'
					)
				),
				'important' => true,
				'track_opens' => null,
				'track_clicks' => null,
				'auto_text' => null,
				'auto_html' => null,
				'inline_css' => null,
				'url_strip_qs' => null,
				'preserve_recipients' => null,
				'view_content_link' => null,
				'bcc_address' => 'message.bcc_address@example.com',
				'tracking_domain' => null,
				'signing_domain' => null,
				'return_path_domain' => null,
				'merge' => true,
				'merge_language' => 'mailchimp',
				'global_merge_vars' => array(
					array(
						'name' => 'merge1',
						'content' => 'merge1 content'
					)
				),
				'merge_vars' => array(
					array(
						'rcpt' => 'recipient.email@example.com',
						'vars' => array(
							array(
								'name' => 'merge2',
								'content' => 'merge2 content'
							)
						)
					)
				),
				'tags' => array('password-resets'),
				'subaccount' => 'customer-123',
				'google_analytics_domains' => array('example.com'),
				'google_analytics_campaign' => 'message.from_email@example.com',
				'metadata' => array('website' => 'www.example.com'),
				'recipient_metadata' => array(
					array(
						'rcpt' => 'recipient.email@example.com',
						'values' => array('user_id' => 123456)
					)
				),
				'attachments' => array(
					array(
						'type' => 'text/plain',
						'name' => 'myfile.txt',
						'content' => 'ZXhhbXBsZSBmaWxl'
					)
				),
				'images' => array(
					array(
						'type' => 'image/png',
						'name' => 'IMAGECID',
						'content' => 'ZXhhbXBsZSBmaWxl'
					)
				)
			);

			$async = false;
			$ip_pool = 'Main Pool';
			$send_at = new DateTime('now');
			$result = $mandrill->messages->send($message, $async, $ip_pool, $send_at);
			print_r($result);


		} catch(Mandrill_Error $e) {
			// Mandrill errors are thrown as exceptions
			echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
			// A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
			throw $e;
		}

	}

}