<?php
include_once( PATH_CONTROLLERS . 'pages/logged.ctrl.php' );

/**
 * Home Controller: Controller example.

 */
class PagesUsercommentsController extends PagesLoggedController
{
	private $view = 'pages/userComments.tpl';
	private $obj_comment;
	private $obj_purchase;
	private $obj_user;
	private $to_user;
	private $to_userData;
	private $isEnableToComment;
	private $allComments;
	private $actualData;
	private $dates;
	private $from_userImgs;
	private $actualPage;
	private $limitPages;
	private $isPrevDis;
	private $isNextDis;
	private $delete = false;
	private $edit = false;
	private $id_edDel;


	public function build()
	{
		if($this->isLogged())
		{
			$this->obj_comment = $this->getClass('PagesCommentModel');
			$this->obj_purchase = $this->getClass('PagesPurchaseModel');
			$this->obj_user = $this->getClass('PagesUserModel');

			$this->getUserParam();


			if($this->delete)
			{
				$this->obj_comment->deleteCommentById($this->id_edDel);
				header('Location: '.URL_ABSOLUTE.'/user-comments/'.$this->to_user);
			}elseif ($this->edit)
			{

				$this->view = 'pages/editUserComments.tpl';
				$this->setToUserInfo();
				$this->completeFields();
				$this->editComment();
				$this->assign('to_user', $this->to_userData);

			}else{

				if($this->to_user == $this->username)
				{
					header('Location: '.URL_ABSOLUTE.'/my-comments');
				}else{
					if(!empty($this->to_user))
					{
						$this->isEnableToComment();
						$this->getAllComments();
						$this->setToUserInfo();
						if (sizeof($this->allComments) > 0) {
							$this->setCommentsForPage();
							$this->setFromUserImgs();
							$this->setDateFormat();
						}
						$this->setPages();
						$this->setTemplate();

						if ($this->isEnableToComment){
							$this->makeComment();
						}
						$this->setTemplate();
					}
				}
			}

			$this->setLayout($this->view);
		}else{
			$this->setLayout($this->error403);
		}

	}

	private function getUserParam()
	{
		if ($this->getParams()['url_arguments'])
		{
			$this->to_user = $this->getParams()['url_arguments'][0];

			$this->actualPage = 1;
			if(sizeof($this->getParams()['url_arguments']) > 1)
			{
				$this->actualPage = $this->getParams()['url_arguments'][1];
				$this->edit = $this->getParams()['url_arguments'][2] == "edit";
				$this->delete = $this->getParams()['url_arguments'][2] == "delete";
				$id = $this->getParams()['url_arguments'][3];
				$id_info = explode('=', $id);
				$this->id_edDel = $id_info[1];
			}
		}
	}

	private function completeFields()
	{
		$comment = $this->obj_comment->getCommentById($this->id_edDel)[0];
		$this->assign('c_toEdit', $comment);
	}

	private function editComment()
	{
		if (Filter::getString("edit"))
		{
			$subject = Filter::getString('subject');
			$comment = Filter::getUnfiltered('commentText');
			if($subject || $comment)
			{
				if ($comment)
				{
					$comment = addslashes($comment);
				}

				$this->obj_comment->updateComment($this->id_edDel, $subject, $comment);

			}
			header('Location: '.URL_ABSOLUTE.'/user-comments/'.$this->to_user);

		}
	}

	private function isEnableToComment()
	{
		$numPurchases = $this->obj_purchase->purchasesFromUserToUser($this->username, $this->to_user);
		$numPurchases = $numPurchases[0]['numPurchases'];

		$numComments = $this->obj_comment->getCommentByToAndFrom($this->to_user, $this->username);
		$numComments = $numComments[0]['numComments'];

		$this->isEnableToComment = $numPurchases > 0 && $numComments == 0;
	}

	private function getAllComments()
	{
		$this->allComments = $this->obj_comment->getAllCommentsToOrderByDate($this->to_user);
	}

	private function setCommentsForPage(){

		for ($i = $this->actualPage*10 - 10; $i <= 10*$this->actualPage && $i < sizeof($this->allComments); $i++)
		{
			$this->actualData[$i-($this->actualPage - 1)*10] = $this->allComments[$i];
		}

	}

	private function setPages(){

		$totalPages = sizeof($this->allComments) / 10;
		if($totalPages == 0)
		{
			$totalPages = 1;
		}
		if (!is_int($totalPages))
		{
			$totalPages = floor($totalPages);
			$totalPages++;
		}
		for ($i = 0; $i < $totalPages; $i++)
		{
			$this->limitPages[$i] = $i + 1;
		}


		if($this->actualPage - 1 <= 0) $this->isPrevDis = 'disabled';
		if($this->actualPage + 1 > $totalPages) $this->isNextDis = 'disabled';

	}

	private function setDateFormat()
	{
		for ($i = 0; $i < sizeof($this->actualData); $i++)
		{
			$dateInfo = explode('-', $this->actualData[$i]['date']);
			$this->dates[$i]['date'] = $dateInfo[2] . "/" . $dateInfo[1] . "/" . $dateInfo[0];
			$this->dates[$i]['id'] = $this->actualData[$i]['id_comment'];
		}

	}

	private function setToUserInfo()
	{
		$this->to_userData['username'] = $this->to_user;
		$this->to_userData['id'] = $this->obj_user->getUserByUsername($this->to_user)[0]['id_user'];
		$this->setStars();
		$this->setImagePath();
	}

	private function setStars()
	{
		$stars = $this->obj_user->getUserByUsername($this->to_user)[0]['success'];
		for ($i = 0; $i < 5; $i++)
		{
			if($i < $stars)
			{
				$this->to_userData['stars'][$i] = "star";
				if ($stars - $i < 1 && $stars - $i> 0)
				{
					$this->to_userData['stars'][$i] = "star_half";
				}
			}else{
				$this->to_userData['stars'][$i] = "star_border";

			}
		}

	}

	private function setImagePath()
	{
		$img = $this->obj_user->getUserByUsername($this->to_user)[0]['image_path'];
		$info = explode(".", $img);
		$this->to_userData['image_path'] = $info[0] . SIZE_400x300 . $info[1];

	}

	private function setFromUserImgs()
	{
		for ($i = 0; $i < sizeof($this->actualData); $i++)
		{
			$user_name = $this->actualData[$i]['from_user'];
			$insert = true;
			foreach ($this->from_userImgs as $fu)
			{
				if($fu['username'] == $user_name)
				{
					$insert = false;
				}
			}

			if ($insert)
			{
				$from_user = $this->obj_user->getUserByUsername($user_name)[0];
				$info = explode(".", $from_user['image_path']);
				$this->from_userImgs[$i]['img'] = $info[0] . SIZE_100x100 . $info[1];
				$this->from_userImgs[$i]['username'] = $from_user['username'];
			}

		}
	}

	private function setTemplate()
	{
		$this->assign('to_user', $this->to_userData);
		$this->assign('from_userImgs', $this->from_userImgs);
		$this->assign('isEnableToComment', $this->isEnableToComment);
		$this->assign('comments', $this->actualData);
		$this->assign('numComments', sizeof($this->allComments));
		$this->assign('date', $this->dates);
		$this->assign('pages', $this->limitPages);
		$this->assign('actual_page', $this->actualPage);
		$this->assign('prev_page', $this->actualPage - 1);
		$this->assign('isPrevDis', $this->isPrevDis);
		$this->assign('next_page', $this->actualPage + 1);
		$this->assign('isNextDis', $this->isNextDis);
	}

	private function makeComment()
	{
		if (Filter::getString('comment') == 'comment') {
			$subject = Filter::getString('subject');
			$comment = Filter::getUnfiltered('commentText');

			$comment = addslashes($comment);

			$today = getdate();
			$date = $today['year'] ."-" .$today['mon'] ."-" .$today['mday'];

			$this->obj_comment->insertNewComment($subject, $comment, $date, $this->to_userData['username'], $this->username);
			header('Location: '.URL_ABSOLUTE.'/user-comments/' . $this->to_user);
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