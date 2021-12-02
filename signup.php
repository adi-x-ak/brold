<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$name =$dob= $email=$number= $password = $confirm_password = "";
$name_err = $dob_err= $email_err=$number_err=$password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate name
    if(empty(trim($_POST["name"])))
    {
        $name_err = "Please enter a name.";
    } 
    elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["name"])))
    {
        $name_err = "name can only contain letters, numbers, and underscores.";
    } 
    else
    {
        $name = trim($_POST["name"]);
    }
    
    //Validate dob
    if(empty(trim($_POST["dob"]))){
        $dob_err = "Please enter your dob id.";     
    } 
    else{
        $dob = trim($_POST["dob"]);
    }  

    //Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter your email id.";     
    } 
    else{
        $email = trim($_POST["email"]);
    }  
    
    
    //Validate number
    if(empty(trim($_POST["number"]))){
        $number_err = "Please enter your number.";     
    }
    //elseif(strlen(trim($_POST["number"])) == 10){
        //$number_err = "Invalid number.";
    //}
    else{
        $number = trim($_POST["number"]);
    }  
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($dob_err) && empty($email_err) && empty($number_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (name,dob,email,number,password) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_name,$param_dob,$param_email,$param_number, $param_password);
            
            // Set parameters
            $param_name = $name;
            $param_dob = $dob;
            $param_email = $email;
            $param_number = $number;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt))
            {
                // Redirect to login page
                header("location: login.php");
                //echo "success";
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
 <html>
    <head>
        <title>SignUp</title>
        <link rel="stylesheet" href="bootstrap.css" type="text/css">
        <link rel="stylesheet" href="signup.css" type="text/css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dongle&family=Merriweather:wght@700&family=Montserrat:wght@600&display=swap" rel="stylesheet">
        
    </head>
    <body>
        <div id="container">
        <div id="display" >
            
        </div>
        <div id="form-cont" >
           <span id="title" >SignUp</span> 
           <span id="caption">Join us for an exciting voyage</span>
           <div id="labels">
               <p class="line">
                Full Name: <br>
                Date of Birth: <br>
              
               
                Email: <br>
                Phone Number:   <br>
                Enter New password: <br>
                Confirm New Password: <br>
                </p>
               
           </div>
           <div id="inputs">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                 <input type="text" name="name"   value="<?php echo $name; ?>">
                 <span ><?php echo $name_err; ?></span><br><br><br>
                 <input type="text" name="dob"   value="<?php echo $dob; ?>" pla>
                 <span ><?php echo $dob_err; ?></span><br><br><br>
                 <input type="text" name="email" value="<?php echo $email; ?>">
                 <span ><?php echo $email_err; ?></span><br><br><br>
                 <input type="text" name="number"   value="<?php echo $number; ?>">
                 <span ><?php echo $number_err; ?></span><br><br><br>
                 <input type="text" name="password"   value="<?php echo $password; ?>">
                 <span ><?php echo $password_err; ?></span><br><br><br>
                 <input type="text" name="confirm_password"   value="<?php echo $confirm_password; ?>">
                 <span ><?php echo $confirm_password_err; ?></span><br><br><br>
 
 
            

           </div>
           <div id="submit">
               <input id="submit-btn" type="submit">
           </div>
        </form>
        </div>   
        </div>
    </body>
</html>