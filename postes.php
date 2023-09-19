<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>Postes</title>
		<!-- CSS link -->
		<link rel="stylesheet" type="text/css" href="style.css" />
		<!-- Date: 2015-04-27 -->
	</head>	
	
	<body>
		<center style="text-align: center">
			<table border="0" width="100%" cellspacing="8">
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
						<table border="0" width="95%" cellspacing="8">
							<tr>
								<td class="accueil" bgcolor="gray" width="70%" height="80px" align="middle" style="color: white; font-size: 20px">
									<a class="lien_accueil" href="Accueil.php">Accueil</a>
								</td>
							</tr>
							<tr>
								<td id="active" class="postes" bgcolor="gray" width="70%" height="80px" align="middle" style="color: white; font-size: 20px">
									<a class="lien_postes" href="postes.php">Postes</a>
								</td>
							</tr>
							<tr>
								<td class="joueurs" bgcolor="gray" width="70%" height="80px" align="middle" style="color: white; font-size: 20px">
									<a class="lien_joueurs" href="joueurs.php">Joueurs</a>
								</td>
							</tr>
							<tr>
								<td class="source_match" bgcolor="gray" width="70%" height="80px" align="middle" style="color: white; font-size: 20px">
									<a class="lien_source_match" href="source_match.php">Source d'un match</a>
								</td>
							</tr>
						</table>
						
						
						
						<br /><br /><br /><br /><br /><br />
					</td>
					<td width="80%">
						<!-- 2nde colonne -->
						
						<br /><br /><br />
						
						<div style="text-align: center">
			<table border="0" width="70%" bgcolor="white" style="border: 2px solid; box-shadow: 8px 8px 8px">
				<tr valign="top">
					<td width="30%" bgcolor="#FEF">
	<!-- ----------------------------------------------------------- -->
						<div style="text-align: center">
						
						<form name="frm" method="post" action="postes.php">
						
						<table border="0" cellspacing="0">
							<tr>
								<td colspan="2">
									<select name="zl_equipe">
										<option value="">---- Choisir une &eacute;quipe ----</option>
										<?php
											include ('inclusion/connect.inc');
											$idc = connect();
											
											$sql3 = "SELECT * FROM t_equipe GROUP BY nom_equipe";
											$rs3 = mysqli_query($idc, $sql3);
											while ($ligne3 = mysqli_fetch_assoc($rs3)) {
													print('<option value="'.$ligne3['num_equipe'].'">
															'.$ligne3['nom_equipe'].'
														</option>');
											}
											
											
										?>
									</select><br /><br />
								</td>
							</tr>
							<tr>
								<th colspan="2" align="left">
									Postes :
								</th>
							</tr>
							<?php
								
							
								$sql = "SELECT * FROM t_poste GROUP BY nom_poste";
								$rs = mysqli_query($idc, $sql);
								while ($ligne = mysqli_fetch_assoc($rs)) {
									print('<tr>
												<td colspan="2">
													<label><input type="checkbox" name="cc_'.$ligne['num_poste'].'" /> '.$ligne['nom_poste'].'</label>
												</td>
											</tr>');
								}
							?>
							
							<tr>
								<td colspan="2"><br />
									<input type="submit" value="Valider" name="valider" />
								</td>
								<td>
									<!-- Rien mettre ici -->
								</td>
							</tr>
						</table>
						</form>
					
					</td>
					<td>
					
					<div style="text-align: center">
					
<!-- ---------------------------------------------------- -->
		<!-- Affichage des résultats -->
								
		<?php
			if (isset($_POST['valider']) && !empty($_POST['valider']) && !empty($_POST['zl_equipe'])){
					
				$equipe = $_POST['zl_equipe'];
				
				foreach ($_POST as $cle=>$valeur) 
				{
					$t = explode('_',$cle);
					if($t[0] == 'cc')
					{
						$num_poste = $t[1];
						
						$sql2 = "SELECT * FROM t_poste WHERE num_poste = ".$num_poste;
						$rs2 = mysqli_query($idc, $sql2);
						$ligne2 = mysqli_fetch_assoc($rs2);
						$nom_poste = $ligne2['nom_poste'];
						
						$sql1 = "SELECT * FROM t_joueur, t_equipe
								 WHERE t_joueur.num_equipe = t_equipe.num_equipe
								 AND t_joueur.num_poste = '".$num_poste."'
								 AND t_joueur.num_equipe = ".$equipe;
						$rs1 = mysqli_query($idc, $sql1);
						$ligne3 = mysqli_fetch_assoc($rs1);
						
						print('<b>Equipe: '.$ligne3['nom_equipe'].'</b>
								<table border="1" width="80%" style="text-align: center">
									<tr>
										<td width="34%">
											Nom
										</td>
										<td width="34%">
											Pr&eacute;nom
										</td>
										<td width="32%">
											Poste
										</td>
									</tr>');
						while ($ligne1 = mysqli_fetch_assoc($rs1)) {
							
							print('<tr>
										<td width="34%">
											'.$ligne1['nom_joueur'].'
										</td>
										<td width="34%">
											'.$ligne1['prenom_joueur'].'
										</td>
										<td width="32%">
											'.$nom_poste.'
										</td>
									</tr>');
						}
						print('</table><br />');
					}
				}
			}
		
		?>
		
						</div>
								
								</td>
							</tr>
						</table>
						</div>
						
						
						
						<br /><br /><br /><br /><br /><br /><br /><br />
						</div>
					</td>
					
				</tr>
				
			</table>
			
			
		
		</div>
		
		
		
	</body>
</html>

