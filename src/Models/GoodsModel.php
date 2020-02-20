<?php


namespace Ifmo\Web\Models;
use Ifmo\Web\Core\DBConnection;

class GoodsModel
{
    const DBUPDATE_FAILED = 'Ошибка внесения данных в базу данных';
    const DBUPDATE_SUCCESS = 'Данные успешно внесены в базу данных';
    const BASKET_OK = 'Товары добавлены в корзину';
//    const ORDER_FAILED = 'Ошибка, заказ не сформирован';
//    const ORDER_SUCCESS = 'Заказ сформирован';
    private $db;
    public function __construct()
    {
        $this->db = DBConnection::getInstance();
    }

    public function getAllGoods($category) {
//        $sql = 'SELECT idsmartphone, title,  price, text, photo FROM smartphone,smartphone_info
//                WHERE smartphone.idsmartphone = smartphone_info.smartphones_idsmartphone ;';
        $sql = 'SELECT idgood, title,  price, text, photo, quantity,category  FROM goods WHERE category = :category;';
       // $sql = 'SELECT idgood, title,  price, text, photo, quantity,category  FROM goods;';
        return $this->db->execute($sql, ['category'=>$category], true);
      //  return $this->db->queryAll($sql);
    }
    public function getAll() {
        $sql = 'SELECT *  FROM goods';
        return $this->db->queryAll($sql);
    }
    public function getAllActions() {
        $sql = 'SELECT *  FROM actions';
        return $this->db->queryAll($sql);
    }
    public function getAllSliders() {
        $sql = 'SELECT *  FROM sliders';
        return $this->db->queryAll($sql);
    }
    public function getGoodsById($id) {
        $sql = 'SELECT idgood, title,  price, text, photo, quantity,category  FROM goods WHERE idgood = :id;';
      //  $sql = 'SELECT title,  price, photo,hardware  FROM goods RIGHT JOIN charSmartphones ON idgood=goods_idgood WHERE idgood = :id;';
       return $this->db->execute($sql, ['id'=>$id], false);
    }
    public function addDataInDB(array $user_data, array $files)
    {
        try {
            $key= $user_data['data'];
            if($key=='Товары')
            {
                $title = $user_data['title'];
                $price = (int)$user_data['price'];
                $category = $user_data['category'];
                $text = $user_data['textJSON'];
                $characteristics=$user_data['textJSON2'];
                $quantity = (int)$user_data['quantity'];
                $photo= PhotoModel::savePhoto($files,'photo');      //сохранение фото
                $goods_sql = "INSERT INTO goods (title,price,category,text,photo,quantity) VALUES (:title,:price,:category,:text,:photo,:quantity)";
                // начало транзакции
                $this->db->getConnection()->beginTransaction();

                // сохранение товаров
                $goods_params = [
                    'title' => $title,
                    'price' => $price,
                    'category' => $category,
                    'text' => $text,
                    'photo' => $photo,
                    'quantity' => $quantity
                ];
                $this->db->executeSql($goods_sql, $goods_params);

                $num=1;
                //чтение id последнего товара
                $sql = 'SELECT idgood  FROM goods ORDER BY idgood DESC LIMIT 1';
                $id_goods =$this->db->execute($sql,['1' => $num],false);                                                   //подумать как убрать!!!!!!!!

                //cохранение характеристик товара
                $char_sql = "INSERT INTO characteristics (text,goods_idgood) VALUES (:text,:id_goods)";

                $char_params = [
                    'text' => $characteristics,
                    'id_goods' => $id_goods['idgood']
                ];
                $this->db->executeSql($char_sql, $char_params);
            }
            else if($key == 'Акции') {
                $actionTitle = $user_data['actionTitle'];
                $actionText = $user_data['actionText'];
                $idgoods= $user_data['idGoodsForAction'];
                $actionPhoto=PhotoModel::savePhoto($files,'actionphoto');   //сохранение фото
                $action_sql = "INSERT INTO actions (title,text,photo,goods_idgood) VALUES (:actionTitle,:actionText,:actionPhoto,:idgoods)";
                // начало транзакции
                $this->db->getConnection()->beginTransaction(); //2801
                // сохранение акций
                $action_params = [
                    'actionTitle' => $actionTitle,
                    'actionText' => $actionText,
                    'actionPhoto' => $actionPhoto,
                    'idgoods'=> $idgoods
                ];
                $this->db->executeSql($action_sql, $action_params); //2801
            }
            else if($key == 'Слайдер') {
                $idgoods = $user_data['idGoodsForSlider'];
                $category = $user_data['categoryForSlider'];
                $sliderPhoto=PhotoModel::savePhoto($files,'photoSlider');   //сохранение фото
                $slider_sql = "INSERT INTO sliders (photo,goods_idgood,category) VALUES (:sliderPhoto,:idgoods,:category)";
                // начало транзакции
                $this->db->getConnection()->beginTransaction(); //2801
                // сохранение акций
                $slider_params = [
                    'sliderPhoto' => $sliderPhoto,
                    'idgoods'=> $idgoods,
                    'category' => $category
                ];
                $this->db->executeSql($slider_sql, $slider_params); //2801

            }
            // подтверждение транзакции
            $this->db->getConnection()->commit();//
            return self::DBUPDATE_SUCCESS;//
        }
        catch (Exception $e)
        {
            // Обработка ошибки
            // откат транзакции// 2801
            $this->db->getConnection()->rollBack();//возрат в состояние строки №53
            return self::DBUPDATE_FAILED;//
        }
    }

    public function DeleteDataInDB(array $dbData)
    {
        $category=$dbData["category"];

        if($category=='Товары') {
            $datas=$dbData["check"];
            try {
                foreach ($datas as $data) {

                    $sql = "DELETE FROM characteristics WHERE goods_idgood=:id;";       //неучитвается category
                    $this->db->getConnection()->beginTransaction();
                    $params = [
                        'id' => $data,
                    ];
                    $this->db->executeSql($sql, $params);
                    // подтверждение транзакции
                    $this->db->getConnection()->commit();

                    $sql = "DELETE FROM sliders WHERE goods_idgood=:id;";       //неучитвается category
                    $this->db->getConnection()->beginTransaction();
                    $params = [
                        'id' => $data,
                    ];
                    $this->db->executeSql($sql, $params);
                    // подтверждение транзакции
                    $this->db->getConnection()->commit();

                    $sql = "DELETE FROM actions WHERE goods_idgood=:id;";       //неучитвается category
                    $this->db->getConnection()->beginTransaction();
                    $params = [
                        'id' => $data,
                    ];
                    $this->db->executeSql($sql, $params);
                    // подтверждение транзакции
                    $this->db->getConnection()->commit();

                    $sql = "DELETE FROM goods_has_basket WHERE goods_idgood=:id;";       //неучитвается category
                    $this->db->getConnection()->beginTransaction();
                    $params = [
                        'id' => $data,
                    ];
                    $this->db->executeSql($sql, $params);
                    // подтверждение транзакции
                    $this->db->getConnection()->commit();

                    $sql = "DELETE FROM goods WHERE goods.idgood = :id";
                    $this->db->getConnection()->beginTransaction();

                    $params = [
                        'id' => $data,
                    ];
                    $this->db->executeSql($sql, $params); //2801
                    // подтверждение транзакции
                    $this->db->getConnection()->commit();//
                }
                return self::DBUPDATE_SUCCESS;//
            } catch (Exception $e) {
                // Обработка ошибки
                // откат транзакции// 2801
                $this->db->getConnection()->rollBack();//возрат в состояние строки №53
                return self::DBUPDATE_FAILED;//
            }
        }
        else if($category=='Акции') {
            $datas=$dbData["checkAction"];
            try{
                foreach ($datas as $data) {
                    $sql = "DELETE FROM actions WHERE idaction=:id;";       //неучитвается category
                    $this->db->getConnection()->beginTransaction();
                    $params = [
                        'id' => $data,
                    ];
                    $this->db->executeSql($sql, $params);
                    // подтверждение транзакции
                    $this->db->getConnection()->commit();
                }

                return self::DBUPDATE_SUCCESS;//
            }
            catch (Exception $e){
                $this->db->getConnection()->rollBack();//возрат в состояние строки №53
                return self::DBUPDATE_FAILED;//
            }
        }
        else if($category=='Слайдер') {
            $datas=$dbData["checkSlider"];
            try{
                foreach ($datas as $data) {
                    $sql = "DELETE FROM sliders WHERE idslider=:id;";       //неучитвается category
                    $this->db->getConnection()->beginTransaction();
                    $params = [
                        'id' => $data,
                    ];
                    $this->db->executeSql($sql, $params);
                    // подтверждение транзакции
                    $this->db->getConnection()->commit();
                }

                return self::DBUPDATE_SUCCESS;//
            }
            catch (Exception $e){
                $this->db->getConnection()->rollBack();//возрат в состояние строки №53
                return self::DBUPDATE_FAILED;//
            }
        }
    }
    public function ChangeDataInDB(array $data)
    {
        $id= $data["id"];


        $title = $data["name"];
        $value = $data["value"];



            try {

//                foreach ($idgoods as $id) {

                    $sql = "UPDATE goods SET $title = :text WHERE goods.idgood = :id";
                    $this->db->getConnection()->beginTransaction(); //2801

                    // сохранение товаров
                    $params = [
                        'id' => $id,
//                        'title' => $title,
                        'text' => $value
                    ];
                    $this->db->executeSql($sql, $params); //2801
                    // подтверждение транзакции
                    $this->db->getConnection()->commit();//

               // }
                return self::DBUPDATE_SUCCESS;//
            }
            catch (Exception $e) {
                // Обработка ошибки
                // откат транзакции// 2801
                $this->db->getConnection()->rollBack();//возрат в состояние строки №53
                return self::DBUPDATE_FAILED;//
            }
    }
    public  function getGoodsChar($section,$id)
    {
        if($section=="description") {
            $sql = 'SELECT text  FROM goods WHERE idgood=:id;';
        }
        // $sql = 'SELECT idgood, title,  price, text, photo, quantity,category  FROM goods WHERE idgood = :id;';
        //  $sql = 'SELECT text  FROM characteristics WHERE goods_idgood=:id;';
        if($section=="specification")
        $sql = 'SELECT text  FROM characteristics WHERE goods_idgood=:id;';

      //  $sql = 'SELECT text  FROM goods WHERE idgood=:id;';

        return $this->db->execute($sql, ['id'=>$id], false);
    }
//    public function saveOrder(){
//        $login= $_SESSION['login'];
//        $idgoods= $_SESSION['idgoods'];
//        $price= $_SESSION['price'];
//        $quantity= "10";
//
//        $sql = 'SELECT iduser  FROM users WHERE login = :login;';
//        $iduser= $this->db->execute($sql, ['login'=>$login], false);



//        try {
//            $sql = "INSERT INTO basket (users_iduser) VALUE (:iduser)";
//            $this->db->getConnection()->beginTransaction();
//            $params = [
//                'iduser' => $iduser['iduser']
//            ];
//            $this->db->executeSql($sql, $params);
//            // подтверждение транзакции
//            $this->db->getConnection()->commit();
//
//        }
//        catch (Exception $e) {
//            // Обработка ошибки
//            // откат транзакции// 2801
//            $this->db->getConnection()->rollBack();//возрат в состояние строки №53
//            return self::ORDER_FAILED;//
//        }



    //SELECT * FROM tbl1 ORDER BY id DESC LIMIT 1

       // $sql = 'SELECT idbasket  FROM basket WHERE users_iduser = :iduser;';
       // $idbasket= $this->db->execute($sql, ['iduser'=>$iduser['iduser']], false);
//        $num=1;
//        //считываем последнюю запись  в корзине (idbasket)
//        $sql = 'SELECT idbasket  FROM basket ORDER BY idbasket DESC LIMIT 1';
//        $idbasket= $this->db->execute($sql,['1' => $num],false);

//        try {
//            //$sql = "UPDATE goods_has_basket SET basket_idbasket = :idbasket";
//            $sql= "INSERT INTO goods_has_basket (goods_idgood,basket_idbasket,pricegoods,quantitygoods) VALUES (:idgoods,:idbasket,:price, :quantity)";
//            $this->db->getConnection()->beginTransaction();
//            $params = [
//                'idgoods' => $idgoods,
//                'idbasket' => $idbasket['idbasket'],
//                'price' => $price,
//                'quantity' => $quantity,
//            ];
//            $this->db->executeSql($sql, $params);
//            // подтверждение транзакции
//            $this->db->getConnection()->commit();
//
//            $sql = 'INSERT INTO orders(basket_idbasket) VALUE (:idbasket)';
//            $this->db->getConnection()->beginTransaction();
//            $this->db->executeSql($sql, ['idbasket'=>$idbasket['idbasket']]);
//            // подтверждение транзакции
//            $this->db->getConnection()->commit();
//
//
//
//            return self::ORDER_SUCCESS;//
//////
//        }
//        catch (Exception $e) {
//            // Обработка ошибки
//            // откат транзакции// 2801
//            $this->db->getConnection()->rollBack();//возрат в состояние строки №53
//            return self::ORDER_FAILED;//
//        }
//
//    }
}