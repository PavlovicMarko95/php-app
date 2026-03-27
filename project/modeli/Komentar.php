<?php
class Komentar{
    private $id;
    private $idKorisnik;
    private $idVest;
    private $tekst;
    private $vreme;
    private static $baza;
    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
        return $this;
    }
    public function getIdKorisnik(){
        return $this->idKorisnik;
    }
    public function setIdKorisnik($idKorisnik){
        $this->idKorisnik = $idKorisnik;
        return $this;
    }
    public function getIdVest(){
        return $this->idVest;
    }
    public function setIdVest($idVest){
        $this->idVest = $idVest;
        return $this;
    }
    public function getTekst(){
        return $this->tekst;
    }
    public function setTekst($tekst){
        $this->tekst = $tekst;
        return $this;
    }
    public function getVreme(){
        return $this->vreme;
    }
    public function setVreme($vreme){
        $this->vreme = $vreme;
        return $this;
    }
    public static function ucitajKomentare($idVest)
    {
        if (!static::$baza) {
            static::$baza = new Baza();
        }
        $result = static::$baza->query(
            sprintf("SELECT * FROM komentar WHERE id_vest='%s' ", 
            $idVest)
        );

        $komentari = [];
        while ($komentariAssoc = static::$baza->fetch_assoc($result)) {
            $komentar = new Komentar();
            $komentar->setId($komentariAssoc["id"]);
            $komentar->setVreme($komentariAssoc["vreme"]);
            $komentar->setTekst($komentariAssoc["tekst"]);
            $komentar->setIdKorisnik($komentariAssoc["id_korisnik"]);
            $komentari[] = $komentar;
        }

        return $komentari;
    }
    public function dodajKomentar(){
        if (!static::$baza){
            static::$baza = new Baza();
        }
        return static::$baza->query(
            sprintf('INSERT INTO komentar (id_vest, tekst, id_korisnik) VALUES("%s", "%s", "%s") ',
            
            $this->getIdVest(),
                    $this->getTekst(),
                    $this->getIdKorisnik()
            
            )
        );
    }

    public static function ucitajKorisnika($id){
        if (!static::$baza) {
        static::$baza = new Baza();
        $result = static::$baza->query(
            sprintf(
            "SELECT * FROM korisnik WHERE id=%s ", 
            static::$baza->escapeString($id)
            )
        );

        $korisnikObj = static::$baza->fetch_assoc($result);
        $korisnik = new Korisnik();
        $korisnik->setId($korisnikObj["id"]);
        $korisnik->setIme($korisnikObj["ime"]);
        $korisnik->setKorIme($korisnikObj["korIme"]);
        $korisnik->setLozinka($korisnikObj["lozinka"]);
        
        return $korisnik;}
    }
}