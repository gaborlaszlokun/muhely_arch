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
			<td id="faq" onclick="window.location.href = 'faq.php'"><strong>Leírás</strong></td>
		</tr>
	</table>
	<div id="browse" <?php if( isset($_GET['lapszam']) || isset($_POST['lapszam']) || isset($_GET['artid']))echo 'style="display:none;"' ?>>	
	<table id="browse_table">
	<?php
		$year = 2003;
		for($i = 0; $i < 4; $i++){
			print "<tr>";
			for($j = 0; $j < 4; $j++){
				if(count(scandir("muhely/".$year."/")) == 2) {
					print '<td style="color: #931328;background-color: white;"><strong>'.$year.'</strong></td>';
				}
				else{
					print '<td id="'.$year.'" ><strong>'.$year.'</strong></td>';
				}
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
					$file = "muhely/".$year."/".$lapid.".pdf";
					$file_json = "muhely/".$year."/".$lapid.".json";
					$file_headers = @get_headers($file);
					if (!file_exists($file)) {
						print "<td style='color: #931328;background-color: white;'><strong>".$year. " / ".$lap."</strong></td>";
					}
					else if (!file_exists($file_json)) {
						print "<td style='color: white;background-color: #131328;' onclick=\"window.location.href = 'muhely/".$year."/".$lapid.".pdf'\"><strong>".$year. " / ".$lap."</strong></td>";
					}
					else {
						print "<td onclick=\"window.location.href = 'muhely/".$year."/".$lapid.".pdf'\"><strong>".$year. " / ".$lap."</strong></td>";
					}
					$lap++;
				}		
				print "</tr>";
			}
			$year++;
			$np_year++;
			print '</table></div>';
		}
	?>
	</body>
</html>