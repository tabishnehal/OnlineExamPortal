<?php
    session_start();
	require 'require/connection.php';

    if(!isset($_SESSION['email']))
	{
		header('location:score.php');
    	exit;
    }

	if($_SESSION['flag']==1 && !isset($_POST['submit']))
	{
		$_SESSION['flag']=0;
		$_SESSION['qn']=1;
		$_SESSION['attempt']=0;
		$_SESSION['unattempt']=0;  
	}

		if($_SESSION['attempt']==0 && $_SESSION['unattempt']==0)
		{
				$_SESSION['qwid']=0;
				$t=$_SESSION['duration']*60;
				$_SESSION['timout']=$t;
				$_SESSION["start_time"]=date("Y-m-d H:i:s");
				$end_time=date('Y-m-d H:i:s',strtotime('+'.$_SESSION['duration'].'minutes',strtotime($_SESSION["start_time"])));
				$_SESSION["end_time"]=$end_time;
		}

	if($_SESSION['qn']<=$_SESSION['tq'])
	{
			$_SESSION['qwid']++;
			$id=$_SESSION['qwid'];
			$_SESSION["qid"]=$id;

$sql=<<<EOF
select * from question where id='$id';
EOF;

		$result=pg_query($db,$sql);
		
		if(!$result)
		{
 			echo pg_last_error($db);
		}
		else
		{
		 	$row=pg_fetch_row($result);
			$_SESSION['id']=$row[0];
			$_SESSION['Question']=$row[1];
			$_SESSION['a']=$row[2];
			$_SESSION['b']=$row[3];
			$_SESSION['c']=$row[4];
			$_SESSION['d']=$row[5];
			$_SESSION['answer']=$row[6];

		}
	}
	else
	{
		header('location:score.php');
	}
?>
<html>
    <head>
         
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >


        <!--jQuery library--> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script type="text/javascript">
var x=setInterval(function()
{
var xmlhttp=new XMLHttpRequest();
xmlhttp.open("POST","response.php",false);
xmlhttp.send(null);
document.getElementById("response").innerHTML=xmlhttp.responseText;
},1000);
</script>
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
                        <li><a href="#"><span class="glyphicon glyphicon-user"><?php echo " ".$_SESSION['name'];?></a></li>
      			<li><a href="Logout.php"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
    		    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row row_style11">
                <div class="col-lg-12">
			<div id="response" class="btn btn-primary btn-lg active" style="float:right"></div>
        	   <div class="panel panel-primary">
            		<div class="panel-heading"><h4><?php echo "Q ".$_SESSION['qn'].") ".$_SESSION['Question'];?></h4>
			</div>
            		<div class="panel-body">	
			<form action="Quizact.php" id="form1" method="POST">
                         <div class="form-group">
    			a)<input type="radio" name="a" value="a">
    			<?php echo " ".$_SESSION['a'];?><br>
			</div>
			<div class="form-group">
    			b)<input type="radio" name="a" value="b">
    			<?php echo " ".$_SESSION['b'];?><br>
			</div>
			 <div class="form-group">
    			c)<input type="radio" name="a" value="c">
    			<?php echo " ".$_SESSION['c'];?><br>
			</div>
			<div class="form-group">
    			d)<input type="radio" name="a" value="d">
    			<?php echo " ".$_SESSION['d'];?><br>
			 </div>
			<div class="panel-footer"><input type="submit" name="submit" value="Submit"></div>			 	
			</from>
			</div>
        	   </div>
                </div>   
            </div>
        </div>
<?php
	if(isset($_POST['submit']))
	{
		header("URL=Quiz.php");
	}
?>
    </body>
</html>
