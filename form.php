<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        h2 {
            text-align: center;
            color: blue;
            font-size: 50px;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serifz;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        body{
            background-color: skyblue;
        }
        .hello {
            color: deeppink;
        }
        img{
            width: 200px;
            height: 200px;
            border-radius: 50%;
        }
    </style>
</head>


<body>
    <div class="container">
        <div class="img">
            <img src="upload-images/<?php echo $_SESSION["image"]; ?>" alt="jeee">
        </div>
        <h2> <span class="hello">Hello</span>
            <?php
            echo $_SESSION["firstname"] . " " . $_SESSION["lastname"];

            // session_destroy();
            ?>
        </h2>
        <?php
        if(isset($_SESSION["text-area"])){
            include("textarea.php");
        }?>
    </div>
</body>

<?php
session_destroy();
?>
</html>
