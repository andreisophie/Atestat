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
            Tabela pacienți
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <?php
                        session_start();
                        session_unset();
                        session_destroy();
                        
                        require 'constante.php';

                        $connection = mysqli_connect($host, $username, $password) or 
                            die ("Nu am putut sa ma conectez la serverul mysql");
                        
                        mysqli_select_db($connection, $database) or die (mysqli_error($connection));

                        $sql = "SELECT COUNT(id) AS cnt FROM pacienti";
                        $r = mysqli_query($connection, $sql); 
                        $row = mysqli_fetch_array($r);

                        if ($row["cnt"] == 0)
                        {
                            echo   "<div class='alert alert-danger' style='text-align: center;'>
                                    <span class='glyphicon glyphicon-remove'></span> <strong>Atenție!</strong> Nu există date in tabelă.
                                    </div>";
                            echo '<a href="Acasa.php" class="btn btn-cyan"><span class="glyphicon glyphicon-home"></span> Acasă</a>';
                            exit;
                        }

                        $sql = "SELECT p.ID, p.Nume, p.Prenume, p.Sex, p.`Data nasterii`, p.CNP, p.Telefon, p.`E-mail`, p.Varsta, 
                                j.Nume AS Judet, p.Oras, p.Strada, p.`Cod postal`, p.Numar, p.Bloc, p.Apartament FROM pacienti AS p 
                                LEFT JOIN judete AS j ON p.ID_judet=j.ID ORDER BY p.Nume ASC";
                        $r = mysqli_query($connection, $sql); 
                    ?>
                    <fieldset>
                        <a href="Acasa.php" class="btn btn-cyan"><span class="glyphicon glyphicon-home"></span> Acasă</a>
                        <a href="AdaugaPacient.php" class="btn btn-cyan"><span class="glyphicon glyphicon-plus"></span> Adaugă pacient</a>
                    </fieldset><br/>
                    <table class="table">
                        <thead class="thead-cyan">
                            <tr>
                                <td class="id">ID</td>
                                <td>Nume</td>
                                <td>Prenume</td>
                                <td>Sex</td>
                                <td>Data nașterii<br/>(zi.luna.an)</td>
                                <td>CNP</td>
                                <td>Telefon</td>
                                <td>E-mail</td>
                                <td>Vârstă</td>
                                <td>Județ</td>
                                <td>Oraș</td>
                                <td>Adresă</td>
                                <td>Cod poștal</td>
                                <td class="actions">Acțiuni</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i=1;   $ID=1;
                                while ($row = mysqli_fetch_array($r))
                                {
                                    if ($i%2==0)
                                        echo "<tr class='bg-cyan'>";
                                    else
                                        echo "<tr bgcolor='#ffffff'>";
                                    $i++;
                                    echo "<td>" . $ID++ . "</td>";
                                    echo "<td>" . $row["Nume"] . "</td>";
                                    echo "<td>" . $row["Prenume"] . "</td>";
                                    echo "<td>" . $row["Sex"] . "</td>";
                                    $data=date_create($row["Data nasterii"]);
                                    echo "<td>" . date_format($data,"d.m.Y") . "</td>";
                                    echo "<td>" . $row["CNP"] . "</td>";
                                    echo "<td>" . $row["Telefon"] . "</td>";
                                    echo "<td>" . $row["E-mail"] . "</td>";
                                    echo "<td>" . $row["Varsta"] . "</td>";
                                    echo "<td>" . $row["Judet"] . "</td>";
                                    echo "<td>" . $row["Oras"] . "</td>";
                                    $adresa=$row["Strada"];
                                    if ($row["Numar"])
                                        $adresa.=", Nr ".$row["Numar"];
                                    if ($row["Bloc"])
                                        $adresa.=", Bloc ".$row["Bloc"];
                                    if ($row["Apartament"])
                                        $adresa.=", Ap ".$row["Apartament"];
                                    echo "<td>" . $adresa . "</td>";
                                    echo "<td>" . $row["Cod postal"] . "</td>";
                                    echo "<td><a class='glyphicon glyphicon-edit glyph-cyan' href = 'ModificaPacient.php?ID=" . $row["ID"] . "'></a> 
                                        <a class='glyphicon glyphicon-trash glyph-cyan' href = 'StergePacient.php?ID=" . $row["ID"] . "'></a></td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                    <a href="Acasa.php" class="btn btn-cyan"><span class="glyphicon glyphicon-home"></span> Acasă</a>
                    <a href="AdaugaPacient.php" class="btn btn-cyan"><span class="glyphicon glyphicon-plus"></span> Adaugă pacient</a>
                </div>
                <div class="col-md-1"></div>
                </div>
            </div>
        </div> 
    </body>
</html>