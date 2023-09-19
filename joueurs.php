<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>Joueurs</title>
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
								<td id="active" class="joueurs" bgcolor="gray" width="70%" height="80px" align="middle" style="color: white; font-size: 20px">
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
						
						<div>
						
						<form name="frm" method="post" action="joueurs.php">
						
						<div style="border: 2px solid; box-shadow: 8px 8px 8px; height: 450px; background-color: white; width: 40%">
						<br />
						<select name="zl_joueur" style="height: 60px; font-size: 16px">
							<option value="0">--- Choix du joueur ---</option>
							<?php
							include ('inclusion/connect.inc');
							$idc = connect();
											
							$sql0 = "SELECT num_joueur, nom_joueur, prenom_joueur
									 FROM t_joueur 
									 GROUP BY nom_joueur, prenom_joueur";
							$rs0 = mysqli_query($idc, $sql0);
							while ($ligne0 = mysqli_fetch_assoc($rs0)) {
								print('<option value="'.$ligne0['num_joueur'].'">
											'.$ligne0['prenom_joueur'].' '.$ligne0['nom_joueur'].'
									</option>');
							}				
							
							?>
							
						</select>
						<input type="submit" value="Soumettre" name="btn_soumettre" 
							style="height: 60px; font-size: 16px; cursor: pointer"/>
							
						<input type="button" value="Refresh" name="btn_refresh" 
						onclick="location.href='joueurs.php'"
						style="height: 60px; font-size: 16px; cursor: pointer" />
							
						<br /><br />
						
						
						</form>

<!-- /////////////////////////////////////////////////////////////////////// -->

<form method="post" action="joueurs.php">

<?php

if (isset($_POST['btn_soumettre']) && !empty($_POST['btn_soumettre']) 
	&& !empty($_POST['zl_joueur'])) {

	$joueur = $_POST["zl_joueur"];
	
	print('<input type="hidden" name="zs_joueur" value="'.$joueur.'" />');
	
	$sql='SELECT * from t_joueur, t_equipe
		  WHERE t_joueur.num_equipe = t_equipe.num_equipe
		  AND t_joueur.num_joueur = '.$joueur;
	$rs=mysqli_query($idc, $sql);
	$ligne2 = mysqli_fetch_assoc($rs);
	
	print('<table >
				<tr>
					<td align="right">
						Equipe: &nbsp;
					</td>
					<td>
						'.$ligne2['nom_equipe'].'
					</td>
				</tr>
				<tr>
					<td align="right">
						Nom: &nbsp;	
					</td>
					<td>
						<input type="text" style="width: 220px; height: 60px; font-size: 16px;
						font-style: oblique" name="zs_nom" value="'.$ligne2['nom_joueur'].'" 
						placeholder="Modifier le nom" />
					</td>
				</tr>
				<tr>
				<td align="right">
					Pr&eacute;nom: &nbsp; 
				</td>
				<td>
					<input type="text" style="width: 220px; height: 60px; font-size: 16px;
					font-style: oblique" name="zs_prenom" value="'.$ligne2['prenom_joueur'].'" 
					placeholder="Modifier le prénom" />
				</td>
			</tr>
			');
		
				
?>

			<tr>
				<td align="right">
					Equipe: &nbsp;
				</td>
				<td>
					<select name="zl_equipe" style="width: 225px; height: 60px; font-size: 16px; border-color: red">
						<option value="0">--- Modifier l'&eacute;quipe ---</option>
					<?php
						$sql = "SELECT * FROM t_equipe GROUP BY nom_equipe";
						$rs = mysqli_query($idc, $sql);
						while ($ligne = mysqli_fetch_assoc($rs)) {
							print('<option value="'.$ligne['num_equipe'].'">
										'.$ligne['nom_equipe'].'
									</option>');
						}
						
					?>
						
					</select>
				</td>
			</tr>
		</table><br />

<input type="submit" value="Modifier" name="btn_modifier" style="width: 100px; 
height: 60px; font-size: 16px; cursor: pointer"/>

</form>							
							
<?php
	}
?>							

<?php
	if (isset($_POST['btn_modifier']) && !empty($_POST['btn_modifier']) 
	&& !empty($_POST['zs_nom']) && !empty($_POST['zs_prenom'])
	&& !empty($_POST['zl_equipe']) && !empty($_POST['zs_joueur'])) {
		
		$joueur = $_POST["zs_joueur"]; // Ancien joueur
		$nom = $_POST["zs_nom"]; 	   // Nouveau nom
		$prenom = $_POST["zs_prenom"]; // Nouveau prenom
		$equipe = $_POST["zl_equipe"]; // Nouvelle équipe
		
		$sql='SELECT * from t_joueur, t_equipe
			  WHERE t_joueur.num_equipe = t_equipe.num_equipe
			  AND t_joueur.num_joueur = '.$joueur;
		$rs=mysqli_query($idc, $sql);
		//print($sql."<br />");
		if($ligne = mysqli_fetch_assoc($rs)){
			$ancien_nom = $ligne['nom_joueur'];
			$ancien_prenom = $ligne['prenom_joueur'];
			$ancien_equipe = $ligne['num_equipe'];
			
			$sql1 = 'UPDATE t_joueur 
					 SET nom_joueur = "'.$nom.'", 
						 prenom_joueur = "'.$prenom.'", 
					 	 num_equipe = '.$equipe.'
					 WHERE num_joueur = '.$ligne['num_joueur'];
			$rs1 = mysqli_query($idc, $sql1);
			//print($sql1);
		}
		//header('Location: joueurs.php');
	}
		
?>


<!-- /////////////////////////////////////////////////////////////////////// -->


										
						<br />
						</div>
						</div>
						
						<br /><br /><br />
					</td>
					
				</tr>
				
			</table>
			
		
		</div>
		
		
		
	</body>
</html>

