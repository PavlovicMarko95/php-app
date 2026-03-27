<!DOCTYPE html>
<html>

<head>
    <title>
        Registracija
    </title>
    <style>
        html, body{
            height: 100%;
            margin: 0;
        }
        header{
            width: 100%;
            height: 80px;
            background-color: #725D72;
        }
        header h1{
            margin: 0;
            margin-left: 25%;
            padding-top: 32px;

        }
        nav{
            width: 50%;
            margin-left: 25%;
        }
        #div1{
            margin-left: 25%;
            width: 40%;
            display: flex;
            min-height: 100vh;

        }
        #div2{
            width: 60%;
            margin-left: 20%;
            margin-top: 40px;
        }
        #div3{
            width: 40%;
            text-align: right;
        }
        footer{
            width: 80%;
            margin-left: 10%;
            text-align: center;
        }
        .crveno {
            color: red;
        }

        .zeleno {
            color: green;
        }
    </style>
</head>

<body>
    <header>
        <h1>Vesti</h1>
    </header>
    <nav>
        <a href="index.php">Naslovna</a>
    </nav>
    
    <div id="div1">
        
        <div id="div2">
        <h1>Registracija</h1>
        <?php
        session_start();
        require('modeli/Korisnik.php');
        $greska = $uspeh = '';
        if ($korIme = $_POST["kor_ime"] ?? null) {
            if (strlen($korIme) >= 3) {
                if (Korisnik::jedinstvenoKorIme($korIme)) {
                    $lozinka = $_POST["lozinka"] ?? null;
                    if (strlen($lozinka) > 5) {
                        if ($lozinka === $_POST["ponovljena_lozinka"]) {
                            $korisnik = new Korisnik();
                            $korisnik->setIme($_POST["ime"])->setKorIme($korIme)->setLozinka($lozinka);
                            if($korisnik->snimiKorisnika()){

                            $uspeh = "Uspesno ste se registrovali na sistem. Hvala.";
                            $_SESSION['user'] = $korisnik->getKorIme();
                            
                            $_SESSION['iduser'] = $korisnik->getId();

                            $_SESSION['isadmin'] = $korisnik->getIsAdmin();

                            }else{
                            $greska .= '<br/> Neuspesno snimanje korisnika u bazu.';

                            }
                        } else {
                            $greska .= '<br/> Ponovljena lozinka treba da bude ista kao prva.';
                        }
                    } else {
                        $greska .= '<br/> Lozinka treba da bude bar 5 karaktera dugacka.';
                    }
                } else {
                    $greska .= '<br/> Korisnicko ime vec postoji u bazi. Probajte drugo ili se <a href="_login.php">ulogujte</a>.';
                }
            } else {
                $greska .= '<br/> Korisnicko ime treba da bude duze bar 3 karaktera duzine';
            }
        }
        ?>
        <div class="zeleno"><?= $uspeh ?></div>
        <?php
        if (!$uspeh) { ?>
            <div class="crveno"><?= $greska ?></div>
            <form action="" method="POST">
                <input type="text" name="ime" placeholder="Unesite  ime"><br><br>
                <input type="text" name="kor_ime" placeholder="Unesite korisnicko ime" value="<?= $_POST["kor_ime"] ?? null ?>"><br><br>
                <input type="password" name="lozinka" placeholder="Unesite lozinku"><br><br>
                <input type="password" name="ponovljena_lozinka" placeholder="Ponovo Unesite lozinku"><br><br>
                <button>Registrujte se</button>
            </form>
        <?php } ?>
        </div>
        <div id="div3">
            <?php
            if(isset($_SESSION['user'])){
                echo ''. $_SESSION['user'] .'';
            }
        ?>
        </div>
    </div>
    <footer>
        <p>
            <a href="#">#</a>
            <a href="#">###</a>
        </p>
        <hr>
        <p>&copy; ITAcademy 2025</p>
    </footer>
</body>

</html>