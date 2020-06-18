<!--
Name:			Alisher Maratov
Date:			November 29, 2019
Purpose:		To collect data information from the users
				Then interest to Database.
-->


<?php
session_start();
include_once("./db.php");


if($_SERVER['REQUEST_METHOD']!=='POST'){
    displayForm1();
}else{
    validation();
}
//validation
function validation(){

    if(!isset($_POST['Submit'])){
            if (empty($_POST['name']) || strlen($_POST['name'])>100){
            echo "Name field is either too long or empty";
            displayForm1();
        }elseif(empty($_POST['age']) || strlen($_POST['age'])>3){
            echo "Age field is empty";
            displayForm1();
        }else{
            $_SESSION['name'] = $_POST['name'];
            $_SESSION['age'] = $_POST['age'];
            displayForm2();

        }
    }else{
        displayForm2();
        validateSecond();
    }

}
//validation
function validateSecond(){
    if (empty(trim($_POST['bio']))){
        echo "Enter your bio field";
    }elseif (empty($_FILES['picFile']['name'])){
        echo "Please enter the text area";
    }else{
        insertDB();
        move_uploaded_file($_FILES['picFile']['tmp_name'],"./uploads/".$_FILES['picFile']['name']);
        echo "The data has been uploaded successfully";
        echo "<br>";
        echo "File name: ".$_FILES['picFile']['name']." with size: ".$_FILES['picFile']['size'];
        echo "<br><br>";
        echo "<a href='index2.php'>Output the result</a>";
    }
}
//inerting to Database
function insertDB(){
        $db = connectDB();
        $sql = "INSERT INTO lab4 (person_name, 
                                  person_age,
                                  person_dio,
                                  file_name, 
                                  store_file_name,
                                  filesize,
                                  file_type)
                          VALUES (:pName,
                                  :age,
                                  :bio,
                                  :fName,
                                  :storeName,
                                  :fSize,
                                  :fType)";

        $stmt = $db->prepare($sql);
        //Assigning variables
        $stmt->bindParam(":pName",$_SESSION['name']);
        $stmt->bindParam(":age",$_SESSION['age']);
        $stmt->bindParam(":bio",$_POST['bio']);
        $stmt->bindParam(":fName",$_FILES['picFile']['name']);
        $stmt->bindParam(":storeName",$_FILES['picFile']['tmp_name']);
        $stmt->bindParam(":fSize",$_FILES['picFile']['size']);
        $stmt->bindParam(":fType",$_FILES['picFile']['type']);

        $status = $stmt->execute();

        if (!$status){
            echo "Error ".$stmt->errorCode()."\nMessage ".implode($stmt->errorInfo())."\n";;
        }
}

?>

<html>
<head>
    <title>lab4 first form page</title>
</head>
<body>

<!--First part-->

<?php
function displayForm1()
{
    ?>
    <form action="./index1.php" method="post">
        <h1>Lab4 form: </h1>
        <br><br>
        <label for="name">Input your name</label>
        <input type="text" id="name" name="name">
        <br><br>
        <label for="age">Input your age:</label>
        <input type="text" id="age" name="age">
        <br><br>
        <input type="submit" value="Next" id="next" name="next">
    </form>
    <?php
}
?>

<?php
function displayForm2()
{
    ?>
    <form action="./index1.php" method="post" enctype="multipart/form-data">
        <label for="textArea">Input your bio:</label>
        <br>
        <textarea name="bio" id="textArea" cols="30" rows="10"></textarea>
        <br><br>
        <label for="file">Input an image of yourself:</label>
        <input type="file" name="picFile" id="file">
        <br><br><br>
        <input type="submit" value="Submit" name="Submit">
    </form>
    <?php
}
?>
</body>
</html>