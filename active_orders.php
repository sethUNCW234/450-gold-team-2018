<?php 
require 'header.php'; 
?>

    <main>
        <h2>Gold's Pizza</h2>
        <h3>Active Orders:</h3>

        <?php
        echo "<div>";
      

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
            $sql = "SELECT orderID, dateReceived, totalPrice FROM orders WHERE emailAddr = :email AND isComplete = 0";
            $stmt = $conn->prepare($sql); 
            $stmt->bindValue(':email', $email);
            $stmt->execute();

            // set the resulting array to associative
            //echo(mysql_num_rows($result));
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

            if(true){
        echo "<table style='border: solid 1px black;'>";
        echo "<tr><th>Order ID</th><th>Date Received</th><th>Price</th></tr>";
                
            foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
                echo $v;
            }
            echo("</table>");
            }
            else{
                echo("<h3>You have no current orders at this time,<br>
                    order now!</h3>");
            }
        }
        catch (PDOException $e) { 
            echo $e->getMessage();
        }
    }
    
        echo "</div>";
        
        ?>

	</main>

<?php 
include 'footer.php';
?>