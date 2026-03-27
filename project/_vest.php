<!DOCTYPE html>
<html>
    <head>
        <title>Vest</title>
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
                text-align: left;
            }
            #div3{
                width: 40%;
                text-align: right;
            }
            .stajl{
                margin: 2px;
                padding: 5px;
                min-height: 100px;
                border: 1px solid #ccc;
                border-radius: 4px;
                overflow-wrap: break-word;
            }
            .div02{
                margin-left: 1%;
            }
            .div02 hr{
                border: none;
                border-top: 1px solid #ccc;
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
                <?php
                session_start();
                require("modeli\Vest.php");

                if (isset($_GET['id'])){

                    $id = $_GET['id'];
                    $vest = Vest::ucitajVest( $id);
                        
                    echo "<div>
                    <h1>"
                    . $vest->getNaslov() . "</h1>" . "<div class='stajl'>"
                    .$vest->getTekst() . "</div>"
                    ."<br></div>";

                    require("modeli\Komentar.php");

                    $komentari = Komentar::ucitajKomentare($id);

                    foreach ($komentari as $komentar){
                        echo "<div class='div02'>" . Vest::ucitajKorisnika($komentar->getIdKorisnik()) . ": " . "<h5>&nbsp;&nbsp;&nbsp;". $komentar->getTekst() . "</h5><hr></div>";
                    }

                }else{
                    echo "Nije zadat id";
                }

                if (isset($_SESSION['user'])){
                    echo "<a href='_komentariDodavanje.php?id={$id}' action='_komentariDodavanje.php' method='POST'>  Dodaj komentar</a>";
                }else{
                    echo "";
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


