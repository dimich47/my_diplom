<?php


namespace Ifmo\Web\Models;
use Ifmo\Web\Core\DBConnection;

class OrdersModel
{
    private $db_orders;
    const ORDER_FAILED = 'Ошибка, заказ не сформирован';
    const ORDER_SUCCESS = 'Заказ сформирован';
    public function __construct()
    {
        $this->db_orders = DBConnection::getInstance();

    }

    public function getIdUser($login){

        $sql = 'SELECT iduser  FROM users WHERE login = :login;';
        $iduser= $this->db_orders->execute($sql, ['login'=>$login], false);
        return $iduser['iduser'];
    }
//    public function getOrders($idBaskets){
//
//        //поиск заказа где basket_idbasket=idbasket
//        foreach ($idBaskets as $idBasket) {
//            $sql = 'SELECT idorder  FROM orders WHERE basket_idbasket = :idBasket;';
//            $idOrders []= $this->db_orders->execute($sql, ['idBasket' => $idBasket['idbasket']], false);
//        }
//        return $idOrders;
//
//    }
    public function getBaskets($iduser){
        $sql = 'SELECT idbasket  FROM basket WHERE users_iduser = :iduser;';
        $idbaskets= $this->db_orders->execute($sql, ['iduser'=>$iduser], true);
        return $idbaskets;
    }
    public function getGoods($idBaskets){

        foreach ($idBaskets as $idBasket) {
           // $sql = 'SELECT goods_idgood,pricegoods,quantitygoods  FROM goods_has_basket WHERE basket_idbasket = :idBasket';
            $sql = 'SELECT goods_idgood,pricegoods,quantitygoods,title  FROM goods_has_basket  LEFT JOIN goods ON goods.idgood=goods_has_basket.goods_idgood WHERE basket_idbasket = :idBasket';
            $idGoods[]= $this->db_orders->execute($sql, ['idBasket' => $idBasket['idbasket']], true);
        }
        foreach ($idGoods as $idGood) {
        $Goods[]=$idGood;
        }
        return $idGoods;
    }
    public function setBasket($id_user)
    {
        $sql = "INSERT INTO basket (users_iduser) VALUE (:id_user)";
        $this->db_orders->getConnection()->beginTransaction();
        $params = [
            'id_user' => $id_user
        ];
        $this->db_orders->executeSql($sql, $params);
        // подтверждение транзакции
        $this->db_orders->getConnection()->commit();
        $num=1;
        //считываем последнюю запись  в корзине (idbasket)
        $sql = 'SELECT idbasket  FROM basket ORDER BY idbasket DESC LIMIT 1';
        $id_basket= $this->db_orders->execute($sql,['1' => $num],false);
        return $id_basket['idbasket'];
    }
    public function saveBasket($id_goods,$id_basket,$price,$quantity){


            $sql= "INSERT INTO goods_has_basket (goods_idgood,basket_idbasket,pricegoods,quantitygoods) VALUES (:idgoods,:idbasket,:price, :quantity)";
            $this->db_orders->getConnection()->beginTransaction();
            $params = [
                'idgoods' => $id_goods,
//                'idbasket' => $id_basket['idbasket'],
                'idbasket' => $id_basket,
                'price' => $price,
                'quantity' => $quantity,
            ];
            $this->db_orders->executeSql($sql, $params);
            // подтверждение транзакции
            $this->db_orders->getConnection()->commit();
    }
//    public function saveOrder($id_basket){
//        try{
//            $sql = 'INSERT INTO orders(basket_idbasket) VALUE (:idbasket)';
//            $this->db_orders->getConnection()->beginTransaction();
////            $this->db_orders->executeSql($sql, ['idbasket'=>$idbasket['idbasket']]);
//            $this->db_orders->executeSql($sql, ['idbasket'=>$id_basket]);
//            // подтверждение транзакции
//            $this->db_orders->getConnection()->commit();
//
//            return self::ORDER_SUCCESS;//
//        }
//        catch (Exception $e) {
//            // Обработка ошибки
//            // откат транзакции// 2801
//            $this->db_orders->getConnection()->rollBack();//возрат в состояние строки №53
//            return self::ORDER_FAILED;//
//        }
//    }
}