<?php
   require 'require/connection.php';
   ob_start();
   session_start();
   if(!isset($_SESSION['Email'])){
       header('location:Admin_Login.php');
       exit;
       } 
?>
<html>
    <head>
         
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >


        <!--jQuery library--> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>


        <!--Latest compiled and minified JavaScript--> 
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
       
        <title>Online Exam Portal</title>
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
                        <li class="dropdown">
    <button class="btn btn-primary dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"><?php echo " Welcome ".$_SESSION['Name']." ";?></button>
    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
<li role="presentation"><a role="menuitem" tabindex="-1" href="Admin_home.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="update1.php"><span class="glyphicon glyphicon-user"></span> Update</a></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="cpwd1.php"><span class="glyphicon glyphicon-cog"></span> Change Password</a></li><li role="presentation" class="divider"></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="Logout.php"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
    </ul>
 			</li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row row_style2">
                <div class="col-xs-4 col-xs-offset-4">
<?php
	if(isset($_POST['submit']))
	{
		$duration = $_POST['duration'];
		$starttime = $_POST['starttime'];
		$endtime = $_POST['endtime'];
		$tq = $_POST['tq'];
		$sc = $_POST['sc'];
$sql =<<<EOF
	INSERT INTO timer (duration,totalq,score,starttime,endtime) VALUES ('$duration','$tq','$sc','$starttime','$endtime');
EOF;
	
		$ret = @pg_query($db, $sql);
   
		if(!$ret)
		{
        	echo pg_last_error($db);
   		}
		else
		{
        	echo "Successfully Done.Redirecting to home page...\n";
			$_SESSION['time']=$duration;
			$_SESSION['totalquestion']=$tq;
			$_SESSION['sc']=$sc;
			header('Refresh: 2; URL=Admin_home.php');
		}	
	}

	pg_close($db);
?>
        <form action="SetQD.php" method="POST">
            <h5>SET THE EXAM DURATION AND TOTAL QUESTION</h5>
            <div class="form-group" >
                <input type="text" name="starttime" class="form-control" placeholder="Test start time in the format YYYY-MM-DD HH:MM:SS" required="true">
            </div>
	    <div class="form-group" >
                <input type="text" name="endtime" class="form-control" placeholder="Test end time in the format YYYY-MM-DD HH:MM:SS" required="true">
            </div>
	    <div class="form-group" >
                <input type="text" name="duration" class="form-control" placeholder="Test duration" required="true">
            </div>
            <div class="form-group">
                <input type="text" class="form-control"  placeholder="Total Question for the Exam" name="tq" required = "true">
            </div>
	    <div class="form-group">
                <input type="text" class="form-control"  placeholder="Total Score" name="sc" required = "true">
            </div>
            <input type="submit" name="submit" value="Set">     
        </form>
                </div>
            </div>
        </div>

    </body>
</html>
