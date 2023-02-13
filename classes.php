<?php
class details
{
  public $firstName = "";
  public $lastName = "";
  // public $imageFile = ""


  function __construct($firstName, $lastName)
  {
    $this->firstName = $firstName;
    $this->lastName = $lastName;
    // $this->imageFile = $imageFile;
  }
  function check_data($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  function check_valid($data)
  {
    if (!preg_match("/^[a-zA-Z-' ]*$/", $data))
      return true;
    else
      return false;
  }
  function check_empty($data)
  {
    if (empty($data)) {
      return true;
    } else {
      return false;
    }
  }
}

class imageClass {
  public $imageType;
  public $imageName;
  public $imageSize;
  public $imageTname;
}


?>
