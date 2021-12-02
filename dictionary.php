<!DOCTYPE html>
<html>
   <head>
      <title>
         Dictionary 
      </title>
      <link rel="stylesheet" href="dict.css">
      
   </head>
   <body>
     
   <span class="title">Dictionary</span> 
      
      <?php
         if(!isset($_POST["submit"])){
         ?>
      <div class="center">
         <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <span style="text-align: center;margin-left: 40%">Enter the word:</span> <input type="text" name="word" class="centrecl"><br>
            <input type="submit" name="submit" class="centrecl">
         </form>
      </div>
      <?php
         }else{
             ?>
      <div class="center">
         <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
         <span style="text-align: center;margin-left: 40%">Enter the word:</span><input type="text" name="word" class="centrecl" value="<?php echo $_POST["word"]; ?> "><br>
            <input type="submit" name="submit" class="centrecl">
         </form>
      </div>
      <br>
      <br>
      <div class="center">
         <?php
            $auth_code = file_get_contents("auth.txt");
            $word = $_POST["word"];
            $cmd = "curl --header \"Authorization: Token " . $auth_code . "\" https://owlbot.info/api/v4/dictionary/" . $word . " > temp";
            system($cmd);
            $file_content = file_get_contents("temp");
            unlink("temp");
            $json_array = json_decode($file_content, true);
            ?>
         <?php
           
            echo "<p class=\"centrecl\"><strong>Definition: </strong>";
            echo $json_array["definitions"][0]["definition"];
            echo "</p><p class=\"centrecl\"><strong>Example: </strong>";
            echo $json_array["definitions"][0]["example"];
            echo "</p><p>";
            
            echo "</p>";
            }
            ?>
      </div>

     
   </body>
</html>