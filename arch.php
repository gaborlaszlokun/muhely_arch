<html>
	<head>
		<title>Műhely cikkarchívum</title>
		<script src="jquery-1.11.3.js"></script>
        <link rel='stylesheet' type='text/css' href='arch.css'/>
       <script type="text/javascript" src="script.js"></script> 
	</head>
	<body>
	<table id="menu">
	<tr id="menu">
	 <td id="search" onclick="window.location.href = 'search.php'"><strong>Keresés</strong></td>
	 <!-- <td id="search"><strong><div id="button"><a href="search.php" style="text-decoration: none; color : white";>Keresés</a></div></strong></td>-->
	 
	 <!--<td id="browser"><strong>Böngészés</strong></td>-->
	 </tr>
	 </table>
	<div id="browse" <?php if( isset($_GET['lapszam']) || isset($_POST['lapszam']) || isset($_GET['artid']))echo 'style="display:none;"' ?>>	
	<table id="browse_table">
	<?php
		$year = 2003;
		for($i = 0; $i < 4; $i++){
			print "<tr>";
			for($j = 0; $j < 4; $j++){	
				print '<td id="'.$year.'"><strong>'.$year.'</strong></td>';
				$year++;
			}
			print "</tr>";
		}	
	 ?>	 
	</table>
	</div>
	<?php
		$year = 2003;
		$np_year = 1;
		for($i = 0; $i < 16; $i++){
			print '<div id="'.$year.'det" style="display:none;"><table id="browse_table"><tr><td id="'.$year.'back"><strong>'.$year.'</strong></td></tr>';
			$lap = 1;
			$yearend = (string)$year;
			$yearend = $yearend[2].$yearend[3];
			$np = (string)$np_year;
			$np = sprintf("%02d", $np);
			for($j = 0; $j < 5; $j++){
				print "<tr>";
				for($k = 0; $k < 3; $k++){	
					$lapend = sprintf("%02d", $lap);
					$lapid = $np.$lapend;
					$file = "http://localhost/muhely/".$year."/".$lapid."/index.html<br>";
					$file_headers = @get_headers($file);
					
					if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
						print "<td style='color: #931328;background-color: white;'><strong>".$year. " / ".$lap."</strong></td>";
}
					else {
						print "<td onclick=\"window.location.href = 'muhely/".$year."/".$lapid."/index.html'\"><strong>".$year. " / ".$lap."</strong></td>";
}
					//print "<td onclick=\"window.location.href = 'muhely/".$year."/".$lapid."/index.html'\"><strong>".$year. " / ".$lap."</strong></td>";
					
					//print "<td onclick=\"window.location.href = 'arch.php?lapszam=".$lapid."'\"><strong>".$year. " / ".$lap."</strong></td>";
					//print "<td onclick=\"window.location.href = 'arch.php?lapszam=".$lapid."'\"><strong>".$year. " / ".$lap."</strong></td>";
					
					$lap++;
				}		
				print "</tr>";
			}
			$year++;
			$np_year++;
			print '</table></div>';
		}
	?> 

	 <div id="fields" <?php if( isset($_POST['lapszam']) == false) echo 'style="display:none;"'?>>
	 <!-- Ide kerül a dinamikusan felbukkanó kereső űrlap-->
	 <form method="post" action="search.php" class="input-list style-2">
		<br/><br/>
		<input id="query" type="text" name="lapszam">
		<select name="mit">
			<option value="minden">Mindenben</option>
			<option value="cim">Csak címben</option>
			<option value="szerzo">Csak szerző</option>
		</select>
		<select name="rovat">
			<option value="minden">Minden rovat</option>
			<option value="korkep">BME Körkép</option>
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
		  <input id="hide" type="button" value="Elrejt" class="input-list style-2">
	 </form>
	 </div>

	</body>
	<?php
	//include 'connect.php';
	//include 'browse.php';
	//include 'search.php';
	//include 'details.php';
	?>
</html>