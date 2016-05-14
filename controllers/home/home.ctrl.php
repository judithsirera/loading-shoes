<?php
include_once( PATH_CONTROLLERS . 'pages/logged.ctrl.php' );
/**
 * Home Controller: Controller example.

 */
class HomeHomeController extends PagesLoggedController
{
	protected $view = 'home/home.tpl';
    private $last_product;
    private $most_Viewed;
    private $obj_product;
    private $obj_user;
	private $actualPage;


    public function build()
    {

        $this->obj_product = $this->getClass('PagesProductModel');
        $this->obj_user = $this->getClass('PagesUserModel');

        $this->getAllParams();

        $this->setLastProduct();
        $this->setMostViewed();

        $this->setLayout($this->view);

		//$this->setLayout('home/provaTW.tpl');



	}

    private function getAllParams()
    {
		$this->actualPage = 1;

        if ($this->getParams()['url_arguments'])
        {
			$this->actualPage = $this->getParams()['url_arguments'][0];

        }

    }

    private function setLastProduct(){
        $this->last_product = $this->obj_product->getLastProductInserted();

		$stars_last = $this->setStars($this->last_product);
		$img_last = $this->setImagesPath($this->last_product);
		$diff_last = $this->setDaysToCaducate($this->last_product);

        $this->assign('p_last', $this->last_product[0]);
		$this->assign('stars_last', $stars_last[0]);
		$this->assign('i_last', $img_last[0]['image_path']);
		$this->assign('diff_last', $diff_last);

	}

    private function setMostViewed(){
        $this->most_Viewed = $this->obj_product->getMostViewed();

		$stars_most = $this->setStars($this->most_Viewed);
		$img_most = $this->setImagesPath($this->most_Viewed);
		$diff_most = $this->setDaysToCaducate($this->most_Viewed);

		$this->setProductsForPage();
		$this->setMostViewedPages();
		$this->assign('stars_most', $stars_most);
		$this->assign('i_most', $img_most);
		$this->assign('diff_most', $diff_most);

    }

	private function setStars($actualData)
	{
		$starsAvaluation = false;
		for($p = 0; $p < sizeof($actualData); $p++)
		{
			$sell_user = $actualData[$p]['usuari'];
			$stars = $this->obj_user->getUserByUsername($sell_user)[0]['success'];
			for ($i = 0; $i < 5; $i++)
			{
				if($i < $stars)
				{
					$starsAvaluation[$p]['stars'][$i] = "star";
					if ($stars - $i < 1 && $stars - $i> 0)
					{
						$starsAvaluation[$p]['stars'][$i] = "star_half";
					}
				}else{
					$starsAvaluation[$p]['stars'][$i] = "star_border";

				}
			}
			$starsAvaluation[$p]['id'] = $actualData[$p]['id'];
		}

		return $starsAvaluation;

	}

	private function setImagesPath($actualData)
	{
		$imgs = false;
		for($i = 0; $i < sizeof($actualData); $i++)
		{
			$img_path = explode(".", $actualData[$i]['image_path']);
			$imgs[$i]['image_path'] = $img_path[0] . "_600x600." . $img_path[1];
			$imgs[$i]['id'] = $actualData[$i]['id'];
		}

		return $imgs;
	}

	private function setDaysToCaducate($actualData)
	{
		$diff = false;
		$today = getdate();
		$today = $today['year'] ."-" .$today['mon'] ."-" .$today['mday'];
		$today = date('d-m-Y', strtotime($today));

		for ($i = 0; $i < sizeof($actualData); $i++)
		{

			$date = $actualData[$i]['limit_date'];
			$date = date('d-m-Y', strtotime($date));
			$days_diff = $date - $today;

			$diff[$i]['days'] = $days_diff;
			$diff[$i]['id'] = $actualData[$i]['id'];
		}

		return $diff;
	}

	private function setProductsForPage(){

		$actualData = false;

		for ($i = $this->actualPage*10 - 10; $i < 10*$this->actualPage && $i < sizeof($this->most_Viewed); $i++)
		{
			$actualData[$i-($this->actualPage - 1)*10] = $this->most_Viewed[$i];
		}
		$this->assign("most_viewed", $actualData);

	}

	private function setMostViewedPages(){
		$limitPages = "";
		$isPrevDis = "";
		$isNextDis = "";

		$totalPages = sizeof($this->most_Viewed) / 10;
		if (!is_int($totalPages))
		{
			$totalPages = floor($totalPages);
			$totalPages++;
		}
		if($totalPages == 0)
		{
			$totalPages = 1;
		}
		for ($i = 0; $i < $totalPages; $i++)
		{
			$limitPages[$i] = $i + 1;
		}
		$this->assign('limit_pages', $limitPages);


		if($this->actualPage - 1 <= 0) $isPrevDis = 'disabled';
		if($this->actualPage + 1 > $totalPages) $isNextDis = 'disabled';

		$this->assign('limit_pages', $limitPages);
		$this->assign('actual_page', $this->actualPage);
		$this->assign('next_page', $this->actualPage + 1);
		$this->assign('prev_page', $this->actualPage - 1);
		$this->assign('isPrevDis', $isPrevDis);
		$this->assign('isNextDis', $isNextDis);

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