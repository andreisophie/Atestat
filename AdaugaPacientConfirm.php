<html>
    <head>
        <title>Pacienți</title>
        <link rel="icon" href="https://cdn3.iconfinder.com/data/icons/health/100/hospital-512.png">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="Interfata.css">
    </head>
    <?php
        session_start();

        function varsta($Data_nasterii)
        {
            $fo  = new DateTimeZone('Europe/Bucharest');
            $dn = date_create_from_format('Y-m-d', $Data_nasterii, $fo);
            $azi=new DateTime('now');
            $varsta=date_diff($dn, $azi);
            return $varsta->format("%y");
        }

        function validateInput($key, $type = 0)
        {
            $errorKeyName = "error" . ucfirst($key); 
            $valueKeyName = "valoare" . ucfirst($key);
    
            unset($_SESSION[$errorKeyName]);
            $_SESSION[$valueKeyName] = $_POST[$key];
            
            if (!isset($_POST[$key]))
            {
                $_SESSION[$errorKeyName] = 1;
                return 0;
            }
            
            if (empty(trim($_POST[$key])) && $type!=-1)
            {
                $_SESSION[$errorKeyName] = 2;
                return 0;
            }
            
            if ($type == 1)
                if (!is_numeric($_POST[$key]))
                {
                    $_SESSION[$errorKeyName] = 3;
                    return 0;
                }

            if ($type == 2)
                if ($_POST[$key]!="M" && $_POST[$key]!="F" && $_POST[$key]!="Altele")
                {
                    $_SESSION[$errorKeyName] = 4;
                    return 0;
                }

            if ($type == 3)
                if (!ctype_alpha($_POST[$key]))
                {
                    $_SESSION[$errorKeyName] = 5;
                    return 0;
                }
    
            return 1;
        }
        
        $ok = 1;
        $ok = $ok & validateInput("Nume",3);
        $ok = $ok & validateInput("Prenume",3);
        $ok = $ok & validateInput("Sex",2);
        $ok = $ok & validateInput("Data_nasterii");
        $ok = $ok & validateInput("CNP",1);
        $ok = $ok & validateInput("Telefon",1);
        $ok = $ok & validateInput("E_mail",-1);
        $ok = $ok & validateInput("ID_judet",1);
        $ok = $ok & validateInput("Oras");
        $ok = $ok & validateInput("Strada");
        $ok = $ok & validateInput("Cod_postal",1);
        $ok = $ok & validateInput("Numar",-1);
        $ok = $ok & validateInput("Bloc",-1);
        $ok = $ok & validateInput("Apartament",-1);
    
        if ($ok == 0)       //Daca am erori, redirectez browserul catre formular
        {
            header("Location: AdaugaPacient.php");
            exit;
        }
    
        $Nume = ucfirst(stripslashes(htmlspecialchars(trim($_POST["Nume"]))));
        $Prenume = ucfirst(stripslashes(htmlspecialchars(trim($_POST["Prenume"]))));
        $Sex = stripslashes(htmlspecialchars(trim($_POST["Sex"])));
        $Data_nasterii = stripslashes(htmlspecialchars(trim($_POST["Data_nasterii"])));
        $CNP = stripslashes(htmlspecialchars(trim($_POST["CNP"])));
        $Telefon = stripslashes(htmlspecialchars(trim($_POST["Telefon"])));
        $E_mail = stripslashes(htmlspecialchars(trim($_POST["E_mail"])));
        $Varsta = varsta($Data_nasterii);
        $ID_judet = stripslashes(htmlspecialchars(trim($_POST["ID_judet"])));
        $Oras = stripslashes(htmlspecialchars(trim($_POST["Oras"])));
        $Strada = stripslashes(htmlspecialchars(trim($_POST["Strada"])));
        $Cod_postal = stripslashes(htmlspecialchars(trim($_POST["Cod_postal"])));
        $Numar = stripslashes(htmlspecialchars(trim($_POST["Numar"])));
        $Bloc = stripslashes(htmlspecialchars(trim($_POST["Bloc"])));
        $Apartament = stripslashes(htmlspecialchars(trim($_POST["Apartament"])));
    ?>
    <body>
        <div class="well" id="title-cyan">
            Adaugă pacient
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5"></div>
                <div class="col-md-2">
                    <?php
                        require 'constante.php';

                        $connection = mysqli_connect($host, $username, $password) or die ("Nu am putut sa ma conectez la serverul mysql");
                        
                        mysqli_select_db($connection, $database) or die (mysqli_error($connection));

                        $sql = "INSERT INTO `pacienti` (`Nume`, `Prenume`, `Sex`, `Data nasterii`, `CNP`, `Telefon`, `E-mail`, `Varsta`, `ID_judet`, `Oras`, `Strada`, `Cod postal`, `Numar`, `Bloc`, `Apartament`)
                                VALUES ('".$Nume."', '".$Prenume."', '".$Sex."', '".$Data_nasterii."', '".$CNP."', '".$Telefon."', '";
                                if ($E_mail)
                                    $sql.=$E_mail;
                                $sql.="', '".$Varsta."', '".$ID_judet."', '".$Oras."', '".$Strada."', '".$Cod_postal."', '";
                                if ($Numar)
                                    $sql.=$Numar;
                                $sql.="','";
                                if ($Bloc)
                                    $sql.=$Bloc;
                                $sql.="','";
                                if ($Apartament)
                                    $sql.=$Apartament;
                                $sql.="');";
                        $r = mysqli_query($connection, $sql); 

                        if ($r)
                        {
                            echo "<div class='alert alert-success' style='text-align: center;'>
                                    <span class='glyphicon glyphicon-ok'></span> Pacientul a fost adăugat cu succes.
                                </div>";
                        }
                        else
                            echo "<div class='alert alert-danger' style='text-align: center;'>
                                    <span class='glyphicon glyphicon-remove'></span> <strong>Atenție!</strong> Ceva nu a mers!
                                </div>";
                    ?>
                    <a href="Acasa.php" class="btn btn-cyan"><span class="glyphicon glyphicon-home"></span> Acasă</a>
                    <a href="VeziPacienti.php" class="btn btn-cyan"><span class="glyphicon glyphicon-eye-open"></span> Vezi pacienți</a>
                </div>
                <div class="col-md-5"></div>
            </div>
        </div>
    </body>
</html>