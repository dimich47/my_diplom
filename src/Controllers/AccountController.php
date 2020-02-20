<?php


namespace Ifmo\Web\Controllers;

use Ifmo\Web\Core\Controller;
use Ifmo\Web\Core\Request;
use Ifmo\Web\Models\AccountModel;
use Ifmo\Web\Models\GoodsModel;

class AccountController extends Controller
{

    private $account_model;
    private $goods_model;
    public function __construct()
    {
        $this->account_model = new AccountModel();
        $this->goods_model = new GoodsModel();
    }

    public function indexAction()    {

        $content = 'account/authorisation.php';
        $data = [
            'page_title'=>'Авторизация',
        ];
        return $this->generateResponse($content, $data); ///templeteadmin
    }
    public function registration()    {

        $content = 'account/registration.php';
        $data = [
            'page_title'=>'Регистрация',
        ];
        return $this->generateResponse($content, $data,"template.php");
    }

    public function authorisation(Request $request){
        $formData = $request->post(); // массив POST со всеми полученными данными
        $result = $this->account_model->authorisation($formData);

        if($result == AccountModel::SUCCESS){
           $_SESSION['admin'] = $formData['login'];
       }
        else if($result == AccountModel::SUCCESS1){
            $_SESSION['login'] = $formData['login'];

            if(isset($_SESSION['idgoods'][0]) )        //если пользователь перед входом добавил в корзину товар
            $result= AccountModel::BASKET;
        }


       // $result="Авторизация прошла успешно";
        return $this->ajaxResponse($result);
    }

    public function account(){
        if(!isset($_SESSION['login'])){
            if(!isset($_SESSION['admin'])){
                header('Location: /');
            }
            $allGoods = $this->goods_model->getAll();
            $allActions = $this->goods_model->getAllActions();
            $allSliders = $this->goods_model->getAllSliders();
            $content = 'admin/accountAdmin.php';
            $data = [
                'page_title'=>'Личный кабинет администратора',
                'all_goods'=>$allGoods,
                'all_actions'=>$allActions,
                'all_sliders'=>$allSliders,
            ];
            return $this->generateResponse($content, $data);
        }
        $content = 'account/account.php';
        $data = [
            'page_title'=>'Личный кабинет пользователя',
        ];
        return $this->generateResponse($content, $data);
    }
    public function addUser(Request $request)
    {
        $result= $this->account_model->addUser($request->post());
        $login=$request->post()['login'];
//        $content = 'account/registration.php';
//        $data=[
//            'page_title'=>'Зарегистрироваться',
//            'result'=>$result
//        ];
        if($result == AccountModel::REGISTRATION_SUCCESS) {
            $_SESSION['login'] = $login;
        }
        return $this->ajaxResponse($result);
//        return $this->generateResponse($content,$data);
    }
    public function outUser(){
        unset($_SESSION['login']); // очищаем ссесию
        unset($_SESSION['admin']); // очищаем ссесию
        session_destroy();
        header('Location: /');

    }
}