<?php
include_once( PATH_CONTROLLERS . 'pages/logged.ctrl.php' );
/**
 * Home Controller: Controller example.

 */
class PagesMyPurchasesController extends PagesLoggedController
{
	protected $view = 'pages/myPurchases.tpl';
	private $obj;
	private $purchases;
	private $products;
	private $dateLimit;
	private $totalPrice = 0;
	private $actualData;
	private $limitPages;
	private $actualPage;
	private $isPrevDis = "";
	private $isNextDis = "";

	public function build()
	{
		if($this->isLogged())
		{
			$this->setLayout( $this->view );
			$this->obj = $this->getClass('PagesPurchaseModel');

			$this->actualPage = 1;
			if ($this->getParams()['url_arguments'][0])
			{
				$this->actualPage = $this->getParams()['url_arguments'][0];
			}

			$this->getAllPurchases();
			$this->getAllProducts();
			$this->setPurchasesForPage();
			$this->setPages();
			$this->setDateFormat();
			$this->setTemplate();

		}else
		{
			$this->setLayout( $this->error403 );
		}

	}

	private function getAllPurchases()
	{
		$this->purchases = $this->obj->getPurchasesByUserBuy($this->username);

		for ($i = 0; $i < sizeof($this->purchases); $i++)
		{
			$this->totalPrice += $this->purchases[$i]['price'];
		}

	}

	private function getAllProducts()
	{
		$obj_product = $this->getClass('PagesProductModel');
		$this->products = $obj_product->getAllProducts();
	}

	private function setPurchasesForPage()
	{
		for ($i = $this->actualPage*10 - 10; $i <= 10*$this->actualPage && $i < sizeof($this->purchases); $i++)
		{
			$this->actualData[$i-($this->actualPage - 1)*10] = $this->purchases[$i];
		}
	}

	private function setPages()
	{
		$totalPages = sizeof($this->purchases) / 10;
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
			$date = explode('-', $this->actualData[$i]['purchase_date']);
			$this->dateLimit[$i]['date'] = $date[2] . "/" . $date[1] . "/" . $date[0];
			$this->dateLimit[$i]['id'] = $this->actualData[$i]['id'];
		}
	}

	private function setTemplate()
	{
		$this->assign('total_purchases', sizeof($this->purchases));
		$this->assign('total_price', $this->totalPrice);
		$this->assign('purchases', $this->actualData);
		$this->assign('products', $this->products);
		$this->assign('date', $this->dateLimit);
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