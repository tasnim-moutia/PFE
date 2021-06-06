<?php

function makeImageFromName($nom) {
    $userImage = "";
    $shortNom = "";

    $noms = explode(" ", $nom);

    foreach ($noms as $w) {
        $shortNom .= $w[0];
    }

    $userImage = '<div class="name-image bg-primary">'.$shortNom.'</div>';
    return $userImage;
}