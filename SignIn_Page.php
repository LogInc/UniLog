<!DOCTYPE html/>

<html>
    <head>
        <title>UniLog | Sign in </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <style>
            body{
                background-color:white;	
            }
            h1.uni{
                color:#4472c4;
                font-family:"Bauhaus 93", Times, serif;                
                margin-top:20px;
            }
            
            button.sign{
                float:right;
            }
            div.signIn_form{
                font-family:"Calibri Light";      
               	margin-top:30px;	
            }
            div.signUp_form{
                font-family:"Calibri Light";
                margin-top:20px;		
            }
            p.Sign{
                font-size:27px;
                margin-bottom:0px;		
            }
            
            div.welcome{
                margin-top: 50px;                
                margin-bottom:25px;
                font-family:"Calibri Light";
                font-size:20px                    
            }
            
            img.img{
                margin-top:20px;
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
            .hor_rule{
                margin-top: 120px;
               
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
        <div class="container">
            <h1 class="uni"><a href="#" class ="brand"> UniLog</a> </h1>
            <hr>
            <div class = "welcome"> Welcome to <b style="color:#4472c4" >UniLog</b>, we hope you enjoy the experience </div>
            <br>
            <div class="row body"  >
                <div class="col-sm-6">
                    
                    <img class="img" id= "rzi" src="schoolbag.jpg" alt="Oh Lord, Increase me in Knowledge" >
                    
                </div>
                
                <div class= "col-sm-4 signIn_form"  >
                    <form>
                        <p class="Sign"><strong>Sign In</strong><br>
                        <p> or <a href="#" id = "signup_page" > create an account </a></p>
                        <input class="input" id="username" type="text" onFocus= "this.value = ''" onBlur = "rename()" value="Username" >
                        <br>
                        <br>
                        <input id="password" type="text" onfocus= "input_password()" onBlur = "rename()"  value="Password">
                        <br><br>
                        <input id="remember me" type="checkbox" name="remember_me"> Remember me
                        
                    </form>
                    
                    <button class = "btn btn-primary sign ">Sign In </button>
                </div>
                
                
                
                <div class= "col-sm-4 signUp_form"  style = "display:none">
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
                    
                    <button class = "btn btn-primary sign">Sign Up </button>
                </div>
                
            </div>
            <hr class="hor_rule">
        </div>
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
        
