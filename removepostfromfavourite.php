<?php
    $id = $_GET["id"];
    if(!isset($_COOKIE["user_id"])) {
    } else {
        if(!isset($_COOKIE["favourite_post"])) {
        } else {
            $favourite_post = explode(",", $_COOKIE["favourite_post"]);
            $key = array_search($id, $favourite_post);
            unset($favourite_post[$key]);
            $favourite_post_string = implode(",", $favourite_post);
            setcookie('favourite_post',  $favourite_post_string, time()+3600);
            header("Location: favourites.php");
        }
    }
?>