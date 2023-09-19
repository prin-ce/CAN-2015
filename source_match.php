<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>Source Match</title>
		<!-- CSS link -->
		<link rel="stylesheet" type="text/css" href="style.css" />
		<!-- Date: 2015-04-27 -->
	</head>	
	
	<body>
		<div>
			<table  width="100%" cellspacing="8">
				<tr bgcolor="#333333" style="font-size: 16px; color: white">
					<td colspan="2" align="middle">
					<!-- Première ligne -->
					<h1>Coupe d'Afrique des Nations 2015</h1>
					
					</td>
		 		</tr>
				<tr>
					<!-- Seconde ligne -->
					<td width="20%" bgcolor="silver" align="center">
						<!-- 1ère colonne -->
						
						
						<!-- Le menu -->
						<table  width="95%" cellspacing="8">
							<tr>
								<td class="accueil" bgcolor="gray" width="70%" height="80px" align="middle" style="color: white; font-size: 20px">
									<a class="lien_accueil" href="Accueil.php">Accueil</a>
								</td>
							</tr>
							<tr>
								<td class="postes" bgcolor="gray" width="70%" height="80px" align="middle" style="color: white; font-size: 20px">
									<a class="lien_postes" href="postes.php">Postes</a>
								</td>
							</tr>
							<tr>
								<td class="joueurs" bgcolor="gray" width="70%" height="80px" align="middle" style="color: white; font-size: 20px">
									<a class="lien_joueurs" href="joueurs.php">Joueurs</a>
								</td>
							</tr>
							<tr>
								<td id="active" class="source_match" bgcolor="gray" width="70%" height="80px" align="middle" style="color: white; font-size: 20px">
									<a class="lien_source_match" href="source_match.php">Source d'un match</a>
								</td>
							</tr>
						</table>
						
						
						
						<br /><br /><br /><br /><br /><br />
					</td>
					<td width="80%">
						<!-- 2nde colonne -->
						
						<br /><br /><br />
						
						<div>
						
			<form method="post" action="source_match.php">
							
						<table width="50%"  style="border: 2px solid; box-shadow: 8px 8px 8px; background-color: white">
							<tr>
								<td>
	<!-- --------------------------------------------------------------------- -->							
						<div>
						
						
						
						<br />
						
						<select name="zl_match" style=" height: 60px; font-size: 16px">
							<option value="0">--- Choix du match ---</option>
							<?php
								include ('inclusion/connect.inc');
								$idc = connect();
								
								$sql = "SELECT * FROM t_match ORDER BY nom_match";
								$rs = mysqli_query($idc, $sql);
								while ($ligne = mysqli_fetch_assoc($rs)) {
									print('<option value="'.$ligne['num_match'].'">
												'.$ligne['nom_match'].'
											</option>');
								}
								
							?>
						</select>
						<input type="submit" value="Valider" name="btn_valider" 
							style="width: 100px; height: 60px; font-size: 16px; cursor: pointer"/>	
						
						<br /><br />
						</div>
						
			</form>
						
<!-- --------------------------------------------------------------- -->
<div>

		<?php
	
	if (isset($_POST['btn_valider']) && !empty($_POST['btn_valider'])) {
	
	$match = $_POST['zl_match'];
	if ($match!=0) {
	
	
	$sql='SELECT * FROM t_match, t_arbitre, t_equipe, t_phase, t_stade
		  WHERE t_match.num_arbitre = t_arbitre.num_arbitre
		  AND t_match.num_phase = t_phase.num_phase
		  AND t_match.num_stade = t_stade.num_stade
		  AND t_match.num_match = '.$match;
	$rs=mysqli_query($idc, $sql);
	$ligne = mysqli_fetch_assoc($rs);
	
	// Affichage Equipe 1
	$sql1 = "SELECT * FROM t_equipe WHERE num_equipe = ".$ligne['num_equipe_1'];
	$rs1 = mysqli_query($idc, $sql1);
	$ligne1 = mysqli_fetch_assoc($rs1);
	
	// Affichage Equipe 2
	$sql2 = "SELECT * FROM t_equipe WHERE num_equipe = ".$ligne['num_equipe_2'];
	$rs2 = mysqli_query($idc, $sql2);
	$ligne2 = mysqli_fetch_assoc($rs2);
	
	// Affichage phase
	$sql3 = "SELECT * FROM t_phase WHERE num_phase = ".$ligne['num_phase'];
	$rs3 = mysqli_query($idc, $sql3);
	$ligne3 = mysqli_fetch_assoc($rs3);
	
	// Affichage stade
	$sql4 = "SELECT * FROM t_stade WHERE num_stade = ".$ligne['num_stade'];
	$rs4 = mysqli_query($idc, $sql4);
	$ligne4 = mysqli_fetch_assoc($rs4);
	
	//print($sql);
	
	print('<table border="1" width="90%" cellpadding="8">
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
					'.$ligne['prenom_arbitre'].' '.$ligne['nom_arbitre'].'
				</td>
			</tr>
			<tr>
				<td align="right">
					Equipe 1: &nbsp; 
				</td>
				<td>
					'.$ligne1['nom_equipe'].'
				</td>
			</tr>
			<tr>
				<td align="right">
					Equipe 2: &nbsp; 
				</td>
				<td>
					'.$ligne2['nom_equipe'].'
				</td>
			</tr>
			<tr>
				<td align="right">
					Phase: &nbsp; 
				</td>
				<td>
					'.$ligne3['nom_phase'].'
				</td>
			</tr>
			<tr>
				<td align="right">
					Stade: &nbsp; 
				</td>
				<td>
					'.$ligne4['nom_stade'].'
				</td>
			</tr>');
	
	}else {
		print("<br />Aucune s&eacute;lection<br />");
	}
	
	}
	?>

</div>

<br /><br />
	
								</td>
							
						</table>

						
						
						
						<br /><br /><br />
					</td>
					
				</tr>
				
			</table>
			
			
		
		
		
		
		
		
		
		</div>
		
		
		
	</body>
</html>

