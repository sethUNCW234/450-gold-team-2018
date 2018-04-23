<?php 
require 'header.php'; 
if (isset($_POST['send'])) {
    $missing = array();
    $toCart = array();

    $BBQChicken = (int) $_POST['0'];
    $toCart[] = $BBQChicken;
    $Deluxe = (int)  $_POST['1'];
    $toCart[] = $Deluxe;
    $Hawaiian = (int) $_POST['2'];
    $toCart[] = $Hawaiian;
    $MeatLovers = (int)  $_POST['3'];
    $toCart[] = $MeatLovers;
    $Vegetarian = (int) $_POST['4'];
    $toCart[] = $Vegetarian;

    $unique_id = substr(strval(time()), -5); // generate unique 5 digit order ID
    $orderTotal = array_sum($toCart) * 14.99;
    if (isset($_SESSION["email"])){
        $userEmail = $_SESSION["email"];
    }
    
    try {
        require_once ('pdo_config.php');
        $date = date("Y-m-d");
        $sql = "insert into orders values(:unique_id, :date, :orderTotal, :userEmail)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':unique_id', $unique_id);
        $stmt->bindValue(':date', $date);
        $stmt->bindValue(':orderTotal', $orderTotal);
        $stmt->bindValue(':userEmail', $userEmail);
        $stmt->execute();

        $pizzaNumber = 1;
        for($i = 0; $i < count($toCart); $i++) {
            if ($i == 0){  //if first index of array i.e: bbq pizza
                if ($toCart[$i] == 0) {
                    //do nothing
                }
                else{
                    for($x = 0; $x < $toCart[$i]; $x++) {
                        $sql2 = "insert into orderDetails values(:unique_id, :pizzaNumber,'Chicken')";
                        $sql3 = "insert into orderDetails values(:unique_id, :pizzaNumber,'Onion')";
                        $sql4 = "insert into orderDetails values(:unique_id, :pizzaNumber,'Green Pepper')";
                        $stmt2 = $conn->prepare($sql2);
                        $stmt3 = $conn->prepare($sql3);
                        $stmt4 = $conn->prepare($sql4);
                        $stmt2->bindValue(':unique_id', $unique_id);
                        $stmt3->bindValue(':unique_id', $unique_id);
                        $stmt4->bindValue(':unique_id', $unique_id);
                        $stmt2->bindValue(':pizzaNumber', $pizzaNumber);
                        $stmt3->bindValue(':pizzaNumber', $pizzaNumber);
                        $stmt4->bindValue(':pizzaNumber', $pizzaNumber);
                        $stmt2->execute();
                        $stmt3->execute();
                        $stmt4->execute();
                        $pizzaNumber ++;
                    }
                }
            }
            else if ($i == 1){ //Deluxe
                if ($toCart[$i] == 0) {
                    //do nothing
                }
                else{
                    for($x = 0; $x < $toCart[$i]; $x++) {
                        $sql5 = "insert into orderDetails values(:unique_id, :pizzaNumber,'Ham')";
                        $sql6 = "insert into orderDetails values(:unique_id, :pizzaNumber,'Chicken')";
                        $sql7 = "insert into orderDetails values(:unique_id, :pizzaNumber,'Onion')";
                        $sql8 = "insert into orderDetails values(:unique_id, :pizzaNumber,'Green Pepper')";
                        $stmt5 = $conn->prepare($sql5);
                        $stmt6 = $conn->prepare($sql6);
                        $stmt7 = $conn->prepare($sql7);
                        $stmt8 = $conn->prepare($sql8);
                        $stmt5->bindValue(':unique_id', $unique_id);
                        $stmt6->bindValue(':unique_id', $unique_id);
                        $stmt7->bindValue(':unique_id', $unique_id);
                        $stmt8->bindValue(':unique_id', $unique_id);
                        $stmt5->bindValue(':pizzaNumber', $pizzaNumber);
                        $stmt6->bindValue(':pizzaNumber', $pizzaNumber);
                        $stmt7->bindValue(':pizzaNumber', $pizzaNumber);
                        $stmt8->bindValue(':pizzaNumber', $pizzaNumber);
                        $stmt5->execute();
                        $stmt6->execute();
                        $stmt7->execute();
                        $stmt8->execute();
                        $pizzaNumber ++;
                    }
                }
            }
            else if ($i == 2){ //Hawaiian
                if ($toCart[$i] == 0) {
                    //do nothing
                }
                else{
                    for($x = 0; $x < $toCart[$i]; $x++) {
                        $sql9 = "insert into orderDetails values(:unique_id, :pizzaNumber,'Ham')";
                        $sql10 = "insert into orderDetails values(:unique_id, :pizzaNumber,'Pineapple')";
                        $stmt9 = $conn->prepare($sql9);
                        $stmt10 = $conn->prepare($sql10);
                        $stmt9->bindValue(':unique_id', $unique_id);
                        $stmt10->bindValue(':unique_id', $unique_id);
                        $stmt9->bindValue(':pizzaNumber', $pizzaNumber);
                        $stmt10->bindValue(':pizzaNumber', $pizzaNumber);
                        $stmt9->execute();
                        $stmt10->execute();
                        $pizzaNumber ++;
                    }
                }
            }
            else if ($i == 3){ //Meat Lovers
                if ($toCart[$i] == 0) {
                    //do nothing
                }
                else{
                    for($x = 0; $x < $toCart[$i]; $x++) {
                        $sql11 = "insert into orderDetails values(:unique_id, :pizzaNumber,'Ham')";
                        $sql12 = "insert into orderDetails values(:unique_id, :pizzaNumber,'Chicken')";
                        $sql13 = "insert into orderDetails values(:unique_id, :pizzaNumber,'Bacon')";
                        $sql14 = "insert into orderDetails values(:unique_id, :pizzaNumber,'Pepperoni')";
                        $stmt11 = $conn->prepare($sql11);
                        $stmt12 = $conn->prepare($sql12);
                        $stmt13 = $conn->prepare($sql13);
                        $stmt14 = $conn->prepare($sql14);
                        $stmt11->bindValue(':unique_id', $unique_id);
                        $stmt12->bindValue(':unique_id', $unique_id);
                        $stmt13->bindValue(':unique_id', $unique_id);
                        $stmt14->bindValue(':unique_id', $unique_id);
                        $stmt11->bindValue(':pizzaNumber', $pizzaNumber);
                        $stmt12->bindValue(':pizzaNumber', $pizzaNumber);
                        $stmt13->bindValue(':pizzaNumber', $pizzaNumber);
                        $stmt14->bindValue(':pizzaNumber', $pizzaNumber);
                        $stmt11->execute();
                        $stmt12->execute();
                        $stmt13->execute();
                        $stmt14->execute();
                        $pizzaNumber ++;
                    }
                }
            }
            else if ($i == 4){ //Vegetarian
                if ($toCart[$i] == 0) {
                    //do nothing
                }
                else{
                    for($x = 0; $x < $toCart[$i]; $x++) {
                        $sql15 = "insert into orderDetails values(:unique_id, :pizzaNumber,'Mushroom')";
                        $sql16 = "insert into orderDetails values(:unique_id, :pizzaNumber,'Onion')";
                        $sql17 = "insert into orderDetails values(:unique_id, :pizzaNumber,'Green Pepper')";
                        $stmt15 = $conn->prepare($sql15);
                        $stmt16 = $conn->prepare($sql16);
                        $stmt17 = $conn->prepare($sql17);
                        $stmt15->bindValue(':unique_id', $unique_id);
                        $stmt16->bindValue(':unique_id', $unique_id);
                        $stmt17->bindValue(':unique_id', $unique_id);
                        $stmt15->bindValue(':pizzaNumber', $pizzaNumber);
                        $stmt16->bindValue(':pizzaNumber', $pizzaNumber);
                        $stmt17->bindValue(':pizzaNumber', $pizzaNumber);
                        $stmt15->execute();
                        $stmt16->execute();
                        $stmt17->execute();
                        $pizzaNumber ++;
                    }
                }
            }
        }
    }
    catch (PDOException $e) {
        echo $e->getMessage();
    }
}
    



?>

    <main>
        <h2>Gold's Pizza</h2>
        <p>
        Please select one of our speciality pizzas from below:
        </p>
        <h3>Specialty Pizzas:</h3>
        <form action="order.php" method="post">
        <?php
        try {
            require_once ('pdo_config.php');

            $sql = "SELECT pizzaName, price FROM pizza";
            $sql2 = "SELECT tName, price FROM topping";
            $stmt = $conn->prepare($sql);
            $stmt2 = $conn->prepare($sql2);
            $stmt->execute();
            $new = 0;
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {


                echo "<input type='number' min='0' max='100' placeholder='0' name='".$new."' value='".
                htmlentities($row['pizzaName'])."'> ".$row['pizzaName']." ($".$row['price'].")";
                echo "<br>";
                $new++;
            } 
        ?>

        <h3>Custom Pizza:</h3>

        <?php 
            $stmt2->execute();
            while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                echo "<input type='checkbox' name='pizzas' value='".
                htmlentities($row2['price'])."'> ".$row2['tName']." ($".$row2['price'].")";
                echo "<br>";
            } 
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
        ?>
        <p>
            <br>
            <input name="send" type="submit" value="Add to Cart">
        </p>
        </form>
	</main>

<?php include 'footer.php'; ?>