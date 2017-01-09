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

/* client has the ability to select product
 * by name, view and modify current quantity on hand, item cost, item price, dimensions, 
 *  and view and modify active/inactive 
 * status 
 */


// display the form is an item has not been selected
if(!isset($_POST['submit']) && empty($_POST['prod_name'])){
    echo
        "<form id='product_info' action='' method='POST'>"
            . "<input type='submit' name='submit' value='submit'>";
              
    
    //query the database for all products 
    $get_products = "SELECT * "
            . "FROM products ";
    $new_prod_row = mysqli_query($connect, $get_products);

    //loop through the results and show the user what options are available
    while ($row = mysqli_fetch_assoc($new_prod_row)) {
        
        echo "<br>Product sku: <u>" . $row['prod_sku'] . "</u>";
        echo "<input type='radio' name='prod_select' value='" . $row['prod_sku'] . "'><br>";
           
    }
    echo "</form>";
}

// if the user has entered a valid item and clicked submit 
// show the relevant product's information
else{

    // ask the db for the user's selected item
    $prod_inv =  "SELECT *"
    . "FROM products "
    . "WHERE prod_sku = '" . $_POST['prod_select'] . "';";
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
        . "Product Dimensions:<input type='text' class=update_text' name='size' value='" . $row['product_size'] . "'><br>"
        . "Product is " . $active . "<br>"        
        . "Active:<input type='radio' class='update_text' name='active' value='active'><br>"
        . "Inactive:<input type='radio' class='update_text' name='active' value='inactive'><br>"
        . "<input type='submit' name='submit_change' value='make changes'><br>";
    }
}

    // if the user wishes to make changes
    if(isset($_POST['submit_change'])){
        
        // going to make change to radio buttons this is just uncivilized 
        if($_POST['active'] == "active"){
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
        
        header("Location: update_inventory.php");
    }
?>
    </body>
</html>