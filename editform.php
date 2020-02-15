<!DOCTYPE HTML>  
<html>
<head>
<style>

.error {color: #FF0000;}
</style>
<link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/owl.carousel.css" rel="stylesheet">
    <link href="css/owl.transitions.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/main1.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet" media="all">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head>
<body id="home" class="homepage">
  <header id="header">
        <nav id="main-menu" class="navbar navbar-default navbar-fixed-top" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html"><img src="images/logo.png" alt="logo"></a>
                </div>

                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                         <li class="scroll active"><a href="index.php">go back</a></li>
                       </ul>
                     </div>
                   </div>
                 </nav>
               </header>
    <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
<?php
// define variables and set to empty values
$nameErr = $regidErr = $emailErr = $SubjectErr = $genderErr = $passwordErr = ""; 
$name = $regid = $email = $Subject = $gender = $comment = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed"; 
    }
  }
  if (empty($_POST["regid"])) {
    $passwordErr = "regid is required";
  } else {
    $regid = test_input($_POST["regid"]);
  
  }
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; 
    }
  }
    
  if (empty($_POST["password"])) {
    $passwordErr = "password is required";
  } else {
    $password = test_input($_POST["password"]);
  
  }

  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
  }

 if (empty($_POST["subject"])) {
    $subjectErr = "subject is required";
  } else {
    $subject = test_input($_POST["subject"]);
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }
  
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<div id="id01" class="a">
  <form class="" action="process.php" method="post">
   
<h2>Registration Form</h2><br>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Name: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  registration id: <input type="text" name="regid" value="<?php echo $regid;?>">
  <span class="error">* <?php echo $regidErr;?></span>
  <br><br>
  E-mail: <input type="text" name="email" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  password: <input type="password" name="password" value="<?php echo $password;?>">
  <span class="error"><?php echo $passwordErr;?></span>
  <br><br>
  Comment: <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
  <br><br>
  Subject:<br>
  <br>
  b.tech<input type="radio" name="subject" <?php if (isset($subject) && $subject=="b.tech") echo "checked";?> value="b.tech"><br>
    M.B.A<input type="radio" name="Subject" <?php if (isset($subject) && $subject=="M.B.A") echo "checked";?> value="M.B.A"><br>
   M.C.A<input type="radio" name="Subject" <?php if (isset($subject) && $subject=="M.C.A") echo "checked";?> value="M.C.A">  
  <span class="error"> <?php echo $SubjectErr;?></span>
  <br><br>
  Gender:<br>
  <br>
  Female<input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female"><br>
    Male<input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male"><br>
    Other<input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">  
  <span class="error"> <?php echo $genderErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>
</div></form>
</div>
</div>
</div>
</div>
</div>
<script>
function myFunction() {
  var checkBox = document.getElementById("myCheck");
  var text = document.getElementById("text");
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
     text.style.display = "none";
  }
}
</script>
<!-- <?php
echo "<h2>Your Input:</h2>";
echo $name;
echo "<br>";
echo $email;
echo "<br>";
echo $website;
echo "<br>";
echo $comment;
echo "<br>";
echo $gender;
?> -->
 <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/mousescroll.js"></script>
    <script src="js/smoothscroll.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/jquery.inview.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>