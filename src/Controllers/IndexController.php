<?php
namespace Ifmo\Web\Controllers;

use Ifmo\Web\Core\Controller;
use Ifmo\Web\Core\DBConnection;
use Ifmo\Web\Models\ActionsModel;

class IndexController extends Controller
{
    private $actions_model;
    private $db_connection;

    public function __construct()
    {
        $this->db_connection =
            DBConnection::getInstance();
        $this->actions_model = new ActionsModel();

    }
    public function showSliderAndAction()
    {

        $content = 'main/main.php';
        $actions = $this->actions_model->getAllActions();
        $sliders = $this->actions_model->getAllSliders();
        $data = [
            'page_title'=>'Интернет магазин',
            'all_actions' => $actions,
            'all_sliders' => $sliders
        ];
        return $this->generateResponse($content, $data);
    }
}