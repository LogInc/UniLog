	<!DOCTYPE html/>

	<html>
	<head>
	<style>
	body{
		background-color:white;	
	}
	h1{
		color:#4472c4;
		font-family:"Bauhaus 93", Times, serif;
		margin-left:50px;
		margin-top:20px;
	}
	div.header{
		
		background-color: black;
		width: 1200px;
		padding: 0.05px;
		margin-top: 10px;
		margin-left: 50px;
		margin-right: 50px;	
	}
	div.signIn_form{
		font-family:"Calibri Light";
		float:right;
		margin-right:300px;
		margin-top:10px;		
	}
	div.signUp_form{
		font-family:"Calibri Light";
		float:right;
		margin-right:300px;
		margin-top:10px;		
	}
	p.Sign{
		font-size:27px;
		margin-bottom:0px;		
	}
	
	div.UniLog{
		margin-top: 50px;
		margin-left: 80px;		
		margin-bottom:25px;
		font-family:"Calibri Light";
		font-size:20px
		
}	

	button.signin{
		color:white;
		font:14px Calibri Light;
		margin-left:280px;
		padding:10px;
		width:80px;
		border:1px solid #4472c4;
		background-color:#4472c4;
		border-radius:10px;
		cursor:pointer;

	}
	
	.input{
		width:360px;
		height:33px;
		color:#7f7b7b;
		font-family:"Calibri Light";
		font-size:20px;
		border:1px solid ;
		border-radius:5px;
		padding-left:5px
		
	}
	#password{
		width:360px;
		height:33px;
		color:#7f7b7b;
		font-family:"Calibri Light";
		font-size:20px;
		border:1px solid ;
		border-radius:5px;
		padding-left:5px
	}
	
	div.img{
		
		margin-left:100px;
		margin-top:70px;
		margin-right:30px;
	}
	#rzi{
		width:400px;
		border:3px solid #ffff  ;
		border-radius:10px;
		
	}
	</style>
	</head>

	<body>
	<h1> UniLog </h1>
	<div class="header"> </div>
	<div class = "UniLog"> Welcome to <b>UniLog</b>, we hope you enjoy the experience </div>
	<div class= "signIn_form"  >
		<form>
		<p class="Sign"><strong>Sign In</strong><br>
		<p> or <a href="#" id = "signup_page" > create an account </a></p>
		<input class="input" id="username" type="text" onFocus= "this.value = ''" onBlur = "rename()" value="Username" >
		<br>
		<br>
			<input id="password" type="text" onfocus= "input_password()" onBlur = "rename()"  value="Password">
	</form>	
	<button class = "signin">Sign In </button>
	</div>
	
	
	<div class= "signUp_form" style = "display:none">
	<form>
		<p class="Sign"><strong>Sign Up</strong><br>
		<p> or <a href="#" id = "signin_page" > Sign In </a></p>
		<input class="input" id = "First_name" type="text" onFocus= "this.value = ''" onBlur = "rename()" value="First Name" >
		<br>
		<br>
			<input class="input" id="Last_name" type="text" onfocus= "this.value = ''" onBlur = "rename()"  value="Last Name">
			<br>
		<br>
			<input class="input" id="Email" type="text" onfocus= "this.value = ''" onBlur = "rename()"  value="Email Id">
			<br>
		<br>
			<input class="input" id="Roll_Number" type="text" onfocus= "this.value = ''" onBlur = "rename()"  value="Roll_Number (e.g 2012-CE-08)">
	</form>
	
	<button class = "signin">Sign Up </button>
	</div>
        <div class = "img">
		<img id= "rzi" src="rzi.jpg" alt="Oh Lord, Increase me in Knowledge" >
		</div>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script>
	$(document).ready(function(){
$("#signin_page").click(function(){
$(".signUp_form").hide();				
$(".signIn_form").show();
});

});	
$(document).ready(function(){
$("#signup_page").click(function(){
$(".signIn_form").hide();
$(".signUp_form").show();
});

});
	
	function input_password()
	{
		var val = document.getElementById("password");
		val.value = '';
		val.setAttribute("type", "password");
	}
	

function rename() {

	var user_val = document.getElementById("username");
	var fname_val = document.getElementById("First_name");
	var lname_val = document.getElementById("Last_name");
	var email_val = document.getElementById("Email");
	var roll_val = document.getElementById("Roll_Number");
	var pass_val =  document.getElementById("password");
	
	
	if(user_val.value == '')
	{
		user_val.value = "Username";
		
	}
	if(fname_val.value == '')
	{
		fname_val.value = "First Name";
	}
	if(lname_val.value == '')
	{
		lname_val.value = "Last Name";
	}
	if(email_val.value == '')
	{
		email_val.value = "Email Id";
	}
	if(roll_val.value == '')
	{
		roll_val.value = "Roll_Number (e.g 2012-CE-08)";
	}
	if(pass_val.value == '')
	{
		pass_val.value = "Password";
		pass_val.setAttribute("type", "text");				
	}
}
</script>

