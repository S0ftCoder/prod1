<!-- Footer -->
<?php 

session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

//require "dbhandler.php"; 
include "dbhandler.php";
?>

<?php
   // checking if the variable is set or not and if set adding the set data value to variable userid
   if(isset($_GET['prod_id']))
    {
      $prodid = $_GET['prod_id']; 
    }
      // SQL query to select all the data from the table where id = $userid
      $query="SELECT * FROM productss WHERE id = $prodid ";
      $view_prods= mysqli_query($conn,$query);

      while($row = mysqli_fetch_assoc($view_prods))
        {              
          $id = $row['id'];                
          $pname = $row['prod_name'];
          $pretprice = $row['prod_retail']; //$pprice     //prod_price      
          $pstck = $row['prod_stock']; //$pqnty        //prod_qnty
        }
 
    //Processing form data when form is submitted
    if(isset($_POST['update'])) 
    {
      $pname = $_POST['pname-inpt'];
      $pretprice = $_POST['pretprice-inpt'];
      $pstck = $_POST['pstck-inpt'];
      
      // SQL query to update the data in user table where the id = $userid 
      $query = "UPDATE productss SET prod_name = '{$pname}' , prod_retail = '{$pretprice}' , prod_stock = '{$pstck}' WHERE id = $prodid";
      $update_prod = mysqli_query($conn, $query);
      //echo "<script type='text/javascript'>alert('User data updated successfully!')</script>";
      header("Location: home.php?update=sucess");
      exit();
    }             
?>
<head>
  <title>Update Product</title>
  <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
</head>
<style>
   body{
		background: #f1f1f1;
	}
  .main-container {
		background: #caebf2;
    height: 662px;
		width: 600px;
		border-radius: 14px;
		position: relative;
		top: 410px;
	}
  .main-container h1{
    padding-top: 39px;
    font-family: 'Public Sans', sans-serif;
    font-size: 52px;
    color: #a9a9a9;
  }
  input[name="pname-inpt"]::placeholder {        
		text-align: center;
	}input[name="pretprice-inpt"]::placeholder {        
		text-align: center;
	}input[name="pstck-inpt"]::placeholder {        
		text-align: center;
	}
  input[name="opr-sub"]{
    margin-top: 121px;
  }
	input {
		height: 70px;
		width: 69%;
		font-size: 41px;
		border: none;
		text-align: center;
		font-family: 'Public Sans', sans-serif;
    margin-top: 8px;
	}
  input[name="update"]{
		height: 60px;
		width: 70%;
		position: relative;
		top: 7px;
		border: none;
		background: #ff3b3f;
		color: #ffffff;
		font-size: 36px;
		font-family: 'Public Sans', sans-serif;
	}
  img[name="back-btn"]{
    position: absolute;
    height: 62px;
    top: -70px;
    right: 1px;
}

</style>
<script>
    $(document).ready(function() {
          const def = $("#stock").val()
          $("#sold,#stock").keyup(function() {
              var total = 0;
              var x = Number($("#sold").val());
              var total = def - x;
              $("#stock").val(total); // the result will be showed in "quantity"
          });
    });
</script>
<center>
  <div class="main-container">
    <a href="home.php"><img name="back-btn" src="img/icons/close-btn.png" alt="Back"></a>
  <h1 class="text-center">Update Product</h1>
    <form action="" method="post">
        <input type="text" name="pname-inpt"  value="<?php echo $pname  ?>" readonly>
        <input type="number" name="pretprice-inpt" step="any" value="<?php echo $pretprice  ?>">
        <input type="number" name="pstck-inpt" id="stock" value="<?php echo $pstck  ?>" readonly>
        <input type="number" name="opr-sub" class="sold-inpt" id="sold" placeholder="Qnty of Sold">
        <input type="submit"  name="update" value="Sold">
    </form>    
  </div>

    <!-- a BACK button to go to the home page -->
    <div class="container text-center mt-5">
      <a href="home.php"> Back </a>
    <div>
</center>
<?php 
   } else {
        header("Location: index.php");
        exit();
    }
 ?>