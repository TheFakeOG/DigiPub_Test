<?php

class Ordre {
    var $ordre = array();
    function add_ordre(Kaffe $new_kaffe){
        $this->ordre[] = $new_kaffe;
    }
    function get_ordre(){
        $navn = "<br>";
        foreach($this->ordre as $kaff) {
            $navn .= $kaff->get_totNavn() . "<br>";
        }
        return $navn;
    }
    function get_kost(){
        $totKost = 0;
        foreach($this->ordre as $kaff){
            $totKost += $kaff->get_totKost();
        }
        return $totKost;
    }
}

class Kaffe {
    var $navn;
    var $koster;
    var $tillegg = array();
    function set_navn($new_navn) {
        $this->navn = $new_navn;
    }
    function set_kost($new_kost) {
        $this->koster = $new_kost;
    }
    function add_tillegg(Tillegg $new_tillegg){
        $this->tillegg[] = $new_tillegg;
    }
    function get_navn() {
        return $this->navn;
    }
    function get_kost() {
        return $this->koster;
    }
    function get_tillegg(){
        return $this->tillegg;
    }
    function get_totNavn(){
        $navn = $this->get_navn();
        foreach($this->tillegg as $til){
            $navn .= ", " . $til->get_navn();
        }
        return $navn;
    }
    function get_totKost(){
        $totKost = $this->get_kost();
        foreach($this->tillegg as $val){
            $totKost += $val->get_kost();
        }
        return $totKost;
    }
}

class Filterkaffe extends Kaffe {
    function __construct(){
        $this->set_navn("Filterkaffe");
        $this->set_kost(10);
    }
}

class Americano extends Kaffe {
    function __construct(){
        $this->set_navn("Americano");
        $this->set_kost(15);
    }
}

class Tillegg {
    var $navn;
    var $koster;
    function set_navn($new_navn) {
        $this->navn = $new_navn;
    }
    function set_kost($new_kost) {
        $this->koster = $new_kost;
    }
    function get_navn() {
        return $this->navn;
    }
    function get_kost() {
        return $this->koster;
    }
}
class Sukker extends Tillegg {
    function __construct(){
        $this->set_navn("Sukker");
        $this->set_kost(6);
    }
}

class Melk extends Tillegg {
    function __construct(){
        $this->set_navn("Melk");
        $this->set_kost(5);
    }
}

?>