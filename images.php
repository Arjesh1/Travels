<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="includes/css/bootstrap.min.css" type="text/css">
    <script src="includes/js/jquery.min.js"></script>
    <script src="includes/js/bootstrap.min.js"></script>
    <title>Images</title>
</head>
<body>
    <style>
        body {
            background-color: ghostwhite;
        }
    </style>
    <?php 
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "travels";

        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    ?>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                    <img class="thumb-nail" alt="Brand" src="images/travel-images/thumb/222222.jpg">
                    <style>
                        .thumb-nail {
                            width: 100%;
                            height: 100%;
                        }
                    </style>
                </a>
                <a class="navbar-brand active" href="index.php">Home Page</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Continents<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php
                                $sql = "SELECT ContinentName, GeoNameId FROM geocontinents";
                                $result = $conn->query($sql);
                                $count = 0;
                                $num_row = $result->num_rows;
                    
                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while($row = $result->fetch_assoc()) {
                                        $count++;
                                        if($count != $num_row)
                                            echo "<li><a href='#'>".$row["ContinentName"]."</a></li>
                                                <li role='separator' class='divider'></li>";
                                        else
                                            echo "<li><a href='#'>".$row["ContinentName"]."</a></li>";
                                    }
                                }
                            ?>
                        </ul>
                    </li>
                    <li><a href="about-us.php">About Us<span class="sr-only">(current)</span></a></li>
                </ul>
                <div>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <form class="navbar-form navbar-left" action="search.php" method="get">
                        <div class="form-group">
                        <input type="text" name="key" class="form-control" placeholder="Image Search">
                        </div>
                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;Image Search</button>
                    </form>
                    <li class="dropdown active">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Browse<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="posts.php">Posts</a></li>
                        <li role="separator" class="divider"></li>
                        <li class="active"><a href="#">Images</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Users</a></li>
                    </ul>
                    </li>
                    <?php
                        if(!isset($_COOKIE["user_id"])) {
                            echo "<li><a href='login.php'>Register/Login</a></li>";
                        } else {
                            $user_id = $_COOKIE["user_id"];
                            $sql1 = "SELECT FirstName, LastName FROM traveluserdetails WHERE UID = $user_id";
                            $result1 = $conn->query($sql1);
                            if ($result1->num_rows > 0) {
                                // output data of each row
                                while($row = $result1->fetch_assoc()) {
                                    echo "<li class='dropdown'>
                                            <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>".$row["FirstName"]."&nbsp;".$row["LastName"]."<span class='caret'></span></a>
                                                <ul class='dropdown-menu'>
                                                    <li><a href='favourites.php'>View Favourites List</a></li>
                                                    <li role='separator' class='divider'></li>
                                                    <li><a href='profile.php'>My Account</a></li>
                                                    <li role='separator' class='divider'></li>
                                                    <li><a href='logout.php'>Log Out</a></li>
                                                </ul>
                                            </li>";
                                }
                            }
                        }
                    ?>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <style>
        .card {
            /* Add shadows to create the "card" effect */
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            transition: 0.3s;
            border-radius: 5px;
        }

        .card img {
            border-radius: 5px 5px 0 0;
        }

        /* On mouse-over, add a deeper shadow */
        .card:hover {
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }

        /* Add some padding inside the card container */
        .card-container {
            padding: 2px 16px;
        }

        .favourite {
            margin-top: -5px;
        }

        .date {
            text-align: right;
            font-size: x-small;
            padding: 5px 10px;
            margin-bottom: 0px;
        }

        .post-image {
            width: 100%;
            height: 320px;
        }
    </style>
    <div class="container-fluid">
    <style>
        .card {
            /* Add shadows to create the "card" effect */
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            transition: 0.3s;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .card img {
            border-radius: 5px 5px 0 0;
        }

        /* On mouse-over, add a deeper shadow */
        .card:hover {
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }

        /* Add some padding inside the card container */
        .card-container {
            padding: 2px 16px;
        }

        .favourite {
            margin: 5px auto;
        }

        .date {
            text-align: right;
            font-size: x-small;
            padding: 5px 10px;
            margin-bottom: 0px;
        }

        .post-image {
            width: 100%;
            height: 320px;
        }

        .message {   
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
        }

        .title {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 1;
        }
    </style>
    <div class="container-fluid">
        <?php
            $sql = "SELECT travelimage.ImageID, travelimage.Path, travelimagedetails.Title, AVG(travelimagerating.Rating) AS Ratings, COUNT(travelimagerating.ImageID) AS ReviewCount FROM travelimagerating INNER JOIN travelimage ON travelimagerating.ImageID = travelimage.ImageID INNER JOIN travelimagedetails ON travelimage.ImageID = travelimagedetails.ImageID GROUP BY travelimagerating.ImageID ORDER BY RAND() DESC LIMIT 12";
            $result = $conn->query($sql);

            
            if ($result->num_rows > 0) {
                // output data of each row
                echo "<div class='row'>";
                while($row = $result->fetch_assoc()) {
                    echo "
                        <div class='col-sm-3'>
                            <div class='card' style='padding-bottom: 10px;' onclick='image(".$row["ImageID"].")'>
                                <img src='images/travel-images/medium/".$row["Path"]."' alt='Post 1' class='post-image'>
                                <div class='card-container text-center'>
                                    <h4 class='title'><b>".$row["Title"]."</b></h4>";
                                    if(!isset($_COOKIE["user_id"])) {
                                        echo "<div class='text-center favourite'><button class='btn btn-info' onclick='showError()'>Add to Favourite&nbsp;&nbsp;<span class='glyphicon glyphicon-star-empty' aria-hidden='true' style='color: gold'></span></button></div>";
                                    } else {
                                        if(!isset($_COOKIE["favourite_image"])) {
                                            echo "<div class='text-center favourite'><button class='btn btn-info' onclick='addImageToFavourite(".$row["ImageID"].")'>Add to Favourite&nbsp;&nbsp;<span class='glyphicon glyphicon-star-empty' aria-hidden='true' style='color: gold'></span></button></div>";
                                        } else {
                                            $favourite_image = explode(",", $_COOKIE["favourite_image"]);
                                            if (in_array($row["ImageID"], $favourite_image)) {
                                                echo "<div class='text-center favourite'><button class='btn btn-danger' onclick='removeImageFromFavourite(".$row["ImageID"].")'>Remove from Favourite&nbsp;&nbsp;<span class='glyphicon glyphicon-star' aria-hidden='true' style='color: gold'></span></button></div>";
                                            } else {
                                                echo "<div class='text-center favourite'><button class='btn btn-info' onclick='addImageToFavourite(".$row["ImageID"].")'>Add to Favourite&nbsp;&nbsp;<span class='glyphicon glyphicon-star-empty' aria-hidden='true' style='color: gold'></span></button></div>";
                                            }
                                        }
                                    }
                                    echo "<span>";
                                        for($i = 1; $i <= 5; $i++) {
                                            if($i <= $row["Ratings"])
                                                echo "<span class='glyphicon glyphicon-star gold' aria-hidden='true'></span>";
                                            else
                                                echo "<span class='glyphicon glyphicon-star-empty gold' aria-hidden='true'></span>";
                                        }
                                    echo " (".round($row["Ratings"], 2).")";
                                    if($row["ReviewCount"] > 1) {
                                        echo "&nbsp;(".$row['ReviewCount']." Ratings)";
                                    } else {
                                        echo "&nbsp;(".$row['ReviewCount']." Rating)";
                                    }
                                    echo "</span>
                                </div>
                            </div>
                        </div>";
                }
                echo "</div>";
            } else {
                echo "<div class='text-center'>Results Not Found</div>";
            }
            $conn->close();
        ?>
    </div>
    <script>
        function image(id) {
            location.href = "image.php?image=" + id;
        }
        function addImageToFavourite(id) {
            location.href = "addimagetofavourite.php?id=" + id;
            if (!e) var e = window.event;
            e.cancelBubble = true;
            if (e.stopPropagation) e.stopPropagation();
        }
        function removeImageFromFavourite(id) {
            location.href = "removeimagefromfavourite.php?id=" + id;
            if (!e) var e = window.event;
            e.cancelBubble = true;
            if (e.stopPropagation) e.stopPropagation();
        }
        function showError() {
            alert("You need to Log In to Add to Favorites");
            if (!e) var e = window.event;
            e.cancelBubble = true;
            if (e.stopPropagation) e.stopPropagation();
        }
    </script>
</body>
</html>