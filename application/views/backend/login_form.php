 <!DOCTYPE html>

<html lang="en">

  <head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <!-- Meta, title, CSS, favicons, etc. -->

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">



    <title>Invoice </title>



    <!-- Bootstrap -->

    <link href="<?php echo base_url().'template/backend/theme/'; ?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->

    <link href="<?php echo base_url().'template/backend/theme/'; ?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- NProgress -->

    <link href="<?php echo base_url().'template/backend/theme/'; ?>vendors/nprogress/nprogress.css" rel="stylesheet">

     <!-- Custom Theme Style -->

    <link href="<?php echo base_url().'template/backend/theme/'; ?>build/css/custom.min.css" rel="stylesheet">

 <!-- Animate.css -->

    <link href="<?php echo base_url().'template/backend/theme/'; ?>vendors/animate.css/animate.min.css" rel="stylesheet">

   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

   

  </head><body class="login">

    <div>

      <a class="hiddenanchor" id="signup"></a>

      <a class="hiddenanchor" id="signin"></a>



      <div class="login_wrapper">

        <div class="animate form login_form">

          <section class="login_content">

            <form action="<?php echo base_url().'index.php/backend/login/';?>" method="post">

              <h1>Login Form</h1>
<?php if($message ==1){ ?>

                    <div class="alert alert-success alert-dismissible fade in" role="alert">

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>

                    </button>

                    <strong>Your Password is send to your email.login here to continue..</strong>

                  </div>

                  <?php } ?>
                   <?php if($error ==1){ ?>

                    <div class="alert alert-danger alert-dismissible fade in" role="alert">

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>

                    </button>

                    <strong>You are not allowed to access Dashboard..</strong>

                  </div>

                  <?php } ?>
              <div>

                <input type="text" class="form-control" name="username" placeholder="Username" required="" />

              </div>

              <div>

                <input type="password" class="form-control" name="password" placeholder="Password" required="" />

              </div>

              
              <input type="submit" value="Submit" id="login" >


              <div class="clearfix"></div>



              <div class="separator">

                <p class="change_link">New to site?

                  <a href="#signup" class="to_register"> Create Account </a>

                </p>



                <div class="clearfix"></div>

                <br />



                <div>

                  <h1><i class="fa fa-paw"></i> Invoice</h1>

                  

                </div>

              </div>

            </form>

          </section>

        </div>



        <div id="register" class="animate form registration_form">

          <section class="login_content">

            <form action="<?php echo base_url().'index.php/backend/create_account/';?>" method="post" id="sign_up_form">

              <h1>Create Account</h1>

              <div>

                <input type="text" class="form-control" placeholder="Name" name="username" required />

              </div>

              <div>

                <input type="email" class="form-control" placeholder="Email" name="email" id="sign_up_email" required />

              </div>
               <p class="error" style="color:red"></p>
              <div>

                <input type="password" class="form-control" placeholder="Password" name="password" id="create_password" required />

              </div>
                <p id="demo" style="color:red"></p>
        <p id="length" style="color:red"></p>
               <div>

                <input type="password" class="form-control" placeholder="confirm Password" name="conf_password" id="confirm_password" onkeyup="check(this)" required />

              </div>
              <div id="result" style="color:red"></div>
              <div>

               <input type="submit" value="Submit" id="create_account" onClick="return false">

              </div>



              <div class="clearfix"></div>



              <div class="separator">

                <p class="change_link">Already a member ?

                  <a href="#signin" class="to_register"> Log in </a>

                </p>


                <div class="clearfix"></div>

                <br />



                <div>

                  <h1><i class="fa fa-paw"></i> Invoice</h1>

                 

                </div>

              </div>

            </form>

          </section>

        </div>

      </div>

    </div>

  </body>

</html>

<script type="text/javascript">
  
function check(input) {
  //alert("fgdg");
  var result = document.getElementById("result");
        if (input.value != document.getElementById('create_password').value) {
          result.innerHTML = "Password don't match";
            input.setCustomValidity('Password Must be Matching.');
            //$('#pass_error').html('Password Must be Matching');
        } else {
            // input is valid -- reset the error message
            result.innerHTML = "";
            input.setCustomValidity('');
        }
    }

</script>
<script>
          $(document).ready(function() {
 
    $('#create_password').keyup(function(){
      //alert("fgdg");
       $('#demo').html(checkStrength($('#create_password').val()))
       $('#length').html(checklength($('#create_password').val()))
    })  
 
    function checkStrength(password){
 
    //if the password length is less than 6, return message.
    if (password.length < 6) {
       
        return 'Too short';
    }
 else{
  return "";
 }
}
function checklength(password){
 
    //if the password length is less than 6, return message.
    if (password.length >32) {
       
        return 'Too long';
    }
 else{
  return "";
 }
}
});

</script>

<script>
            $(document).ready(function() {
             
            jQuery("#create_account" ).click(function() {
              
          var email =  jQuery('#sign_up_email').val();  
         var password =  jQuery('#create_password').val(); 
         //var base_url = "<?php //echo base_url();?>";
         //alert (email);
         //var form = $(this);
         
         $.ajax({
            type: "POST",
            dataType:'json',
            url: "<?php echo base_url('backend/post_ajax_sign_up_check');?>",
           
            data:"email="+email+"&password="+password,       

           
            success: 
              function(data){
              //var obj= JSON.parse(data);
              //alert(data.response);
              //if(obj.error)
              //alert(data.json);
              if(data.response=='false'){
               //alert("err");
              $('#sign_up_email').html(data.json.email); 
             //$('#create_password').html(data.json.password);
              $('.error').html("<p>This email already exists</p>");
             
              
              }
            
              if(data.response=='true'){

                $('#sign_up_form').submit();
              }
            
            }
            }); 
            }); 
            });         

            </script> 
