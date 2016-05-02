<?php
include_once( PATH_CONTROLLERS . 'pages/logged.ctrl.php' );
/**
 * Home Controller: Controller example.

 */
class PagesBuyController extends PagesLoggedController
{
    private $obj_product;
    private $obj_purchase;
    private $obj_user;

    private $product_name;
    private $product_id;
    private $product_to_buy;
    private $user_sell;
    private $user_buy;

    private $error = false;
    private $errorProduct = 'error/productNoExist.tpl';



    public function build()
    {
        if($this->isLogged())
        {
            $this->obj_product = $this->getClass('PagesProductModel');
            $this->obj_purchase = $this->getClass('PagesPurchaseModel');
            $this->obj_user = $this->getClass('PagesUserModel');

            $this->getAllParams();
            if ($this->getProductToBuy())
            {
                $this->getUsers();
                $this->updateUsersMoney();
                $this->updateStock();
                $this->insertPurchaseDB();
                header('Location: '.URL_ABSOLUTE.'/my-purchases');

            }else{
                $this->setLayout( $this->errorProduct );
            }

        }else
        {
            $this->setLayout( $this->error403 );
        }

    }

    private function getAllParams()
    {
        if (sizeof($this->getParams()['url_arguments']) == 2)
        {
            $this->product_name = $this->getParams()['url_arguments'][0];
            $this->product_id = $this->getParams()['url_arguments'][1];
            $this->product_id = explode("=", $this->product_id)[1];

        } else{
            $this->error = true;
        }
    }

    private function getProductToBuy()
    {
        $this->product_to_buy = $this->obj_product->getProductById($this->product_id);
        if ($this->product_to_buy[0]['URL'] == $this->product_name)
        {
            $this->product_to_buy = $this->product_to_buy[0];
            return true;
        }
        return false;
    }

    private function getUsers()
    {
        $this->user_sell = $this->obj_user->getUserByUsername($this->product_to_buy['usuari'])[0];
        $this->user_buy = $this->obj_user->getUserByUsername($this->username)[0];
    }

    private function updateUsersMoney()
    {
        $product_price = $this->product_to_buy['price'];

        //update money to user who is selling
        $user_money = $this->user_sell['money'];
        $this->obj_user->updateMoney($this->user_sell['username'], $user_money + $product_price);

        //update money to user who is buying
        $this->money = $this->money - $product_price;
        $this->obj_user->updateMoney($this->username, $this->money);
        $this->updateMoney();
    }

    private function updateStock()
    {
        $this->obj_product->updateStock($this->product_id, $this->product_to_buy['stock'] - 1);
    }

    private function insertPurchaseDB()
    {
        $today = getdate();
        $date = $today['year'] ."-" .$today['mon'] ."-" .$today['mday'];
        echo $date;
        $this->obj_purchase->insertNewPurchase($this->user_sell['username'], $this->username, $this->product_to_buy['name'] , $date, $this->product_to_buy['price']);
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