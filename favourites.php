<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="includes/css/bootstrap.min.css" type="text/css">
    <script src="includes/js/jquery.min.js"></script>
    <script src="includes/js/bootstrap.min.js"></script>
    <title>About Us</title>
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
                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Browse<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="posts.php">Posts</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="images.php">Images</a></li>
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
                                    echo "<li class='dropdown active'>
                                            <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>".$row["FirstName"]."&nbsp;".$row["LastName"]."<span class='caret'></span></a>
                                                <ul class='dropdown-menu'>
                                                    <li class='active'><a href='favourites.php'>View Favourites List</a></li>
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
    <div class="container text-center" style="width: 50%">
        <h1>My Favourites</h1>
        <style>
            .card {
                box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
                transition: 0.3s;
                width: 100%;
                border-radius: 5px;
            }

            .card:hover {
                box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
            }

            .search-image {
                margin-left: 0px;
                border-radius: 5px 0px 0px 5px;
                width: 255px;
                height: 175px;
            }

            .search-card {
                margin-bottom: 10px;
            }

            .nav-tabs > li {
                float:none;
                display:inline-block;
                zoom:1;
            }

            .active > a {
                background-color: #F8F8FF !important;
                color: black !important;
            }

            .nav-tabs {
                text-align:center;
            }

            .dropdown-menu> .active > a {
                background-color: ghostwhite !important;
            }
        </style>
        <br>
        <div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#posts" aria-controls="posts" role="tab" data-toggle="tab">Posts</a></li>
                <li role="presentation"><a href="#images" aria-controls="images" role="tab" data-toggle="tab">Images</a></li>
            </ul><br>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="posts">
                    <?php
                        if(!isset($_COOKIE["user_id"])) {
                        } else {
                            if(!isset($_COOKIE["favourite_post"])) {
                                echo "<p>Nothing to Show</p>";
                            } else {
                                $favourite_post = explode(",", $_COOKIE["favourite_post"]);
                                foreach ($favourite_post as $post) {
                                    $sql = "SELECT travelpost.PostID, travelpost.Title, travelimage.Path, traveluserdetails.FirstName, traveluserdetails.LastName, travelpost.PostTime FROM travelpost INNER JOIN travelpostimages ON travelpost.PostID = travelpostimages.PostID INNER JOIN travelimage ON travelpostimages.ImageID = travelimage.ImageID INNER JOIN traveluserdetails ON travelpost.UID = traveluserdetails.UID WHERE travelpost.PostID = $post LIMIT 1";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                            echo "
                                            <div class='row search-card'>
                                                <div class='card' onclick='toPost(".$row["PostID"].")'>
                                                    <div class='row'>
                                                        <div class='col-md-4'><img class='search-image' src='images/travel-images/square-medium/".$row["Path"]."' alt='Image'></div>
                                                        <div class='col-md-8'>
                                                            <h1>".$row["Title"]."</h1>
                                                            <p class='posted-by'>Posted By: ".$row["FirstName"]."&nbsp;".$row["LastName"]."</p>
                                                            <p class='date'>Posted On: ".substr($row["PostTime"], 0, 10)."</p>
                                                            <button class='btn btn-danger' onclick='removePostFromFavourite(".$row["PostID"].")'>Remove from Favourite&nbsp;&nbsp;<span class='glyphicon glyphicon-star' aria-hidden='true' style='color: gold'></span></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>";       
                                        }
                                    }
                                }
                            }
                        }
                    ?>
                </div>
                <div role="tabpanel" class="tab-pane" id="images">
                    <?php
                        if(!isset($_COOKIE["user_id"])) {
                        } else {
                            if(!isset($_COOKIE["favourite_image"])) {
                                echo "<p>Nothing to Show</p>";
                            } else {
                                $favourite_image = explode(",", $_COOKIE["favourite_image"]);
                                foreach ($favourite_image as $image) {
                                    $sql2 = "SELECT travelimage.ImageID, travelimage.Path, travelimagedetails.Title FROM travelimage INNER JOIN travelimagedetails ON travelimage.ImageID = travelimagedetails.ImageID WHERE travelimage.ImageID = $image";
                                    $result2 = $conn->query($sql2);
                                    if ($result2->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result2->fetch_assoc()) {
                                            echo "<div class='row search-card'>
                                                        <div class='card' onclick='image(".$row["ImageID"].")'>
                                                            <div class='row'>
                                                                <div class='col-md-4'><img class='search-image' src='images/travel-images/square-medium/".$row["Path"]."' alt='Image'></div>
                                                                <div class='col-md-8'>
                                                                    <h1>".$row["Title"]."</h1>
                                                                    <button class='btn btn-danger' onclick='removeImageFromFavourite(".$row["ImageID"].")'>Remove from Favourite&nbsp;&nbsp;<span class='glyphicon glyphicon-star' aria-hidden='true' style='color: gold'></span></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>";       
                                        }
                                    }
                                }
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <script>
        function toPost(id) {
            location.href = "post.php?post=" + id;
        }
        function image(id) {
            location.href = "image.php?image=" + id;
        }
        function removePostFromFavourite(id) {
            location.href = "removepostfromfavourite.php?id=" + id;
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
    </script>
</body>
</html>