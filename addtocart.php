<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="utf-8">
</head>

<body>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST["car"]) && ($_POST['car'] != "") && isset($_POST["days"]) && ($_POST['days'] != "")) {
            $carname = $_POST['car'];
            $days = $_POST['days'];

            include 'model.php';
            $model = new model();

            $query = "SELECT * FROM Cars WHERE carname =\"$carname\"";

            $result = $model->sqlcommend($query);

            if (!empty($result)) {
                foreach($result as $key => $value)
                $row = $value;
                $carid = $row["cars_id"];
                $price = $row["price"];
                $userid = $_COOKIE['id'];
                //Not sure how to insert the parking price into table
                $sql = "INSERT INTO Orders_cars(cars_id, users_id)
                           VALUES ($carid, $userid)";
                $model->sqlcommend($sql);
                $totalprice = $days * $price;
                setcookie("carprice", $totalprice);
            //header("Location: viewcart.php");

        } else {
            echo '<script language="javascript">';
            echo 'alert("Retrieval Failed")';
            echo '</script>';
        }
    }
}

    ?>
    <a href="viewcart.php"><input type="button" id="btn1" value="OK"></a>
</body>
</html>