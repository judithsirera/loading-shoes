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
    private $obj;
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

        $this->obj = $this->getClass('PagesProductModel');

        $this->getAllParams();
        $this->getAllProducts();
        $this->setProductsForPage();
        $this->setStars();
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
            $this->products = $this->obj->searchProduct($this->search);
            $this->areResults = true;
            if(sizeof($this->products) == 0)
            {
                $this->products = $this->obj->getAllProductsByIdOrderByDate();
                $this->areResults = false;
            }
        }else{
            $this->products = $this->obj->getAllProductsByIdOrderByDate();

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
            $stars = $this->actualData[$p]['stars'];
            for ($i = 0; $i < 5; $i++)
            {
                if($i < $stars)
                {
                    $this->starsAvaluation[$p]['stars'][$i] = "star";
                }else{
                    $this->starsAvaluation[$p]['stars'][$i] = "star_border";
                }
            }
            $this->starsAvaluation[$p]['id'] = $this->actualData[$p]['id'];
        }
    }

    private function setTemplate()
    {
        $this->assign('isResult', $this->isSearch);
        $this->assign('areResults', $this->areResults);
        $this->assign('word', $this->search);
        $this->assign('total_products', sizeof($this->products));
        $this->assign('data', $this->actualData);
        $this->assign('stars', $this->starsAvaluation);
        $this->assign('actual_page', $this->actualPage);
        $this->assign('prev_page', $this->actualPage - 1);
        $this->assign('isPrevDis', $this->isPrevDis);
        $this->assign('next_page', $this->actualPage + 1);
        $this->assign('isNextDis', $this->isNextDis);
        $this->assign('limit_pages', $this->limitPages);

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