<?php


namespace Ifmo\Web\Models;
use Ifmo\Web\Core\DBConnection;

class AccountModel
{
    const USER_EXISTS = 'Ошибка! Пользователь с таким именем существует!';
    const SUCCESS = "Авторизация администратора прошла успешно";//
    const SUCCESS1 = "Авторизация пользователя прошла успешно";//
    const BASKET = "В корзине есть товары";//
    const  ERROR = "Ошибка авторизации";//
    const REGISTRATION_FAILD = 'Ошибка регистрации';//
    const REGISTRATION_SUCCESS = 'РЕГИСТРАЦИЯ ПРОШЛА УСПЕШНО';//
    private  $db;
    public function __construct()
    {
        $this->db= DBConnection::getInstance();
    }
    public  function authorisation(array $formData){

        $login = $formData['login'];
        $pwd = $formData['pwd'];
        $user = $this->isUser($login);
        if(!$user) // если пользователя в БД не нашли
        {
            return self::ERROR;
        }
        if(!password_verify($pwd,$user["pwd"])){    // пароль не совпал                                     //!!!!
            return self::ERROR;
        }
        if($login=='admin')
        return self::SUCCESS;

        return self::SUCCESS1;
    }
    public function addUser(array $user_data){

        // проверка уникальности логина
        // password_hash();
        // добавление в таблицу user
        // добавление контактной информации
        //  в таблицу user_info

        $login = $user_data['login'];
        if ($this->isUser($login)) return self::USER_EXISTS;
        $pwd = $user_data['password'];
        $pwd = password_hash($pwd,PASSWORD_DEFAULT);

        $user_sql = "INSERT INTO users (login, pwd) VALUES (:login, :pwd)";
        //$user_info_sql = "INSERT INTO user_info(address, phone, user_iduser) VALUES (:address, :phone, :user_id)";

        try{
            // начало транзакции
            $this->db->getConnection()->beginTransaction(); //2801

            $user_params = [
                'login' => $login,
                'pwd'=>$pwd
            ];


            $this->db->executeSql($user_sql, $user_params); //2801
//            $info_params = [
//                'address'=>$user_data['address'],
//                'phone'=>$user_data['phone'],
//                'user_id'=>$this->db->getConnection()->lastInsertId() //2801
//            ];
//            $this->db->executeSql($user_info_sql, $info_params);//
            // подтверждение транзакции
            $this->db->getConnection()->commit();//
            return self::REGISTRATION_SUCCESS;//
        }
        catch (Exception $e)
        { // Обработка ошибки

            // откат транзакции// 2801
            $this->db->getConnection()->rollBack();//возрат в состояние строки №53
            return self::REGISTRATION_FAILD;//
        }
    }
    //проверка существования логина
    private function isUser(string $login){
        $sql = 'SELECT * FROM users WHERE login = :login';

        return $this->db->execute($sql, ['login'=>$login],false);
    }


}