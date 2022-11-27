<?php
    if (isset($_COOKIE['user_id'])) {
        unset($_COOKIE['user_id']); 
        setcookie('user_id', null, -1, '/'); 
    }

    if (isset($_COOKIE['favourite_post'])) {
        unset($_COOKIE['favourite_post']); 
        setcookie('favourite_post', null, -1, '/travels'); 
    }

    if (isset($_COOKIE['favourite_image'])) {
        unset($_COOKIE['favourite_image']); 
        setcookie('favourite_image', null, -1, '/travels'); 
    }

    header("Location: index.php");
?>