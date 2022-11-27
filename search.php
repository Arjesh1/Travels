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
    <style>
        body {
            background-color: ghostwhite;
        }
    </style>
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
                <a class="navbar-brand" href="index.php">Home Page</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Continents<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Contintent 1</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">Contintent 2</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">Contintent 3</a></li>
                        </ul>
                    </li>
                    <li><a href="about-us.php">About Us<span class="sr-only">(current)</span></a></li>
                </ul>
                <div>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Browse<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Posts</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Images</a></li>
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
    <?php
        $key = $_GET["key"];
    ?>
    <div class="container" style="width: 50%;">
        <form action="search.php" method="get" clas="text-center">
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group">
                        <input name="key" type="text" class="form-control" placeholder="Search" value="<?php echo $key?>">
                    </div>
                </div>
                <div class="col-md-3"><button type="submit" class="btn btn-primary" style="width: 90%"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;Search</button></div>
            </div>
        </form>
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
                height: 160px;
            }

            .search-card {
                margin-bottom: 10px;
            }

            .dropdown-near {
                left: 105px !important;
            }

            .active {
                background-color: skyblue !important;
            }
        </style>
        <br>
        <div class="row">
        <?php
            $sql = "SELECT travelimagedetails.ImageID, geocities.AsciiName, geocountries.CountryName
                        FROM travelimagedetails
                        INNER JOIN travelimage ON travelimagedetails.ImageID = travelimage.ImageID
                        INNER JOIN traveluserdetails ON travelimage.UID = traveluserdetails.UID
                        INNER JOIN travelpost ON travelimage.UID = travelpost.UID
                        INNER JOIN geocities ON travelimagedetails.CityCode = geocities.GeoNameID
                        INNER JOIN geocountries ON travelimagedetails.CountryCodeISO = geocountries.ISO
                        WHERE travelimagedetails.Title LIKE '%$key%'";
            $result = $conn->query($sql);
            $cities = array();
            $countries = array(); 

            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    if(!in_array($row['AsciiName'], $cities)) {
                        array_push($cities, $row["AsciiName"]);
                    }
                    if(!in_array($row["CountryName"], $countries)) {
                        array_push($countries, $row["CountryName"]);
                    }
                }
            }

            echo "<div class='col-sm-6 dropdown text-center'>
                <button class='btn btn-default dropdown-toggle' type='button' id='dropdownMenu2' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'>
                    Filter by Country
                <span class='caret'></span>
                </button>
                <ul class='col-sm-6 dropdown-menu dropdown-near' aria-labelledby='dropdownMenu2'>";
                foreach($countries as $country) { ?>
                    <li <?php if(isset($_GET["country"])) { if($_GET["country"] == $country) { echo " class='active'"; }} ?> onclick="country('<?php echo $country ?>')"><?php echo $country?></li>
                <?php }
                echo "</ul>
            </div>";

            echo "<div class='col-sm-6 dropdown text-center'>
                    <button class='btn btn-default dropdown-toggle' type='button' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'>
                        Filter by City
                    <span class='caret'></span>
                    </button>
                    <ul class='col-sm-6 dropdown-menu dropdown-near' aria-labelledby='dropdownMenu1'>";
                    foreach($cities as $city) { ?>
                        <li <?php if(isset($_GET["city"])) { if($_GET["city"] == $city) { echo " class='active' "; }} ?> onclick="city('<?php echo $city ?>')"><?php echo $city?></li>
                    <?php }
                    echo "</ul>
                </div>";

            echo "</div><br>";
            if(isset($_GET["city"]) || isset($_GET["country"])) {
                if(isset($_GET["city"])) {
                    $city_name = $_GET["city"];
                    $sql = "SELECT travelimagedetails.ImageID, travelimagedetails.Title, traveluserdetails.FirstName, traveluserdetails.LastName, travelimage.Path, travelpost.PostTime, geocities.AsciiName, geocountries.CountryName
                                FROM travelimagedetails
                                INNER JOIN travelimage ON travelimagedetails.ImageID = travelimage.ImageID
                                INNER JOIN traveluserdetails ON travelimage.UID = traveluserdetails.UID
                                INNER JOIN travelpost ON travelimage.UID = travelpost.UID
                                INNER JOIN geocities ON travelimagedetails.CityCode = geocities.GeoNameID
                                INNER JOIN geocountries ON travelimagedetails.CountryCodeISO = geocountries.ISO
                                WHERE travelimagedetails.Title LIKE '%$key%'
                                HAVING geocities.AsciiName = '$city_name'";
                    $result = $conn->query($sql);
        
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "<div class='row search-card'>
                                    <div class='card' onclick='image(".$row["ImageID"].")'>
                                        <div class='row'>
                                            <div class='col-md-4'><img class='search-image' src='images/travel-images/square-medium/".$row["Path"]."' alt='Image'></div>
                                            <div class='col-md-8' style='padding-left: 30px;'>
                                                <h1>".$row["Title"]."</h1>
                                                <p class='posted-by'>Posted By: ".$row["FirstName"]."&nbsp;".$row["LastName"]."</p>
                                                <p class='date'>Posted On: ".substr($row["PostTime"], 0, 10)."</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>";
                        }
                    } else {
                        echo "<div class='text-center'>Results Not Found</div>";
                    }
                }
                if(isset($_GET['country'])) {
                    $country_name = $_GET["country"];
                    $sql = "SELECT travelimagedetails.ImageID, travelimagedetails.Title, traveluserdetails.FirstName, traveluserdetails.LastName, travelimage.Path, travelpost.PostTime, geocities.AsciiName, geocountries.CountryName
                                FROM travelimagedetails
                                INNER JOIN travelimage ON travelimagedetails.ImageID = travelimage.ImageID
                                INNER JOIN traveluserdetails ON travelimage.UID = traveluserdetails.UID
                                INNER JOIN travelpost ON travelimage.UID = travelpost.UID
                                INNER JOIN geocities ON travelimagedetails.CityCode = geocities.GeoNameID
                                INNER JOIN geocountries ON travelimagedetails.CountryCodeISO = geocountries.ISO
                                WHERE travelimagedetails.Title LIKE '%$key%'
                                HAVING geocountries.CountryName = '$country_name'";
                    $result = $conn->query($sql);
        
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "<div class='row search-card'>
                                    <div class='card' onclick='image(".$row["ImageID"].")'>
                                        <div class='row'>
                                            <div class='col-md-4'><img class='search-image' src='images/travel-images/square-medium/".$row["Path"]."' alt='Image'></div>
                                            <div class='col-md-8' style='padding-left: 30px;'>
                                                <h1>".$row["Title"]."</h1>
                                                <p class='posted-by'>Posted By: ".$row["FirstName"]."&nbsp;".$row["LastName"]."</p>
                                                <p class='date'>Posted On: ".substr($row["PostTime"], 0, 10)."</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>";
                        }
                    } else {
                        echo "<div class='text-center'>Results Not Found</div>";
                    }
                }
            } else {
                $sql = "SELECT travelimagedetails.ImageID, travelimagedetails.Title, traveluserdetails.FirstName, traveluserdetails.LastName, travelimage.Path, travelpost.PostTime, geocities.AsciiName, geocountries.CountryName
                            FROM travelimagedetails
                            INNER JOIN travelimage ON travelimagedetails.ImageID = travelimage.ImageID
                            INNER JOIN traveluserdetails ON travelimage.UID = traveluserdetails.UID
                            INNER JOIN travelpost ON travelimage.UID = travelpost.UID
                            INNER JOIN geocities ON travelimagedetails.CityCode = geocities.GeoNameID
                            INNER JOIN geocountries ON travelimagedetails.CountryCodeISO = geocountries.ISO
                            WHERE travelimagedetails.Title LIKE '%$key%'";
                $result = $conn->query($sql);
    
                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "
                            <div class='row search-card'>
                                <div class='card' onclick='image(".$row["ImageID"].")'>
                                    <div class='row'>
                                        <div class='col-md-4'><img class='search-image' src='images/travel-images/square-medium/".$row["Path"]."' alt='Image'></div>
                                        <div class='col-md-8' style='padding-left: 30px;'>
                                            <h1>".$row["Title"]."</h1>
                                            <p class='posted-by'>Posted By: ".$row["FirstName"]."&nbsp;".$row["LastName"]."</p>
                                            <p class='date'>Posted On: ".substr($row["PostTime"], 0, 10)."</p>
                                        </div>
                                    </div>
                                </div>
                            </div>";
                    }
                } else {
                    echo "<div class='text-center'>Results Not Found</div>";
                }
            }
            $conn->close();
        ?>
    </div>
    <script>
        function image(id) {
            location.href = "image.php?image=" + id;
        }
        function city(city_name) {
            <?php
                echo "location.href = 'search.php?key=$key&city=' + city_name;";
            ?>
        }
        function country(country_name) {
            <?php
                echo "location.href = 'search.php?key=$key&country=' + country_name;";
            ?>
        }
    </script>
</body>
</html>