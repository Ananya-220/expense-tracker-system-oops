<?php 

require_once __DIR__ . '\classes\db.php';
require_once __DIR__ . '\classes\user.php';

if (isset($_POST['register']))
    {
        $user = new User;

        if ($user -> register($_POST['first_name'] , $_POST['last_name'] , $_POST['email'] , $_POST['password']))
            {
                header('location: login.html');
            }
        else 
            {
                header('location: register.html');
            }
    }
?>