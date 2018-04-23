<?php 
require 'header.php'; 
?>

    <main>
        <h2>Gold's Pizza</h2>
        <p>
        Please select one of our speciality pizzas from below:
        </p>

        <?php
        echo "<div>";
        echo "<table style='border: solid 1px black;'>";
        echo "<tr><th>Specialty Pizza</th><th>Price</th></tr>";

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

        try {
            require_once ('pdo_config.php');
            $sql = "SELECT pizzaName, price FROM pizza";
            $sql2 = "SELECT tName, price FROM topping";
            $stmt = $conn->prepare($sql); 
            $stmt2 = $conn->prepare($sql2);
            $stmt->execute();

            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
            foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
                echo $v;
            }
        echo "</table>";
        ?>
        <p>
        Or create your own pizza! $10 as a base price + whatever toppings you'd like from the table below:
        </p>
        <?php
        echo "<table style='border: solid 1px black;'>";
        echo "<tr><th>Toppings</th><th>Price</th></tr>";
            $stmt2->execute();
            $result2 = $stmt2->setFetchMode(PDO::FETCH_ASSOC);
            foreach(new TableRows(new RecursiveArrayIterator($stmt2->fetchAll())) as $k=>$v) {
                echo $v;
            }
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        echo "</table>";
        ?>
	</main>

<?php 
include 'footer.php';
?>