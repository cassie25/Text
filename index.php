<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet" type="text/css">
    <title>Document</title>
</head>
<body>
  <?php
      $alert="";
      //code runs when user clicks on the submit button
      if(isset($_POST['signup'])){
          $fname=$_POST['fname'];
          $lname=$_POST['lname'];
          $email=$_POST['email'];
          //encryption our password
          $password=$_POST['password'];
          $password=password_hash($password,PASSWORD_DEFAULT);
           
          //connect to your db
          $link=mysqli_connect("localhost","root","","eshop");
        //verify from the database table if the registered email already exist
           $query=mysqli_query($link, "select email_address from members where email_address='$email'");
          //count numbers of rows selected from the above query
          $rows=mysqli_num_rows($query);
          if($rows==1){
            //upload profile picture
          $pic=$_FILES["picture"]["name"];
          $ext=pathinfo($pic, PATHINFO_EXTENSION);
          $memberid=mysqli_insert_id($link);

            $alert="Email Already Exist...";
          }
          else{
            //insert the registered user in the  table(members) in your database
            $usercode=uniqid("user-".rand(),true);
          $query=mysqli_query($link,"insert into members(firstname,lastname,email_address,password,verified,usercode) values('$fname','$_POST[lname]','$email','$password','No','$usercode')");
          if($query){
             $alert="Form Inserted";
          }
       }
      }//end of if

  ?>
    <div class="form">
      <h3><?php echo $alert ?></h3>
       <ul class="tab-group">
          <li class="tab active"><a href="#signup">Sign Up</a></li>
          <li class="tab"><a href="#login">Log In</a></li>
        </ul>
        
        <div class="tab-content">
          <div id="signup">   
            <h1>Sign Up for Free</h1>
            
            <form action="index.php" method="post">
            
            <div class="top-row">
              <div class="field-wrap">
                <label>
                  First Name<span class="req">*</span>
                </label>
                <input type="text" required autocomplete="off"  name="fname"/>
              </div>
             <div class="book"></div>
              <div class="field-wrap">
                <label>
                  Last Name<span class="req">*</span>
                </label>
                <input type="text"required autocomplete="off" name="lname"/>
              </div>
            </div>
  
            <div class="field-wrap">
              <label>
                Email Address<span class="req">*</span>
              </label>
              <input type="email"required autocomplete="off" name="email"/>
            </div>
            
            <div class="field-wrap">
              <label>
                Set A Password<span class="req">*</span>
              </label>
              <input type="password"required autocomplete="off" name="password"/>
            </div>

            <div class="field-wrap">
              <label>
                Profile Picture<span class="req">*</span>
              </label>
              <input type="file" required name="picture"/>
            </div>

            <input type="submit" class="button button-block" value="Get Started" name="signup">
            
            </form>
  
          </div>
          
          <div id="login">   
            <h1>Welcome Back!</h1>
            
            <form action="/" method="post">
            
              <div class="field-wrap">
              <label>
                Email Address<span class="req">*</span>
              </label>
              <input type="email"required autocomplete="off"/>
            </div>
            
            <div class="field-wrap">
              <label>
                Password<span class="req">*</span>
              </label>
              <input type="password"required autocomplete="off"/>
            </div>
            
            <p class="forgot"><a href="#">Forgot Password?</a></p>
            
            <button class="button button-block"/>Log In</button>
            
            </form>
  
          </div>
          
        </div><!-- tab-content -->
        
  </div> <!-- /form -->
  <script src="script.js"></script>
</body>
</html>