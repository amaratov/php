<!--
Name:			Alisher Maratov
Date:			November 29, 2019
Purpose:		To collect displat the daya from the Database
-->

<?php
require_once ("db.php");
$db = connectDB();

$sql = "SELECT person_name, person_age, person_dio, file_name FROM lab4";

$result = $db->query($sql);
if ($result->rowCount()>0){
    echo "<table border='1'>";
        echo "<tr>";
            echo "<th>Name</th>";
            echo "<th>Age</th>";
            echo "<th>Bio</th>";
            echo "<th>Picture</th>";
        echo "</tr>";
    while($row = $result->fetch()){
        echo "<tr>";
            echo "<td>".$row['person_name']."</td>";
            echo "<td>".$row['person_age']."</td>";
            echo "<td>".$row['person_dio']."</td>";
            echo "<td><img src='./uploads/".$row['file_name']."' style='max-width: 400px;max-height: 400px alt='".$row['file_name']."'></td>";
        echo "</tr>";
    }
    echo "</table>";
}else{
    echo "Empty table";
}

unset($db);
?>

<html>
<head>
    <title>Part2</title>
</head>
<body>

<br><br><br><br>
<a href="index1.php">Go back to page</a>
</body>
</html>