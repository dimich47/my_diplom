<?php


namespace Ifmo\Web\Models;
use Ifmo\Web\Core\DBConnection;

class ActionsModel
{
    private $db;
    public function __construct()
    {
        $this->db = DBConnection::getInstance();
    }

    public function getAllActions() {

        $sql = 'SELECT * FROM actions;';
        return $this->db->queryAll($sql);
    }

    public function getActionById($id){
        $sql = 'SELECT * FROM actions WHERE idaction= :id;';
        return $this->db->execute($sql, ['id'=>$id], false);
    }
    public function getAllSliders() {

        $sql = 'SELECT * FROM sliders;';
        return $this->db->queryAll($sql);
    }
}