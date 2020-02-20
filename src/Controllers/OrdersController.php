<?php


namespace Ifmo\Web\Controllers;
use Ifmo\Web\Core\Controller;
use Ifmo\Web\Core\DBConnection;
use Ifmo\Web\Core\Request;
use Ifmo\Web\Models\OrdersModel;

class OrdersController extends Controller
{
    private $db_connection;
    private $orders_model;

    public function __construct()
    {
        $this->db_connection = DBConnection::getInstance();
        $this->orders_model = new OrdersModel();
    }


    public function showUserOrders(){
        if(!isset($_SESSION['login']))
        {
                header('Location: /');
        }
        $login = $_SESSION['login'];

        //определение iduser по login
        $idUser= $this->orders_model->getIdUser($login);
        //получение номера корзины
        $idBaskets= $this->orders_model->getBaskets($idUser);
        //получение товаров по номеру корзин
        $goods = $this->orders_model->getGoods($idBaskets);


        //return $this->ajaxResponse(json_encode($goods));

        //поиск заказов с номером корзины user-а
        //$orders= $this->orders_model->getOrders($idBaskets);
        $data = [
            'page_title' => 'Заказы',
           'idBaskets' => $idBaskets,
            'all_goods' => $goods
        ];
        $content = 'orders/orders.php';
        return $this->generateResponse($content, $data);
    }


}