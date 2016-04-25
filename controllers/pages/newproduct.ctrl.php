<?php
/**
 * Home Controller: Controller example.

 */
class PagesNewProductController extends Controller
{
	//private $user_name = "";
	private $product_name = "";
    private $product_description = "";
	private $price = "";
	private $stock = "";
	private $limit_date = "";


	protected $view = 'pages/newproduct.tpl';

	public function build()
    {

        $this->obj = $this->getClass(PagesProductModel);

		$this->getUserData();

		$this->insertProductData();


		$this->setLayout( $this->view );

	}

	private function getUserData()
	{
		//$this->user_name = Filter::getString('user_name');
		$this->product_name = Filter::getString('product_name');
		$this->product_description = Filter::getString('description_product');
		$this->price = Filter::getFloat('price');
        $this->stock = Filter::getInteger('quantity');
        $this->limit_date = Filter::getString('limit_date');

        echo $this->product_name;
        echo $this->product_description;
        echo $this->price;
        echo $this->stock;
        echo $this->limit_date;
    }

	private function insertProductData()
	{
		if ($this->checkProductName() && $this->checkPrice() && $this->checkStock() && $this->checkCaducity())
		{
			$this->obj->insertNewProduct($this->product_name, $this->product_description, $this->price, $this->stock, $this->limit_date);
            $this->completeFields();
		}
	}

	private function checkProductName()
	{
        if(empty($this->product_name))
        {
            return false;
        }

        if(strlen($this->product_name) > 50)
        {
            $this->assign("error_msg", "The product name is to long. 50 characters max.");
            return false;
        }

        $this->assign('product_name', $this->product_name);
		return true;
	}


	private function checkPrice()
	{
        if(empty($this->price))
        {
            return false;
        }

		if(($this->price) < 0)
        {
			$this->assign("error_msg", "The price must be a positive value.");
			return false;
		}

        $this->assign('price_value', $this->price);
        return true;

	}

	private function checkStock()
	{

        if(empty($this->stock))
        {
           return false;
        }
        if(($this->stock) < 0)
        {
            $this->assign("error_msg", "The quantity must be a positive value.");
            return false;
        }

        $this->assign('quantity_value', $this->stock);
        return true;
	}


    private function checkCaducity()
    {
        date_default_timezone_set('Europe/Madrid');
        $date = date('d/m/Y');

        $today_date_array = explode("/",$date);
        $limit_date_array = explode ("/",$this->limit_date);

        if(empty($this->limit_date))
        {
            return false;
        }
        if($today_date_array[2] > $limit_date_array[2])
        {
            $this->assign("error_msg", "The caducity date has to be a future day.");
            return false;
        }else if ($today_date_array[1] > $limit_date_array[1]){
            $this->assign("error_msg", "The caducity date has to be a future day.");
            return false;
        }else if ($today_date_array[0] > $limit_date_array[0]){
            $this->assign("error_msg", "The caducity date has to be a future day.");
            return false;
        }

        $this->assign('limit_date', $this->limit_date);
        return true;
    }


    private function completeFields()
    {
       // $this->assign('username_value', $this->user_name);
        $this->assign('product_name', $this->product_name);
        $this->assign('description_product', $this->product_description);
        $this->assign('price', $this->price);
        $this->assign('quantity_value', $this->stock);
        $this->assign('limit_date', $this->limit_date);
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