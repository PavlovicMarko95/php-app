<!DOCTYPE html>
<html>

<head>
    <title>
        Vesti
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
            margin-top: 15px;
        }
        #div3{
            width: 40%;
            text-align: right;
        }
        .div01{
            margin: 15px 0;
            padding: 5px;
            /*min-height: 100px;*/
            aspect-ratio: 7/2;
            border: 1px solid #ccc;
            border-radius: 4px;
            overflow-wrap: break-word;
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
            <div>

                <?php
                session_start();
                require("modeli\Vest.php"); 

                $vesti = Vest::ucitajVesti();
                
                foreach ($vesti as $vest) {
                    echo "<div class='div01'><a href='_vest.php?id={$vest->getId()}' action='_vest.php' method='post' ><h2>" . $vest->getNaslov() . "</h2>" . $vest->getId() . "</a></div>";
                    
                }
                ?>


            </div>
        </div>
        <div id="div3">
            <?php
            if(isset($_SESSION['user'])){
                echo ''. $_SESSION['user'] .'';
                echo "<h3><a href='logout.php'>Odjava</a></h3>";
                if($_SESSION['isadmin']==="1"){
                    echo "<h3><a href='_dodavanjeVesti.php'>Dodaj vest</a></h3>";
                }
            }else{
                echo "<h3><a href='_login.php'>Prijava</a></h3>";
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