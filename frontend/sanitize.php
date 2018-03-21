<?php
if (isset($_POST['Submit'])) {
 
        if ($_POST['username'] != "") {
            $_POST['username'] = (filter_var($_POST['username'], FILTER_SANITIZE_STRING ));
            $_POST['username'] =(filter_var($_POST['username'], FILTER_SANITIZE_NUMBER_INT)):
			$_POST['username'] =(filter_var($_POST['username'],FILTER_SANITIZE_SPECIAL_CHARS));
        		
			if ($_POST['username'] == "") {
            $errors .= 'Please enter a valid username.<br/><br/>'; 
       		}
        } else {
            $errors .= 'Please enter your username.<br/>';
       	}
 
 
        if ($_POST['password'] != "") {
            $_POST['password'] = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
            $_POST['password'] =(filter_var($_POST['password'], FILTER_SANITIZE_NUMBER_INT)):
			$_POST['password'] =(filter_var($_POST['password'],FILTER_SANITIZE_SPECIAL_CHARS));
            
            if ($_POST['password'] == "") {
                $errors .= 'Please enter a password .<br/>';
            }
        } else {
            $errors .= 'Please enter a password.<br/>';
        }

?>


<!DOCTYPE HTML>
<html>  
<body>

<form action="welcome_get.php" method="get">
Name: <input type="text" name='username'><br>
password: <input type="text" name='password'><br>
<input type='submit'>
</form>

</body>
</html>