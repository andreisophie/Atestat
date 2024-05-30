<html>
    <head>
        <title>Specializări</title>
        <link rel="icon" href="https://cdn3.iconfinder.com/data/icons/health/100/hospital-512.png">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="Interfata.css">
    </head>
    <body>
        <div class="well" id="title-orange">
            Tabela specializări
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <?php
                        session_start();
                        session_unset();
                        session_destroy();

                        require 'constante.php';

                        $connection = mysqli_connect($host, $username, $password) or die ("Nu am putut sa ma conectez la serverul mysql");
                        
                        mysqli_select_db($connection, $database) or die (mysqli_error($connection));

                        $sql = "SELECT COUNT(id) AS cnt FROM specializari";
                        $r = mysqli_query($connection, $sql); 
                        $row = mysqli_fetch_array($r);

                        if ($row["cnt"] == 0)
                        {
                            echo   "<div class='alert alert-danger' style='text-align: center;'>
                                        <span class='glyphicon glyphicon-remove'></span> <strong>Atenție!</strong> Nu există date in tabelă.
                                    </div>";
                            echo '<a href="Acasa.php" class="btn btn-orange"><span class="glyphicon glyphicon-home"></span> Acasă</a>';
                            exit;
                        }

                        $sql = "SELECT * FROM specializari ORDER BY Denumire ASC";
                        $r = mysqli_query($connection, $sql); 
                    ?>
                    <fieldset>
                        <a href="Acasa.php" class="btn btn-orange"><span class="glyphicon glyphicon-home"></span> Acasă</a>
                        <a href="AdaugaSpecializare.php" class="btn btn-orange"><span class="glyphicon glyphicon-plus"></span> Adaugă specializare</a>
                    </fieldset><br/>
                    <table class="table">
                        <thead class="thead-orange">
                            <tr>
                                <td class="id">ID</td>
                                <td>Denumire</td>
                                <td>Salariu de bază</td>
                                <td>Acțiuni</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i=1;   $ID=1;
                                while ($row = mysqli_fetch_array($r))
                                {
                                    if ($i%2==0)
                                        echo "<tr class='bg-orange'>";
                                    else
                                        echo "<tr bgcolor='#ffffff'>";
                                    $i++;
                                    echo "<td>" . $ID++ . "</td>";
                                    echo "<td>" . ucfirst($row["Denumire"]) . "</td>";
                                    echo "<td>" . $row["Salariu_baza"] . "</td>";
                                    echo "<td><a class='glyphicon glyphicon-edit glyph-orange' href = 'ModificaSpecializare.php?ID=" . $row["ID"] . "'></a>
                                        <a class='glyphicon glyphicon-trash glyph-orange' href = 'StergeSpecializare.php?ID=" . $row["ID"] . "'></a></td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                    <a href="Acasa.php" class="btn btn-orange"><span class="glyphicon glyphicon-home"></span> Acasă</a>
                    <a href="AdaugaSpecializare.php" class="btn btn-orange"><span class="glyphicon glyphicon-plus"></span> Adaugă specializare</a>
                </div>
                <div class="col-md-4"></div>
                </div>
            </div>
        </div> 
    </body>
</html>