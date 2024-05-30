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
    <body>
        <div class="well" id="title-cyan">
            Șterge pacient
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <?php
                        require 'constante.php';

                        $connection = mysqli_connect($host, $username, $password) or die ("Nu am putut sa ma conectez la serverul mysql");
                        
                        mysqli_select_db($connection, $database) or die (mysqli_error($connection));

                        $sql = "SELECT ID, Nume, Prenume FROM pacienti WHERE ID=".$_GET["ID"].";";
                        $r = mysqli_query($connection, $sql);
                        $row=mysqli_fetch_assoc($r);

                        echo "<div class='alert alert-warning' style='text-align: center;'>
                                Sigur vrei să ștergi intrarea<br/><b>";
                        echo $row["Nume"]." ".$row["Prenume"]."</b><br/>";
                        echo "din tabela pacienti?
                            </div>";

                        echo '<a href="VeziPacienti.php" class="btn btn-cyan"><span class="glyphicon glyphicon-eye-open"></span> Vezi pacienți</a>
                            <a href="StergePacientConfirm.php?ID='.stripslashes(htmlspecialchars(trim($_GET["ID"]))).'" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Șterge</a>';
                    ?>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </body>
</html>