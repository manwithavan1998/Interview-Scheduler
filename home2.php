<?php

$DB_SERVER='localhost';
         	$DB_USER = 'root';
        	$DB_PASSWORD = "";
        	$DB_DATABASE = 'interview';
      
        $sql = mysqli_connect($DB_SERVER , $DB_USER, $DB_PASSWORD, $DB_DATABASE);
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
		
//echo $sid;
if( isset($_POST['submit']) ){
	$iname = $_POST['interviewname'];
	$stime=$_POST['starttime'];
	$etime=$_POST['endtime'];
	$iid=$_POST['interviewer_id'];
	$q = 'select interview_id from interview';
	$res = mysqli_query($sql,$q);

	$id = 0;
	while($row = $res->fetch_assoc()){
		if($id<$row['interview_id'])
			$id = $row['interview_id'];
	}
	$id = $id + 1;
	//echo $id;
	$cstmnt="insert into interview(interview_id,interview_name,start_time,end_time,interviewer_id) values('$id','$iname','$stime','$etime','$iid')";
	$stid = $_POST['select'];
	//echo $stid;
	$connect = "insert into connection(interview_id,user_id) values('$id','$stid')";
	$times = "select connection.user_id,connection.interview_id,interview.start_time,interview.end_time,interview.interviewer_id from connection INNER JOIN interview ON connection.interview_id = interview.interview_id and connection.user_id = '$stid' or interview.interviewer_id = '$iid' ";
	$res = mysqli_query($sql,$times) or die("res error");
	$chk = 1;
	while($row = $res->fetch_assoc()){

		 if(strtotime($stime) >= strtotime($row['start_time']) and strtotime($stime) <= strtotime($row['end_time']) and ($row['user_id'] == $stid or $row['interviewer_id'] == $iid) ){
		 	$chk = 0;
		 }
		 if(strtotime($etime) >= strtotime($row['start_time']) and strtotime($etime) <= strtotime($row['end_time']) and ($row['user_id'] == $stid or $row['interviewer_id'] == $iid)){
		 	$chk = 0;
		 }

	}
	if($chk == 1){
		$r=mysqli_query($sql,$cstmnt) or die("error hai");	
		$p=mysqli_query($sql,$connect);
		header("location:/Vivek_project/home2.php");
	}
	else{
		header("location:/Vivek_project/action.php");	
	}


}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>INTERVIEW</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <style>
  footer {
  background-color: mediumseagreen;
  padding:20px;
  color: white;
  margin-left:110px;
  margin-right:110px;
}
header {
  background-color: #666;
  padding: 30px;
  text-align: center;
  font-size: 50px;
  color: white;
}
.scheduler {
	padding : 100px;
  	font-size: 20px;
}
</style>

</head>
<body style="background-color:azure;">
<div class="header">
<p style="margin-left:100px;"><h2 style="margin-left:100px;margin-right:300px;font-size: 50px; font-family: Times New Roman; font-color:white;"><right style="font-color:white;">INTERVIEW SCHEDULER<br/></right></h2></p>



<nav class="navbar navbar-inverse" navbar-static-top style="margin-left:100px; margin-right:100px; padding-left:70px; background-color:darkblue; font-color:cornsilk;font-family: Times New Roman;">
  <div class="container-fluid">
    
    <ul class="nav navbar-nav">
	<li class="active"><a href="#">HOME</a></li>
      <li>
      <a class="nav-item"  href="/Vivek_project/int_list.php">INTERVIEW LIST</a>
        </li>
	  <li>
      <a class="nav-item"  href="/Vivek_project/int_edit.php">EDIT INTERVIEWS</a>
        </li>
     
      
    </ul>
    <ul class="nav navbar-nav navbar-right">
	<li><a href="/miniproj/admin_login.php"><span class="glyphicon glyphicon-log-in"></span>Admin Login</a></li>
      <li><a href="/miniproj/register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="/miniproj/student_login.php"><span class="glyphicon glyphicon-log-in"></span>Student Login</a></li>
    </ul>
  </div>
  </nav>
	<div class="scheduler">
		<form action="home2.php" method = "post" class ="editor">
		  	<label for="interviewname">Interview name:</label>

  			<input type="text" name="interviewname"><br><br>

  			<label for="stime">  Start Time:   </label>

  			<input type="datetime-local" name="starttime" ><br><br>

  			<label for="etime">End Time:   </label>

  			<input type="datetime-local" name="endtime" ><br><br>

			<label for="int_id" > Interviewer Id: </label>
			<input type="text" name="interviewer_id" > <br><br>
			<label for="students" > Interviewee: </label> 
			
			<select name="select">
				
			<?php
				$data="SELECT user_id,user_name FROM user";
				$res = mysqli_query($sql,$data);
				while ($row = $res->fetch_assoc()) {
					$select ='<option value='.$row['user_id'].'>'. $row['user_id'].' : '.$row['user_name'].'</option>';
					echo $select;
				}				

			?>
			</select>	<br><br>
  			<button type="submit" name="submit" class="registerbtn">SAVE</button>

			
		</form>

	</div>

<footer>
<ul>
<li> Contact Us: +91 9140785339</li>

<li>Email: vivekmaurya163@gmail.com </li>
</ul>
</footer>







</body>
</html>
