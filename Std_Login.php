<html>
    <head>
         
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >


        <!--jQuery library--> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>


        <!--Latest compiled and minified JavaScript--> 
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
       
        <title>Onilne Exam Portal</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavBar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        
                    </button>
                    <a class="navbar-brand" href="#">Online Exam</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavBar">
                    <ul class="nav navbar-nav navbar-right">
                        <?php
                        include 'require/Sign_Login.html';
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row row_style1">
                <div class="col-xs-4 col-xs-offset-4">
<?php
session_start();
if(isset($_POST['submit'])){
   require 'require/connection.php';
    $em=$_POST['email'];
    $pwd=$_POST['Password'];
    $hash=password_hash($_POST['Password'],PASSWORD_DEFAULT);
$sql=<<<EOF
        select email from student where email='$em';
EOF;
$ret=pg_query($db,$sql);
   if(!$ret) {
       echo pg_last_error($db);
   }else{
	if(!pg_fetch_row($ret)){
		echo "<b>$em does not exist!\nEnter valid email id<b>";
	}else{
	$sql1=<<<EOF
        	select id,name,email,password,contact from student where email='$em';
EOF;
	$ret1=pg_query($db,$sql1);
   	if(!$ret1) {
     	echo pg_last_error($db);   
   	}else{
		 $sql0=<<<EOF
			update student set loginvalue=1 where email='$em';
EOF;
	$ret0=pg_query($db,$sql0);
   	if(!$ret0) {
     	echo pg_last_error($db);   
   	}else{echo "$em set successfully";}
	   	while($row=pg_fetch_row($ret1)){
		if(password_verify($pwd,$row[3])){
			      $_SESSION['valid'] = true;
                  	      $_SESSION['timeout'] = time();
			      $_SESSION['id'] = $row[0];
                  	      $_SESSION['email'] = $row[2];
			      $_SESSION['name'] = $row[1];
			      $_SESSION['Contact'] = $row[4];	
			      header('location:Instruction.php');
			      exit;
				
			}else{
    			   echo 'Password Invalid!Please try again.';
			} 
      		     }
	      }
    }
   }
}
?>
        <div class="panel panel-primary">
            <div class="panel-heading"><h4>Login</h4>
            </div>
            <div class="panel-body">
                <p class="text-warning"><h5>Login to give exam</h5></p>
            <form action="Std_Login.php" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" name="email" placeholder="email">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="Password" placeholder="Password">
                    </div>
                    <input type="submit" name="submit" value="Login">
                </form>
            </div>
            <div class="panel-footer">Don't have an account? <a href="Std_Signup.php">Register</a></div>
        </div>
             </div>   
        </div>
        </div>
    </body>
</html>

