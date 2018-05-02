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

        <style type="text/css">




th { 
    background-color:RED; 
    color: white; 
    font-weight: bold; 
    }

td, th { 
    padding: 10px; 
    border: 1px solid #ccc; 
    text-align: left; 
    font-size: 18px;
    }

.labels tr td {
    background-color: black;
    font-weight: bold;
    color: #fff;
}

.label tr td label {
    display: block;
}
.head td {
    
    border: 5px solid #ccc !important;
}
.hide{
    display:none;
}
[data-toggle="toggle"] {
    display: none;
}
</style>


         <script type='text/javascript'>
    
 
$(document).ready(function() {
    $('[data-toggle="toggle"]').change(function(){
        $(this).parents().next('.hide').toggle();
    });
});

    /*
    $(document).ready(function() {
    $(".orderCB").change(function(){
        alert('change');
        $(this).parents().next('.hide').toggle();

    });
});
*/
 </script>

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
      
    require_once('pdo_config.php');
   
     $sql = "SELECT orderId,order_timestamp,totalPrice FROM orders WHERE isComplete = 0";
     $sql2 = "SELECT pizzaNumber, GROUP_CONCAT(topping) as toppings from orderdetails natural join orders where orderId= :orderId group by pizzaNumber  order by pizzaNumber asc";


            $stmt = $conn->prepare($sql); 
            $stmt->execute();
             $result=$stmt->fetchAll();
            echo "<select name='orderSelect'>";
            foreach($result as $row){
                echo "<option value='" . $row['orderId'] . "'>" . $row['orderId'] . "</option>";

             }

             echo "</select> <input name='send' type='submit' value='Update Order'><br>";

             echo "<table class='table'>";
             echo "<tr><th>Order ID</th><th>Date Received</th><th>Price</th></tr></thead><tbody>";
             


            foreach($result as $row) {
                $id = $row['orderId'];
                $ts = $row['order_timestamp'];
                $price = $row['totalPrice'];
                echo "<tbody class ='labels'><tr>
                <td><label for='".$id."'>".$id."</label>
                <input type='checkbox' name='".$id."' id='".$id."' data-toggle='toggle'></td><td>".$ts."</td><td>".$price."</td></tr></tbody>";
                     $stmt2 = $conn->prepare($sql2); 
                    $stmt2->bindvalue(':orderId',$id);
                    $stmt2->execute();
                   $result2=$stmt2->fetchAll();
                   echo "<tbody class='hide'><tr><td class='head'>Pizza Number</td><td class='head'>Toppings</td>";

                foreach($result2 as $row2){
                    
                   echo "<tr> <td>".$row2['pizzaNumber']."</td>
                    <td>".$row2['toppings']."</td></tr>";


                
                }
                echo "</tbody>";
            }
            echo "</tbody></table>";






      
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