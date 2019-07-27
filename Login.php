<?php
    // Database Things =========================================================
//These values can be found in the email.
    $host = "localhost"; //<--put your host here
    $user = "sql_test1"; //<-- put username here
    $password = "test"; //<--put your password here
    $dbname = "sql_test"; //<-- put your database name here
    mysql_connect($host, $user, $password) or die("Cant connect into database");
    mysql_select_db($dbname)or die("Cant connect into database");   
    // =============================================================================
    $Act = $_GET["Act"];// what is action, Login or Register?
    $nick = $_GET["User"];
    $pass = $_GET["Pass"];   
    $Email = $_GET["Email"];    
    if($Act == "Login"){
    if(!$nick || !$pass) {
        echo "Login or password cant be empty.";
        } else {
       
                 $SQL = "SELECT * FROM Users_THC WHERE Username = '" . $nick . "'";
                $result_id = @mysql_query($SQL) or die("DB ERROR");
                $total = mysql_num_rows($result_id);
                    if($total) {
                        $datas = @mysql_fetch_array($result_id);
                            if(!strcmp($pass, $datas["Password"])) {
                                echo "Correct";
                            } else {
                                echo "Wrong";
                            }
                    } else {
                        echo "No User";
                }
            
    }
    }
   if($Act == "Register"){
       
        $checkuser = mysql_query("SELECT Username FROM Users_THC WHERE Username='$nick'"); 
        $username_exist = mysql_num_rows($checkuser);
        if($username_exist > 0)
        {
              echo "TAKEN";// Username is taken
              
              unset($nick);
              exit();
        }else{
            $query = "INSERT INTO Users_THC (Username, Password,Email) VALUES('$nick', '$pass', '$Email')";
            mysql_query($query) or die("ERROR");
            mysql_close();
            echo "Registered";
        }
    }
    // Close mySQL Connection
    mysql_close();
    ?>