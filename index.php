<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <?php
  session_start();
  ?>
  <?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  include("classes.php");
  $firstError = $lastError = "";
  $imageError = "";
  $uploadOk = 1;
  $temp = 0;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $person = new details($_POST["firstname"], $_POST["lastname"]);
    $person->firstName = $person->check_data($person->firstName);
    $person->lastName = $person->check_data($person->lastName);
    // $person->imageFile = $person->check_image_empty($person->imageFile);
    $_SESSION["text-area"] = $_POST['text-area'];

    if ($person->check_valid($person->firstName)) {
      $firstError = "* Name should contains alphabets only!";
      $temp = 1;
    }
    if ($person->check_valid($person->lastName)) {
      $lastError = "* Last name should contains alphabets only!";
      $temp = 1;
    }
    if ($person->check_empty($person->firstName)) {
      $firstError = "* This field can't be empty!";
      $temp = 1;
    }
    if ($person->check_empty($person->lastName)) {
      $lastError = "* This field can't be empty!";
      $temp = 1;
    }

    if (isset($_FILES['image'])) {
      $image = new imageClass();
      $image->imageType = $_FILES['image']['type'];
      $image->imageName = $_FILES['image']['name'];
      $image->imageSize = $_FILES['image']['size'];
      $image->imageTname = $_FILES['image']['tmp_name'];
      if ($image->imageSize == 0) {
        $imageError = "* This field can't be empty!";
        $uploadOk = 0;
      } elseif ($image->imageSize > 3000000) {
        $imageError = "* Sorry your file is too large";
        $uploadOk  = 0;
      } elseif ($image->imageType != "image/jpg" && $image->imageType != "image/png" && $image->imageType != "image/jpeg" && $image->imageType != "iamge/gif") {
        $imageError = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
      } else (move_uploaded_file($image->imageTname, "upload-images/" . $image->imageName));
    }
  }

  // 
  ?>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Innoraft task</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Dropdown
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#">Disabled</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav>

  <div class="container">
    <form action="index.php" method="post" enctype="multipart/form-data">
      <h1>Enter your details below</h1>
      <div class="form-group">
        <label for="exampleInputEmail1">First name</label>
        <input type="name" name="firstname" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter first name">
        <span class=red><?php echo $firstError ?></span>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">last name</label>
        <input type="name" name="lastname" class="form-control" id="exampleInputPassword1" placeholder="Enter last name">
        <span class="red"><?php echo $lastError ?></span>
      </div>
      <input type="file" name="image" id="filesubmit" class="image-file"><span class="red"><?php echo $imageError; ?></span>
      <br>
      <textarea name="text-area" id="text" cols="73" rows="10"></textarea>
      <br>
      <button type="submit" class="btn btn-success">Submit</button>
    </form>
  </div>
  
  <?php
  if ($temp == 0 && $uploadOk == 1 && $_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION["firstname"] = $person->firstName;
    $_SESSION["lastname"] = $person->lastName;
    $_SESSION["image"] = $image->imageName;
    // $_SESSION["lastname"] = $person->lastName;
    header("Location: form.php ");
  }
  ?>


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>