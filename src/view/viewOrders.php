<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!-- Rating stars -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">

<?php
 session_start();
 include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/Menu.php";
 include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";
establishConnection();

isAdmin();

$user = $_SESSION['UserID'];

//----------------------------- Order Search ----------------------------------
echo"<form action = '' method = 'post'>";
//   <input type = 'text' placeholder = 'Search' name = 'search' required> ";
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css">
<link rel="stylesheet" href="../../CSS/order.css">

  <h1> View Orders</h1>
  <div class="container1"> 
    <div class="form-group1"> 
      <div class="dropdown1">
        <div class="default-option">
        <select name =filter class ="select"> 
             <option value=OrderID> Ref. no </option> 
              <option value=Amount> Amount </option> 
              <option value=Price> Price </option> 
              <option value=Learner> Learner </option> 
              <option value=Course> Course </option> 
            </select>
            </div>
       </div>
      <div class="search">
         <input type='text' name='search'  class='search-input' placeholder="search"  class="form-control" required>
      </div>
      <button class= "btn" name='submit' type='submit'><i class="fas fa-search"></i>
    </div>
  </div>

  <div class="randomimage">
<img id="learnerImage" src="../../uploads/backgroundImages/graph (1).png">
</div>

  <?php


if (isset($_POST['submit']))
{
  $text = $_POST['search'];
  $query = "SELECT distinct * FROM courses c 
  JOIN ordercourses o2 ON o2.CourseID =c.CourseID 
  JOIN orders o1 ON o1.orderID=o2.orderID 
  JOIN users u ON o1.UserID=u.UserID";


  if ($_POST['filter'] == "Amount")
  {
    $query .= " WHERE o1.Amount LIKE '%".$_POST['search'];
  }
  elseif ($_POST['filter'] == "OrderID")
  {
    $query .= " WHERE o1.OrderID LIKE '%".$_POST['search'];
  }
  elseif ($_POST['filter'] == "Price")
  {
    $query .= " WHERE o1.Total LIKE '%".$_POST['search'];
  }
  elseif ($_POST['filter'] == "Course")
  {
    $query .= " WHERE c.Code LIKE '%".$_POST['search'].
    "%' OR c.Title LIKE '%".$_POST['search'].
    "%' OR c.Description LIKE '%".$_POST['search'].
    "%' OR c.Hours LIKE '%".$_POST['search'].
    "%' OR c.Level LIKE '%".$_POST['search'].
    "%' OR c.Price LIKE '%".$_POST['search'];
  }
  elseif  ($_POST['filter'] == "Learner")
  {
    $query.= " WHERE u.UserName LIKE '%".$_POST['search'];
  }

  $query .= "%' GROUP BY o1.OrderID";

  displayOrders($query);

}
else
{
  //------------------------------ Get all orders ------------------------------ 
  $getOrdersQuery = "SELECT * FROM orders  ORDER BY OrderTime desc";
  displayOrders($getOrdersQuery);
}



function displayOrders($query)
{
  $result = $GLOBALS['conn']->query($query);
  try{
    if (!$result)
      throw new Exception("Error Occured"); 
              
}catch(Exception $e){  
 echo"Message:", $e->getMessage();  
}

  if (mysqli_num_rows($result)<=0)
  {
    echo "No results";
  }


while($row = $result->fetch_array(MYSQLI_ASSOC)){
    // Get order info
?>


<div class='Cardorder'>
    <div class='row'>

        <div class="col-lg-4">
            <div class="cardorder-body">
                <h4 class="cardorder-title">
                <a href=viewOrderDetails.php?id=<?php echo $row['orderID'] ?>> Order Ref. <?php echo $row['orderID']?></a>
                </h4>
                <p class="cardorder-text">
                    <?php echo getUsername($row["UserID"])?> <br>
                        <?php "Amount: ".$row["Amount"]."<br>"?>
                        <span class="dot"></span>
                        <?php echo$row["OrderTime"]?><br> 
                    </small>
                </p>
            </div>
        </div>
        <div class="col-lg-3">
            <h4 class="cardorder-subtitle">
                <?php echo"EGP".$row["Total"]?><br>
            </h4>
       </div>
      </div>
  </div>


 <?php
    }
}
?>
