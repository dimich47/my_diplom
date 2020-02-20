<?php


namespace Ifmo\Web\Controllers;


use Ifmo\Web\Core\Controller;
use Ifmo\Web\Core\DBConnection;
use Ifmo\Web\Core\Request;
use Ifmo\Web\Models\ActionsModel;

class ActionController extends Controller
{
    private $db_connection;
    private $action_model;
    public function __construct()
    {
        $this->db_connection = DBConnection::getInstance();
        $this->action_model = new ActionsModel();
    }

    public function showAction(Request $request){
        $id = $request->params()['id'];
        $content = 'actions/action.php';
        $aboutAction = $this->action_model->getActionById($id);
        $data = [
            'page_title' => 'Акции',
            'action' => $aboutAction
        ];
        return $this->generateResponse($content, $data);
    }
}