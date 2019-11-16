<?php
   ob_start();
   session_start();
   if(!isset($_SESSION['Email'])){
       header('location:Admin_Login.php');
       exit;
       }
header('Refresh: 5; URL=monitor.php');
?>

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
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="Admin_home.php"><span class="glyphicon glyphicon-home"></span> Online Exam</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavBar">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
    <button class="btn btn-primary dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"><span class="glyphicon glyphicon-home"></span><?php echo " Welcome ".$_SESSION["Name"]." ";?></button>
    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
      <li role="presentation"><a role="menuitem" tabindex="-1" href="Admin_home.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="update1.php"><span class="glyphicon glyphicon-user"></span> Update</a></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="cpwd1.php"><span class="glyphicon glyphicon-cog"></span> Change Password</a></li><li role="presentation"><a role="menuitem" tabindex="-1" href="monitor.php"><span class="glyphicon glyphicon-wrench"></span> Monitor</a></li><li role="presentation" class="divider"></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="Logout.php"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row row_style1">
                <div class="col-xs-4 col-xs-offset-3">           
            <table class="table">
  <thead>
    <tr>
      <th scope="col">S.No.</th>
      <th scope="col">Name</th>
      <th scope="col">Email Id</th>
      <th scope="col">Contact</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
<?php 
require 'require/connection.php';
$sql=<<<EOF
select name,email,contact,loginvalue from student;
EOF;
$ret=pg_query($db,$sql);
   if(!$ret) {
     	echo pg_last_error($db);   
   	}else{
		$i=1;
		while($row=pg_fetch_row($ret)){
		?><tr>
		  <th scope="row"><?php echo $i++;?></th>
		  <td><?php echo $row[0];?></td>
		  <td><?php echo $row[1];?></td>
		  <td><?php echo $row[2];?></td>
		  <td><?php if($row[3]==1){
					echo "Online";
					}else{
					echo "Offline";
					}?></td>
		 <td><?php if($row[3]==1){?>
					<a href="stdlogoutbyadmin.php">Stop</a>
					<?php } ?></td>
		</tr>
	<?php
		}
	}
?>
  </tbody>
</table><hr>
        </div>
             </div> 
	<font align="center"><h1>Result</h1></font><hr>
	<div class="col-xs-4 col-xs-offset-3">           
            <table class="table">
  <thead>
    <tr>
      <th scope="col">S.No.</th>
      <th scope="col">Name</th>
      <th scope="col">Email Id</th>
      <th scope="col">Contact</th>
      <th scope="col">Score</th>
    </tr>
  </thead>
  <tbody>
<?php 
require 'require/connection.php';
$sql1=<<<EOF
select name,emailid,contact,score from qscore;
EOF;
$ret1=pg_query($db,$sql1);
   if(!$ret) {
     	echo pg_last_error($db);   
   	}else{
		$i=1;
		while($row1=pg_fetch_row($ret1)){
		?><tr>
		  <th scope="row"><?php echo $i++;?></th>
		  <td><?php echo $row1[0];?></td>
		  <td><?php echo $row1[1];?></td>
		  <td><?php echo $row1[2];?></td>
		  <td><?php echo $row1[3];?></td>
		</tr>
	<?php
		}
	}
?>
  </tbody>
</table>
        </div>
             </div>     
        </div>
        </div>
    </body>
</html>

