<?php
session_start();

require_once "notes_config.php";

$email = $_SESSION["email"];


$notes = $notes_error="";

if(isset($_POST['submit_contact']))
{

    if(empty(trim($_POST["notes"])))
    {
        $notes_error = "Please enter your notes!";
    }
    else
    {
        $notes = trim($_POST["notes"]);
    }

   

    if(empty($notes_error))
    {
        $sql = "INSERT into note_table (email,notes) VALUES ('$email','$notes')";
        if(mysqli_query($link, $sql)){
            echo "submitted";
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }

        mysqli_close($link);

    }
    
    

    exit();

}

?>