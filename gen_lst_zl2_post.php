<?php
	header('Content-Type: text/html; charset=ISO-8859-1');

	$num = $_POST["num"];
	$idc = mysqli_connect("localhost", "root", "", "bd_can");
	mysqli_select_db($idc, "bd_can");
	
	$sql='SELECT * FROM t_match, t_arbitre, t_equipe, t_phase, t_stade
		  WHERE t_match.num_arbitre = t_arbitre.num_arbitre
		  AND t_match.num_equipe_1 = t_equipe.num_equipe
		  AND t_match.num_equipe_2 = t_equipe.num_equipe
		  AND t_match.num_phase = t_phase.num_phase
		  AND t_match.num_stade = t_stade.num_stade
		  AND t_match.num_match = '.$num;
	$rs=mysqli_query($idc, $sql);
	$ligne = mysqli_fetch_assoc($rs);
	print($sql);
	
	print('<table border="1">
			<tr>
				<td align="right">
					Date: &nbsp;
				</td>
				<td>
					'.$ligne['date_match'].'
				</td>
			</tr>
			<tr>
				<td align="right">
					Arbitre: &nbsp;	
				</td>
				<td>
					'.$ligne['nom_arbitre'].'
				</td>
			</tr>
			<tr>
				<td align="right">
					Equipe 1: &nbsp; 
				</td>
				<td>
					'.$ligne['nom_equipe'].'
				</td>
			</tr>
			<tr>
				<td align="right">
					Equipe 2: &nbsp; 
				</td>
				<td>
					'.$ligne['nom_equipe'].'
				</td>
			</tr>');
		
		
?>
			


										
										
										
