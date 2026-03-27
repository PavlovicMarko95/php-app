<!DOCTYPE html>
<html>
    <head>
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
            width: 50;
            margin-left: 25%;
        }
        #div1{
            margin-left: 25%;
            display: flex;
            width: 40%;
            min-height: 100vh;
        }
        #div2{
            width: 60%;
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
                
                <h1>Dodavanje komentara</h1>
                
                <?php
                session_start();
                require("modeli\Komentar.php");
                require("modeli\Vest.php");

                if (isset($_GET['id'])) {

                    $idVesti = $_GET['id'];
                    
                    $vest = Vest::ucitajVest($idVesti);
                    echo "<h2><a href='_vest.php?id={$_GET['id']}'>".$vest->getNaslov()."</a></h2>";
                    if(isset($_POST['tekst'])){
                        $tekst = $_POST['tekst'];
                        if(strlen($tekst) > 5) {
                            $komentar = new Komentar();
                            $komentar->setIdVest($idVesti)->setTekst($tekst)->setIdKorisnik($_SESSION['iduser']);
                            if($komentar->dodajKomentar()){
                                echo "Uspesno dodat komentar";
                            }
                        }
                        else{
                        echo "Tekst treba da sadrzi bar 5 karaktera";
                        }
                    }else{
                        echo "Nije unet komentar.";
                    }
                }else {
                    echo "Nije ucitan id vesti ili sesija";
                }
                
                ?>
                <form action="" method="POST">
                    <!--<input type="text" name="tekst" placeholder="Unesite tekst vesti"><br><br>-->
                    <textarea id="text" name="tekst" cols="40" rows="4" placeholder="Unesite komentar"></textarea><br><br>
                    <button>Sacuvaj</button>
                </form>
                
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