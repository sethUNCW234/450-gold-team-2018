<?php 
require 'header.php'; 
?>

    <main>
        <h2>Gold's Pizza</h2>
        <h3>Account Info</h3>

        <?php
        echo "<div>";
        echo "<table style='border: solid 1px black;'>";
        echo "<tr><th>First Name</th><th>Last Name</th><th>Email</th><th>Address</th></tr>";

        class TableRows extends RecursiveIteratorIterator { 
            function __construct($it) { 
                parent::__construct($it, self::LEAVES_ONLY); 
            }

            function current() {
                return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
            }

            function beginChildren() { 
                echo "<tr>"; 
            } 

            function endChildren() { 
                echo "</tr>" . "\n";
            } 
        } 
        if (isset($_SESSION["firstName"], $_SESSION["email"])) {
            $email = $_SESSION["email"];
            try {
                require_once ('pdo_config.php');
                $sql = "SELECT * FROM userinfo WHERE emailAddr = :email"; // make use of userInfo view
                $sql2 = "SELECT orderID, dateReceived, totalPrice, pizzaNumber, GROUP_CONCAT(topping) from orders natural join pizzaHistory where emailAddr = :email GROUP BY orderID, pizzaNumber";
                $stmt = $conn->prepare($sql); 
                $stmt2 = $conn->prepare($sql2);
                $stmt->bindValue(':email', $email);
                $stmt2->bindValue(':email', $email);
                $stmt->execute();

                // set the resulting array to associative
                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
                foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
                    echo $v;
                }
                 
                echo "</table></br>";
               
                $stmt2->execute();
                $result2 = $stmt2->setFetchMode(PDO::FETCH_ASSOC);
                if (true) { //(mysqli_num_rows($result2)>=1){
                echo "<h3>Your Order History</h3>";
                echo "<table style='border: solid 1px black;'>";
                echo "<tr><th>Order #</th><th>Date Ordered</th><th>Total Price</th><th>Pizza #</th><th>Toppings on Pizza</th></tr>";
                foreach(new TableRows(new RecursiveArrayIterator($stmt2->fetchAll())) as $k=>$v) {
                echo $v;
                }
                echo("</table>");
            }
            else{
                echo("<h2>Our records show you have not placed an order with us </h2>");
            }
            }
            catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        
        }
        
        ?>
	</main>

<?php 
include 'footer.php';
?>