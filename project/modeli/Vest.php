<?php
require("baza\classBaza.php");
class Vest
{
    private $id;
    private $naslov;
    private $tekst;
    private $vreme;
    private $idKorisnik;
    private static $baza;

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    public function getNaslov()
    {
        return $this->naslov;
    }
    public function setNaslov($naslov)
    {
        $this->naslov = $naslov;
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
    public function getIdKorisnik(){
        return $this->idKorisnik;
    }
    public function setIdKorisnik($idKorisnik){
        $this->idKorisnik = $idKorisnik;
        return $this;
    }

    public static function ucitajVesti()
    {
        if (!static::$baza) {
            static::$baza = new Baza();
        }
        $result = static::$baza->query("SELECT * FROM vest ORDER BY id DESC");

        $vesti = [];
        while ($vestAssoc = static::$baza->fetch_assoc($result)) {
            $vest = new Vest();
            $vest->setId($vestAssoc["id"]);
            $vest->setNaslov($vestAssoc["naslov"]);
            $vest->setTekst($vestAssoc["tekst"]);
            $vest->setIdKorisnik($vestAssoc["id_korisnik"]);
            $vesti[] = $vest;
        }

        return $vesti;
    }

    public static function ucitajVest($id){
        if (!static::$baza) {
        static::$baza = new Baza();
        $result = static::$baza->query(
            sprintf(
            "SELECT * FROM vest WHERE id=%s ", 
            static::$baza->escapeString($id)
            )
        );

        $vestObj = static::$baza->fetch_assoc($result);
        $vest = new Vest();
        $vest->setId($vestObj["id"]);
        $vest->setNaslov($vestObj["naslov"]);
        $vest->setTekst($vestObj["tekst"]);
        
        return $vest;}
    }
    public function dodajVest(){
        if (!static::$baza){
            static::$baza = new Baza();
        }
        return static::$baza->query(
            sprintf('INSERT INTO vest (id_korisnik, naslov, tekst) VALUES("%s", "%s", "%s") ',
            
            $this->getIdKorisnik(),
            $this->getNaslov(),
            $this->getTekst()
            
            )
        );
    }

    public static function ucitajKorisnika($id){
        if (!static::$baza) {
        static::$baza = new Baza();}
        $result = static::$baza->query(
            sprintf(
            "SELECT kor_ime FROM korisnik WHERE id=%s ", 
            static::$baza->escapeString($id)
            )
        );
        $row = $result->fetch_assoc();
        /*$korisnikObj = static::$baza->fetch_assoc($result);
        $korisnik = new Korisnik();
        $korisnik->setId($korisnikObj["id"]);
        $korisnik->setIme($korisnikObj["ime"]);
        $korisnik->setKorIme($korisnikObj["korIme"]);
        $korisnik->setLozinka($korisnikObj["lozinka"]);*/
        
        return $row['kor_ime']??null;
    }
}

