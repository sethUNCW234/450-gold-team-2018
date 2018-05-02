
<style type="text/css">
img{
    position:absolute;
}
.topping{
    margin-top: 30px;
    margin-left:30px;

}
</style>


<?php 
require 'header.php'; 
if (isset($_POST['send'])) {
    $missing = array();
    $toCart = array();
    $BBQCart = array();
    $DeluxeCart =array();
    $HawaiianCart=array();
    $MeatLoversCart=array();
    $VegetarianCart=array();



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
    
    if (isset($_SESSION["email"])){
        $userEmail = $_SESSION["email"];
    }
    
    try {
        require_once ('pdo_config.php');
        $date = date("Y-m-d");

        $sql = "insert into orders (orderId, dateReceived, emailAddr, totalPrice) values(:unique_id,:date,:userEmail,:totalPrice)";
        
       // $sql = "insert into orders values(:unique_id,:date,:userEmail,:totalPrice)";
        
        $sqlprice = "select price from pizza where pizzaName ='Deluxe'";
        $priceStmt = $conn->prepare($sqlprice);
        $priceStmt->execute();
        $resultprice =$priceStmt->fetch();
        $price =  (float) $resultprice["price"];
        $orderTotal = array_sum($toCart) * $price;


        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':unique_id', $unique_id);
        $stmt->bindValue(':date', $date);
        $stmt->bindValue(':totalPrice', $orderTotal);
        $stmt->bindValue(':userEmail', $userEmail);
        $stmt->execute();
        $pizzaNumber = 1;

        

        if(isset($_POST['customPcheck'])){
            if( isset($_POST['topping']) && is_array($_POST['topping']) ) {
                $orderTotal+=10.00;
                foreach($_POST['topping'] as $topping) {
                    
                $toppingArray=explode('-',$topping);
                    //print_r($toppingArray);
                    $sql99 = "insert into orderDetails values(:unique_id, :pizzaNumber,'".$toppingArray[1]."')";
                        $stmt99 = $conn->prepare($sql99);
                        $orderTotal += (float)$toppingArray[0]; 
                       $stmt99->bindValue(':unique_id', $unique_id);
                       $stmt99->bindValue(':pizzaNumber', $pizzaNumber);
                       $stmt99->execute();
                        }

        
                    }
                    echo($orderTotal);
                $sql98 = "UPDATE orders set totalPrice= :totaPrice where orderId= :unique_id";
                $stmt98 = $conn->prepare($sql98);
                $stmt98->bindParam(':totalPrice', $orderTotal);
                $stmt98->bindParam(':unique_id', $unique_id,PDO::PARAM_INT);
                $stmt98->execute(array(":totaPrice" => $orderTotal, ":unique_id" => $unique_id));
                $pizzaNumber++;
                }
                
                
        for($i = 0; $i < count($toCart); $i++) {
            
            if ($i == 0){  //if first index of array i.e: bbq pizza
               // echo($toCart[$i]."this is tocart 0");
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
        <p>
        Please select one of our speciality pizzas from below:
        </p>
        <h3 style="display:inline; left-padding:50px">Your Total: </h3><h3 id="total2" style="display:inline;">$0.00</h3>
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


                echo "<input type='number' id='".$row['pizzaName']."-".$row['price']."' style='width:150px; display:inline' class='form-control' min='0' max='100' placeholder='0' name='".$new."' value='".
                htmlentities($row['pizzaName'])."'> ".$row['pizzaName']." ($".$row['price'].")";
                echo "</br>";
                $new++;
            } 
        ?>

        <h3>Custom Pizza:</h3>
       <div class="form-check" style="display:inline;">
      <input type="checkbox" name="customPcheck" id="custPcheck">
      <label class="form-check-label" for="customPizza">
        create your own custom pizza ($10.00 + Toppings)
      </label>
  </div>
        <div id='custom-pizza-container' style="width:700px">
            <div id='custom-pizza-pic'  style='width:60%;float:left;margin-right:5px;'>
                <img id='basePic' src="./pics-450/pizza.png" style="opacity:0.4;">
                <!-- Meats -->
                <img id="1" class='topping' src="./pics-450/pep.png" style="display:none">
                <img  id="2" class='topping' src="./pics-450/bacon.png" style="display:none">
                <img  id="3" class='topping' src="./pics-450/chicken.png" style="display:none">
                <img  id="4" class='topping' src="./pics-450/ham.png" style="display:none">
                <img  id="5" class='topping' src="./pics-450/salami.png" style="display:none">
                <!-- veggies -->
                <img  id="6" class='topping' src="./pics-450/pineapple.png" style="display:none">
                <img  id="7" class='topping' src="./pics-450/greenpepper.png" style="display:none">
                <img  id="8" class='topping' src="./pics-450/mushroom.png" style="display:none">
                <img  id="9" class='topping' src="./pics-450/onion.png" style="display:none">
                <img  id="10" class='topping' src="./pics-450/jalpepper.png" style="display:none">

                <input type="hidden" name="hiddenTotal" id="hiddenTotal" value="0.00">
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
            </div>
            <div id='custom-toppings'>

        <?php 
            $stmt2->execute();
            while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='form-check'><label class='form-check-label'><input type='checkbox' class='form-check-input' name='topping[]' disabled='true' id=".$row2['tName']." value='".
                htmlentities($row2['price']).'-'.$row2['tName']."'> ".$row2['tName']." ($".$row2['price'].") </label></div>";
                echo "<br>";
            } 
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
        ?>
    </div>
        </div>
        <p>
            <br>
            <h2 style="display:inline;">Current total: </h2><h2 style="display:inline;" id=total>$0.00</h2>
            <input name="send" type="submit" value="Add to Cart">
        </p>
        </form>

        <script type="text/javascript">
            
            function calculatePrice(){
                var total=0.00;
                $('input[type=number]').each(function() {
                   //alert($(this.val()));
                   if($(this).val() >0){
                    total+=$(this).val() * parseFloat($(this).attr('id').split('-')[1]);
                   }
                });
                var first=true;
                if($("#custPcheck").is(":checked")){
                    
                    total += 10.00;
                    $('#custom-pizza-container input[type=checkbox]:checked').each(function(){
                        total+=parseFloat($(this).val());
                    });

                }
                total = total.toFixed(2);
                return total.toString();
            }

            



            var toppingMap={
                'Pepperoni':'1',
                'Bacon':'2',
                'Chicken':'3',
                'Ham':'4',
                'Salami':'5',
                'Pineapple':'6',
                'Green':'7',
                'Mushroom':'8',
                'Onion':'9',
                'Jalapeno':'10'

            };
            $(document).on('change',"#custPcheck",function(){
                 
                    $('#custom-pizza-container [type=checkbox]').each(function(){
                        if($('#custPcheck').is(':checked')){

                         $(this).removeAttr("disabled");
                         $('#basePic').css('opacity','1.0')
                        }
                        else{
                            $('.topping').css('display','none');
                            $(this).prop("checked",false);
                            $(this).attr("disabled",true);
                            $('#basePic').css('opacity','0.4')

                        }

                    });

                    
                 });

            $(document).on('change','#custom-pizza-container [type=checkbox]',function(){
                if(this.checked){
                    //alert($(this).attr('id'));
                   // alert(toppingMap[$(this).attr('id')]);
                   $("#"+toppingMap[$(this).attr('id')]).css('display','block');
                }
                if(!this.checked){
                     $("#"+toppingMap[$(this).attr('id')]).css('display','none');

                }



            });

            $(document).change(function(){
                var currentPrice=calculatePrice()
                $('#total').text("$"+ currentPrice);
                $("#total2").text("$"+ currentPrice);
                $('#hiddenTotal').value(currentPrice);
            });
            

        </script>

	</main>

<?php include 'footer.php'; ?>