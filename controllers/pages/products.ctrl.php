<?php
include_once( PATH_CONTROLLERS . 'pages/logged.ctrl.php' );
/**
 * Home Controller: Controller example.

 */
class PagesProductsController extends PagesLoggedController
{
    /*SEARCH productcs*/
    private $search = "";
    private $isSearch = false;
    private $areResults = false;

    /*ALL products*/
    private $products;
    private $diff;
    private $obj_product;
    private $obj_user;
    private $actualPage = 1;
    private $limitPages;
    private $isPrevDis = "";
    private $isNextDis = "";
    private $actualData;
    private $starsAvaluation;

	protected $view = 'pages/products.tpl';

	public function build()
    {

        $this->setLayout($this->view);

        $this->obj_product = $this->getClass('PagesProductModel');
        $this->obj_user = $this->getClass('PagesUserModel');

        $this->getAllParams();
        $this->getAllProducts();
        $this->setProductsForPage();
        $this->setStars();
        $this->setImagesPath();
        $this->setDaysToCaducate();
        $this->setPages();
        $this->setTemplate();


	}

    private function getAllParams()
    {
        if ($this->getParams()['url_arguments'])
        {
            $this->actualPage = $this->getParams()['url_arguments'][0];

        }
        if ($this->getParams()['url_arguments'][0] == "search" && $this->getParams()['url_arguments'][1])
        {
            $this->actualPage = 1;
            $this->search = $this->getParams()['url_arguments'][1];
            $this->isSearch = true;

            if ($this->getParams()['url_arguments'][2])
            {
                $this->actualPage = $this->getParams()['url_arguments'][2];
            }
        }
    }

    private function getAllProducts()
    {
        if ($this->isSearch)
        {
            $this->products = $this->obj_product->searchProduct($this->search);
            $this->areResults = true;
            if(sizeof($this->products) == 0)
            {
                $this->products = $this->obj_product->getAllProductsOrderByDate();
                $this->areResults = false;
            }
        }else{
            $this->products = $this->obj_product->getAllProductsOrderByDate();

        }
    }

    private function setProductsForPage()
    {
        for ($i = $this->actualPage*10 - 10; $i <= 10*$this->actualPage && $i < sizeof($this->products); $i++)
        {
            $this->actualData[$i-($this->actualPage - 1)*10] = $this->products[$i];
        }
    }

    private function setPages()
    {
        $totalPages = sizeof($this->products) / 10;
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

    private function setStars()
    {
        for($p = 0; $p < sizeof($this->actualData); $p++)
        {
            $sell_user = $this->actualData[$p]['usuari'];
            $stars = $this->obj_user->getUserByUsername($sell_user)[0]['success'];
            for ($i = 0; $i < 5; $i++)
            {
                if($i < $stars)
                {
                    $this->starsAvaluation[$p]['stars'][$i] = "star";
                    if ($stars - $i < 1 && $stars - $i> 0)
                    {
                        $this->starsAvaluation[$p]['stars'][$i] = "star_half";
                    }
                }else{
                    $this->starsAvaluation[$p]['stars'][$i] = "star_border";

                }
            }
            $this->starsAvaluation[$p]['id'] = $this->actualData[$p]['id'];
        }

    }

    private function setImagesPath()
    {
        foreach ($this->actualData as $p)
        {
            $img = explode(".", $p['image_path']);
            $p['image_path'] = $img[0] . "_600x600" . $img[1];
        }
    }

    private function setDaysToCaducate()
    {
        $today = getdate();
        $today = $today['year'] ."-" .$today['mon'] ."-" .$today['mday'];
        $today = date('d-m-Y', strtotime($today));


        for ($i = 0; $i < sizeof($this->actualData); $i++)
        {

            $date = $this->actualData[$i]['limit_date'];
            $date = date('d-m-Y', strtotime($date));
            $days_diff = $date - $today;

            $this->diff[$i]['days'] = $days_diff;
            $this->diff[$i]['id'] = $this->actualData[$i]['id'];
        }
    }

    private function setTemplate()
    {
        $this->assign('isResult', $this->isSearch);
        $this->assign('areResults', $this->areResults);
        $this->assign('word', $this->search);
        $this->assign('total_products', sizeof($this->products));
        $this->assign('products', $this->actualData);
        $this->assign('diff_days', $this->diff);
        $this->assign('stars', $this->starsAvaluation);
        $this->assign('actual_page', $this->actualPage);
        $this->assign('prev_page', $this->actualPage - 1);
        $this->assign('isPrevDis', $this->isPrevDis);
        $this->assign('next_page', $this->actualPage + 1);
        $this->assign('isNextDis', $this->isNextDis);
        $this->assign('limit_pages', $this->limitPages);
        $this->assign('user', $this->username);
        if ($this->isLogged())
        {
            $this->assign('user', $this->username);
        }else {
            $this->assign('user', "");
        }
        $this->assign('logged', $this->isLogged());

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