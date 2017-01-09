<!DOCTYPE html>

<html lang="en">

    <head>
        <script
            src="http://code.jquery.com/jquery-3.1.1.js"
            integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA="
            crossorigin="anonymous">
        </script>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-
              BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-
              rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-
        Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link rel="apple-touch-icon" sizes="57x57" href="apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
        <link rel="manifest" href="/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
        <link href="https://fonts.googleapis.com/css?family=Ruthie" rel="stylesheet">
        <link href="Assets/css/Background_Style.css" rel="stylesheet" type="text/css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Jagger Bush Defense</title>
        <meta charset="UTF-8">
    </head>


    <!--********* Item comparison page with dynamic table *******************-->    




    <body id="main">
        <div id="background"></div><!-- This div holds the background image for the site-->
        <!--link back to index/homepage -->
        <a href="index.php">Continue Shopping</a>



        <?php
        // connect to the database
        include 'connection.php';

        //start/continue session from previous page
        session_start();
                
        //function to remove items from the cart 1 at a time
        function remove_item() {

            // search the array for the selected value and find key
            if (array_search($_POST['remove'], $_SESSION['compare_item']) !== false) {

                // variable to hold key
                $key = array_search($_POST['remove'], $_SESSION['compare_item']);

                //use the key to unset the selected product from the session
                unset($_SESSION['compare_item'][$key]);
            }
        }

        if (!empty($_SESSION['compare_item'])) {
            //start the 3rd page for product comparison using bootstrap for responsiveness 
            echo "<section class='container-fluid' id='compareItems'>
                
                <div class='container-fluid' id='comp'>
                   
                    <form name='form_compare' action='' method='POST'>
                        
                        <a name ='compare'><h1 id='page3title'>Compare Items</h1></a>
                                                
                        <table class='table' id='compTable'>
                            
                            <tr>
                                <td class='tblRemove'>Remove item</td>
                                <td class='col_name'><p>Product Name</p></td>
                                <td><p class='col_image'>Product Image</p></td>
                                <td><p class='col_description'>Product Description</p></td>
                                <td class='col_material'><p class=table_p>Material</p></td>
                                <td class='col_size'><p class=table_p>Size</p></td>
                                <td class='col_price'>Price</td>
                            </tr>";

            // more php voodoo -->
            // loop through the checked values
            foreach ($_SESSION['compare_item'] as $tblitem) {

                //use each value to query the db
                $dbToTable = "Select * "
                        . "FROM products"
                        . " WHERE prod_sku = '" . $tblitem . "';";

                $new_table_row = mysqli_query($connect, $dbToTable);

                // loop through each result
                while ($row = mysqli_fetch_assoc($new_table_row)) {

                    // display results
                    echo "<tr>
                                        <td class='tableProdName'>Remove<br><input type='submit' name='remove' class='remove'  value='" . $row['prod_sku'] . "'></td>
                                        <td class='col_name'><p>" . $row['prod_name'] . "</p></td>
                                        <td class='col_image'><img class='page3Imgs' src='uploads/" . $row['prod_image'] . "' alt=''/></td>
                                        <td class='col_description'><p class='table_p'>" . $row['prod_description'] . "</p></td>
                                        <td class='col_material'><p>" . $row['material'] . "</p></td>    
                                        <td class='col_size'><p class=table_p>" . $row['product_size'] . "</p></td>
                                        <td class='col_price'>" . $row['price'] . "</td>
                                    </tr>";
                }
            }
            if(isset($_POST['remove'])){
                remove_item();
            }
            echo            "</table>
                    </form>
                </div>
            </section>";
        }else{
            echo "<p>There are no Items to compare.</p>";
        }
        ?>
        
        




        <!-- footer to hold 'contact us' information -->
        <footer class="container-fluid">

            <!-- link to navigation to contact info -->
            <a name="contactUs"><h3 id="footTitle">Contact Us</h3></a>
            <p class='p_footer'>JaggerBush Defense</p>
            <p class='p_footer'>Owner: Karen Wescott</p>
            <p class='p_footer'>Email: JaggerBushDefense@gmail.com</p>
            <p class='p_footer'>Phone: 724-413-8216</p>

        </footer>
    </body>