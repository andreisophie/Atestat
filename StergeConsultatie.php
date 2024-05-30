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
    <body>
        <div class="well" id="title-yellow">
            Șterge consultație
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <?php
                        require 'constante.php';

                        $connection = mysqli_connect($host, $username, $password) or die ("Nu am putut sa ma conectez la serverul mysql");
                        
                        mysqli_select_db($connection, $database) or die (mysqli_error($connection));

                        $sql = "SELECT c.ID, c.Data, c.Ora, p.Nume AS Nume_p, p.Prenume AS Prenume_p, d.Nume AS Nume_d, d.Prenume AS Prenume_d, s.Denumire AS Denumire_s FROM consultatii AS c 
                        LEFT JOIN pacienti AS p ON c.ID_pacient=p.ID LEFT JOIN doctori AS d ON c.ID_medic=d.ID LEFT JOIN specializari AS s ON d.ID_specializare=s.ID WHERE c.ID=".$_GET["ID"]."";
                        $r = mysqli_query($connection, $sql);
                        $row=mysqli_fetch_assoc($r);
                        $data=date_create($row["Data"]." ".$row["Ora"]);

                        echo "<div class='alert alert-warning' style='text-align: center;'>
                                Sigur vrei să ștergi intrarea<br/><b>";
                        echo "Medic " . lcfirst($row["Denumire_s"])." ".$row["Nume_d"]." ".$row["Prenume_d"]." - ".$row["Nume_p"]." ".
                            $row["Prenume_p"]." - ".date_format($data,"d.m.Y, H:i")."</b><br/>";
                        echo "din tabela consultații?
                            </div>";

                        echo '<a href="VeziConsultatii.php" class="btn btn-yellow"><span class="glyphicon glyphicon-eye-open"></span> Vezi consultații</a>
                            <a href="StergeConsultatieConfirm.php?ID='.stripslashes(htmlspecialchars(trim($_GET["ID"]))).'" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Șterge</a>';
                    ?>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </body>
</html>