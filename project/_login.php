<!DOCTYPE html>
<html>

<head>
    <title>
        Login
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
            width: 50%;
            margin-left: 20%;
            margin-top: 40px;
        }
        #div3{
            width: 50%;
            text-align: right;
        }
        footer{
            width: 80%;
            margin-left: 10%;
            text-align: center;
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
            <h1>Login</h1>

            <?php
            session_start();
            require('modeli/Korisnik.php');
            if(isset($_POST["kor_ime"])){
                $korIme = $_POST["kor_ime"];
                if(Korisnik::jedinstvenoKorIme1($korIme)){
                        $lozinka = $_POST["lozinka"] ?? null;
                        if($korisnik = Korisnik::jedinstveniKorisnik($korIme, $lozinka)){
                            
                            echo "Uspesno logovanje.";
                            $_SESSION['user'] = $korisnik->getKorIme();
                            $_SESSION['iduser'] = $korisnik->getId();
                            $_SESSION['isadmin'] = $korisnik->getIsAdmin();
                        
                        }else{
                            echo "Pogresna lozinka.";
                        }
                }else
                {
                    echo "Pogresno korisnicko ime.";

                }
            }else{echo "Nema imena";}
            ?>

            <form action="" method="POST">
                <input type="text" name="kor_ime" placeholder="Unesite korisnicko ime"><br><br>
                <input type="password" name="lozinka" placeholder="Unesite lozinku"><br><br>
                <button>Ulogujte se</button>
            </form>
            <a href="index.php">Vesti</a><br><br>
            <?php
            if(!isset($_SESSION['user']))
                { echo "<a href='_registracija.php'>Registrujte se</a>";
            }
            ?>
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