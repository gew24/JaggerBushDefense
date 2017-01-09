<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
        
        $dbName = 'gew24'; // database name
        $dbUserName = 'gew24'; // database username
        $dbPassword = ''; // database password
        $dbHost = 'sis-teach-01.sis.pitt.edu'; // database host name
        
        $connect = mysqli_connect($dbHost, $dbUserName,$dbPassword, $dbName);

        // connect to the database        
        if(mysqli_connect_errno()){
            die("Oops! Something went wrong. Please try again later." . mysqli_connect_errno());
            //echo "Database connection failed!";
        }
        if(!mysqli_select_db($connect, $dbUserName)){
            die("The user was not found.");
            //echo "database not found!";
        }
        else{
            echo "Connected!";
        }
         
        ?>
    </body>
</html>
