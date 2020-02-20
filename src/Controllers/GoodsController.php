<?php


namespace Ifmo\Web\Controllers;

use Ifmo\Web\Core\Controller;
use Ifmo\Web\Core\DBConnection;
use Ifmo\Web\Core\Request;

use Ifmo\Web\Models\GoodsModel;
use Ifmo\Web\Models\OrdersModel;

class GoodsController extends Controller
{
    private $db_connection;
    private $goods_model;
    private $order_model;
    public function __construct()
    {
        $this->db_connection = DBConnection::getInstance();
        $this->order_model = new OrdersModel();
        $this->goods_model = new GoodsModel();
    }

    public function indexAction(Request $request)
    {
        $category = $request->params()['category'];

        $content = 'goods/goods.php';
        $goods = $this->goods_model->getAllGoods($category);
        //var_dump($articles);
        $data = [
            'page_title' => 'Смартфоны',
            'all_goods' => $goods,
        ];

        return $this->generateResponse($content, $data);
    }
    public function showAction(Request $request)
    {
        $id = $request->params()['id'];

        $content = 'goods/good.php';
        $position = $this->goods_model->getGoodsById($id);
        $data = [
            'page_title' => $position['title'],
            'position' => $position,
        ];
        return $this->generateResponse($content, $data);
    }
    public function updateGoods(Request $request)
    {

        $formData = $request->post(); // массив POST со всеми полученными данными
        $files= $request->files();

        $result = $this->goods_model->addDataInDB($formData,$files);

        return $this->ajaxResponse($result);

    }
    public function deleteData(Request $request)
    {
        $dbData = $request->post(); // массив POST с отмеченными позициями

        $result = $this->goods_model->DeleteDataInDB($dbData );
        return $this->ajaxResponse($result);
    }
    public function changeData(Request $request)
    {
        $data = $request->post(); // массив POST с отмеченными позициями
        $result = $this->goods_model->ChangeDataInDB($data);
        return $this->ajaxResponse($result);

    }
    public function char(Request $request)
    {
        $section = $request->params()['section'];
        $id = $request->params()['id'];
       // $result="{\"1\":[\"описание\",\"значение\"]}";
        $result = $this->goods_model->getGoodsChar($section,$id);
        return $this->ajaxResponse(json_encode($result,JSON_UNESCAPED_UNICODE));
    }
    public function buyGoods(Request $request){
        $category = $request->params()['category'];
        $id = $request->params()['id'];
        $_SESSION['idgoods'][] = $id;
        $dataGoods = $this->goods_model->getGoodsById($id);
        $title = $dataGoods['title'];
        $price = $dataGoods['price'];
        $_SESSION['title'][] = $title;
        $_SESSION['price'][] = $price;
//        $data = $request->post();
//        $_SESSION['title'][] = $data['title'];
//        $_SESSION['price'][] = $data['price'];

        $result= GoodsModel::BASKET_OK;
        return $this->ajaxResponse($result);
    }
    public function showBasket(){
        if(!isset($_SESSION['login']))
        {
            header('Location: /authorisation');
        }
        $content = 'orders/basket.php';
        $data = [
            'page_title' => 'Корзина'
        ];
        return $this->generateResponse($content, $data);
    }
    public function order(Request $request)
    {

        $login = $_SESSION['login'];
        $id_user = $this->order_model->getIdUser($login);
        $id_basket = $this->order_model->setBasket($id_user);

        for ($i = 0; $i < count($_SESSION['idgoods'], COUNT_RECURSIVE); $i++) {

            $id_goods = $_SESSION['idgoods'][$i];
            $price = $_SESSION['price'][$i];
            $quantity=$request->post()['quantity'][$i];
            //$sql = 'SELECT iduser  FROM users WHERE login = :login;';
            // $iduser= $this->db->execute($sql, ['login'=>$login], false);

            $this->order_model->saveBasket($id_goods, $id_basket, $price, $quantity);
        }
          //  $result = $this->order_model->saveOrder($id_basket);
        $result="Заказ сформирован";                                 //!!!!!!!!!!!Переделать!!!!!
            unset($_SESSION['idgoods']);
            unset($_SESSION['title']);
            unset($_SESSION['price']);
            return $this->ajaxResponse($result);
    }
    public function orderCancel()
    {
        $result="Заказ отменен";                                 //!!!!!!!!!!!Переделать!!!!!
        unset($_SESSION['idgoods']);
        unset($_SESSION['title']);
        unset($_SESSION['price']);
        return $this->ajaxResponse($result);
    }

}
