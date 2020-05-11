<?php 
session_start();
include('../models/requeteProfil.php');

function listeInfoPatient(PDO $db, $valeur, $recherche){
    if($recherche==''){
        $nombre=nombrePatient($db, $_SESSION['user_id']);
    } else{
        $nombre=nombrePatientRecherche($db, $_SESSION['user_id'], $recherche);
    }
    if ($nombre!= 0){
        if ($valeur==0){
            if($recherche==''){
                $info=infoPatient($db, $_SESSION['user_id']);
            }else{
                $info=infoPatientRecherche($db, $_SESSION['user_id'], $valeur, $recherche);
            }
        } elseif ($valeur == 1){
            if ($recherche==''){
                $info=infoPatient($db, $_SESSION['user_id']);
            } else {
                $info=infoPatientRecherche($db, $_SESSION['user_id'], $valeur, $recherche);
            } 
        } elseif ($valeur == 2){
            if ($recherche==''){
                $info=infoPatient($db, $_SESSION['user_id']);
            } else {
                $info=infoPatientRecherche($db, $_SESSION['user_id'], $valeur, $recherche);
            } 
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
                                ."<td rowspan='4' class='photoProfil' > ";
            if ($value['picture']==NULL){
                $resultat .=  "<img src='images/iconProfil.jpg'/>";
            } else{
                $resultat .=  "<img src='" .$value['picture'] ."'/>";
            }
            $resultat .="<td>" .$value['first_name'] ." " .$value['last_name'] ."</td>"
                                ."<td class='modifierSupprimer'>"
                                    ."<img src='images/iconCroix.png' onclick=\"rejeterPatient('utilisateur', " .$valeur ." , '" .$recherche ."' , " .$value['id'] .")\"/>"
                                ."</td>"
                            ."</tr>"
                            ."<tr> <td>" .$value['email'] ."</td> </tr>"
                            ."<tr> <td> Patient </td> </tr>"
                            ."<tr>"
                                ."<td colspan='2' class='iconGerer'>"
                                    ."<img src='images/iconCheck.png' onclick='openExamen()' />"
							        ."<img src='images/iconVoirProfil.png' />"
							        ."<img src='images/iconContacter.png' />"
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
