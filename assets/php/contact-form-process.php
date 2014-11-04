<?php
// define variables and set to empty values
$name = $email = $message = "";
$nameErr = $emailErr = $messageErr = "";
$out=array('result' => true);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
    $out = array('result' => false);
    $out = array('msg' => $nameErr);
    echo json_encode($out);
    exit;
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed"; 
      $out = array('result' => false);
      $out = array('msg' => $nameErr);
      echo json_encode($out);
      exit;
    } 
  }

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
    $out = array('result' => false);  
    $out = array('msg' => $emailErr);
    echo json_encode($out);
    exit; 
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; 
      $out = array('result' => false); 
      $out = array('msg' => $emailErr);     
      echo json_encode($out);
      exit;   
    }
  }

  if (empty($_POST["message"])) {
    $messageErr = "Message empty";
    $out = array('result' => false);
    $out = array('msg' => $messageErr);
    echo json_encode($out);
    exit;
  } else {
    $message = test_input($_POST["message"]);
  }

  if(mail($email, "message from web cv", $name+"\n"+$message)==false){
  	$out = array('result' => false);
  	$out = array('msg' => "Problem occurred in sending the email");
  	echo json_encode($out);
    exit;
  }

  echo json_encode($out);
  exit;
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>