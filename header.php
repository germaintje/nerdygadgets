<?php
session_start();
include "connect.php";
?>
<!DOCTYPE html>
<html lang="en" style="background-color: rgb(35, 35, 47);">
<head>
    <script src="Public/JS/fontawesome.js" crossorigin="anonymous"></script>
    <script src="Public/JS/jquery.min.js"></script>
    <script src="Public/JS/bootstrap.min.js"></script>
    <script src="Public/JS/popper.min.js"></script>
    <script src="Public/JS/Resizer.js"></script>
    <script src="Public/JS/jquery-3.4.1.js"></script>
    <style>
        @font-face {
            font-family: MmrText;
            src: url(/Public/fonts/mmrtext.ttf);
        }
    </style>
    <meta charset="ISO-8859-1">
    <title>NerdyGadgets</title>
    <script src="https://kit.fontawesome.com/77789b20d3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Public/CSS/Style.css" type="text/css">
    <link rel="stylesheet" href="Public/CSS/styleNew.css" type="text/css">
    <link rel="stylesheet" href="Public/CSS/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="Public/CSS/nha3fuq.css">
    <link rel="apple-touch-icon" sizes="57x57" href="Public/img/LOGONG.png">
    <link rel="apple-touch-icon" sizes="60x60" href="Public/img/LOGONG.png">
    <link rel="apple-touch-icon" sizes="72x72" href="Public/img/LOGONG.png">
    <link rel="apple-touch-icon" sizes="76x76" href="Public/img/LOGONG.png">
    <link rel="apple-touch-icon" sizes="114x114" href="Public/img/LOGONG.png">
    <link rel="apple-touch-icon" sizes="120x120" href="Public/img/LOGONG.png">
    <link rel="apple-touch-icon" sizes="144x144" href="Public/img/LOGONG.png">
    <link rel="apple-touch-icon" sizes="152x152" href="Public/img/LOGONG.png">
    <link rel="apple-touch-icon" sizes="180x180" href="Public/img/LOGONG.png">
    <link rel="icon" type="image/png" sizes="192x192" href="Public/img/LOGONG.png">
    <link rel="icon" type="image/png" sizes="32x32" href="Public/img/LOGONG.png">
    <link rel="icon" type="image/png" sizes="96x96" href="Public/img/LOGONG.png">
    <link rel="icon" type="image/png" sizes="16x16" href="Public/img/LOGONG.png">
    <link rel="manifest" href="Public/Favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="Public/Favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
</head>
<body>
<div class="Background">
    <div class="row" id="Header">
        <div class="col-2"><a href="index.php"> <img src="Public/Img/LOGONG.png"></a>

        </div>
        <div class="col-8" id="CategoriesBar">
            <ul id="ul-class">
                <?php
                $Query = "
                SELECT StockGroupID, StockGroupName, ImagePath
                FROM stockgroups
                WHERE StockGroupID IN (
                                        SELECT StockGroupID
                                        FROM stockitemstockgroups
                                        ) AND ImagePath IS NOT NULL
                ORDER BY StockGroupID ASC";
                $Statement = mysqli_prepare($Connection, $Query);
                mysqli_stmt_execute($Statement);
                $HeaderStockGroups = mysqli_stmt_get_result($Statement);

                foreach ($HeaderStockGroups as $HeaderStockGroup) {
                    ?>
                    <li>
                        <a href="browse.php?category_id=<?php print $HeaderStockGroup['StockGroupID']; ?>"
                           class="HrefDecoration"
                           style="font-size:20px"><?php print $HeaderStockGroup['StockGroupName']; ?></a>
                    </li>
                    <?php
                }
                ?>
                <li>
                    <a href="categories.php" class="HrefDecoration" style="font-size:20px"> Alle categorieën</a>
                </li>
            </ul>
        </div>
        <ul id="ul-class-navigation">
            <li>
                <?php
                if (isset($_SESSION['login'])){
                    if ($_SESSION['login'] == FALSE) {
                        echo "<a href='login.php' style='color: white;'><i class='fas fa-user' style='color:#676EFF;'></i> Inloggen</a>";
                    } else {
                        echo "<a href='login.php?logout=TRUE' style='color: white;'><i class='fas fa-sign-out-alt' style='color:#676EFF;'></i> Uitloggen</a>";
                    }
                } else {
                    echo "<a href='login.php' style='color: white;'><i class='fas fa-user' style='color:#676EFF;'></i> Inloggen</a>";
                }?>
            </li>
            &nbsp;
            <li>
                <a href="browse.php" class="HrefDecoration"><i class="fas fa-search" style="color:#676EFF;"> </i>
                    Zoeken</a>
            </li>
            &nbsp;
            <li>
                <a href="cart.php" class="HrefDecoration"><i class="fas fa-shopping-cart" style="color:#676EFF;"></i>
                    Winkelmandje</a>
            </li>
        </ul>
    </div>

    <div class="row" id="Content">
        <div class="col-12">
            <div id="SubContent">


