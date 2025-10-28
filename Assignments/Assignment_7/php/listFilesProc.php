<?php
require 'classes/Pdo_methods.php';

class listFilesProc extends PdoMethods{

    public function getPDF(){

        $pdo = new PdoMethods();

        $sql = "SELECT * FROM file";

        $records = $pdo->selectNotBinded($sql);

        if(count($records) != 0){
            return $this->createList($records);
        }
        else{
            return '';
        }
        $pdo = null;
    }


    private function createList($records){
        $list = '<ul>';
        foreach ($records as $row){
            $list .= "<li><a href=\"files/{$row['filelocation']}\">{$row['filename']}</a></li>";
        }
        $list .= '</ul>';
        return $list;
    }

}