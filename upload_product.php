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
            Product Dimensions:<br><input type="text" name ="size" value=""><br>
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
        $error = $_FILES['image']['error'];
        
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
                echo "Product " . $img_name . " added successfully <br>";
                echo $message;
                
                //query to add the item to the database
                $add_item = "INSERT INTO products(prod_sku, prod_name, prod_description, prod_image, cost, price, QOH, material, is_active, product_size) "
                        . " VALUES('" . $_POST['prod_sku'] . "', '" . $_POST['prod_id'] . "', '" . $_POST['prod_description']
                        . "', '" . $img_name . "', " . $_POST['cost'] . ", "
                        . $_POST['price'] . ", " . $_POST['quantity'] . ",'"
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