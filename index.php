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
        <link href="Assets/css/Background_Style.css" rel="stylesheet" type="text/css">
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
        
        $count = sizeof($_SESSION['cart_item']);
        echo "<p id='count_cart'>Cart: " . $count . "</p>";
       
        
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
        <div id="background"></div><!-- This div holds the background image for the site-->
        <script>
            //480px
            $(function () {
                    $(".toggle-button").click(function(){
                        $(".navigation").toggle(); 
            }); 

            });
                
               
                

        </script>

        <script>
            $(function () {
                $('.description').hide();
            });

            $(this).click(function () {
                $(".description").toggle();
            });
        </script>

        <!-- *********************************** PAGE 1*****************************************-->        

        <!-- container for navigation header -->
        <span class="toggle-button">
            <div class="menu-bar menu-bar-top"></div>
            <div class="menu-bar menu-bar-middle"></div>
            <div class="menu-bar menu-bar-bottom"></div>
        </span>
        <nav class="navigation" id="navigation"><!-- -->
            <a class="nav" href="#home">Home</a>
            <a class="nav" href="#products">Products</a>
            <a class="nav" href="productComp.php">Compare Items</a>  
            <a class="nav" href="#contactUs">Contact Us</a>
            <a class="nav" href="shoppingCart.php">View Shopping Cart</a>
        </nav>

        <!-- container to hold the entire page -->
        <main class="container-fluid" id="mainbody">


            
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
                                    <input name='addToCart[]' type='checkbox' value='" . $row['prod_sku'] . "'> Add to cart <br>
                                    <input name='addToTable[]' type='checkbox' value='" . $row['prod_sku'] . "'> Compare products <br><br>    
                                    <p>" . $row['prod_name'] . "</p><br>
                                    <p>Price: $" . $row['price'] . "</p>
                                    <img responsive class='page2img' src='uploads/" . $row['prod_image'] . "' alt=''/>
                                    <p class='description'>" . $row['prod_description'] . "</p>
                                    
                                </figure>";
                            }
                        }
                        ?>

                    </div>
                </form>
            </section>










            <!--############################### PAGE 3 ################################################-->




            <script>
                //document.ready;
                //$("#compareItems").hide();
            </script>




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