<?php include'dbconnect.php';?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sql injection</title>
    </head>

    <body>
        <h2>Sql injection</h2>
        <form action="" method="post">
            <p><input type="text" name="email">
                <input type="submit" value="Check Email" name="submit" id="">
            </p>
        </form>
        <?php
        // ------------------------Query method for sql injection  start--------------
        error_reporting(0);// to avoid error reporting
        $usermail=$_POST['email']; // assign the value from input form
        if(isset($usermail)){ // check is set to variable $usermail then if yes execute this
            $sql=$pdo->query("select * from tbl_mail where email='$usermail'"); //$usermail value come from user input
            if($sql->rowCount()){
                echo "mail matched".' '.$usermail.'<br>';

            }else{
                echo "wrong email";
            }
        }
        ?>
        <!-- // -------Query method for sql injection  end--------------------------- -->
        <?php
        // prepared statement for preventing sql injection start
        $sqlpre=$pdo->prepare("select * from tbl_mail where email=:e");
        $sqlpre->bindParam(':e',$usermail);
        $sqlpre->execute();
        $row=$sqlpre->fetch(PDO::FETCH_ASSOC);
        if($row['email'] == $usermail){
            echo'Email matched with this'." ".$usermail;

        }else{
           echo 'Not found mail which is matched'; 
        }
        //-------------- prepared statement for preventing sql injection start end--------
        ?>
    </body>

</html>