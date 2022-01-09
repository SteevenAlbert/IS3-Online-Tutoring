<?php
 session_start();
 include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/Menu.php";
 include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";
establishConnection();

$user = $_SESSION['UserID'];

//----------------------------- Order Search ----------------------------------
echo"<form action = '' method = 'post'> 
  <input type = 'text' placeholder = 'Search' name = 'search' required> 
  <select name =filter > 
  <option value=OrderID> Ref. no </option> 
  <option value=Amount> Amount </option> 
  <option value=Price> Price </option> 
  <option value=Learner> Learner </option> 
  <option value=Course> Course </option> 
  </select>
  <input type = 'submit' name = 'submit' value = 'Go'>  </form>";

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
  if (!$result)
    die("Cannot process query $getOrdersID");

  if (mysqli_num_rows($result)<=0)
  {
    echo "No results";
  }

  while ($row = $result->fetch_array(MYSQLI_ASSOC))
  {
    // Get order info
    echo "<a href=viewOrderDetails.php?id=".$row['orderID']."> Order Ref.". $row['orderID']."</a><br>"; 
    echo getUsername($row["UserID"])."<br>";
    echo "Amount: ".$row["Amount"]."<br>";
    echo "Price: ".$row["Total"]."<br>";
    echo $row["OrderTime"]."<br>";
    echo "<br>";

  }

}

