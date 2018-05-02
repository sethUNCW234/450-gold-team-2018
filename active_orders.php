<?php 
require 'header.php';
if (isset($_POST['send'])) {
    require_once('pdo_config.php');
    $orderNumber = $_POST['orderSelect'];

    $sql5 = "update orders set isComplete= true where orderId= :orderId";
     $stmt5 = $conn->prepare($sql5);
     $stmt5->bindParam(':orderId', $orderId,PDO::PARAM_INT);
    $stmt5->execute(array(":orderId" => $orderNumber));

}

?>

    <main>
        <form method="post" action="active_orders.php">
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
    

    if (isset($_SESSION["adminEmail"])){
      
        try{
            
            require_once ('pdo_config.php');
            $sql = "SELECT orderId FROM orders WHERE isComplete = 0";
            $sql2 = "SELECT orderId, dateReceived, totalPrice FROM orders WHERE isComplete = 0";


            $stmt = $conn->prepare($sql); 
            $stmt->execute();
             $result=$stmt->fetchAll();

            echo "<select name='orderSelect'>";
            foreach($result as $row) {
                //print_r($row);
                echo "<option value='" . $row['orderId'] . "'>" . $row['orderId'] . "</option>";
            }
        echo "</select> <input name='send' type='submit' value='Update Order'><br>";


        $stmt2 = $conn->prepare($sql2);
        $stmt2->execute();
        
        $result = $stmt2->setFetchMode(PDO::FETCH_ASSOC); 
        if(true){
        echo "<table style='border: solid 1px black;'>";
        echo "<tr><th>Order ID</th><th>Date Received</th><th>Price</th></tr>";
                
            foreach(new TableRows(new RecursiveArrayIterator($stmt2->fetchAll())) as $k=>$v) { 
                echo $v;
            }
            echo("</table>");
            }
            else{
                echo("<h3>You have no current orders at this time,<br>
                    order now!</h3>");
            }



        }
        catch(PDOException $e){
            echo($e->getMessage());

        }
    }
    elseif (isset($_SESSION["firstName"], $_SESSION["email"])) {
            $email = $_SESSION["email"];
        try {
            require_once ('pdo_config.php');
            $sql = "SELECT orderId, dateReceived, totalPrice FROM orders WHERE emailAddr = :email AND isComplete = 0";
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
    </form>
	</main>

<?php 
include 'footer.php';
?>