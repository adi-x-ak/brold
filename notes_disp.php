<?php
session_start();

require_once "notes_config.php";

$email = $_SESSION["email"];

$sql = "SELECT * FROM note_table WHERE email ='$email'";

$result = $link->query($sql);

mysqli_close($link);


?>

<html>

<head>
    <title>notes display</title>
    <link rel="stylesheet" href="note-style.css">
</head>

    <body>

    <span id="title">NOTES</span>
        <div id="output" >

        
    <?php   // LOOP TILL END OF DATA 
                $count= 0;
                while($rows=$result->fetch_assoc())
                {
             ?>


<?php 
$count += 1;
echo $count.":".$rows['notes']."<br><br>";
?>



<?php
                }
             ?>

</div>
    </body>
</html>