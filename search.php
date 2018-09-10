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
			<input id="query" type="text" name="query">
			<select name="where">
				<option value="mindenben">Mindenben</option>
				<option value="cim">Csak címben</option>
				<option value="szerzo">Csak szerző</option>
			</select>
			<select name="column">
				<option value="minden">Minden rovat</option>
				<option value="korkep">BME Körkép</option>
				<option value="megkerdeztuk">Megkérdeztük</option>
				<option value="kapun">Kapun kívül</option>
				<option value="kozelet">Közélet</option>
				<option value="sport">Sport</option>
				<option value="tudtech">Tudomány és Technika</option>
				<option value="magazin">Magazin</option>
				<option value="nezopont">Nézőpont</option>
				<option value="vita">Vitafórum</option>
				<option value="gondolatok">Gondolatok</option>
				<option value="uzleti">Üzleti Negyed</option>
				<!-- És így tovább igény szerint ( főképp, ha korábban más rovatok is voltak! ) -->
			</select>
			<input type="submit" value="Mehet!" class="input-list style-2">
			</form>
		</div>
		<?php
		
			// megjelenítő függvényt
			function show_res($row){
				print $row['id'] ." ". $row['ev']."<br>";
				//print "<img src='muhely/".$row['ev']."/".$row['id']."/thumbnails/1.jpg'><br>";
				/*print '<table id="menu">
				<tr id="menu">';
				print "<td onclick='window.location.href = \"muhely/".$row['ev']."/".$row['id'].".pdf\"'><strong>Kattints!</strong></td>";
				print '</tr>
				</table>';*/
				
			}
		
			if( isset($_POST['query']) ){
				$statement=$_POST['query'];
				$where = $_POST['where'];
				$column = $_POST['column'];
				if (strlen($statement) < 3){
					print "Hiba! Túl rövid kifejezést adtál meg!";
				}
				else{
					//print $where.", ".$column."<br>";
					print "Találatok a(z) <strong>".$statement."</strong> kifejezésre (";
					try{
						$statement = strtolower("%".$statement."%");
						$myPDO = new PDO('sqlite:muhely.db');
						$stmt = $myPDO->prepare("SELECT * FROM muhely WHERE LOWER(szoveg) LIKE :id ORDER BY id;");
						$stmt->execute(['id' => $statement]); 
						$user = $stmt->fetchAll();
						print sizeof($user)." db találat) :<br>";
						foreach($user as $row)
							{
								show_res($row);
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