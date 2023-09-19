<?php
	function dateus2fr($dus)
	{
		$t=explode('-',$dus);
		$dfr=$t[2].'/'.$t[1].'/'.$t[0];
		return($dfr);
	}


	function jour_fr_v1($num_jour)
	{
		if($num_jour==0){
			$resultat='Dimanche';
		}
		else{
			if($num_jour==1){
				$resultat='Lundi';
			}
			else{
				if($num_jour==2){
					$resultat='Mardi';
				}
				else{
					if($num_jour==3){
						$resultat='Mercredi';
					}
					else{
						if($num_jour==4){
							$resultat='Jeudi';
						}
						else{
							if($num_jour==5){
								$resultat='Vendredi';
							}
							else{
								$resultat='Samedi';
							}
						}
					}
				}
			}
		}
		return($resultat);
	}

	function jour_fr_v2($num_jour)
	{
		switch($num_jour){
			case 0:
				$resultat='Grosmanche';break;
			case 1:
				$resultat='Landi';break;
			case 2:
				$resultat='Maaardi';break;
			case 3:
				$resultat='Credi';break;
			case 4:
				$resultat='Jôdi';break;
			case 5:
				$resultat='Dredi';break;
			case 6:
				$resultat='Sadi';break;
		}
		return($resultat);
	}

	function jour_fr_v3($num_jour)
	{
		$t=array('Dimanche', 'Lundi','Mardi','Mercredi',
		      'Juedi','Vendredi','Samedi');
		$resultat=$t[$num_jour];
		return($resultat);
	}

	function mois_fr($num_mois)
	{
		$t=array(1=>'Janv', 'Fév','Mars','Avril','Mai','Juin',
		      'Juill','Aout','Sept','Oct','Nov','Dec');
		$resultat=$t[$num_mois];
		return($resultat);
	}

?>