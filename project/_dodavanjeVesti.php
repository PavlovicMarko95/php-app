<!DOCTYPE html>
<html>
    <head>
        <title>Dodavanje vesti</title>
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
                width: 40%;
                display: flex;
                min-height: 100vh;
            }
            #div2{
                width: 60%;
                margin-left: 15%;
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
                <h1>Dodavanje vesti</h1>
                <?php
                session_start();
                require("modeli\Vest.php");
                
                
                if(isset($_POST["tekst"]) AND isset($_POST["naslov"])){
                    if(strlen($_POST["naslov"])> 5){
                        if(strlen($_POST["tekst"])> 5){
                            $vest = new Vest();
                            $vest->setIdKorisnik($_SESSION['iduser'])->setNaslov($_POST["naslov"])->setTekst($_POST["tekst"]);
                            $vest->dodajVest();
                            echo "Uspesno dodata vest";
                            echo "<a href='index.php'>Vesti</a>";
                                

                        }else{
                            echo"Tekst mora sadrzati bar 5 karaktera.";
                        }      
                    }else{
                        echo "Naslo mora imati bar 5 karaktera.";
                    }
                }else{
                    echo "Nije dodata vest.";
                }
                
                ?>
                <form action="" method="POST">
                    <input type="text" name="naslov" placeholder="Unesite naslov vesti"><br><br>
                    <textarea id="text" name="tekst" cols="30" rows="10" placeholder="Unesite tekst vesti"></textarea><br><br>
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