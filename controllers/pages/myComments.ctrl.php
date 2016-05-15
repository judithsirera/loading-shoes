<?php
include_once( PATH_CONTROLLERS . 'pages/logged.ctrl.php' );

/**
 * Home Controller: Controller example.

 */
class PagesMyCommentsController extends PagesLoggedController
{
	private $view = 'pages/myComments.tpl';
	private $obj_user;
	private $obj_comment;
	private $allComments;
	private $actualData;
	private $dates;
	private $from_userImgs;
	private $actualPage;
	private $limitPages;
	private $isPrevDis;
	private $isNextDis;


	public function build()
	{
		if($this->isLogged())
		{
			$this->obj_comment = $this->getClass('PagesCommentModel');
			$this->obj_user = $this->getClass('PagesUserModel');

			$this->getUserParam();

			$this->getAllComments();
			if (sizeof($this->allComments) > 0) {
				$this->setCommentsForPage();
				$this->setFromUserImgs();
				$this->setDateFormat();
			}
			$this->setPages();
			$this->setTemplate();

			$this->setLayout($this->view);
		}else{
			$this->setLayout($this->error403);
		}

	}

	private function getUserParam()
	{
		$this->actualPage = 1;
		if ($this->getParams()['url_arguments'])
		{
			$this->actualPage = $this->getParams()['url_arguments'][0];

		}
	}

	private function getAllComments()
	{
		$this->allComments = $this->obj_comment->getAllCommentsToOrderByDate($this->username);
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
		$this->assign('from_userImgs', $this->from_userImgs);
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