<?php
include('../models/requeteProfil.php');

function listeInfoPatient(PDO $db, $valeur, $recherche){
    if($recherche==''){
        $nombre=nombrePatient($db, $_SESSION['user_id']);
    } else{
        $nombre=nombrePatientRecherche($db, $_SESSION['user_id'], $recherche);
    }
    if ($nombre!= 0){
        if($recherche==''){
            $info=infoPatient($db, $_SESSION['user_id']);
        }else{
            $info=infoPatientRecherche($db, $_SESSION['user_id'], $valeur, $recherche);
        }
        foreach ($info as $key => $value ){
            if ($key==0){
                $resultat = "<table class='affichageResultat' style='display: block;'>"
                            ."<tr>";
            } elseif ($key%4==0){
                $resultat .= "<tr>";
            }

            $resultat .= "<td><table class='utilisateur'>"
                            ."<tr>"
                                ."<td rowspan='4' class='photoProfil' ><img src='images/iconProfil.jpg'/></td>"
                                ."<td>" .$value['first_name'] ." " .$value['last_name'] ."</td>"
                            ."</tr>";
            if (strlen($value['email'])>23){
                $resultat .="<tr> <td>" .substr ( $value['email'] , 0 , 19 ) ."...</td> </tr>";
            } else {
                $resultat .="<tr> <td>" .$value['email'] ."</td> </tr>";
            }
            $resultat .="<tr> <td> Patient </td> </tr>"
                            ."<tr>"
                                ."<td colspan='2' class='iconGerer'>"
                                    ."<img src='images/iconCheck.png' onclick='openExamen(\"".$value['nss']."\", \"".$value['first_name']."\",\"".$value['last_name']."\")' />"
							        ."<a href='mailto:" .$value['email'] ."'><img src='images/iconContacter.png' /></a>"
                                ."</td>"
                            ."</tr>"
                        ."</table></td>";
            if ($key%4==0 && $key+1==$nombre){
                $resultat .= "<td></td><td></td><td></td>";
            } elseif ($key%4==1 && $key+1==$nombre){
                $resultat .= "<td></td><td></td>";
            } elseif ($key%4==2 && $key+1==$nombre){
                $resultat .= "<td></td>";
            }

            if ($key+1==$nombre){
                $resultat .= "</tr></table>";
            } elseif ($key%4==3){
                $resultat .= "</tr>";
            }
        }

    } else {
        $resultat= "<p>Il n'y a pas de patient enregistré.</p>";
    }
    return $resultat;
}
