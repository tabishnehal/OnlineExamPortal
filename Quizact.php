<?php
    session_start();
	require 'require/connection.php';

	if(!isset($_SESSION['email']))
	{
		header('location:score.php');
    	exit;
    }

	if(isset($_POST['submit']))
	{	
		$_SESSION['qn']+=1;
		
		if(isset($_POST['a']))
		{
			$a=$_POST['a'];
		}

		if(!empty($a))
		{
			$_SESSION['attempt']+=1;

			if($a==$_SESSION['answer'])
			{		
				$_SESSION['score']+=1;
				$_SESSION['rightattempt']+=1;	
			}
			else
			{
				$_SESSION['wrongattempt']+=1;
			}
				
		}
		else
		{
			$_SESSION['unattempt']+=1;
		}
	}
	
	if($_SESSION['qn']==$_SESSION['tq']+1)
	{
		$id=$_SESSION['id'];
		$nm=$_SESSION['name'];
		$em=$_SESSION['email'];
		$ct=$_SESSION['Contact'];
		$sc=$_SESSION['score'];

		$sql=<<<EOF
			insert into qscore(id,name,emailid,score,contact) values ('$id','$nm','$em','$sc','$ct');
EOF;
		$ret=pg_query($db,$sql);

		if(!$ret)
		{
			echo pg_last_error($db);
		}
	}
header("location:Quiz.php");
?>
