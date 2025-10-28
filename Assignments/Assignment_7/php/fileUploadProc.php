<?php
require 'classes/Pdo_methods.php';

class FileUploadProc extends PdoMethods{


    public function init(){
        if(count($_POST) > 0){

            if(isset($_POST['fileUpload'])){
                
                return $this->uploadFile();
                
            }
        }
        else{
            return "";
        }
    }


    private function uploadFile(){
        
        $pdo = new PdoMethods();

        if (!empty($_FILES['file']['name'])){
            $file = $_FILES['file'];
            $fileName = $_POST['fileName'];
            $filelocation = basename($file["name"]);
        }
        else{
            
            return 'No file was uploaded. Make sure you choose a file to upload';
        }
        if($file["size"] > 100000){
            return 'The file is too large';
        }
        elseif(!($file["type"] === "application/pdf")){
            return 'PDF files only only!';
        }
        else{
            move_uploaded_file($file["tmp_name"],"files/" . $file["name"]);
            $sql = "INSERT INTO file (filename, filelocation) VALUES (:filename, :filelocation)";
            $bindings = [
			[':filename',$fileName,'str'],
			[':filelocation',$filelocation,'str']
		];
            $result = $pdo->otherBinded($sql, $bindings);
            if($result === 'error'){
			    return 'There was an error adding the file';
		    }
		    else {
			    return 'File has been added.';
		    }
            
        }

        $pdo = null;


        
    }


}

?>