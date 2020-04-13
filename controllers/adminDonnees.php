<?php
include('../models/requeteAdmin.php');

function listeInfoDispositif(PDO $db, int $value, string $recherche){
    if ($value==0){
        if($recherche==''){
            $nombre=nombreDispositif($db);
        }
    }
    if ($nombre!= 0){
        if ($value==0){
            if($recherche==''){
                $info=infoDispositif($db);
            }
        }
        foreach ($info as $key => $value ){
            if ($key%12==0){
                if ($key==0){
                    $resultat = "<table class='affichageResultat' style='display: block;'>"
                                    ."<tr>";
                }else {
                    $resultat .= "<table class='affichageResultat' style='display: none;'>"
                                    ."<tr>";
                }
            } elseif ($key%4==0){
                $resultat .= "<tr>";
            }

            $resultat .= "<td><table class='dispositif'>"
                            ."<tr>"
                                ."<td rowspan='3' class='imageDispositif' > <img src='images/iconDispositif.png'/></td>"
                                ."<td>" .$value['code'] ."</td>"
                                ."<td class='modifierSupprimer'>"
                                    ."<img src='images/iconModifier.png' />"
                                    ."<img src='images/iconCroix.png'/>"
                                ."</td>"
                            ."</tr>"
                            ."<tr> <td>" .$value['work_adress'] ."</td> </tr>"
                            ."<tr>"
                                ."<td colspan='2' class='proprietaireDispositif'>";
            if ($value['picture']==NULL){
                $resultat .=  "<img src='images/iconProfil.jpg'/>";
            } else {
                $resultat .=  "<img src='" .$value['picture'] ."'/>";
            }
            $resultat .= $value['first_name'] ." " .$value['last_name'] ."</td>"
                            ."</tr>"
                        ."</table></td>";

            if ($key%12==11){
                $resultat .= "</tr></table>";
            } elseif (($key%12==3) or ($key%12==7)){
                $resultat .= "</tr>";
            }
        }

        if (count($info)>12){
            $resultat .= "<div class='pagination'>"
                            ."<button class='pageBefore' onclick='openBefore(dispositif)'> <img src='images/flecheGauche.png' /> </button>";
            for ($compteur=0; $compteur<(count($info)%12); $compteur++){
                if ($compteur==0){
                    $resultat .="<button class='page actif' onclick='openPage(0, dispositif)'> 1 </button>";
                } else {
                    $resultat .="<button class='page' onclick='openPage(".$compteur .", dispositif)'>".($compteur+1) ."</button>";
                }
            }
            $resultat .= "<button class='pageAfter' onclick='openAfter(dispositif)'> <img src='images/flecheDroite.png'/> </button>"
                        ."</div>";
        }

    } else {
        $resultat= "<p>Il n'y a pas de dispositif enregistré!</p>";
    }

    return $resultat;
}

function listeInfoUtilisateur(PDO $db, $value, $recherche){
    if ($value==0){
        if($recherche==''){
            $nombre=nombreUtilisateur($db);
        }
    }
    if ($nombre!= 0){
        if ($value==0){
            if($recherche==''){
                $info=infoUtilisateur($db);
            }
        }
        foreach ($info as $key => $value ){
            if ($key%12==0){
                if ($key==0){
                    $resultat = "<table class='affichageResultat' style='display: block;'>"
                                    ."<tr>";
                }else {
                    $resultat .= "<table class='affichageResultat' style='display: none;'>"
                                    ."<tr>";
                }
            } elseif ($key%4==0){
                $resultat .= "<tr>";
            }

            $resultat .= "<td><table class='utilisateur'>"
                            ."<tr>"
                                ."<td rowspan='3' class='photoProfil' > ";
            if ($value['picture']==NULL){
                $resultat .=  "<img src='images/iconProfil.jpg'/>";
            } else{
                $resultat .=  "<img src='" .$value['picture'] ."'/>";
            }
            $resultat .="<td>" .$value[first_name] ." " .$value[last_name] ."</td>"
                                ."<td class='modifierSupprimer'>"
                                    ."<img src='images/iconModifier.png' />"
                                    ."<img src='images/iconCroix.png'/>"
                                ."</td>"
                            ."</tr>"
                            ."<tr> <td>" .$value['email'] ."</td> </tr>"
                            ."<tr>"
                                ."<td colspan='2' class='iconGerer'>"
                                    ."<img src='images/iconVoirProfil.png' />"
                                    ."<img src='images/iconContacter.png' />"
                                    ."<img src='images/iconBannir.png' />"
                                ."</td>"
                            ."</tr>"
                        ."</table></td>";

            if ($key%12==11){
                $resultat .= "</tr></table>";
            } elseif (($key%12==3) or ($key%12==7)){
                $resultat .= "</tr>";
            }
        }

        if (count($info)>12){
            $resultat .= "<div class='pagination'>"
                            ."<button class='pageBefore' onclick='openBefore(utilisateur)'> <img src='images/flecheGauche.png' /> </button>";
            for ($compteur=0; $compteur<(count($info)%12); $compteur++){
                if ($compteur==0){
                    $resultat .="<button class='page actif' onclick='openPage(0, utilisateur)'> 1 </button>";
                } else {
                    $resultat .="<button class='page' onclick='openPage(".$compteur .", utilisateur)'>".($compteur+1) ."</button>";
                }
            }
            $resultat .= "<button class='pageAfter' onclick='openAfter(utilisateur)'> <img src='images/flecheDroite.png'/> </button>"
                        ."</div>";
        }

    } else {
        $resultat= "<p>Il n'y a pas d'utilisateur enregistré (même vous :p)!</p>";
    }

    return $resultat;
}

function listeInfoRequete(PDO $db, $value){
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
                                    ."<td>" .$value[first_name] ." " .$value[last_name] ."</td>"
                                ."</tr>"
                                ."<tr>"
                                    ."<td></td>"
                                    ."<td>" .$value[email] ."</td>"
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
    return $resultat;
}

function listeFAQ(PDO $db){
    $nombre=nombreQuestion($db);
    if ($nombre!= 0){
        $info=infoFaq($db);
        $resultat="";
        foreach ($info as $key => $value ){
            $resultat.="<div class='affichageQuestion' style='display:block;'>"
                            ."<div class='question' id='" .$value[id] ."'>"
                                ."<div>" .$value[id] ."</div>"
                                ."<div>" .$value[question] ."</div>"
                                ."<div> <img src='images/iconDroite.png' class='symboleDroite actif' onclick='openReponse(" .$value[id] .")'/> </div>"
                                ."<div class='vide' style='font-size: 15px;'> Dernière modification par " .$first_name ." " .$last_name ."</div>"
                                ."<div>"
                                    ."<img src='images/iconModifier.png' class='symboleModifier' onclick='openModification(" .$value[id] .")'/>"
                                    ."<img src='images/iconCroix.png'/>"
                                ."</div>"
                            ."</div>"
                        ."</div>"
                        ."<div class='affichageQuestionReponse' style='display:none;'>"
                            ."<div class='affichage' id='" .$value[id] ."'>"
                                ."<div>" .$value[id] ."</div>"
                                ."<div>" .$value[question] ."</div>"
                                ." <div> <img src='images/iconBas.png' class='symboleBas' onclick='closeReponse(" .$value[id] .")'/> </div>"
                                ."<div class='vide' style='font-size: 15px;'> Dernière modification par " .$first_name ." " .$last_name ."</div>"
                                ."<div>"
                                    ."<img src='images/iconModifier.png' class='symboleModifier' onclick='openModification(" .$value[id] .")'/>"
                                    ."<img src='images/iconCroix.png'/>"
                                ."</div>"
                            ."</div>"
                            ."<div class='reponse' id='" .$value[id] ."' >"
                                ."<div id='reponse'>" .$value[answer] ."</div>"
                            ."</div>"
                        ."</div>"
                        ."<form class='affichageModifier' style='display:none;'>"
                            ."<div class='modifier' id='" .$value[id] ."' >"
                            ."<div>" .$value[id] ."</div>"
                                ."<div> <textarea id='answer' name='question " .$value[id] ."' cols=20' rows='1' style='resize: none;'>" .$value[question] ."</textarea> </div>"
                                ."<div class='vide' > </div>"
                                ."<div>"
                                    ."<img src='images/iconValider.png'/>"
                                    ."<img src='images/iconAnnuler.png' class='symboleAnnuler' onclick='openReponse(" .$value[id] .")'/>"
                                ."</div>"
                            ."</div>"
                            ."<div class='reponseModifiable' id='" .$value[id] ."' >"
                                ."<div id='reponse'>"
                                    ."<textarea id='answer' name='question " .$value[id] ."' cols='140' rows='8' style='resize: none;'>" .$value[id] ."</textarea>"
                                ."</div>"
                            ."</div>"
                       ." </form>";
        }

    } else {
        $resultat= "<p>Il n'y a pas de question enregistré!</p>";
    }

    return $resultat;
}
