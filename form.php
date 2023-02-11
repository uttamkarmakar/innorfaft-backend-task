<?php
session_start();
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
            height: 900px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
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
            session_destroy();
            ?>
        </h2>
    </div>
</body>

</html>