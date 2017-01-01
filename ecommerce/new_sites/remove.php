 <!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Add Product Information</title>
</head>

<body>
    <p>
    	
        <?php
	        
        $con = mysqli_connect("localhost","root", "sesame","pioneers");
       
		$productId = filter_input(INPUT_POST, "productId");
	    $query = " DELETE FROM product where productId='$productId'";
		$result = $con->query($query);
	 	if($result!=false){
			echo '<script language="javascript">';
			
			echo 'alert("Product is successfully removed !")';
			echo '</script>';
			include("removeProduct.php");
		}else{
		    echo '<script language="javascript">';
			echo 'alert("One of the fields you entered is wrong.Please enter the correct details!!")';
			echo '</script>';
			include("removeProduct.php");
		}
        ?>
    </p>
</body>
</html>