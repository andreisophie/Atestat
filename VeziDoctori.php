<html>
    <head>
        <title>Doctori</title>
        <link rel="icon" href="https://cdn3.iconfinder.com/data/icons/health/100/hospital-512.png">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="Interfata.css">
    </head>
    <body>
        <div class="well" id="title-purple">
            Tabela doctori
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?php
                        session_start();
                        session_unset();
                        session_destroy();

                        require 'constante.php';

                        $connection = mysqli_connect($host, $username, $password) or die ("Nu am putut sa ma conectez la serverul mysql");
                        
                        mysqli_select_db($connection, $database) or die (mysqli_error($connection));

                        $sql = "SELECT COUNT(ID) AS cnt FROM doctori";
                        $r = mysqli_query($connection, $sql); 
                        $row = mysqli_fetch_array($r);

                        if ($row["cnt"] == 0)
                        {
                            echo   "<div class='alert alert-danger' style='text-align: center;'>
                                        <span class='glyphicon glyphicon-remove'></span> <strong>Atenție!</strong> Nu există date in tabelă.
                                    </div>";
                            echo '<a href="Acasa.php" class="btn btn-purple"><span class="glyphicon glyphicon-home"></span> Acasă</a>';
                            exit;
                        }

                        $sql = "SELECT d.`ID`, d.`Nume`, d.`Prenume`, d.`Sex`, d.`Data nasterii`, d.`CNP`, d.`Varsta`, d.`E-mail`, d.`Telefon`, d.`Sporuri salariu`, 
                                d.`Data angajarii`, d.`ID_specializare`, j.`Nume` AS Judet, d.`Oras`, d.`Strada`, d.`Cod postal`, d.`Numar`, d.`Bloc`, d.`Apartament`, 
                                s.ID AS ID_s, s.Denumire, s.Salariu_baza FROM doctori AS d LEFT JOIN judete AS j ON d.ID_judet=j.ID 
                                LEFT JOIN specializari AS s ON d.ID_specializare=s.ID ORDER BY d.Nume ASC";
                        $r = mysqli_query($connection, $sql); 
                    ?>
                    <fieldset>
                        <a href="Acasa.php" class="btn btn-purple"><span class="glyphicon glyphicon-home"></span> Acasă</a>
                        <a href="AdaugaDoctor.php" class="btn btn-purple"><span class="glyphicon glyphicon-plus"></span> Adaugă doctor</a>
                    </fieldset><br/>
                    <table class="table">
                        <thead class="thead-purple">
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
                                <td>Specializare</td>
                                <td>Salariu de bază</td>
                                <td>Sporuri salariu</td>
                                <td>Salariu total</td>
                                <td>Data angajării<br/>(zi.luna.an)</td>
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
                                        echo "<tr class='bg-purple'>";
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
                                    echo "<td>Medic " . lcfirst($row["Denumire"]) . "</td>";
                                    echo "<td>" . $row["Salariu_baza"] . "</td>";
                                    echo "<td>" . $row["Sporuri salariu"] . "</td>";
                                    echo "<td>" . ($row["Salariu_baza"]+$row["Sporuri salariu"]) . "</td>";
                                    $data=date_create($row["Data angajarii"]);
                                    echo "<td>" . date_format($data,"d.m.Y") . "</td>";
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
                                    echo "<td><a class='glyphicon glyphicon-edit glyph-purple' href = 'ModificaDoctor.php?ID=" . $row["ID"] . "'></a>
                                        <a class='glyphicon glyphicon-trash glyph-purple' href = 'StergeDoctor.php?ID=" . $row["ID"] . "'></a></td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                    <a href="Acasa.php" class="btn btn-purple"><span class="glyphicon glyphicon-home"></span> Acasă</a>
                    <a href="AdaugaDoctor.php" class="btn btn-purple"><span class="glyphicon glyphicon-plus"></span> Adaugă doctor</a>
                </div>
            </div>
        </div> 
    </body>
</html>