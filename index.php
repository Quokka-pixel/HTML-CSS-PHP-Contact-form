<!doctype html>
<html lang="de">
<head>
<link rel="stylesheet" type="text/css" href="bootstrap.css">

<meta name="viewport" content="width=device-width, initial-scale=1"> 
</meta>
<style>
  div.form-group {
  text-align: center;
  }
  .error {color: #f0000;}
</style>
</head>
    <div class="form-group">
        <h1>
            Kontaktformular
        </h1>
    </div>
<body>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
$nameErr = $emailErr = $messageERR ="";
$name = $email =$message = "";
$e = 0;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  

  $nameErr = $messageErr ="";
  $name = $email =$message = "";
  
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    

    
    if (empty($_POST["email"])) {
      $emailErr = "Email wird Benötigt";
    } else {
      $email = index_input($_POST["email"]);
      $e = $e + 1;
    }
    if (empty($_POST["text"])) {
      $messageERR = "Nachricht wird Benötigt";
    } else {
      $message = index_input($_POST["text"]);
      $e = $e + 1;
    }
    if ($e == 2){
      $to = "(your email)";
      $from = $_POST['email']; 
      $name = $_POST['name'];
      $subject = "Kontaktformular";
      $subject2 = "Kopie deines Kontaktformulares";
      $message = $name . " Hat folgendes geschrieben:" . "\n\n" . $_POST['text'];
      $message2 = "Hier ist eine Kopie deiner Nachricht " . $name . "\n\n" . $_POST['text'];
  
      $headers = "From:" . $from;
      $headers2 = "From:" . $to;
      mail($to,$subject,$message,$headers);
      mail($from,$subject2,$message2,$headers2);
    }
  }
}
function index_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
    
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class = "d">
            <div class="form-group">
                
                <input type ="text" class="form-control" id = "name"  name = "name" placeholder="Namen eingeben">
                
            </div>
            <div class="form-group">
                
                <input type="text" class="form-control" id="email" name ="email"pattern="[a-zA-Z0-9.-_]{1,}@[a-zA-Z.-]{2,}[.]{1}[a-zA-Z]{2,}"    placeholder="Email Adresse eingeben"  required>
                <span class="error"> <?php echo $emailErr;?></span>
            </div>
        </div>
            <div class="form-group">
                
                <textarea class="form-control" id="Nachrichtenfeld"  name = "text"rows="4" placeholder="Nachricht eingeben" required ></textarea>
                <span class="error" ><?php echo $messageERR;?></span>
            </div>
            <button type="submit" class="btn-primary">Absenden</button>   
            
            <div class="d">
                <input class="input" type="checkbox" id="gridCheck" required>
                <label class="label" for="gridCheck">
                Datenschutzbestimmungen zustimmen
                </label>
                
            
        </form>
    <?php
    ?> 
     
    </body>
</html>
