<?php
require 'Pdo_methods.php';

class Date_Time extends PdoMethods{

    public function init(){
        if(count($_POST) > 0){

            if(isset($_POST['addNote'])){
                
                return $this->uploadNote();
                
            }
            elseif(isset($_POST['getNotes'])){
                return $this->receiveNotes();
            }   
        }
        else{
            return "";
        }
    }


    private function uploadNote(){

        $pdo = new PdoMethods();

        if(empty($_POST['note']) && empty($_POST['dateTime'])){
            return "You need to enter a date, time and note.";
        }
        elseif(empty($_POST['note'])){
            return "You need to enter a date, time and note.";
        }
        elseif(empty($_POST['dateTime'])){
            return "You need to enter a date, time and note.";
        }
        else{
            $timestamp = strtotime($_POST['dateTime']);
            $note = $_POST['note'];
            $sql = "INSERT INTO notes (timestamp, note) VALUES (:timestamp, :note)";
            $bindings = [
			[':timestamp',$timestamp,'str'],
			[':note',$note,'str']
        ];
            $result = $pdo->otherBinded($sql, $bindings);
            if($result === 'error'){
                $pdo = null;
			    return 'There was an error adding the file';
		    }
		    else {
                $pdo = null;
			    return 'Note has been added';
		    }
        }
        


    }


    private function receiveNotes(){

        $pdo = new PdoMethods();

        $begDate = strtotime($_POST['begDate']);
        $endDate = strtotime($_POST['endDate']);
        $sql = "SELECT timestamp, note FROM notes WHERE timestamp BETWEEN :begDate AND :endDate ORDER BY timestamp DESC";
        $bindings = [
			[':begDate',$begDate,'str'],
			[':endDate',$endDate,'str']
    ];
        $records = $pdo->selectBinded($sql, $bindings);

        if(count($records) != 0){
            $pdo = null;
            return $this->createTable($records);
        }
        else{
            $pdo = null;
            return 'No notes found for the date range selected';
        }


    }

    private function createTable($records){
        $table = "<form method='post' action='update_delete_name.php'>";
		$table .= "<table class='table table-bordered table-striped'><thead><tr>";
		$table .= "<th>Date and Time</th><th>Note</th><tbody>"; 
        foreach ($records as $row){
            $table .= "<tr><td>" . date("m/d/Y h:i A", $row["timestamp"]) . "</td><td>" . $row["note"] . "</td></tr>";
        }
        $table .= "</tbody></table>";
        return $table;

    }


}

?>