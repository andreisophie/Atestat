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
        $ok = $ok & validateInput("ID_consultatie",1);
        $ok = $ok & validateInput("ID_medicament",1);
        $ok = $ok & validateInput("Cantitate");

        $ID = stripslashes(htmlspecialchars(trim($_POST["ID"])));
    
        if ($ok == 0)       //Daca am erori, redirectez browserul catre formular
        {
            header("Location: ModificaReteta.php?ID=".$ID);
            exit;
        }
    
        $ID_consultatie = stripslashes(htmlspecialchars(trim($_POST["ID_consultatie"])));
        $ID_medicament = stripslashes(htmlspecialchars(trim($_POST["ID_medicament"])));
        $Cantitate = stripslashes(htmlspecialchars(trim($_POST["Cantitate"])));
    ?>
    <body>
        <div class="well" id="title-yellow">
            Modifică consultație
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <?php
                        require 'constante.php';

                        $connection = mysqli_connect($host, $username, $password) or die ("Nu am putut sa ma conectez la serverul mysql");
                        
                        mysqli_select_db($connection, $database) or die (mysqli_error($connection));

                        $sql = "UPDATE `retete` SET `ID_consultatie`='".$ID_consultatie."', `ID_medicament`='".$ID_medicament."', `Cantitate`='".$Cantitate."' WHERE ID=".$ID.";";
                        $r = mysqli_query($connection, $sql); 

                        if ($r)
                        {
                            echo "<div class='alert alert-success' style='text-align: center;'>
                                    <span class='glyphicon glyphicon-ok'></span> Rețeta a fost modificată cu succes.
                                </div>";
                            $_SESSION = array();
                        }
                        else
                            echo "<div class='alert alert-warning' style='text-align: center;'>
                                    <span class='glyphicon glyphicon-remove'></span> <strong>Atenție!</strong> Ceva nu a mers!
                                </div>";
                    ?>
                    <a href="Acasa.php" class="btn btn-yellow"><span class="glyphicon glyphicon-home"></span> Acasă</a>
                    <a href="VeziConsultatii.php" class="btn btn-yellow"><span class="glyphicon glyphicon-eye-open"></span> Vezi consultații</a>
                    <a href="AdaugaReteta.php" class="btn btn-yellow"><span class="glyphicon glyphicon-plus"></span> Adaugă rețetă</a>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </body>
</html>