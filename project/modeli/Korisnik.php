
<?php
require("baza\classBaza.php");

class Korisnik
{
    private $id;
    private $ime;
    private $isAdmin = false;
    private $korIme;
    private $lozinka;
    private static $baza;

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getIme()
    {
        return $this->ime;
    }
    public function setIme($ime)
    {
        $this->ime = $ime;
        return $this;
    }
    public function getIsAdmin()
    {
        return $this->isAdmin;
    }
    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;
        return $this;
    }
    public function getKorIme()
    {
        return $this->korIme;
    }
    public function setKorIme($korIme)
    {
        $this->korIme = $korIme;
        return $this;
    }
    public function getLozinka()
    {
        return $this->lozinka;
    }
    public function setLozinka($lozinka)
    {
        $this->lozinka = $lozinka;
        return $this;
    }

    public static function jedinstvenoKorIme($korIme)
    {
        static::connectToDB();
        $result = static::$baza->query(
            sprintf('SELECT COUNT(*) FROM korisnik WHERE kor_ime = "%s"', $korIme)
        );
        $row = $result->fetch_row();

        return !$row["0"];
    }
        public static function jedinstvenoKorIme1($korIme)
    {
        static::connectToDB();
        $result = static::$baza->query(
            sprintf('SELECT COUNT(*) FROM korisnik WHERE kor_ime = "%s"', $korIme)
        );
        $row = $result->fetch_row();

        return $row["0"];
    }
    public static function jedinstveniKorisnik($korIme, $lozinka){
        static::connectToDB();
        $result = static::$baza->query(
            sprintf('SELECT COUNT(*) FROM korisnik WHERE kor_ime = "%s" AND lozinka = "%s"', $korIme, $lozinka )
        );
        $row = $result->fetch_row();
        if( $row["0"]){
            static::connectToDB();
            $result1 = static::$baza->query(
            sprintf('SELECT * FROM korisnik WHERE kor_ime = "%s" AND lozinka = "%s"', $korIme, $lozinka )
            );
            $korisnikAsocc = static::$baza->fetch_assoc($result1);
            $korisnik = new Korisnik();
            $korisnik->setId($korisnikAsocc["id"]);
            $korisnik->setIme($korisnikAsocc["ime"]);
            $korisnik->setKorIme($korisnikAsocc["kor_ime"]);
            $korisnik->setLozinka($korisnikAsocc["lozinka"]);
            $korisnik->setIsAdmin($korisnikAsocc["is_admin"]);

            return $korisnik;
        }else{
            return false;
        }

        //return $row["0"];
    }
    private static function connectToDB()
    {
        if (!static::$baza) {
            static::$baza = new Baza();
        }
    }

    public function snimiKorisnika()
    {
        static::connectToDB();
        if ($this->getId()) {
            
            return static::$baza->query(
                sprintf(
                    'UPDATE korisnik (ime, kor_ime, lozinka) VALUES("%s", "%s", "%s") WHERE id = "%s"',
                    $this->getIme(),
                    $this->getKorIme(),
                    $this->getLozinka(),
                    $this->getId()
                )
            );
        }else{
            return static::$baza->query(
                sprintf(
                    'INSERT INTO korisnik (ime, kor_ime, lozinka) VALUES("%s", "%s", "%s")',
                    $this->getIme(),
                    $this->getKorIme(),
                    $this->getLozinka()
                )
            );
        }
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
