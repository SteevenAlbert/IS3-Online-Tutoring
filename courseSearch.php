<?php
 session_start();
include_once "Menu.php";
include_once "is3library.php";

establishConnection();

//--------------------------------------- Get all matching courses ---------------------------------------
$query = "select * from courses where approved = 1 AND ( Code LIKE '%".$_POST['search'].
"%' OR Title LIKE '%".$_POST['search'].
"%' OR Description LIKE '%".$_POST['search'].
"%' OR Hours LIKE '%".$_POST['search'].
"%' OR Level LIKE '%".$_POST['search'].
"%' OR Price LIKE '%".$_POST['search'].
"%' OR CreatedBy LIKE '%".$_POST['search']."%')";

$result = $conn->query($query);

if (!$result) die ("Fatal error in executing query $query");
if (mysqli_num_rows($result)<=0)
{
    echo "No results for your search: ". $_POST['search'];
}
else{
    // Display matching courses
    while ($row = $result->fetch_array(MYSQLI_ASSOC))
    {
        echo "<a href = courseDetails.php?id=".$row["CourseID"]." >".$row["Code"]."&nbsp".$row["Title"]."</a> <br>";
        echo $row["Description"]."<br>";
        echo "Hours: ".$row["Hours"]." <br>";
        echo "Level: ".$row["Level"]." <br>";
        echo "Price: ".$row["Price"]." <br>";
        echo "<i> Created by: ".$row["CreatedBy"]." </i> <br>";
        echo "<br> <br>";

    }
}

?>