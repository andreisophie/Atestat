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
            Șterge rețetă
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5"></div>
                <div class="col-md-2">
                    <?php
                        require 'constante.php';

                        $connection = mysqli_connect($host, $username, $password) or die ("Nu am putut sa ma conectez la serverul mysql");
                        
                        mysqli_select_db($connection, $database) or die (mysqli_error($connection));

                        $sql = "DELETE FROM retete WHERE ID=".$_GET["ID"].";";
                        $r = mysqli_query($connection, $sql); 

                        if ($r)
                            echo "<div class='alert alert-success' style='text-align: center;'>
                                    <span class='glyphicon glyphicon-ok'></span> Rețeta a fost ștearsă cu succes.
                                </div>";
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