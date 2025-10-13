<?php

class Directories {

    public function createDirectoryAndFile($dirName, $fileContent) {
        $targetPath = "directories/$dirName";


        if (is_dir($targetPath)) {
            return [
                'status' => 'error',
                'message' => 'A directory already exists with that name.'
            ];
        }

        if (!mkdir($targetPath)) {
            return [
                'status' => 'error',
                'message' => 'Error: Unable to create the directory.'
            ];
        }
        chmod($targetPath, 0777);
        
        $filePath = "$targetPath/readme.txt";
        $file = fopen($filePath, 'w');
        if ($file === false) {
            return [
                'status' => 'error',
                'message' => 'Error: Unable to create the file.'
            ];
        }

        fwrite($file, $fileContent);
        fclose($file);

        return [
            'status' => 'success',
            'message' => 'Directory and file created successfully.'
        ];
    }
}