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

    private $layout;


    public function build()
    {

        if($this->isLogged())
        {
            $this->obj_product = $this->getClass('PagesProductModel');
            $this->obj_purchase = $this->getClass('PagesPurchaseModel');
            $this->obj_user = $this->getClass('PagesUserModel');

            $this->getAllParams();
            if ($this->getProductToBuy() && $this->enoughMoney())
            {
                $this->getUsers();
                $this->updateUsersMoney();
                $this->updateStock();
                $this->insertPurchaseDB();
                $this->updateUserSuccess();

            }elseif (!$this->getProductToBuy())
            {
                $this->layout = 'error/productNoExist.tpl';
            }elseif (!$this->enoughMoney())
            {
                $this->layout = 'error/noMoney.tpl';
            }

        }else
        {
            $this->layout = $this->error403;
        }

        if(isset($this->layout))
        {
            $this->setLayout($this->layout);
        }else{
            header('Location: '.URL_ABSOLUTE.'/my-purchases');
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
            $this->layout = $this->error404;
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

    private function enoughMoney()
    {
        $product_price = $this->product_to_buy['price'];
        if ($this->money - $product_price < 0)
        {
            return false;
        }
        return true;
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
        $this->obj_purchase->insertNewPurchase($this->user_sell['username'], $this->username, $this->product_to_buy['name'], $this->product_to_buy['id'] , $date, $this->product_to_buy['price']);
    }

    private function updateUserSuccess()
    {
        $stadistics = $this->obj_purchase->getStadisticsByUserSell($this->user_sell['username'])[0];
        $percentage = $stadistics['sells'] / $stadistics['total'];

        $success = $percentage * 5;
        $this->obj_user->updateSuccess($this->user_sell['username'], $success);

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