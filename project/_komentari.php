<!DOCTYPE html>
<html>
    <head>
        <title>Komentari</title>
        <style>
            #div1{
                position: fixed;
                left: 25%;
                width: 650px;
            }
        </style>
    </head>
    <body>
        <div1 id="div1">
            <div2>
                <h1>Komentari</h1>
                <div>
                    <?php
                    require("modeli\Komentar.php");

                    if (isset($_GET['id'])) {

                        $idVesti = $_GET['id'];

                        $komentari = Komentar::ucitajKomentare($idVesti);

                        foreach ($komentari as $komentar){
                            echo "<div><h3>". $komentar->getTekst() . "</h3></div>";
                        }

                    }else {
                        echo "nesto ne stima";
                    }
                    ?>
                </div>
            </div2>
        </div1>
    </body>
</html>