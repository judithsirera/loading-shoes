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
    private $photo;
    private $url;
    private $obj_product;
    private $obj_user;


    protected $view = 'pages/newProduct.tpl';

	public function build()
    {

        if ($this->isLogged())
        {
            $this->obj_product = $this->getClass('PagesProductModel');
            $this->obj_user = $this->getClass('PagesUserModel');

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
		$this->product_description = Filter::getUnfiltered('description_product');
		$this->price = Filter::getFloat('price');
        $this->stock = Filter::getInteger('quantity');
        $this->limit_date = Filter::getUnfiltered('limit_date');
        $this->conditions = Filter::getBoolean('conditions');

        $this->product_description = addslashes($this->product_description);
        $this->getImage();
    }

    private function getImage()
    {
        $ruta ="./imag/products/"; //ruta carpeta donde queremos copiar las imágenes
        $uploadFile_temporal = $_FILES['fileName']['tmp_name'];
        $this->photo = $_FILES['fileName']['name'];

        if (filesize($uploadFile_temporal) > TWO_MB)
        {
            echo filesize($uploadFile_temporal);
            $this->assign("error_msg", "The file size is 2MB maximum.");
            $this->photo = false;
        }else{
            if (is_uploaded_file($uploadFile_temporal))
            {
                move_uploaded_file($uploadFile_temporal, $ruta . $this->photo);
            }


            $this->redimImage(400, 300);
            $this->redimImage(100, 100);
        }


    }

    private function redimImage($new_width, $new_height)
    {
        $ruta = "./imag/products/";
        $filename = $ruta . $this->photo;
        $info = explode(".", $this->photo);
        $newFilename = $info[0] . "_" . $new_width . "x" . $new_height . "." . $info[1];

        list($width, $height) = getimagesize($filename);
        if ($info[1] == 'jpg') {
            $image_p = imagecreatetruecolor($new_width, $new_height);
            $image = imagecreatefromjpeg($filename);
            imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            imagejpeg($image_p, $ruta . $newFilename);
        } elseif ($info[1] == 'gif') {
            $image_p = imagecreatetruecolor($new_width, $new_height);
            $image = imagecreatefromgif($filename);
            imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            imagegif($image_p, $ruta . $newFilename);
        } elseif ($info[1] == 'png') {
            $image_p = imagecreatetruecolor($new_width, $new_height);
            $image = imagecreatefrompng($filename);
            imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            imagepng($image_p, $ruta . $newFilename);
        }
    }

	private function insertProductData()
	{
		if ($this->checkProductName() && $this->checkPrice() && $this->checkStock() && $this->photo && $this->checkConditions())
		{
            if ($this->enoughMoney())
            {
                $this->setDate();
                $this->setUrl();
                $this->obj_product->insertNewProduct($this->product_name, $this->product_description, $this->price, $this->stock, $this->limit_date, $this->username, $this->photo, $this->url);
                $this->updateUsersMoney();

                $product = $this->obj_product->getLastProductInserted($this->url)[0];
                header('Location: ' . URL_ABSOLUTE . '/p/' . $this->url . '/id=' . $product['id']);
            }else{
                $this->view = 'error/noMoney.tpl';
            }


        }else {
            $this->completeFields();
        }
    }

    private function setDate()
    {
        $date = strtotime($this->limit_date);
        $this->limit_date = date('Y-m-d', $date);
    }

    private function setUrl()
    {
        $this->url = $this->product_name;
        $this->url = str_replace(" ", "-", $this->url);
    }

    private function enoughMoney()
    {
        $publish_price = 1;
        if ($this->money - $publish_price < 0)
        {
            return false;
        }
        return true;
    }

    private function updateUsersMoney()
    {
        $publish_price = 1;

        //update money to user who is buying
        $this->money = $this->money - $publish_price;
        $this->obj_user->updateMoney($this->username, $this->money);
        $this->updateMoney();
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