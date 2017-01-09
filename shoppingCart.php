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
        <div id="background"></div><!-- This div holds the background image for the site-->
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
