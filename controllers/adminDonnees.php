<?php
include('../models/requeteAdmin.php');

function listeManager(PDO $db){
    $nombre=nombreManager($db);
    if ($nombre!= 0){
        $info=infoManager($db);
        $resultat = "<option selected disabled> Nom propriétaire </option>";
        foreach ($info as $key => $value ){
            $resultat .= "<option value='" .$value[id] ."'> " .$value[first_name] ." " .$value[last_name] ." </option>";
        }
    } else {
        $resultat = "<option selected disabled> Pas de médecin </option>";
    }
    return $resultat;
}

function listeInfoDispositif(PDO $db, int $valeur, string $recherche){
    if ($valeur==0){
        if($recherche==''){
            $nombre=nombreDispositif($db);
        }
    }
    if ($nombre!= 0){
        if ($valeur==0){
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
                                    ."<img src='images/iconCroix.png' />"
                                ."</td>"
                            ."</tr>"
                            ."<tr> <td>" .$value['work_address'] ."</td> </tr>"
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
            if ($key%12==0 && $key+1==$nombre){
                $resultat .= "<td></td><td></td><td></td>";
            } elseif ($key%12==1 && $key+1==$nombre){
                $resultat .= "<td></td><td></td>";
            } elseif ($key%12==2 && $key+1==$nombre){
                $resultat .= "<td></td>";
            }

            if ($key%12==11 || $key+1==$nombre){
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

function listeInfoUtilisateur(PDO $db, $valeur, $recherche){
    if ($valeur==0){
        if($recherche==''){
            $nombre=nombreUtilisateur($db);
        }
    }
    if ($nombre!= 0){
        if ($valeur==0){
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
                                ."<td rowspan='4' class='photoProfil' > ";
            if ($value['picture']==NULL){
                $resultat .=  "<img src='images/iconProfil.jpg'/>";
            } else{
                $resultat .=  "<img src='" .$value['picture'] ."'/>";
            }
            $resultat .="<td>" .$value['first_name'] ." " .$value['last_name'] ."</td>"
                                ."<td class='modifierSupprimer'>"
                                    ."<img src='images/iconModifier.png' />"
                                    ."<img src='images/iconCroix.png' onclick=\"rejeter('utilisateur', " .$valeur ." , '" .$recherche ."' , " .$value['id'] ." , '" .$value['origine'] ."')\"/>"
                                ."</td>"
                            ."</tr>"
                            ."<tr> <td>" .$value['email'] ."</td> </tr>";
            if ($value['origine']=='user' ){
                $resultat .="<tr> <td> Patient </td> </tr>";
            } elseif ($value['origine']=='manager' ){
                $resultat .="<tr> <td> Médecin </td> </tr>";
            } elseif ($value['origine']=='administrator' ){
                $resultat .="<tr> <td> Administrateur </td> </tr>";
            } else {
                $resultat .="<tr> <td> Inconnu </td> </tr>";
            }
                $resultat .="<tr>"
                                ."<td colspan='2' class='iconGerer'>";
            if ($value['origine']!='user' || ($value['origine']=='user' && $value['ack_share']==true)){
                $resultat .="<img src='images/iconVoirProfil.png' />";
            }
            $resultat .="<a href='mailto:" .$value['email'] ."'><img src='images/iconContacter.png' /></a>"
                                    ."<img src='images/iconBannir.png' onclick=\"bannir(" .$valeur ." , '" .$recherche ."' , " .$value['id'] ." , '" .$value['origine'] ."')\"/>"
                                ."</td>"
                            ."</tr>"
                        ."</table></td>";
            if ($key%12==0 && $key+1==$nombre){
                $resultat .= "<td></td><td></td><td></td>";
            } elseif ($key%12==1 && $key+1==$nombre){
                $resultat .= "<td></td><td></td>";
            } elseif ($key%12==2 && $key+1==$nombre){
                $resultat .= "<td></td>";
            }

            if ($key%12==11 || $key+1==$nombre){
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

function listeInfoRequete(PDO $db, $valeur){
    if ($valeur==0){
        $nombre=nombreRequete($db);
    } elseif ($valeur==1){
        $nombre=nombreRequeteAdmin($db);
    } elseif ($valeur==2){
        $nombre=nombreRequeteManager($db);
    }
    if ($nombre!= 0){
        if ($valeur==0){
            $info=infoRequete($db);
        } elseif ($valeur==1){
            $info=infoRequeteAdmin($db);
        } elseif ($valeur==2){
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
            $resultat .= "<td>" .$value['origine'] ."</td>"
                                    ."<td>" .$value['first_name'] ." " .$value['last_name'] ."</td>"
                                ."</tr>"
                                ."<tr>"
                                    ."<td></td>"
                                    ."<td>" .$value['email'] ."</td>"
                                ."</tr>"
                                ."<tr>"
                                    ."<td class='valider'><button onclick=\"validerRequete(" .$valeur .", ''," .$value['id'] ." , '" .$value['origine'] ."')\"=> Valider </button></td>"
                                    ."<td class='rejeter'><button onclick=\"rejeter('requete', " .$valeur .", ''," .$value['id'] ." , '" .$value['origine'] ."')\"> Rejeter </button></td>"
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
        $i=1;
        foreach ($info as $key => $value ){
            $resultat.="<div class='affichageQuestion' style='display:block;'>"
                            ."<div class='titreQuestion' id='" .$i ."'>"
                                ."<div>" .$i ."</div>"
                                ."<div>" .$value['question'] ."</div>"
                                ."<div> <img src='images/iconDroite.png' class='symboleDroite actif' onclick='openReponse(" .$i .")'/> </div>"
                                ."<div class='vide' style='font-size: 15px;'> Dernière modification par " .$value['first_name'] ." " .$value['last_name'] ."</div>"
                                ."<div>"
                                    ."<img src='images/iconModifier.png' class='symboleModifier' onclick='openModification(" .$i .")'/>"
                                    ."<img src='images/iconCroix.png' onclick='supQuestion(" .$value['id'] .")'/>"
                                ."</div>"
                            ."</div>"
                        ."</div>"
                        ."<div class='affichageQuestionReponse' style='display:none;'>"
                            ."<div class='affichage' id='" .$i ."'>"
                                ."<div>" .$i ."</div>"
                                ."<div>" .$value['question'] ."</div>"
                                ." <div> <img src='images/iconBas.png' class='symboleBas' onclick='closeReponse(" .$i .")'/> </div>"
                                ."<div class='vide' style='font-size: 15px;'> Dernière modification par " .$value['first_name'] ." " .$value['last_name'] ."</div>"
                                ."<div>"
                                    ."<img src='images/iconModifier.png' class='symboleModifier' onclick='openModification(" .$i .")'/>"
                                    ."<img src='images/iconCroix.png' onclick='supQuestion(" .$value['id'] .")'/>"
                                ."</div>"
                            ."</div>"
                            ."<div class='reponse' id='" .$i ."' >"
                                ."<div id='reponse'>" .$value['answer'] ."</div>"
                            ."</div>"
                        ."</div>"
                        ."<div class='affichageModifier' style='display:none;'>"
                            ."<div class='modifier' id='" .$i ."' >"
                            ."<div>" .$i ."</div>"
                                ."<div> <textarea class='question' id='question" .$value['id'] ."' name='question " .$value['id'] ."' cols=20' rows='1' style='resize: none;'>" .$value['question'] ."</textarea> </div>"
                                ."<div class='vide' > </div>"
                                ."<div>"
                                    ."<img src='images/iconValider.png' onclick='modifQuestion(" .$value['id'] ." , " .$i .")'/>"
                                    ."<img src='images/iconAnnuler.png' class='symboleAnnuler' onclick='openReponse(" .$i .")'/>"
                                ."</div>"
                            ."</div>"
                            ."<div class='reponseModifiable' id='" .$i ."' >"
                                ."<div id='reponse'>"
                                    ."<textarea class='answer' id='answer" .$value['id'] ."' name='reponse " .$value['id'] ."' cols='140' rows='8' style='resize: none;'>" .$value['answer'] ."</textarea>"
                                ."</div>"
                            ."</div>"
                       ." </div>";
            ++$i;
        }

    } else {
        $resultat= "<p>Il n'y a pas de question enregistrée!</p>";
    }

    $resultat .="<div id='questionSup'></div>";

    return $resultat;
}

function ajouterQuestion(PDO $db){
    $nombre=nombreQuestion($db);
    $resultat="<div class='affichageModifier'>"
                    ."<div class='modifier' id='" .($nombre+1) ."' >"
                        ."<div>" .($nombre+1) ."</div>"
                        ."<div> <textarea id='newQuestion' name='question' cols='20' rows='1' style='resize: none;' placeholder='Question'></textarea></div>"
                        ."<div class='vide' > </div>"
                        ."<div>"
                            ."<img src='images/iconValider.png' onclick='validAjoutQuestion()'/>"
                            ."<img src='images/iconAnnuler.png' class='symboleAnnuler' onclick='closeAddQuestion()'/>"
                        ."</div>"
                    ."</div>"
                    ."<div class='reponseModifiable' id='" .($nombre+1) ."' >"
                        ."<div id='reponse'>"
                            ."<textarea id='newAnswer' name='answer' cols='140' rows='8' style='resize: none;' placeholder='Réponse'></textarea>"
                        ."</div>"
                    ."</div>"
            ." </div>";
    return $resultat;
}
?>