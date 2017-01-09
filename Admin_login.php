<?php
include 'connection.php';
session_start();


echo "<link href='Assets/css/Background_Style.css' rel='stylesheet' type='text/css'/>";

//echo "<h4>Please Log in</h4>";
//$_SESSION['logged in'] = False;
if ($_SERVER['REQUEST_METHOD'] != 'POST') { // display the login form if a request has not already been made
    echo
    '<form id="info_form" action="" method="POST">
                user name: <input type="text" name="userName" value=""><br>
                Password: <input type ="password" name="password" value=""><br>
                <input type="submit" name="submit" value="Submit">
            </form>';
} else { // this is what happens if you aren't logged in
    $error = array(); // array to hold errors to tell user what to correct
    if (!isset($_POST['userName'])) { //if the user name wasn't entered
        $error[] = 'The user name field must not be empty'; // tell the user to enter a stinkin username
    }
    if (!isset($_POST['password'])) {// if the password wasn't entered
        $error[] = 'the password must be filled in'; // tell the user they ain't gettin in without the password
    }

    if (!empty($error)) { // 
        echo 'Please correct the following errors:';
        foreach ($error as $errnum => $errval) {
            echo $errval . '<br>';
        }
    } else { // if there are no errors query the database - safety first (use escape string)
        $query = "SELECT * "
                . "FROM jaggerBushUsers "
                . "WHERE username ='" . mysqli_real_escape_string($connect, $_POST['userName'])
                . "' AND password = '" . mysqli_real_escape_string($connect, $_POST['password']) . "';";

        $result = mysqli_query($connect, $query);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $login = $row['userName'];
                $pword = $row['password'];
                
                if($_SESSION['userName'] = $login && $_SESSION['password'] = $pword){
                    $_SESSION['logged in'] = True; //created a 'logged in' super global in session
                    header('Location: upload_product.php');
                    
                }
                else{
                    $_SESSION['logged in'] = False;
                    echo "Wrong user name or password";
                    echo $_SESSION['logged in'];
                }
            }
        } else {
            echo "False";
            $_SESSION['logged in'] = False;
            
            echo "<p>User does not exist. Please try again.</p>";
        }
    }
}
if (@$_GET['action'] == "logout") {
    session_destroy();
    header("Location: login.php");
} else {
    echo "";
}
?>
