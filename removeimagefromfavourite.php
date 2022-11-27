<?php
    $id = $_GET["id"];
    if(!isset($_COOKIE["user_id"])) {
    } else {
        if(!isset($_COOKIE["favourite_image"])) {
        } else {
            $favourite_image = explode(",", $_COOKIE["favourite_image"]);
            $key = array_search($id, $favourite_image);
            unset($favourite_image[$key]);
            $favourite_image_string = implode(",", $favourite_image);
            setcookie('favourite_image',  $favourite_image_string, time() + (86400 * 30));
            header("Location: favourites.php");
        }
    }
?>