<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Save</title>
</head>

<body>

<?


include 'LIB/Connection.php';

$sql = "INSERT INTO storeddata (storedData_Name,storedData_FBID,storedData_createDate) VALUES ('".$_GET['name']."','".$_GET['id']."',NOW())";
		
		$objQuery = mysql_query($sql);
		 if($objQuery){
			
			?>
            <script type="text/JavaScript">
			<!--
			alert("Save Complete");
			setTimeout("location.href = 'index.php';",1500);
			-->
			</script>
            <?
		}else{
			?>
            <script type="text/JavaScript">
			<!--
			alert("Incomplete Please contact Dev");
			//setTimeout("location.href = 'index.php';",1500);
			-->
			</script>
            <?
			
		}
		mysql_close();

?>
</body>
</html>