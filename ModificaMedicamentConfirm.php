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
        
        $ok = 1;
        $ok = $ok & validateInput("ID");
        $ok = $ok & validateInput("Denumire");

        $ID = stripslashes(htmlspecialchars(trim($_POST["ID"])));
    
        if ($ok == 0)       //Daca am erori, redirectez browserul catre formular
        {
            header("Location: ModificaMedicament.php?ID=".$ID);
            exit;
        }
    
        $Denumire = stripslashes(htmlspecialchars(trim($_POST["Denumire"])));
    ?>
    <body>
        <div class="well" id="title-blue">
            Modifică medicament
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5"></div>
                <div class="col-md-2">
                    <?php
                        require 'constante.php';

                        $connection = mysqli_connect($host, $username, $password) or die ("Nu am putut sa ma conectez la serverul mysql");
                        
                        mysqli_select_db($connection, $database) or die (mysqli_error($connection));

                        $sqlv="SELECT Denumire FROM medicamente WHERE Denumire='".$Denumire."';";
                        $rv=mysqli_query($connection, $sqlv); 
                        $rowv=mysqli_fetch_assoc($rv);

                        if (isset($rowv["Denumire"]))
                        {
                            echo "<div class='alert alert-warning' style='text-align: center;'>
                                    <span class='glyphicon glyphicon-exclamation-sign'></span> <strong>Atenție!</strong> Această intrare există deja în tabelă!
                                </div>";
                        }
                        else
                        {
                            $sql = "UPDATE `medicamente` SET Denumire='".$Denumire."' WHERE ID=".$ID.";";
                            $r = mysqli_query($connection, $sql); 
    
                            if ($r)
                            {
                                echo "<div class='alert alert-success' style='text-align: center;'>
                                        <span class='glyphicon glyphicon-ok'></span> Medicamentul a fost modificat cu succes.
                                    </div>";
                                $_SESSION = array();
                            }
                            else
                                echo "<div class='alert alert-danger' style='text-align: center;'>
                                        <span class='glyphicon glyphicon-remove'></span> <strong>Atenție!</strong> Ceva nu a mers!
                                    </div>";
                        }
                    ?>
                    <a href="Acasa.php" class="btn btn-primary"><span class="glyphicon glyphicon-home"></span> Acasă</a>
                    <a href="VeziMedicamente.php" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open"></span> Vezi medicamente</a>
                </div>
                <div class="col-md-5"></div>
            </div>
        </div>
    </body>
</html>