<?php include("class_lib.php") ?>
<?php

    $ordre1 = new Ordre();
    $ordre2 = new Ordre();
    $ordre3 = new Ordre();
    $kaffeBar = new Filterkaffe();
    $kaffeMelk = new Filterkaffe();
    $kaffeSukker = new Filterkaffe();
    $americanoSukkerMelk = new Americano();
    $americanoSukker = new Americano();
    $kaffeMelk->add_tillegg(new Melk);
    $kaffeSukker->add_tillegg(new Sukker);
    $americanoSukkerMelk->add_tillegg(new Melk);
    $americanoSukkerMelk->add_tillegg(new Sukker);
    $americanoSukker->add_tillegg(new Sukker);
    $ordre1->add_ordre($kaffeBar);
    $ordre1->add_ordre($kaffeMelk);
    $ordre2->add_ordre($kaffeMelk);
    $ordre2->add_ordre($americanoSukker);
    $ordre2->add_ordre($americanoSukkerMelk);
    $ordre3->add_ordre($kaffeMelk);
    $ordre3->add_ordre($kaffeSukker);
    echo 'Ordre 1:';
    echo '<br>Ordre: ' . $ordre1->get_ordre();
    echo 'Pris: ' . $ordre1->get_kost();
    echo '<br><br>Ordre 2:';
    echo '<br>Ordre: ' . $ordre2->get_ordre();
    echo 'Pris: ' . $ordre2->get_kost();
    echo '<br><br>Ordre 3 (fra eksempel):';
    echo '<br>Ordre: ' . $ordre3->get_ordre();
    echo 'Pris: ' . $ordre3->get_kost();
    

?>