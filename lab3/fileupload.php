<?php

//if th files i set
if (isset($_FILES['upload'])){
    
    #let's first make a whitelist of allowed extensions
    $allowedextensions = array('jpg', 'jpeg', 'gif', 'png');
    
   
    $extension = strtolower(substr($_FILES['upload']['name'], strrpos($_FILES['upload']['name'], '.') + 1));
    
    #test by echoing out what you upload
    echo "Your file extension is: ".$extension;
    
    #we create an array called 'error' to store all our errors, so we can later use them.
    $error = array ();
    
    if(in_array($extension, $allowedextensions) === false){
        
        $error[] = 'This is not an image, upload is allowed only for images.';        
    }
    
    #it is also good to think about the size of the file you want to accept.
    #this is for images, so how big of an image would you like to accept?
    #this is in bytes, and 1000000 is actually 1 mb which is now our limit
    if($_FILES['upload']['size'] > 1000000){
        
        $error[]='The file exceeded the upload limit';
    }
    
    
    if(empty($error)){

        move_uploaded_file($_FILES['upload']['tmp_name'], "uploadedfiles/{$_FILES['upload']['name']}");     
    }
    
}
?>

<html>
    <head>
        <title>Upload</title>
        <link rel="stylesheet" href="css/main.css">
           </head>
           
           <body>
            <?php include("header.php"); ?>
               <div>
                   <?php 
                   
                   #Now we want to either upload the file or type an error
                   #what we do is basically  check if there's an array named 'error'
                   #and we check if it's empty. If it's empty that means no errors we found
                   #we should proceed with the upload.
                   if (isset($error)){
                       if (empty($error)){
                           
                           #here we give the user the chance to check the file right away. 
                           #this is just for testing purposes so we can see the file is there
                           #when the user clicks, it will open the folder "uploadedfiles" and look for filename
                           echo '<a href="uploadedfiles/' . $_FILES['upload']['name'] . '">Check picture';
                           
                       } else {
                           #else, if there was an error, then it simply goes through the error array
                           #it prints out ALL errors in the array.
                           #you can have one or more errors. 
                           #e.g. File too big, AND not supported!
                           foreach ($error as $err){
                               echo $err;
                           }
                           
                       }
                   }
                   
                   ?>
               </div>
               <div>
                   
                   <form action="" method="POST" enctype="multipart/form-data">
                       <input type="file" name="upload" /></br>
                       <input  type="submit" value="submit" />
                   </form>                   
               </div>
           </body>
</html>