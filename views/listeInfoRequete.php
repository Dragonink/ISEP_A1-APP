<?php

include('../controllers/adminDonnees.php');

if(($_GET["value"]>=0) && ($_GET["value"]<3)) {
    $value=$_GET["value"];
    if ($value==0){
        $nombre=nombreRequete($db);
    } elseif ($value==1){
        $nombre=nombreRequeteAdmin($db);
    } elseif ($value==2){
        $nombre=nombreRequeteManager($db);
    }
    if ($nombre!= 0){
        if ($value==0){
            $info=infoRequete($db);
        } elseif ($value==1){
            $info=infoRequeteAdmin($db);
        } elseif ($value==2){
            $info=infoRequeteManager($db);
        }
        foreach ($info as $key => $value ){
            if ($key==0){
                $resultat = "<table class='affichageResultat'>"
                                ."<tr>";
            }else {
                $resultat .= "<table class='affichageResultat'>"
                                ."<tr>";
            }
            $resultat .= "<td>Type de demande</td>"
                                    ."<td>" .$info[first_name] ." " .$info[last_name] ."</td>"
                                ."</tr>"
                                ."<tr>"
                                    ."<td></td>"
                                    ."<td>" .$info[email] ."</td>"
                                ."</tr>"
                                ."<tr>"
                                    ."<td class='valider'><button> Valider </button></td>"
                                    ."<td class='rejeter'><button> Rejeter </button></td>"
                                ."</tr>"
                            ."</table>";
        }
        
    } else {
        $resultat= "<p>Il n'y a pas de demande. </p>";
    }
    echo $resultat;
}
?>