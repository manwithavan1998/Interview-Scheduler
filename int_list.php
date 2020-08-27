<?php
	
        	$DB_SERVER='localhost';
         	$DB_USER = 'root';
        	$DB_PASSWORD = "";
        	$DB_DATABASE = 'interview';
      
        // define("DB_SERVER", "localhost");
        // define("DB_USER", "root");
        // define("DB_PASSWORD", "");
        // define("DB_DATABASE", "codechef");
        $sql = mysqli_connect($DB_SERVER , $DB_USER, $DB_PASSWORD, $DB_DATABASE);
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
		
		
	
?>
<html>
   






   <head>


  
      <title>Welcome </title>
	  <style>
	  	.header {
  background-color: #996;
  padding: 10px;
  text-align: center;
  font-size: 20px;
  color: black;
}
table {
  border-collapse: collapse;
  margin-left:155px;
  margin-right:25px;
  padding:2%;
  width: 75%;

	  

}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
  background-color: #4CAF50;
  color: white;
}
</style>
	  
	  
	  
	  
	  
   </head>
   
   <body>



      <center style="margin-top:25px;"><font size="20" color="dodglerblue" style="serif">Interview  <?php echo "List" ?></font></center> 
      <div class ="header">
	<?php
		//$sql1 = "SHOW TABLES"; 
		$sql1 = "select * from interview";
		
			//edit your table name here
		$res = mysqli_query($sql,$sql1);
		
		
		while ($row = $res->fetch_assoc()) {

			$Interviewee = '';
			foreach($row as $ind => $val)
			{
				if($ind=='interviewer_id'){
						
					$sql2 = "select interviewer_name from interviewer where interviewer_id= $val";
					$res2 = mysqli_query($sql,$sql2);
					$row = mysqli_fetch_assoc($res2);
					echo "Interviewer:  {$row['interviewer_name']}<br/>";
				}
				else if($ind!='interview_id'){
					echo "$ind : $val<br />";
				}
				else if($ind == 'interview_id'){
				//	echo $ind." ".$val."<br/>";
				$sql2 = "select interview.interview_id,connection.user_id,user.user_name from interview INNER JOIN connection INNER JOIN user where interview.interview_id = connection.interview_id and interview.interview_id = $val and user.user_id = connection.user_id ";
					$res2 = mysqli_query($sql,$sql2);
					$row = mysqli_fetch_assoc($res2);
					$Interviewee = $row['user_name'];
					//echo "Interviewee : {$row['user_name']} <br/>";
				}
				
			}
			echo "Interviewee : $Interviewee <br/>";
			echo "<hr />";
		}
	

	?>
</div>
		
	
		  
	  
   </body>
   
</html>
