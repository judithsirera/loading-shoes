<?php
include_once( PATH_CONTROLLERS . 'pages/logged.ctrl.php' );
/**
 * Home Controller: Controller example.

 */
class PagesNewProductController extends PagesLoggedController
{
	private $product_name = "";
    private $product_description = "";
	private $price = "";
	private $stock = "";
	private $limit_date = "";
    private $conditions;
    private $obj;
    private $photo;


    protected $view = 'pages/newproduct.tpl';

	public function build()
    {
        if ($this->isLogged())
        {
            $this->obj = $this->getClass('PagesProductModel');

            $this->getUserData();

            $this->insertProductData();

            $this->setLayout( $this->view );
        }else{
            $this->setLayout($this->error403);
        }



	}

	private function getUserData()
	{
		$this->product_name = Filter::getString('product_name');
		$this->product_description = Filter::getString('description_product');
		$this->price = Filter::getFloat('price');
        $this->stock = Filter::getInteger('quantity');
        $this->limit_date = Filter::getUnfiltered('limit_date');
        $this->conditions = Filter::getBoolean('conditions');

        $this->getPhoto();
    }

    private function getPhoto()
    {
        $ruta ="./imag/products/"; //ruta carpeta donde queremos copiar las imágenes
        $uploadFile_temporal = $_FILES['fileName']['tmp_name'];
        $this->photo = $_FILES['fileName']['name'];

        if (is_uploaded_file($uploadFile_temporal))
        {
            move_uploaded_file($uploadFile_temporal, $ruta . $this->photo);
        }
    }

	private function insertProductData()
	{
		if ($this->checkProductName() && $this->checkPrice() && $this->checkStock() && $this->checkConditions())
		{
            $this->setDate();
			$this->obj->insertNewProduct($this->product_name, $this->product_description, $this->price, $this->stock, $this->limit_date, $this->username, $this->photo);

        }else {
            $this->completeFields();
        }
    }

    private function setDate()
    {
        $date = explode("/", $this->limit_date);
        $this->limit_date = $date[2] . "-" . $date[1] . "-" . $date[0];
        $this->limit_date = date('Y-m-d', strtotime($this->limit_date));
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

    private function checkConditions()
    {

        if(empty($this->conditions))
        {
            $this->assign("error_msg", "Has d'acceptar les condicions");
            return false;
        }
        else {
            $this->assign('conditions', $this->conditions);
            return true;
        }
    }


    private function completeFields()
    {
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