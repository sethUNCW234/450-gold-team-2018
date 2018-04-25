<?php 
require 'header.php'; 
?>
<style ="text/css">
tr:hover{
	background-color: #ffff99;
}
</style>

<script type='text/javascript'>

var photoMap = {
    "BBQ Chicken": 'http://www.jennycancook.com/wp-content/uploads/2015/03/BBQ_Chicken_Pizza_600.jpg',
    "Deluxe": 'http://media.foodnetwork.ca/recipetracker/dmm/U/L/Ultimate_Chicken_Sausage_Deluxe_Pizza_001.jpg',
	"Hawaiian":'http://www.landomoms.com/wp-content/uploads/2011/10/GettyImages-537640710-e1507558357499.jpg',
	"Meat Lovers":'http://www.brosgiantpizza.com/wp-content/uploads/2016/08/meat-lovers.png',
	"Vegetarian": 'https://www.pamperedchef.com/iceberg/com/recipe/9658-lg.jpg'
    
};

var descriptionMap = {
	"BBQ Chicken": "Made with our tangy and smokey sauce, get all the benefits of a cookout without all the clean up!",
	"Deluxe":" Who says you can't have it all? Go all the way with our Deluxe!",
	"Hawaiian":"Maui isn't so far away with our classic Hawaiian!",
	"Meat Lovers":"Unleash the carnivore within! With heaping slices of ham,bacon,sausage,and pepperioni!",
	"Vegetarian":"Meat not your thing? Our Veggies are garden fresh!"
};

$(document).ready(function(){
    $('#specialty').find('tr').on("mouseover",function(){
        var rowPos = $(this).find('td:first-child').offset();
		var text =$(this).find('td:first-child').text();
		//alert(text);
		getPizzaInfo(rowPos,text);
			
    });
	$('#specialty').find('tr').on("mouseleave",function(){
		$('.PizzaInfo').css("display",'none');
		//alert('left');
	});
});


function getPizzaInfo(pos,text){
var bottomTop = pos.top;
var bottomLeft = pos.left;
$('#pizzaImage').attr('src',photoMap[text]);
$('#pizzaDescription').text(descriptionMap[text]);
$('.PizzaInfo').css({
	display:'block',
	position: 'absolute',
    top: bottomTop+35,
    left: bottomLeft+125,	
});
}
</script>
    <main>
	
		<div class="PizzaInfo" style="display:none;border-radius:7px;background-color:GRAY; word-wrap:'break-word';width:200px;">
			<div>
			<div style="height:100px; width:200px">
			<img id='pizzaImage' style="height:100px; width:100%; object-fit:cover"/>
			</div>
			<p id="pizzaDescription">
			Our awesome pizza will leave you wanting more!
			</p>
			</div>
		</div>
	
		</br>
        <p>
        select one of our specialty pizzas below!
        </p>

        <?php
        echo "<div>";
        echo "<table class='table' id='specialty'>";
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