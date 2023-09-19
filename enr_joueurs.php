<?php
	include ('inclusion/connect.inc');
	$idc = connect();
	
	//Modifier les infos d'un joueur
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
		print($sql."<br />");
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
			print($sql1);
		}
		header('Location: joueurs.php');
	}

	// Afficher les infos sur les joueurs
	if (isset($_POST['btn_soumettre']) && !empty($_POST['btn_soumettre']) && !empty($_POST['zl_joueur'])) {

		$joueur = $_POST["zl_joueur"];
		
		print('<input type="hidden" name="zs_joueur" value="'.$joueur.'" />');
		
		$sql='SELECT * from t_joueur, t_equipe
			WHERE t_joueur.num_equipe = t_equipe.num_equipe
			AND t_joueur.num_joueur = '.$joueur;
		$rs=mysqli_query($idc, $sql);
		$ligne2 = mysqli_fetch_assoc($rs);
		
		print('<table>
					<tr>
						<td align="right"> Equipe: &nbsp; </td>
						<td> '.$ligne2['nom_equipe'].' </td>
					</tr>

					<tr>
						<td align="right"> Nom: &nbsp; </td>
						<td>
							<input type="text" style="width: 220px; height: 60px; font-size: 16px; font-style: oblique" name="zs_nom" 
							value="'.$ligne2['nom_joueur'].'" placeholder="Modifier le nom"/>
						</td>
					</tr>

					<tr>
						<td align="right"> Prenom: &nbsp; </td>
						<td>
							<input type="text" style="width: 220px; height: 60px; font-size: 16px; font-style: oblique" name="zs_prenom" 
							value="'.$ligne2['prenom_joueur'].'" placeholder="Modifier le prénom" />
						</td>
					</tr>'
		);
	}        
                
?>
