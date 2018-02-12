<?php
ini_set('Session.cookie_httponly', true);
session_start();

if(isset($_SESSION['userip']) === false)

{
    $Session['userip'] = $_SERVER['REMOTE_ADDR'];
}

if ($_SESSION['userip'] !== $_SERVER['REMOTE_ADDR']) {

    session_unset();
    session_destroy(); 
    //check if the ip is correct and if is not you dont allow them to go in. - session Hijacking

}


?>

<?php

@ $db = new mysqli('localhost', 'root', 'root', 'lab');

if ($db->connect_error) {
    echo "could not connect: " . $db->connect_error;
    printf("<br><a href=index.php>Return to home page </a>");
    exit();
}

    #the mysqli_real_espace_string function helps us solve the SQL Injection
    #it adds forward-slashes in front of chars that we can't store in the username/pass
    #in order to excecute a SQL Injection you need to use a ' (apostrophe)
    #Basically we want to output something like \' in front, so it is ignored by code and processed as text

if (isset($_POST['username'], $_POST['userpass'])) {
    #with statement under we're making it SQL Injection-proof
    $uname = mysqli_real_escape_string($db, $_POST['username']);
    
    #without function, so here you can try to implement the SQL injection
    #various types to do it, either add ' -- to the end of a username, which will comment out
    #or simply use 
    #' OR '1'='1' #
    #$uname = $_POST['username'];
    
    #here we hash the password, and we want to have it hashed in the database as well
    #optimally when you create a user (through code) you simply send a hash
    #hasing can be done using different methods, MD5, SHA1 etc.
    
    $upass = sha1($_POST['userpass']);
    
    #just to see what we are selecting, and we can use it to test in phpmyadmin/heidisql
    
    echo "SELECT * FROM user WHERE username = '{$uname}' AND userpass = '{$upass}'";
    
    $query = ("SELECT * FROM user WHERE username = '{$uname}' "."AND userpass = '{$upass}'");
       
    
    $stmt = $db->prepare($query);
    $stmt->execute();
    $stmt->store_result(); 
    
    #here we create a new variable 'totalcount' just to check if there's at least
    #one user with the right combination. If there is, we later on print out "access granted"
    $totalcount = $stmt->num_rows();
    
    
    
}
?>
<!DOCTYPE html>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>User</title>
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
        <?php include("header.php"); ?>

        <?php
        
        
        
        if (isset($totalcount)) {
            if ($totalcount == 0) {
                echo '<h2>You got the wrong password!</h2>';
            } else {
                echo '<h2>Welcome! Correct password.</h2>';
                echo '<a href="fileupload.php">Here is the link</a>';
            }
        }
        ?>
        <form method="POST" action="">
            <fieldset>
                <legend>LOGIN:</legend>
                    User: <br>
                    <input type="text" name="username">
                    Password: <br>
                    <input type="text" name="userpass">
                    <input type="submit" value="Login">
            </fieldset>
        </form>
<?php
include("footer.php");
?>

    </body>
</html>