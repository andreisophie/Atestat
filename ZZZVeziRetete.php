<html>
    <head>
        <title>Rețete</title>
        <link rel="icon" href="https://cdn3.iconfinder.com/data/icons/health/100/hospital-512.png">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="Interfata.css">
        <style>
            .glyphicon-edit, .glyphicon-trash{
                color: #ff3333;
            }
        </style>
    </head>
    <body>
        <div class="well" id="title-yellow">
            Tabela rețete
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <?php
                        session_start();
                        session_unset();
                        session_destroy();
                        
                        require 'constante.php';

                        $connection = mysqli_connect($host, $username, $password) or die ("Nu am putut sa ma conectez la serverul mysql");
                        
                        mysqli_select_db($connection, $database) or die (mysqli_error($connection));

                        $sql = "SELECT COUNT(id) AS cnt FROM retete";
                        $r = mysqli_query($connection, $sql); 
                        $row = mysqli_fetch_array($r);

                        if ($row["cnt"] == 0)
                        {
                            echo   "<div class='alert alert-warning' style='text-align: center;'>
                                        <strong>Atenție!</strong> Nu există date in tabelă.
                                    </div>";
                            echo '<a href="Acasa.php" class="btn btn-info"><span class="glyphicon glyphicon-home"></span> Acasă</a>';
                            exit;
                        }

                        $sql1 = "SELECT p.ID, COUNT(r.ID) AS nrr FROM pacienti AS p RIGHT JOIN retete AS r ON r.ID_pacient=p.ID GROUP BY p.ID ORDER BY p.ID";
                        $r1 = mysqli_query($connection, $sql1); 

                        $sql2 = "SELECT p.ID, p.Nume, p.Prenume, m.Denumire, r.ID AS ID_r, r.Cantitate FROM retete AS r RIGHT JOIN pacienti AS p ON r.ID_pacient=p.ID 
                                RIGHT JOIN medicamente AS m ON r.ID_medicament=m.ID ORDER BY p.ID";
                        $r2 = mysqli_query($connection, $sql2); 
                    ?>
                    <table class="table">
                        <thead-orange>
                            <tr>
                                <td class="id">ID</td>
                                <td>Pacient</td>
                                <td>Medicament</td>
                                <td>Cantitate</td>
                                <td class="actions">Acțiuni</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i=1; $j=1;
                                while ($p = mysqli_fetch_array($r1))
                                {
                                    if ($i%2==0)
                                        echo "<tr class='danger'>";
                                    else
                                        echo "<tr bgcolor='#ffffff'>";
                                    $i++;
                                    $row=mysqli_fetch_array($r2);
                                    if ($j%2==0)
                                    {
                                        echo "<td rowspan='".$p["nrr"]."' class='danger'>" . $row["ID"] . "</td>";
                                        echo "<td rowspan='".$p["nrr"]."' class='danger'>" . $row["Nume"]." ".$row["Prenume"] . "</td>";
                                    }
                                    else
                                    {    
                                        echo "<td rowspan='".$p["nrr"]."' id='white'>" . $row["ID"] . "</td>";
                                        echo "<td rowspan='".$p["nrr"]."' id='white'>" . $row["Nume"]." ".$row["Prenume"] . "</td>";
                                    }
                                    $j++;
                                    echo "<td>" . $row["Denumire"] . "</td>";
                                    echo "<td>" . $row["Cantitate"] . "</td>";  
                                    echo "<td><a class='glyphicon glyphicon-edit' href = '###" . $row["ID_r"] . "'></a> 
                                        <a class='glyphicon glyphicon-trash' href = 'StergeReteta.php?ID=" . $row["ID_r"] . "'></a></td>";
                                    echo "</tr>";
                                    for ($k=2;  $k<=$p["nrr"]; $k++)
                                    {
                                        $row=mysqli_fetch_array($r2);
                                        if ($i%2==0)
                                            echo "<tr class='danger'>";
                                        else
                                            echo "<tr bgcolor='#ffffff'>";
                                        $i++;
                                        echo "<td>" . $row["Denumire"] . "</td>";
                                        echo "<td>" . $row["Cantitate"] . "</td>";  
                                        echo "<td><a class='glyphicon glyphicon-edit' href = '###" . $row["ID_r"] . "'></a> 
                                            <a class='glyphicon glyphicon-trash' href = 'StergeReteta.php?ID=" . $row["ID_r"] . "'></a></td>";
                                        echo "</tr>";
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                    <a href="Acasa.php" class="btn btn-danger"><span class="glyphicon glyphicon-home"></span> Acasă</a>
                </div>
                <div class="col-md-3"></div>
                </div>
            </div>
        </div> 
    </body>
</html>