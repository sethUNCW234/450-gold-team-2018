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


input [type='checkbox']{
	display: block;
}
</style>

 <script type='text/javascript'>
 	alert('work');
$(document).on('change', '[type=checkbox]'){
	alert('change');
}

 	$(document).ready(function() {
	$(".orderCB").change(function(){
		alert('change');
		$(this).parents().next('.hide').toggle();

	});
});
 </script>



<table>
	<thead>
		<tr>
			<th>Regian</th>
			<th>Q1 2010</th>
			<th>Q2 2010</th>
			<th>Q3 2010</th>
			<th>Q4 2010</th>
		</tr>
	</thead>
	<tbody>
		<tbody class="labels">
			<tr>
				<td colspan="5">
					<label for="accounting">Accounting</label>
					<input type="checkbox" name="accounting" id="accounting" data-toggle="toggle">
				</td>
			</tr>
		</tbody>
		<tbody class="hide">
			<tr>
				<td>Australia</td>
				<td>$7,685.00</td>
				<td>$3,544.00</td>
				<td>$5,834.00</td>
				<td>$10,583.00</td>
			</tr>
			<tr>
				<td>Central America</td>
				<td>$7,685.00</td>
				<td>$3,544.00</td>
				<td>$5,834.00</td>
				<td>$10,583.00</td>
			</tr>
		</tbody>
		<tbody class="labels">
			<tr>
				<td colspan="5">
					<label for="management">Management</label>
					<input type="checkbox" name="management" id="management">
				</td>
			</tr>
		</tbody>
		<tbody class="hide">
			<tr>
				<td>Australia</td>
				<td>$7,685.00</td>
				<td>$3,544.00</td>
				<td>$5,834.00</td>
				<td>$10,583.00</td>
			</tr>
			<tr>
				<td>Central America</td>
				<td>$7,685.00</td>
				<td>$3,544.00</td>
				<td>$5,834.00</td>
				<td>$10,583.00</td>
			</tr>
			<tr>
				<td>Europe</td>
				<td>$7,685.00</td>
				<td>$3,544.00</td>
				<td>$5,834.00</td>
				<td>$10,583.00</td>
			</tr>
			<tr>
				<td>Middle East</td>
				<td>$7,685.00</td>
				<td>$3,544.00</td>
				<td>$5,834.00</td>
				<td>$10,583.00</td>
			</tr>
		</tbody>		
	</tbody>
</table>


<?php 

 require_once('pdo_config.php');
   
     $sql = "SELECT orderId FROM orders WHERE isComplete = 0";
     $sql2 = "SELECT pizzaNumber, GROUP_CONCAT(topping) as toppings from orderdetails natural join orders where orderId= :orderId group by pizzaNumber  order by pizzaNumber asc";


            $stmt = $conn->prepare($sql); 
            $stmt->execute();
             $result=$stmt->fetchAll();




             echo "<table>";
             echo "<tr><th>Order ID</th><th>Date Received</th><th>Price</th></tr></thead><tbody>";
             


            foreach($result as $row) {
            	$id = $row['orderId'];
            	echo "<tbody class ='labels'><tr>
				<td colspan='5'><label for='".$id."'>".$id."</label>
				<input type='checkbox' name='".$id."' id='".$id."' class='orderCB'></td></tr></tbody>";
				     $stmt2 = $conn->prepare($sql2); 
             		$stmt2->bindvalue(':orderId',$id);
           		    $stmt2->execute();
                   $result2=$stmt2->fetchAll();
				foreach($result2 as $row2){
					echo "<tbody class='hide'>
			        <tr> <td>".$row2['pizzaNumber']."</td>
			        <td>".$row2['toppings']."</td></tr></tbody>";


				
				}
			}
			echo "</tbody></table>";




 ?>
