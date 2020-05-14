<?php
session_start();
include('../models/requeteAdmin.php');

$nombre=nombreQuestion($db);
if ($nombre!= 0){
    $info=infoFaq($db);
    $faq="";
    foreach ($info as $key => $value ){
        $faq .= "<details>"
                ."<summary>" .$value['question']  ."</summary>"
                ."<p>" .$value['answer'] ."</p>"
            ."</details>";
    }
} else {
    $faq = "<p>Il n'y a pas de question enregistrée. N'hésitez pas à en poser une.</p>";
}
