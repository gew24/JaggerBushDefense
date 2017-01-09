
****************************************************** Index.HTML = Store *********************************************************
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


    <?php
// this is where the db connection magic happens
    include 'connection.php';

// begin a session for the new user
    session_start();

// query to collect products for the site
    $get_products = "SELECT * "
            . "FROM products "
            . "WHERE is_active = 1;";
    $new_prod_row = mysqli_query($connect, $get_products);


    /*     * ******************** logic for the shopping cart ************************** */


// instantiate variable to hold cart items
    $cart_item = '';

// create global array
    //global $cart_contents;
    $_SESSION['cart_item'] = array();

// add items to the shopping cart when button is clicked
    if (isset($_POST['btnCart'])) {

        // make sure that a checkbox is checked
        if (!empty($_POST['addToCart'])) {


            // loop through the checked values
            foreach ($_POST['addToCart'] as $cart_item) {

                //add each item to array
                array_push($_SESSION['cart_item'], $cart_item);
            }
        }
    }



    /*     * *********************** logic for the comparison table ******************** */


// instantiate a session as array
    $_SESSION['compare_item'] = array();

// make sure that the user selected compare button
    if (isset($_POST['btnCompare'])) {

        // make sure that a checkbox is checked
        if (!empty($_POST['addToTable'])) {


            // loop through the checked values
            foreach ($_POST['addToTable'] as $compare_item) {

                // put selected items into superglobal variable
                array_push($_SESSION['compare_item'], $compare_item);
                //print_r($_SESSION['compare_item']);
            }
        }
    }
    ?>

    <body id="main">



        <!-- *********************************** PAGE 1*****************************************-->        

        <!-- container for navigation header -->
        <nav class="container-fluid" id="navigation"><!-- -->
            <a class="nav" href="#home">Home</a>
            <a class="nav" href="#products">Products</a>
            <a class="nav" href="productComp.php">Compare Items</a>  
            <a class="nav" href="#contactUs">Contact Us</a>
            <a class="nav" href="shoppingCart.php">View Shopping Cart</a>
        </nav>
        
        <!-- container to hold the entire page -->
        <main class="container-fluid" id="mainbody">
            
            
            <div id="background"></div><!-- This div holds the background image for the site-->
            <!-- link for navigation -->
            <a class="bigText" name="home"></a>


            <!-- this is the title page -->
            <section class="container-fluid" id="container_titlepage">
                <h1 id="page_title">Jaggerbush Defense Company</h1>

                <h3 id="subtitle">Women's Self-Defense Accessories</h3>

            </section>






            <!--################################################### PAGE 2  ################################################-->









            <!-- this is the beginning of the store page using bootstrap container for responsiveness-->
            <section class="container" id='inlineimages'>
                <script>
                document.ready(function () {
                    $(".description").hide();
                });

                $(this).hover(function () {
                    $("p").show();
                });
                </script>
                <!-- create a form to hold buttons and check boxes -->
                <form  id='productsForm' action='' method='POST'>

                    <!-- create the button to add items to the cart -->
                    
                    <input type='submit' name='btnCart' id='btnCart' value=''>

                    <!-- create the button to add items to be compared -->
                    <input type='submit' name='btnCompare' id='btnTable' value=''>

                    <!-- page title and link for navigation to store page -->
                    <a class="bigText" name ="products"></a><h1 id='page2title'>Shop Products</h1>

                    <!--div to hold each product separately using bootstrap row for responsiveness -->
                    <div class="row" id="prod0">

                        <!-- add some php to render products dynamically -->
<?php
// loop through the query results to display each product
while ($row = mysqli_fetch_assoc($new_prod_row)) {

    //make sure the product is active or else don't display it
    if ($row['is_active'] == True) {

        //add active products the page 
        echo
        "<figure class='col-xs-12 col-sm-6 col-md-4 col-lg-3' id='" . $row['prod_sku'] . "'>
                                    <input name='addToCart[]' type='checkbox' value='" . $row['prod_sku'] . "'> Add to cart <br><br>    
                                    <p>" . $row['prod_name'] . "</p><br>
                                    <p>Price: $" . $row['price'] . "</p>
                                    <img responsive class='page2img' src='uploads/" . $row['prod_image'] . "' alt=''/>
                                    <p class='description'>" . $row['prod_description'] . "</p>
                                    <input name='addToTable[]' type='checkbox' value='" . $row['prod_sku'] . "'> Compare products <br>
                                </figure>";
    }
}
?>

                    </div>
                </form>
            </section>










            <!--############################### Footer ################################################-->





            <!-- footer to hold 'contact us' information -->
            <footer class="container-fluid">

                <!-- link to navigation to contact info -->
                <a name="contactUs"><h3 id="footTitle">Contact Us</h3></a>
                <p class='p_footer'>JaggerBush Defense</p>
                <p class='p_footer'>Owner: Karen Wescott</p>
                <p class='p_footer'>Email: JaggerBushDefense@gmail.com</p>
                <p class='p_footer'>Phone: 724-413-8216</p>

            </footer>

        </main>
    </body>
</html>



************************************************ productComp.php*******************************************


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
	
	
	
	********************************************************* shoppingCart.php***********************************************
	
	
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
        <link href="Assets/css/cartSheet.css" rel="stylesheet" type="text/css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Jagger Bush Defense</title>
        <meta charset="UTF-8">
    </head>



    <body id="main">
        <section class="container-fluid">
        <!-- link back to the store -->
        <a href="index.php">Continue Shopping</a>
        <h1 id="cartTitle">Shopping Cart</h1>

        <!-- black magic php -->
        <?php
        // connect to the database
        include 'connection.php';

        //start/continue session from previous page
        session_start();

        // clear the cart for the customer if they don't want to make a purchase
        if (isset($_POST['emptyCart'])) {
            session_unset();
            header("Location: shoppingCart.php");
        }

        //function to remove items from the cart 1 at a time
        function remove_item() {

            // search the array for the selected value and find key
            if (array_search($_POST['remove'], $_SESSION['cart_item']) !== false) {

                // variable to hold key
                $key = array_search($_POST['remove'], $_SESSION['cart_item']);

                //use the key to unset the selected product from the session
                unset($_SESSION['cart_item'][$key]);
            }
        }

        //function to create order and put it into the database later it
        // will also connect us to a card services api or paypal but that costs money
        // so we're not doing it yet
        function createOrder() {
            $newOrder = "INSERT INTO orders(FKcustomerID, quantity)"
                    . "VALUES(1, " . array_sum($_POST['quantity_ordered']) . ")";

            mysqli_query($connect, $newOrder);
        }

        $quantity = array();


        // test that session has content
        if (!empty($_SESSION['cart_item'])) {
            echo "<div class='container'>";

            //if the session has content then create the new form
            echo "<table class='table' id='cartTbl'>
                    <tr>
                        <th class='col_remove'>Click to Remove Item</th>
                        <th class='col_image'>Product</th>
                        <th class='col_price'>Price</th>
                        <th class='col_qty'>Quantity</th>
                    </tr>   
                <form type='' action='' method='post'>";

            //loop through the session contents
            foreach ($_SESSION['cart_item'] as $cart) {

                //query the database for each item
                $get_cart = "SELECT * "
                        . "FROM products "
                        . "WHERE prod_sku = '" . $cart . "';";

                $new_cart_item = mysqli_query($connect, $get_cart);

                //loop through the query results   
                while ($row = mysqli_fetch_assoc($new_cart_item)) {

                    //create the shopping cart table
                    echo "<tr class='cart_row'>"
                    . "<td class='col_remove'><input type='submit' name='remove' class='remove'  value='" . $row['prod_sku'] . "'></td>"
                    . "<td class='col_image'><img class='cartImg' src='uploads/" . $row['prod_image'] . "' alt=''/></td>
                       <td class='col_price'><p>$" . $row['price'] . "</p></td>
                       <td class='col_qty'><input id='txtQty' type='number' name='quantity_ordered' value='1'></td>
                       </tr>";
  
                    // get a sum of the price of items in the cart
                    $sumof[] = floatval($row['price']);
                }
                // hold the sum of all items in a variable
                $totalPrice = array_sum($sumof);
            }
  
            echo "<input id='btnClear' type='submit' name='emptyCart' value='Empty cart'>"
                //<input type='submit' name='create_order' value='Create Order'> // feature coming soon!
                . "</form>
                    <tr>
                       <td></td>
                       <td>Total Price: $" . $totalPrice/* tell the user how much they owe */ . "</td>
                       <td></td>
                   </tr>
                </table>";

            echo "</div>";

            // call the create order function when the button is clicked
            if (isset($_POST['create_order'])) {
                createOrder();
            }

            // call the remove item function if the button is clicked
            if (isset($_POST['remove'])) {
                remove_item();
            }
        }

        // if the session is empty let the user know they haven't added anything to the cart
        else {
            echo "Your shopping cart is empty";
        }
        ?>
        
        </section>
        
        
        <footer class="container-fluid">

            <!-- link to navigation to contact info -->
            <a name="contactUs"><h3 id="footTitle">Contact Us</h3></a>
            <p class='p_footer'>JaggerBush Defense</p>
            <p class='p_footer'>Owner: Karen Wescott</p>
            <p class='p_footer'>Email: JaggerBushDefense@gmail.com</p>
            <p class='p_footer'>Phone: 724-413-8216</p>

        </footer>
    </body>
</html>


*************************************************** update inventory **************************************************


<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Jaggerbush Defense Update Inventory</title>
    </head>
    <body id="main">
        
        <!-- php voodoo time -->
<?php

// connect to the database
include 'connection.php';

// include header with links to other backstore options
include 'header.php';

/* client with have ability to select product
 * by name, view and modify current quantity
 * on hand, and view and modify active/inactive 
 * status
 */
if(isset($_POST['submit'])){
    $product = $_POST['prod_name'];
}

// display the form is an item has not been selected
if(!isset($_POST['submit']) && empty($_POST['prod_name'])){
    echo
        "<form id='product_info' action='' method='POST'>"
        . "Enter product sku:<input type='text' name='prod_sku' value=''>"
            . "<input type='submit' name='submit' value='submit'>"
            . "</form>";   
    
    //query the database for all products 
    $get_products = "SELECT * "
            . "FROM products ";
    $new_prod_row = mysqli_query($connect, $get_products);

    //loop through the results and show the user what options are available
    while ($row = mysqli_fetch_assoc($new_prod_row)) {
        echo "<br>Record Number: <u>" . $row['pk_prod_id'] . "</u> Product sku: <u>" . $row['prod_sku'] . "</u><br>"; 
    }
}

// if the user has entered a valid item and clicked submit 
// show the relevant product's information
else{
    
    // ask the db for the user's selected item
    $prod_inv =  "SELECT *"
    . "FROM products "
    . "WHERE prod_sku like '%" . $_POST['prod_sku'] . "%';";
    //echo "SUCCESS";
    $view_prod = mysqli_query($connect, $prod_inv);
    
    //loop through the results and show the user the relevant data
    while($row = mysqli_fetch_assoc($view_prod)) {
        //echo "we have results";
        $active = '';
        
        // if the is_active column in the db is true then let the user know the product is active
        if($row['is_active'] == True){
            $active = "Active";
        }
        else{
            $active = "Inactive";
        }
        echo "<form id='product_info' action='' method='POST'>"
        . "Item Number:<input type='text' class='update_text' name='prod_id' value=" . $row['pk_prod_id'] . "><br>"
        . "Item sku:<input type='text' class='update_text' name='prod_sku' value='" . $row['prod_sku'] . "'><br>"
        . "Item name:<input type='text' class='update_text' name='prod_name' value='" . $row['prod_name'] . "'><br>"
        . "Item Cost:<input type='text' class='update_text' name='cost' value='" . $row['cost'] . "'><br>"
        . "Item Price:<input type='text' class='update_text' name='price' value='" . $row['price'] . "'><br>"
        . "Quantity:<input type='number' class='update_text' name='qoh' value='" . $row['QOH'] . "'><br>"
        . "Product Dimensions:<input type='text' class=update_text' name='size' value='" . $row['product_size'] . "'"        
        . "Active/inactive:<input type='text' class='update_text' name='active' value='" . $active . "'><br>"
        . "<input type='submit' name='submit_change' value='make changes'><br>";
    }
}

    // if the user wishes to make changes
    if(isset($_POST['submit_change'])){
        
        // going to make change to radio buttons this is just uncivilized 
        if($_POST['active'] == "Active"){
            $update_active = True;
        }
        else{
            $update_active = False;
        }    
         
        // submit the desired changes to the database 
        $update_item =  "UPDATE products "
                    . " SET prod_name = '" . $_POST['prod_name'] . "', cost = " . $_POST['cost'] . ""
                . ", price = " . $_POST['price'] . ",QOH = " . $_POST['qoh'] . ", is_active = '" . $update_active 
                    . "' WHERE pk_prod_id = " . $_POST['prod_id'] . ";";
        
        $view_prod = mysqli_query($connect, $update_item);       
    }
?>
    </body>
</html>


*************************************************************** upload products ********************************************************


<?php
include 'connection.php';
include 'header.php';
/* used video by Kevin Skoglund found on Lynda.com as reference to upload the files */ 
$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);

// make a note of the location of the upload handler script 
$uploadHandler = 'http://' . $_SERVER['HTTP_HOST'] . $directory_self . 'upload.processor.php';

// set a max file size for the html upload form 
$max_file_size = 1500000; // size in bytes 
?>

<html lang="en"> 
    <head> 
        <meta http-equiv="content-type" content="text/html; charset=windows-1252"> 
        <title>Upload form</title> 
    </head> 
    
    <!-- create the form to add products to the database -->
    <body id='main'> 
        <form id="product_info" action='upload_product.php' enctype='multipart/form-data' method='POST'>
            <h1>Enter Product Information</h1>
            Product SKU(ex.US03G-8287): <br><input type='text' name='prod_sku' value=''> <br>
            Product Name: <br><input type='text' name='prod_id' value=''> <br>
            Product Description: <br><textarea name='prod_description'></textarea> <br>
            Vendor Cost: <br><input type='text' name='cost' value=''> <br>
            Price: <br><input type='text' name='price' value=''> <br>
            Quantity: <br><input type="number" name="quantity" value="0" /><br>
            Product Material: <br><input type='text' name='material' value=''> <br>
            Product Dimensions:<input type="text" name ="size" value=""><br>
            Select an image to upload<br> <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size ?>"> 
            <input id="file" type="file" name="image"> <br>
            <input type="submit" name="upload_product" value="Add Product"><br>
        </form> 
        
        <!-- add a little php to spice it up and make it work -->
        <?php
        
        // build an array to hold the upload errors
        $upload_errors = array(
            UPLOAD_ERR_OK => "No Errors.",
            UPLOAD_ERR_INI_SIZE => "Larger than Upload_max_filesize.",
            UPLOAD_ERR_FORM_SIZE => "Largehr than form MAX_FILE_SIZE",
            UPLOAD_ERR_PARTIAL => "Partial upload.",
            UPLOAD_ERR_NO_FILE => "No file.",
            UPLOAD_ERR_NO_TMP_DIR => "No temporary directory.",
            UPLOAD_ERR_CANT_WRITE => "Can't write to disk.",
            UPLOAD_ERR_EXTENSION => "File upload stopped by extension.",
        );

        // variable to hold the appropriate error message
        $error = $_FILES['file']['error'];
        
        // variable to hold message to be displayed
        $message = $upload_errors[$error];
        
        // if the user clicks the button to start the spell
        if (isset($_POST['upload_product'])) {
            
            $tmp_file = $_FILES['image']['tmp_name'];
            $target_file = basename($_FILES['image']['name']);
            
            // tell the program where to stick it(the image file)
            $upload_dir = "uploads";
            
            // strip the name from the file to put into the db as reference
            $img_name = $_FILES['image']['name'];
                       
            
            //make sure our file moves correctly to the folder we specified
            if (move_uploaded_file($tmp_file, $upload_dir . "/" . $target_file)) {
                
                //tell the user they were successful
                echo "Product" . $img_name . " added successfully <br>";
                echo $message;
                
                //query to add the item to the database
                $add_item = "INSERT INTO products(prod_sku, prod_name, prod_description, prod_image, cost, price, QOH, material, is_active, product_size) "
                        . "VALUES('" . $_POST['prod_sku'] . "', '" . $_POST['prod_id'] . "', '" . $_POST['prod_description']
                        . "', '" . $img_name . "', '" . $_POST['cost'] . "', '"
                        . $_POST['price'] . "', '" . $_POST['quantity'] . "','"
                        . $_POST['material'] . "', True, '" . $_POST['size'] . "');";

                mysqli_query($connect, $add_item);
            } 
            
            // if the file did not move to the specified folder tell the user there was a problem
            else {
                echo $message;
            }
        }
        ?>
    </body> 
</html> 



*********************************** Main css page (styling for index.php, productComp.php, update_inventory.php, upload_products.php************************************



*{
    box-sizing: border-box;
}


/********************************* PAGE 1 Title Screen ************************/


     
#main{
    text-align: center;
    background-image: url(../images/blackorchid.jpg);
    /*textured background image from - http://subtlepatterns.com/blach-orchid/*/
    color: #29A9E0;
    font-size: 25px;
    font-family: Fontif;   
    border:#ef4361;
    border-left: 5em;
}

#mainbody{
    display: flex;
    flex-direction: column;
    justify-content: space-around;
    align-items: center;
}
nav{ /* style for the navigation buttons*/
    font-size: 1em;
    position: fixed;
    color: #111111;
    width: 99%;

}
a:-webkit-any-link{
    color: #ef4361;
    text-decoration: underline;
    cursor: auto    
}
a:hover{
    color: #29A9E0;
}
#navigation{
    position: fixed;
    z-index: 1;
    width: 99%;
    background-image: url(../images/blackorchid.jpg);
    /*background-color: #b22222;*/
    display: flex;
    flex-direction: row;
    justify-content: space-around;
    align-items: center;
    color: #29A9E0;
    top: 0%;
}
#background{
    position: fixed;
    z-index: -1;
    width: 100%;
    height: 98%;
    background-image: url(../images/Mom_Range.jpg);
    background-size: cover;
    opacity: 0.2;
}
#page_title{
    padding-top: 15%;
    color: #ef4361;
    font-size: 5em;
    font-family: 'Ruthie', cursive;  
}
.bigText{
    padding-top: 15%;
    color: #B22222;
    font-family: 'Ruthie', cursive;    
}
#main_logo{
    width: 50%;
    margin-top: 5%;
    margin-bottom: 2%;
    margin-left: 25%;
}  
#subtitle{
    padding-top: 7%;
    color: #ef4361;
    font-size: 2.5em;
    font-family: 'Ruthie', cursive;
}
#container_titlepage{
    margin-bottom: 20em;
}







/********************** PAGE 2 Store Front *****************************/






#inlineimages{
    background-color:#111111;
    width: 85%;
    position: relative;
}
#productsForm{
    width: 100%;
}
figure{
    border:#29A9E0;
    border-style:solid;
    border-width: 0.01em;
    height: 39em;
    /*padding-left: 2%;*/
    text-align: left;
    content: center;
    /*margin-right: 1em;*/
}
#btnCart{
    width: 2.9em;
    height: 2.5em;
    background-color: #111111;
    background-image: url(../images/shoppingCartDark.png);
    background-size: cover;
    position: fixed;
    top: 0.5em;
    left: 92%;
    z-index: 1;
    border-radius: 20%;
}
#cartButtonText{
    position: fixed;
    top: 5em;
    left: 92%;
    z-index: 1;
}
#btnTable{
    text-height: .02em;
    width: 2.9em;
    height: 2.5em;
    background-color: #111111;
    background-image: url(../images/Compare_button.png);
    background-size: cover;
    position: fixed;
    top: 0.5em;
    left: 3%;
    z-index: 1;
    border-radius: 20%;
}
#itemsInCart{
    color: #29A9E0;
    width: 2.9em;
    background-image: url(../images/blackorchid.jpg);
    position: fixed;
    top: 8em;
    left: 95%;
    z-index: 1;
}
#page2title{
    font-size: 2em;
    font-family: 'Ruthie', cursive;
}
#title_header{
    position: relative;
    color: #29A9E0;
    font-size: 25px;
    font-family: Fontif;
}
#logo{
    padding-bottom: 4%;
}
.prodImg{

    background-color: #383630;
    width: 25%;
    padding: 1% 5% 1% 5%;
}
.prodImg{
    height: 34em;
    width: 30%;
    padding-bottom: 1%;
    text-align: left;
    display: inline-block;
    background-color:#111111;
    display: flex;
    flex-direction: column;
    justify-content: space-around;
    align-items: center;
}
.img-responsive:hover{
    position: absolute;
    width: 20em;
    height: 20em;
    border-radius: 10%; 
    z-index: 1;
}
.products{
    height: 35em;
    padding-left: 2%;
    display: flex;
    flex-direction: row;
    flex-wrap: nowrap;
    justify-content: space-around;
    align-items: center;
    width: 98%;
    border-bottom-style: solid;
    border-bottom-color: #29A9E0;
}







/***************************PAGE 3 Product Comparison *************************/








#table_section{
    position: relative;
    width: 85%;
    margin-top: 5em;    
}
#page3title{
    font-size: 2em;
    font-family: 'Ruthie', cursive;
    color: #111111;
}
#compTable{
    overflow-x: auto;  
    overflow-wrap:break-word; 
    position: relative;
    width: 85%;  
}
p{
    width: 90%;
}
#comp{
    background-color: #29A9E0;
    display: flex;
    flex-direction: column;
    flex-wrap: nowrap;
    justify-content: space-around;
    align-items: center;
    width: 100%;
    z-index: 1;
}
tr{
    /*border:#29A9E0;
    border-style:solid; 
    border-width: 0.5em;
    width: 25%;*/
}
td{
    border:#29A9E0;
    border-style:solid;
    border-width: 0.01em;
    width: 25%;
    color:#111111;
}
#compDesc{
    width: 75%;
}
.tableProdName{
    width: 10%;
    text-align: left;
    padding-left: 0.5%;
}
.tableProdDesc{
    text-align: left;
    padding-left: 0.5%;
}
.tableProdMat{
    width: 10%;
    text-align: left;
    padding-left: 0.5%;
}
.tableProdSize{
    width: 10%;
    text-align: left;
    padding-left: 0.5%;
}
.tableProdPrice{
    width: 12%;
    text-align: left;
    padding-left: 0.5%;
}






/*********************** FOOTER *****************************/
footer{
    position: relative;
    background-image: url(../images/blackorchid.jpg);
    color: #ef4361;
    width: 99%;
    height: 12em;
    z-index: -1;
    margin-top: 5em; 
}
#footTitle{
    font-size: 2em;
    font-family: 'Ruthie', cursive;
    width: 50%;
    position: relative;
    padding-top: 2em;
    text-align: center;
    left:20%;
}
.p_footer{
    position: relative;
    text-align: center;
    font-size: 0.5em;
    z-index: 1;
}

/*********************************************************** tablet screen size ***************************************/

@media screen and (min-width: 481px) and (max-width: 768px) {
    
    nav{ /* style for the navigation buttons*/
    font-size: 1em;
    position: fixed;
    color: #111111;
    width: 99%;
    height: 3em;
}
a:-webkit-any-link{
    color: #ef4361;
    text-decoration: underline;
    cursor: auto    
}

#navigation{
    position: fixed;
    z-index: 1;
    width: 99%;
    background-image: url(../images/blackorchid.jpg);
    /*background-color: #b22222;*/
    display: flex;
    flex-direction: row;
    justify-content: space-around;
    align-items: center;
    color: #29A9E0;
    top: 0%;
}
#main{
    text-align: center;
    background-image: url(../images/blackorchid.jpg);
    /*textured background image from - http://subtlepatterns.com/blach-orchid/*/
    color: #29A9E0;
    font-size: 25px;
    font-family: Fontif;   
    border:#ef4361;
    border-left: 5em;
}
footer{
    position: relative;
    background-image: url(../images/blackorchid.jpg);
    color: #ef4361;
    width: 99%;
    height: 12em;
    z-index: -1;
    margin-top: 5em; 
}
#footTitle{
    font-size: 2em;
    font-family: 'Ruthie', cursive;
    width: 50%;
    position: relative;
    padding-top: 0.1em;
    text-align: center;
    left:20%;
}
.p_footer{
    position: relative;
    text-align: center;
    font-size: 0.5em;
    z-index: 1;
}
#btnCart{
    width: 2.9em;
    height: 2.5em;
    background-color: #111111;
    background-image: url(../images/shoppingCartDark.png);
    background-size: cover;
    position: fixed;
    top: 2.5em;
    left: 90%;
    z-index: 1;
    border-radius: 20%;
}
#cartButton{
    position: fixed;
    top: 3em;
    left: 85%;
}
#btnTable{
    text-height: 0.8em;
    width: 2.9em;
    height: 2.5em;
    background-color: #111111;
    /*background-image: url(../images/shoppingCartDark.png);*/
    background-size: cover;
    position: fixed;
    top: 2.5em;
    left: 0.1%;
    z-index: 1;
    border-radius: 20%;
}
#comp{
    overflow:auto;
    background-color: #29A9E0;
    display: flex;
    flex-direction: column;
    flex-wrap: nowrap;
    justify-content: space-around;
    align-items: center;
    z-index: 1;
}

}   
/*************************** Medium Page 1 *****************************/    
    




@media screen and (max-width: 480px) {
    #main{
    text-align: center;
    background-image: url(../images/blackorchid.jpg);
    /*textured background image from - http://subtlepatterns.com/blach-orchid/*/
    color: #29A9E0;
    font-size: 15px;
    font-family: Fontif;   
    border:#ef4361;
    border-left: 5em;
}
nav{ /* style for the navigation buttons*/
    font-size: 1em;
    position: fixed;
    color: #111111;
    width: 99%;

}
a:-webkit-any-link{
    color: #ef4361;
    text-decoration: underline;
    cursor: auto    
}
#navigation{
    position: fixed;
    z-index: 1;
    width: 99%;
    background-image: url(../images/blackorchid.jpg);
    /*background-color: #b22222;*/
    display: flex;
    flex-direction: column;
    justify-content: space-around;
    align-items: center;
    color: #29A9E0;
    top: 0%;
}
#btnCart{
    width: 2.9em;
    height: 2.5em;
    background-color: #111111;
    background-image: url(../images/shoppingCartDark.png);
    background-size: cover;
    position: fixed;
    top: 1.5em;
    left: 85%;
    z-index: 1;
    border-radius: 20%;
}
#cartButton{
    position: fixed;
    top: 3em;
    left: 85%;
}
#btnTable{
    width: 2.9em;
    height: 2.5em;
    background-color: #111111;
    /*background-image: url(../images/shoppingCartDark.png);*/
    background-size: cover;
    position: fixed;
    top: 1.5em;
    left: 8%;
    z-index: 1;
    border-radius: 20%;
}
.page2img{
    width: 90%;
}
footer{
    position: relative;
    background-image: url(../images/blackorchid.jpg);
    color: #ef4361;
    width: 99%;
    z-index: -1;
    margin-top: 1em; 
    margin-bottom: 1em;
}
#footTitle{
    font-size: 2em;
    font-family: 'Ruthie', cursive;
    width: 50%;
    position: relative;
    padding-top: 0.1em;
    text-align: center;
    left:20%;
}
.p_footer{
    position: relative;
    text-align: center;
    font-size: 0.5em;
    z-index: 1;
}

#table_section{
    overflow-y:scroll;
    position: relative;
    margin-top: 5em;    
}
.page3Imgs{
    width: 100%;
}
#page3title{
    font-size: 2em;
    font-family: 'Ruthie', cursive;
    color: #111111;
}
#compTable{
    overflow-x: auto;  
    overflow-wrap:break-word; 
    position: relative; 
}

#comp{
    overflow:auto;
    background-color: #29A9E0;
    display: flex;
    flex-direction: column;
    flex-wrap: nowrap;
    justify-content: space-around;
    align-items: center;
    z-index: 1;
}
td{
    color:#111111;
}
/*#compDesc{
    width: 90%;
}*/
.col_name{
    text-align: left;
    padding-left: 0.5%;
}
.col_description{
    width: 4em;
    text-align: left;
    padding-left: 0.5%;
}
.col_material{
    text-align: left;
    padding-left: 0.5%;
}
.col_size{
    visibility:hidden;
}
.col_price{
    text-align: left;
    padding-left: 0.5%;
}


}

/**************************************************************/    
/*.col-1 {width: 8.33%;}
.col-2 {width: 16.66%;}
.col-3 {width: 25%;}
.col-4 {width: 33.33%;}
.col-5 {width: 41.66%;}
.col-6 {width: 50%;}
.col-7 {width: 58.33%;}
.col-8 {width: 66.66%;}
.col-9 {width: 75%;}
.col-10 {width: 83.33%;}
.col-11 {width: 91.66%;}
.col-12 {width: 100%;}*/




*************************************************** cartSheet.css  style for shoppingCart.php ****************************************
