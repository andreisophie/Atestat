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
        $ok = $ok & validateInput("ID",1);
        $ok = $ok & validateInput("ID_medic",1);
        $ok = $ok & validateInput("ID_pacient",1);
        $ok = $ok & validateInput("Data");
        $ok = $ok & validateInput("Ora");
        $ok = $ok & validateInput("Observatii",-1);
    
        $ID = stripslashes(htmlspecialchars(trim($_POST["ID"])));

        if ($ok == 0)       //Daca am erori, redirectez browserul catre formular
        {
            header("Location: ModificaConsultatie.php?ID=".$ID);
            exit;
        }
    
        $ID_medic = stripslashes(htmlspecialchars(trim($_POST["ID_medic"])));
        $ID_pacient = stripslashes(htmlspecialchars(trim($_POST["ID_pacient"])));
        $Data = stripslashes(htmlspecialchars(trim($_POST["Data"])));
        $Ora = stripslashes(htmlspecialchars(trim($_POST["Ora"])));
        $Observatii = stripslashes(htmlspecialchars(trim($_POST["Observatii"])));
    ?>
    <body>
        <div class="well" id="title-yellow">
            Modifică consultație
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5"></div>
                <div class="col-md-2">
                    <?php
                        require 'constante.php';

                        $connection = mysqli_connect($host, $username, $password) or die ("Nu am putut sa ma conectez la serverul mysql");
                        
                        mysqli_select_db($connection, $database) or die (mysqli_error($connection));

                        $sql = "UPDATE `consultatii` SET `ID_pacient`='".$ID_pacient."', `ID_medic`='".$ID_medic."', `Data`='".$Data."', `Ora`='".$Ora."', 
                                `Observatii`='".$Observatii."' WHERE ID=".$ID.";";
                        $r = mysqli_query($connection, $sql); 

                        if ($r)
                        {
                            echo "<div class='alert alert-success' style='text-align: center;'>
                                    <span class='glyphicon glyphicon-ok'></span> Consultatia a fost modificată cu succes.
                                </div>";
                            $_SESSION = array();
                        }
                        else
                            echo "<div class='alert alert-danger' style='text-align: center;'>
                                    <span class='glyphicon glyphicon-remove'></span> <strong>Atenție!</strong> Ceva nu a mers!
                                </div>";
                    ?>
                    <a href="Acasa.php" class="btn btn-yellow"><span class="glyphicon glyphicon-home"></span> Acasă</a>
                    <a href="VeziConsultatii.php" class="btn btn-yellow"><span class="glyphicon glyphicon-eye-open"></span> Vezi consultații</a>
                </div>
                <div class="col-md-5"></div>
            </div>
        </div>
    </body>
</html>