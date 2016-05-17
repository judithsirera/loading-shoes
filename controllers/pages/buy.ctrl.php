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
    private $user_sell_mail;
    private $user_sell_name;
    private $user_buy_name;

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
                if (!$this->isAlreadyBuy())
                {
                    $this->getUsers();
                    $this->updateUsersMoney();
                    $this->updateStock();
                    $this->insertPurchaseDB();
                    $this->updateUserSuccess();
                    $this->createAndSendEmail();
                }else {
                    $this->layout = 'error/alreadyBuy.tpl';
                }

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

    private function isAlreadyBuy()
    {
        $p = $this->obj_purchase->getPurchasesByProductId($this->product_id);

        if (sizeof($p) > 0)
        {
            return true;
        }
        return false;
    }

    private function getUsers()
    {
        $this->user_sell = $this->obj_user->getUserByUsername($this->product_to_buy['usuari'])[0];
        $this->user_sell_mail = $this->user_sell['email'];
        $this->user_sell_name = $this->user_sell['username'];
        $this->user_buy = $this->obj_user->getUserByUsername($this->username)[0];
        $this->user_buy_name = $this->user_buy['username'];

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

    private function createAndSendEmail(){
        $to = $this->user_sell_mail;
        $from = "From: Loading Shoes <productionsloading@gmail.com>";
        $subject = "You have sold a product";
        $content = "Content-Type: text/html; charset=ISO-8859-1";
        $headers = $from . "\r\n" . $content;


        $body = "<html>
                  <head>
                    <title>Product purchase</title>
                    <link href='http://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'><!-- Latest compiled and minified CSS -->
                    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'>
                    <style>
                        body{
                            font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif;
                        font-size: 14px;
                        line-height: 1.42857143;
                        color: #333;
                        background-color: #fff;
                      }
                      h1{
                            color: #852F06;
                        }
                      h3 {
                            color: #CC6B3C;
                            line-height: 1.5;
                      }
                      a{
                            color: #AC4D1F;
                        }
                      .box .a{
                            color: #AC4D1F;
                            font-size: 24px;
                            transform: translateX(-50%);
                            left: 50%;
                            position: absolute;
                      }
                      a:hover, a:active, a:focus{
                            text-decoration: none;
                            color: #852F06;
                      }
                      .box{
                            background-color: rgba(255,184,150,0.2);
                          border-radius: 10px;
                          padding: 30px 30px 30px 30px;
                          margin-top: 50px;
                          position: relative;
                          height: 260px;
                      }
                    </style>
                  </head>
                  <body>
                    <div class='container-fluid'>
                      <div class='row'>
                        <div class='col-md-3'></div>
                        <div class='col-md-6'>
                          <div class='box'>
                                <h1>Congratulations ".$this->user_sell_name."</h1>
                                <h3>You have sold your ".$this->product_name." to ".$this->user_buy_name."</h3>
                          </div>
                        </div>
                      </div>
                    </div>
                    <script type='text/javascript' src='https://code.jquery.com/jquery-2.1.1.min.js'></script>
                    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
                  </body>
                </html>";


        mail($to, $subject, $body, $headers);

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