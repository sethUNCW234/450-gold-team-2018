<?php 
require 'header.php'; 
?>
<style ="text/css">
tr:hover{
	background-color: #ffff99;
}
</style>
    <main>
		</br>
        <p>
        select one of our specialty pizzas below!
        </p>

        <?php
        echo "<div>";
        echo "<table class='table'>";
        echo "<tr><th>Specialty Pizza</th><th>Price</th></tr>";

        class TableRows extends RecursiveIteratorIterator { 
            function __construct($it) { 
                parent::__construct($it, self::LEAVES_ONLY); 
            }

            function current() {
                return "<td style='border:solid black;'>" . parent::current(). "</td>";
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
        Or create your own custom pizza! $10 as a base price + whatever toppings you'd like from the table below:
        </p>
        <?php
        echo "<table class='table'>";
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
        <p>
        Login or choose the 'Order' option on the menu to place an order!
        </p>
	</main>

<?php 
include 'footer.php';
?>