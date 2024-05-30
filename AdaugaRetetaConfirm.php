<html>
    <head>
        <title>Consultații</title>
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

        require 'constante.php';

        $connection = mysqli_connect($host, $username, $password) or die ("Nu am putut sa ma conectez la serverul mysql");
        
        mysqli_select_db($connection, $database) or die (mysqli_error($connection));

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
    
            return 1;
        }

        function do_query($nr)
        {
            global $connection;

            $ok = 1;
            $ok = $ok & validateInput("ID_consultatie",1);
            $ok = $ok & validateInput("ID_medicament".$nr,1);
            $ok = $ok & validateInput("Cantitate".$nr);

            $ID_consultatie = stripslashes(htmlspecialchars(trim($_POST["ID_consultatie"])));
        
            if ($ok == 0)       //Daca am erori, redirectez browserul catre formular
            {
                header("Location: AdaugaReteta.php?ID_consultatie=".$ID_consultatie);
                exit;
            }

            $ID_medicament = stripslashes(htmlspecialchars(trim($_POST["ID_medicament".$nr])));
            $Cantitate = stripslashes(htmlspecialchars(trim($_POST["Cantitate".$nr])));

            $sqlv="SELECT ID_medicament FROM retete WHERE ID_consultatie='".$ID_consultatie."' AND ID_medicament='".$ID_medicament."';";
            $rv=mysqli_query($connection, $sqlv); 
            $rowv=mysqli_fetch_assoc($rv);

            if (isset($rowv["ID_medicament"]))
            {
                echo "<div class='alert alert-warning' style='text-align: center;'>
                        <span class='glyphicon glyphicon-exclamation-sign'></span> <strong>Atenție!</strong> Acest medicament este deja prescris pacientului!
                    </div>";
            }
            else
            {
                $sql = "INSERT INTO `retete` (`ID_consultatie`, `ID_medicament`, `Cantitate`) VALUES ('".$ID_consultatie."', '".$ID_medicament."', '".$Cantitate."');";
                $r = mysqli_query($connection, $sql); 
    
                if ($r)
                {
                    echo "<div class='alert alert-success' style='text-align: center;'>
                            <span class='glyphicon glyphicon-ok'></span> Rețeta ".$nr." a fost adăugată cu succes.
                        </div>";
                    $_SESSION = array();
                }
                else
                    echo "<div class='alert alert-danger' style='text-align: center;'>
                            <span class='glyphicon glyphicon-remove'></span> <strong>Atenție!</strong>  Rețeta ".$nr." nu a putut fi adăugată!
                        </div>";
            }
        }
    ?>
    <body>
        <div class="well" id="title-yellow">
            Adaugă consultație
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <?php
                        for ($i=1;$i<=4;$i++)
                            if (isset($_POST["Trimite".$i]) &&  stripslashes(htmlspecialchars(trim($_POST["Trimite".$i])))=="true")
                                do_query($i);
                            else
                                echo "<div class='alert alert-warning' style='text-align: center;'>
                                        <span class='glyphicon glyphicon-exclamation-sign'></span>  Rețeta ".$i." a fost ignorată.
                                    </div>";
                    ?>
                    <a href="Acasa.php" class="btn btn-yellow"><span class="glyphicon glyphicon-home"></span> Acasă</a>
                    <a href="VeziConsultatii.php" class="btn btn-yellow"><span class="glyphicon glyphicon-eye-open"></span> Vezi consultații</a>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </body>
</html>