<?php
include_once( PATH_CONTROLLERS . 'pages/logged.ctrl.php' );

/**
 * Home Controller: Controller example.

 */
class PagesMyProductsController extends PagesLoggedController
{
	protected $view = 'pages/myProducts.tpl';
	private $obj;
	private $dataProducts;
	private $actualPage;
	private $actualData;
	private $totalPrice;
	private $limitPages;
	private $isPrevDis = "";
	private $isNextDis = "";


	public function build()
	{
		if($this->isLogged())
		{
			$this->setLayout( $this->view );

			$this->obj = $this->getClass('PagesProductModel');

			$this->actualPage = 1;
			if ($this->getParams()['url_arguments'][0])
			{
				$this->actualPage = $this->getParams()['url_arguments'][0];
			}
			$this->assign('actual_page', $this->actualPage);
			$this->assign('prev_page', $this->actualPage - 1);
			$this->assign('next_page', $this->actualPage + 1);


			$this->getCash();
			$this->setProductsForPage();
			$this->setPages();
			$this->setDateFormat();
			$this->setImagesPath();


		}else{

			$this->setLayout($this->error403);
		}

	}

	private function getCash(){

		$this->dataProducts = $this->obj->getAllProductsByUser($this->username);
		$totalProducts = sizeof($this->dataProducts);

		for ($i = 0; $i < sizeof($this->dataProducts); $i++)
		{
			$this->totalPrice += $this->dataProducts[$i]['price'];
		}
		$this->assign("price", $this->totalPrice);
		$this->assign("numberOfProducts",$totalProducts );

	}

	private function setProductsForPage(){

		for ($i = $this->actualPage*10 - 10; $i <= 10*$this->actualPage && $i < sizeof($this->dataProducts); $i++)
		{
			$this->actualData[$i-($this->actualPage - 1)*10] = $this->dataProducts[$i];
		}
		$this->assign("products", $this->actualData);

	}

	private function setPages(){

		$totalPages = sizeof($this->dataProducts) / 10;
		if (!is_int($totalPages))
		{
			$totalPages = floor($totalPages);
			$totalPages++;
		}
		for ($i = 0; $i < $totalPages; $i++)
		{
			$this->limitPages[$i] = $i + 1;
		}
		$this->assign('limit_pages', $this->limitPages);


		if($this->actualPage - 1 <= 0) $this->isPrevDis = 'disabled';
		if($this->actualPage + 1 > $totalPages) $this->isNextDis = 'disabled';

		$this->assign('isPrevDis', $this->isPrevDis);
		$this->assign('isNextDis', $this->isNextDis);

	}

	private function setDateFormat()
	{
		for ($i = 0; $i < sizeof($this->actualData); $i++)
		{
			$date = explode('-', $this->actualData[$i]['limit_date']);
			$dateLimit[$i]['date'] = $date[2] . "/" . $date[1] . "/" . $date[0];
			$dateLimit[$i]['id'] = $this->actualData[$i]['id'];
		}
		$this->assign('date', $dateLimit);
	}

	private function setImagesPath()
	{
		foreach ($this->actualData as $p)
		{
			$img = explode(".", $p['image_path']);
			$p['image_path'] = $img[0] . "_100x100." . $img[1];
			echo $p['image_path'];
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