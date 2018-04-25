<?php 
require 'header.php'; 
?>

    <main>
        <h2>Gold's Pizza</h2>
        <h3>Active Orders:</h3>

        <?php
        echo "<div>";
        echo "<table style='border: solid 1px black;'>";
        echo "<tr><th>Order ID</th><th>Date Received</th><th>Price</th></tr>";

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
            $sql = "SELECT orderID, dateReceived, price from orderDetails natural join orders";
            $stmt = $conn->prepare($sql); 
            $stmt->execute();

            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
            foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
                echo $v;
            }
        }
        catch (PDOException $e) { 
            echo $e->getMessage();
        }
        echo "</table>";
        ?>
	</main>

<?php 
include 'footer.php';
?>