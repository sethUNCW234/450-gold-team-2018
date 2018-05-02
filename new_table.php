<style type="text/css">


table { 
	width: 750px; 
	border-collapse: collapse; 
	margin:50px auto;
	}

th { 
	background: #3498db; 
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
	background-color: #2cc16a;
	font-weight: bold;
	color: #fff;
}

.label tr td label {
	display: block;
}
.head td {
	
	border: 5px solid #ccc !important;
}

[data-toggle="toggle"] {
	display: none;
}
</style>


<main>



<?php 
require 'header.php'; 
 require_once('pdo_config.php');
   
     $sql = "SELECT orderId,order_timestamp,totalPrice FROM orders WHERE isComplete = 0";
     $sql2 = "SELECT pizzaNumber, GROUP_CONCAT(topping) as toppings from orderdetails natural join orders where orderId= :orderId group by pizzaNumber  order by pizzaNumber asc";


            $stmt = $conn->prepare($sql); 
            $stmt->execute();
             $result=$stmt->fetchAll();




             echo "<table>";
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




 ?>
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
</main>

