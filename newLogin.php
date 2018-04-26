<?php require 'header.php';?>



<form>


<div class="form-group">
    <label for="inputFirstName">First Name</label>
    <input type="text" class="form-control" id="inputFirstName" placeholder="First Name">
    <span class="error text-danger" id="fnError" style="display:none">Please enter your first name, letters only please!</span>
  </div>

<div class="form-group">
    <label for="inputLastName">Last Name</label>
    <input type="text" class="form-control" id="inputLastName" placeholder="Last Name">
    <span class="error text-danger" id="lnError" style="display:none">Please enter your last name, letters only please!</span>
  </div>
  
  
  <div class="form-group">
    <label for="inputEmail">Email address</label>
    <input type="text" class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="Enter email">
    <span class="error text-danger" id="emailError" style="display:none">please enter a valid email.</span>
  </div>
  
  <div class="form-group">
    <label for="inputAddress">Address</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="Address">
      <span class="error text-danger" id="adrError" style="display:none">Please enter an address.</span>
  </div>
  
  <div class="form-group">
    <label for="inputPassword1">Password</label>
    <input type="password" class="form-control" id="inputPassword1" placeholder="Password">
     <span class="error text-danger" id="passError1" style="display:none">Your password must be between 8 and 16 characters</span>
  </div>
   
  
   <div class="form-group">
    <label for="inputPassword2">Re-Enter Password</label>
    <input type="password" class="form-control" id="inputPassword2" onblur="passwordCheck(this)" placeholder="Password">
     <span class="error text-danger" id="passError" style="display:none">The passwords did not match</span>
  </div>
  
   <div class="form-group">
    <label for="inputCCNumber">Credit Card Number</label>
    <input type="password" class="form-control" id="inputCCNumber" placeholder="numbers only please">
     <span class="error text-danger" id="pass2Error" style="display:none">Please enter only the numbers no dashes</span>
  </div>
  
   <div class="form-group">
    <label for="inputCVC">CVC Code</label>
    <input type="password" class="form-control" id="inputCVC" placeholder="CVC">
     <span class="error text-danger" id="csvError" style="display:none">The cvc code is on the back of your card, it should only be 3 digits</span>
  </div>
  
    <div class="form-group">
    <label for="inputEXP">Input date</label>
    <input type="date" class="form-control" id="inputEXP" placeholder="EXP">
    <span class="error text-danger" id="expError" style="display:none">Please enter a date.</span>
  </div>
  
  
  
  </form>
  
  <script type="text/javascript">
  function myTextFunc(ele){
		if (!$(ele).val()){
		$(ele).next("span").css("display","block");
  	$(ele).removeClass("form-control");
  	$(ele).addClass("form-control is-invalid");
		}
	else{
  $(ele).removeClass("form-control is-invalid");
  $(ele).addClass("form-control");
	$(ele).next("span").css("display","none");
		}
	}
  
  function myEmailFunc(ele,pat){
  
  
 if(!$(ele).val() || !pat.test($(ele).val())){
 		$(ele).next("span").css("display","block");
  	$(ele).removeClass("form-control");
  	$(ele).addClass("form-control is-invalid");
		}
    else{
    $(ele).removeClass("form-control is-invalid");
  	$(ele).addClass("form-control");
		$(ele).next("span").css("display","none");
    }
 }
 
 function passwordCheck(ele){
 if($(ele).val() != $("#inputPassword1").val()){
 		$(ele).next("span").css("display","block");
  	$(ele).removeClass("form-control");
  	$(ele).addClass("form-control is-invalid");
 }
 else{
 		$(ele).removeClass("form-control is-invalid");
  	$(ele).addClass("form-control");
		$(ele).next("span").css("display","none");
 }
}
 
 $("#inputEmail").blur(function(){
 myEmailFunc(this,/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/);
 });
$("#inputAddress").blur(function(){
myEmailFunc(this,/^[a-zA-Z0-9 _.-]*$/);
});
$("#inputFirstName").blur(function(){
myEmailFunc(this,/^[a-zA-Z\s]*$/);
});
$("#inputLastName").blur(function(){
myEmailFunc(this,/^[a-zA-Z\s]*$/);
});

$("#inputPassword1").blur(function(){
myEmailFunc(this,/.{8,16}/);
});
$("#inputCCNumber").blur(function(){
myEmailFunc(this,/^[0-9]*$/);
});
$("#inputCSV").blur(function(){
myEmailFunc(this,/^\d{3}/);
});
$("#inputEXP").blur(function(){
myTextFunc(this);
});

  
  </script>
  
  
  <style type="text/css">
input[type="text"] {
    width: 300px;
}
input[type="date"] {
    width: 300px;
}
input[type="password"]{
	width:300px;
}

</style>