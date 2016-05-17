<?php
include_once( PATH_CONTROLLERS . 'pages/logged.ctrl.php' );
/**
 * Home Controller: Controller example.

 */
class PagesProductViewController extends PagesLoggedController
{
	protected $view = 'pages/productView.tpl';
    private $layout;
    private $product_url;
    private $product_id;
    private $product;
    private $dateLimit;
    private $starsAvaluation;
    private $obj_product;
    private $obj_user;
    private $obj_comment;
    private $image_user;

    private $date_comments;
    private $limitPages;
    private $actualPage;
    private $actualComments;
    private $isPrevDis;
    private $isNextDis;
    private $from_userImgs;
    private $allComments;



    public function build()
    {

        $this->layout = $this->view;
        $this->obj_product = $this->getClass('PagesProductModel');
        $this->obj_user = $this->getClass('PagesUserModel');
        $this->obj_comment = $this->getClass('PagesCommentModel');

        $this->getAllParams();

        $this->isLastUrl();

        if ($this->isLastUrl())
        {
            header("Location:" . URL_ABSOLUTE . '/p/' . $this->product['URL'] . '/id=' . $this->product['id']);
            exit();
        }else{
            if ($this->getProduct())
            {
                $this->product = $this->product[0];
                $this->updateViews();
                $this->setDateProductsFormat();
                $this->setStars();
                $this->setImagePath();
                $this->setProductTemplate();

                $this->getAllComments();
                $this->setCommentsForPage();
                $this->setPages();
                $this->setDateCommentsFormat();
                $this->setFromUserImgs();
                $this->setCommentsTemplate();
            }else{
                $this->layout = 'error/productNoExist.tpl';
            }
            $this->setLayout($this->layout);
        }


	}

    private function getAllParams()
    {
        if ($this->getParams()['url_arguments'])
        {
            $this->product_url = $this->getParams()['url_arguments'][0];
            $this->actualPage = 1;
            if(sizeof($this->getParams()['url_arguments']) > 1)
            {
                $info = $this->getParams()['url_arguments'][1];

                if (strpos($info, "id"))
                {
                    if ($this->getParams()['url_arguments'][2])
                    {
                        $this->actualPage = $this->getParams()['url_arguments'][2];
                    }
                }
            }
        }else{
            header("Location:" . URL_ABSOLUTE . '/products');
        }
    }



    private function getIdFromParams()
    {
        if (sizeof($this->getParams()['url_arguments']) > 1)
        {
            $this->product_name = $this->getParams()['url_arguments'][0];
            $this->product_id = $this->getParams()['url_arguments'][1];
            $this->product_id = explode("=", $this->product_id)[1];

        } else{
            $this->layout = $this->error404;
        }
    }

    private function isLastUrl()
    {
        $this->product = $this->obj_product->getProductByLastUrl($this->product_url);
        if (sizeof($this->product) > 1)
        {
            $this->getIdFromParams();
            $this->product = $this->obj_product->getProductById($this->product_id);
        }

        if(!empty($this->product))
        {
            $this->product = $this->product[0];
            return true;
        }
        return false;
    }

    private function getProduct()
    {
        $this->product = $this->obj_product->getProductByUrl($this->product_url);
        $this->getIdFromParams();

        if (sizeof($this->product) > 1)
        {
            $this->product = $this->obj_product->getProductById($this->product_id);
        }

        if (!isset($this->product) || $this->product_id != $this->product[0]['id'])
        {
            return false;
        }
        return true;
    }

    private function setDateProductsFormat()
    {
        $date = explode('-', $this->product['limit_date']);
        $this->dateLimit = $date[2] . "/" . $date[1] . "/" . $date[0];
    }

    private function setStars()
    {
        $sell_user = $this->product['usuari'];
        $stars = $this->obj_user->getUserByUsername($sell_user)[0]['success'];
        for ($i = 0; $i < 5; $i++)
        {
            if($i < $stars)
            {
                $this->starsAvaluation[$i] = "star";
                if ($stars - $i < 1 && $stars - $i > 0)
                {
                    $this->starsAvaluation[$i] = "star_half";
                }
            }else{
                $this->starsAvaluation[$i] = "star_border";

            }
        }
    }

    private function setImagePath()
    {
        $sell_user = $this->product['usuari'];
        $img = $this->obj_user->getUserByUsername($sell_user)[0]['image_path'];
        $info = explode(".", $img);
        $this->image_user = $info[0] . SIZE_100x100 . $info[1];

    }

    private function updateViews()
    {
        $views = $this->product['views'] + 1;
        $this->obj_product->updateViews($this->product['id'], $views);
    }

    private function setProductTemplate()
    {
        $this->assign('p', $this->product);
        $this->assign('date_limit', $this->dateLimit);
        $this->assign('stars', $this->starsAvaluation);
        $this->assign('image_user', $this->image_user);

        if ($this->isLogged())
        {
            $this->assign('user', $this->username);
        }else {
            $this->assign('user', "");
        }
        $this->assign('logged', $this->isLogged());

    }

    private function getAllComments()
    {
        $to_user = $this->product['usuari'];
        $this->allComments = $this->obj_comment->getAllCommentsToOrderByDate($to_user);
    }

    private function setCommentsForPage(){
        for ($i = $this->actualPage*10 - 10; $i <= 10*$this->actualPage && $i < sizeof($this->allComments); $i++)
        {
            $this->actualComments[$i-($this->actualPage - 1)*10] = $this->allComments[$i];
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

    private function setDateCommentsFormat()
    {
        for ($i = 0; $i < sizeof($this->actualComments); $i++)
        {
            $dateInfo = explode('-', $this->actualComments[$i]['date']);
            $this->date_comments[$i]['date'] = $dateInfo[2] . "/" . $dateInfo[1] . "/" . $dateInfo[0];
            $this->date_comments[$i]['id'] = $this->actualComments[$i]['id_comment'];
        }

    }

    private function setFromUserImgs()
    {
        for ($i = 0; $i < sizeof($this->actualComments); $i++) {
            $user_name = $this->actualComments[$i]['from_user'];
            $insert = true;
            foreach ($this->from_userImgs as $fu) {
                if ($fu['username'] == $user_name) {
                    $insert = false;
                }
            }

            if ($insert) {
                $from_user = $this->obj_user->getUserByUsername($user_name)[0];
                $info = explode(".", $from_user['image_path']);
                $this->from_userImgs[$i]['img'] = $info[0] . SIZE_100x100 . $info[1];
                $this->from_userImgs[$i]['username'] = $from_user['username'];
            }

        }
    }


    private function setCommentsTemplate()
    {
        $this->assign('to_user', $this->product['usuari']);
        $this->assign('from_userImgs', $this->from_userImgs);
        $this->assign('comments', $this->actualComments);
        $this->assign('numComments', sizeof($this->allComments));
        $this->assign('date', $this->date_comments);
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