<?php
 session_start();
 include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/Menu.php";
 include_once "/xampp/htdocs/IS3-Online-Tutoring/src/public/is3library.php";

establishConnection();

echo"<form action='OrderSearch.php' method='post'> 
  <input type='text' placeholder='Search Order' name='searchOrder' required> 
  <input type='submit' value='Search'>  </form>";


//search by username
$sql_1="SELECT Distinct u.Username, o1.orderID, c.title ,o1.orderDate, o1.Amount FROM orders o1
 JOIN ordercourses o2 ON o1.orderID=o2.orderID
 JOIN courses c ON c.courseID=o2.courseID
 JOIN users u ON u.UserID=o1.UserID
 WHERE ( u.Username LIKE'%".$_POST['searchOrder']."%'
OR o2.orderID LIKE '%".$_POST['searchOrder']."%' 
OR c.title LIKE '%".$_POST['searchOrder']."%'
OR o1.orderDate LIKE '%".$_POST['searchOrder']."%'
OR o1.Amount LIKE '%".$_POST['searchOrder']."%')";

$result_sql_1=$conn->query($sql_1);

if (!$result_sql_1) {
    die ("Error.$sql_1");
}

if (mysqli_num_rows($result_sql_1)<=0)
{
    echo "No results for your search: ". $_POST['searchOrder'];
}
else{
    // $row = $result_sql_1->fetch_array(MYSQLI_ASSOC);
    

    while ($row = $result_sql_1->fetch_array(MYSQLI_ASSOC))
    {
        echo "<h4>".$row["Username"]."</h4><br>";  
        echo"Order ".$row["orderID"].":<br>";
        echo"Course: ".$row["title"].":<br>";
        echo"Amout: ".$row["Amount"].":<br>";
        echo"Order Date: ".$row["orderDate"].":<br>";
        


    }
    
}
?>
