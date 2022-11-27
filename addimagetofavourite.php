<?php
    $id = $_GET["id"];
    if(!isset($_COOKIE["user_id"])) {
    } else {
        if(!isset($_COOKIE["favourite_image"])) {
            $favourite_image = array($id);
            $favourite_image_string = implode(",", $favourite_image);
            setcookie('favourite_image', $favourite_image_string, time() + (86400 * 30));
            header("Location: favourites.php");
        } else {
            $favourite_image = explode(",", $_COOKIE["favourite_image"]);
            array_push($favourite_image, $id);
            $favourite_image_string = implode(",", $favourite_image);
            setcookie('favourite_image',  $favourite_image_string, time() + (86400 * 30));
            header("Location: favourites.php");
        }
    }
?>