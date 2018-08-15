<html>
	<head>
		<title>Műhely cikkarchívum</title>
		<script src="jquery-1.11.3.js"></script>
		<script type="text/javascript" src="script.js"></script>
		<link rel='stylesheet' type='text/css' href='arch.css'/>
	</head>
	<body>
		<table id="menu">
			<tr id="menu">
				<td id="browsr" onclick="window.location.href = 'arch.php'"><strong>Böngészés</strong></td>
			</tr>
		</table>

		<div id="fields">
			 <form method="post" action="search.php" class="input-list style-2">
			<br/><br/>
			<input id="query" type="text" name="lapszam">
			<input type="submit" value="Mehet!" class="input-list style-2">
			</form>
		</div>
		<?php
			if( isset($_POST['lapszam']) ){
				$statement=$_POST['lapszam'];
				if (strlen($statement) < 3){
					print "Hiba! Túl rövid kifejezést adtál meg!";
				}
				else{
					print "Találatok a(z) <strong>".$statement."</strong> kifejezésre (";
					try{
						$statement = strtolower("%".$statement."%");
						$myPDO = new PDO('sqlite:muhely.db');
						$stmt = $myPDO->prepare("SELECT * FROM muhely WHERE LOWER(szoveg) LIKE :id;");
						$stmt->execute(['id' => $statement]); 
						$user = $stmt->fetchAll();
						print sizeof($user)." db találat) :<br>";
						foreach($user as $row)
							{
								print $row['id'] ." ". $row['ev']."<br>";
								print "<img src='muhely/".$row['ev']."/".$row['id']."/thumbnails/1.jpg'><br>";
							}
					}
					 catch (Exception $e) {
						echo 'Caught exception: ',  $e->getMessage(), "\n";
					}
				}
			}			
		?>
	</body>
</html>