<?php 

require_once __DIR__ . '\classes\db.php';
require_once __DIR__ . '\classes\user.php';

if (isset($_POST['login']))
    {
        $user = new User;

        if ($user -> login($_POST['email'] , $_POST['password']))
            {
                header('location: index.html');
            }
        else 
            {
                header('location: login.html');
            }
    }
?>