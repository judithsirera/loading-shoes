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



    public function build()
    {

        $this->layout = $this->view;
        $this->obj_product = $this->getClass('PagesProductModel');
        $this->obj_user = $this->getClass('PagesUserModel');

        $this->getAllParams();
        if ($this->getProduct())
        {
            $this->product = $this->product[0];
            $this->updateViews();
            $this->setDateFormat();
            $this->setStars();
            $this->setTemplate();
        }else{
            $this->layout = 'error/productNoExist.tpl';
        }
        $this->setLayout($this->layout);


	}

    private function getAllParams()
    {
        if ($this->getParams()['url_arguments'])
        {
            $this->product_url = $this->getParams()['url_arguments'][0];
        }else{
            header("Location:", URL_ABSOLUTE . '/products');
        }
    }

    private function getIdFromParams()
    {
        if (sizeof($this->getParams()['url_arguments']) == 2)
        {
            $this->product_name = $this->getParams()['url_arguments'][0];
            $this->product_id = $this->getParams()['url_arguments'][1];
            $this->product_id = explode("=", $this->product_id)[1];

        } else{
            $this->layout = $this->error404;
        }
    }

    private function getProduct()
    {
        $this->product = $this->obj_product->getProductByUrl($this->product_url);
        if (sizeof($this->product) > 1)
        {
            $this->getIdFromParams();
            $this->product = $this->obj_product->getProductById($this->product_id);
        }
        if (!isset($this->product))
        {
            return false;
        }
        return true;
    }

    private function setDateFormat()
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

    private function updateViews()
    {
        $views = $this->product['views'] + 1;
        $this->obj_product->updateViews($this->product['id'], $views);
    }

    private function setTemplate()
    {
        $this->assign('p', $this->product);
        $this->assign('date_limit', $this->dateLimit);
        $this->assign('stars', $this->starsAvaluation);
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