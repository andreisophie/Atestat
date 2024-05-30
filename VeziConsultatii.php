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
            Tabela consultații
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

                        $connection = mysqli_connect($host, $username, $password) or die ("Nu am putut sa ma conectez la serverul mysql");
                        
                        mysqli_select_db($connection, $database) or die (mysqli_error($connection));

                        $sql3 = "SELECT ID, Nume, Prenume FROM pacienti ORDER BY Nume ASC;";  /*Extrag pacientii pentru filtrare*/
                        $r3 = mysqli_query($connection, $sql3); 

                        $sql4 = "SELECT d.ID, d.Nume, d.Prenume, s.Denumire FROM doctori as d   /*Extrag doctorii pentru filtrare*/
                                LEFT JOIN specializari AS s ON d.ID_specializare=s.ID ORDER BY s.Denumire, d.Nume ASC;"; 
                        $r4 = mysqli_query($connection, $sql4);
                    ?>
                    <fieldset>
                        <a href="Acasa.php" class="btn btn-yellow"><span class="glyphicon glyphicon-home"></span> Acasă</a>
                        <a href="AdaugaConsultatie.php" class="btn btn-yellow"><span class="glyphicon glyphicon-plus"></span> Adaugă consultație</a>
                    <fieldset><br/>
                    <fieldset  class="bg-yellow">
                        <form action="VeziConsultatii.php" method="get">
                            <p>
                                Filtrează:
                                <select name="ID_medic">
                                    <option value='0'>Toți doctorii</option>
                                    <?php 
                                        $ID=1;
                                        while ($row4 = mysqli_fetch_array($r4))
                                        {
                                            echo "<option value='".$row4["ID"]."'";
                                            if (isset($_GET["ID_medic"]))
                                                if ($_GET["ID_medic"]==$row4["ID"])
                                                    echo ' selected';
                                            echo ">".$ID++." - ".$row4["Nume"]." ".$row4["Prenume"]." - Medic ".lcfirst($row4["Denumire"])."</option>";
                                        }
                                    ?>
                                </select>
                                <select name="ID_pacient">
                                    <option value='0'>Toți pacienții</option>
                                    <?php 
                                        $ID=1;
                                        while ($row3 = mysqli_fetch_array($r3))
                                        {
                                            echo "<option value='".$row3["ID"]."'";
                                            if (isset($_GET["ID_pacient"]))
                                                if ($_GET["ID_pacient"]==$row3["ID"])
                                                    echo ' selected';
                                            echo ">".$ID++." - ".$row3["Nume"]." ".$row3["Prenume"]."</option>";
                                        }
                                    ?>
                                </select>
                                <input type="submit" class="btn btn-yellow" value="Y Filtrează"/>
                                <a href="VeziConsultatii.php" class="btn btn-yellow">¥ Șterge filtre</a>
                            </p>
                        </form>
                    </fieldset> <br/>
                    <?php

                        $sql = "SELECT COUNT(id) AS cnt FROM consultatii";
                        if (isset($_GET["ID_medic"]) && $_GET["ID_medic"]!=0)
                        {
                            $sql.=" WHERE ID_medic=".$_GET["ID_medic"];
                            if (isset($_GET["ID_pacient"]) && $_GET["ID_pacient"]!=0)
                                $sql.=" AND ID_pacient=".$_GET["ID_pacient"];
                        }
                        else
                            if (isset($_GET["ID_pacient"]) && $_GET["ID_pacient"]!=0)
                                $sql.=" WHERE ID_pacient=".$_GET["ID_pacient"];
                        $sql.=";"; 

                        $r = mysqli_query($connection, $sql);

                        $row=mysqli_fetch_assoc($r);
                        if ($row["cnt"] == 0)
                        {
                            echo   "<div class='alert alert-danger' style='text-align: center;'>
                                        <span class='glyphicon glyphicon-remove'></span> <span class='glyphicon glyphicon-trash'></span> <strong>Atenție!</strong> Nu există date in tabelă.
                                    </div>";
                            echo '<a href="Acasa.php" class="btn btn-info"><span class="glyphicon glyphicon-home"></span> Acasă</a>';
                            exit;
                        }
                        
                        $sql1 = "SELECT c.ID, COUNT(r.ID) AS nrr FROM consultatii AS c LEFT JOIN retete AS r ON r.ID_consultatie=c.ID";
                                if (isset($_GET["ID_medic"]) && $_GET["ID_medic"]!=0)
                                {
                                    $sql1.=" WHERE c.ID_medic=".$_GET["ID_medic"];
                                    if (isset($_GET["ID_pacient"]) && $_GET["ID_pacient"]!=0)
                                        $sql1.=" AND c.ID_pacient=".$_GET["ID_pacient"];
                                }
                                else
                                    if (isset($_GET["ID_pacient"]) && $_GET["ID_pacient"]!=0)
                                        $sql1.=" WHERE c.ID_pacient=".$_GET["ID_pacient"];
                                $sql1.=" GROUP BY c.ID ORDER BY c.ID;";  

                        $r1 = mysqli_query($connection, $sql1); 

                        $sql2 = "SELECT c.ID, c.Data, c.Ora, c.Observatii, p.Nume AS Nume_p, p.Prenume AS Prenume_p, d.Nume AS Nume_d, d.Prenume AS Prenume_d, r.Cantitate, 
                                r.ID AS ID_r, s.Denumire AS Denumire_s, m.Denumire FROM consultatii AS c LEFT JOIN pacienti AS p ON c.ID_pacient=p.ID 
                                LEFT JOIN doctori AS d ON c.ID_medic=d.ID LEFT JOIN specializari AS s ON d.ID_specializare=s.ID LEFT JOIN retete AS r ON r.ID_consultatie=c.ID 
                                LEFT JOIN medicamente AS m ON r.ID_medicament=m.ID";
                                if (isset($_GET["ID_medic"]) && $_GET["ID_medic"]!=0)
                                {
                                    $sql2.=" WHERE c.ID_medic=".$_GET["ID_medic"];
                                    if (isset($_GET["ID_pacient"]) && $_GET["ID_pacient"]!=0)
                                        $sql2.=" AND c.ID_pacient=".$_GET["ID_pacient"];
                                }
                                else
                                    if (isset($_GET["ID_pacient"]) && $_GET["ID_pacient"]!=0)
                                        $sql2.=" WHERE c.ID_pacient=".$_GET["ID_pacient"];
                                $sql2.=" ORDER BY c.ID ASC;";
                        
                        $r2 = mysqli_query($connection, $sql2); 
                    ?>
                    <table class="table">
                        <thead class="thead-yellow">
                            <tr>
                                <td class="id">ID</td>
                                <td>Specializare</td>
                                <td>Doctor</td>
                                <td>Pacient</td>
                                <td>Data și ora<br/>(zi.luna.an, ora:min)</td>
                                <td>Observații</td>
                                <td class="actions">Acțiuni consultație</td>
                                <td>Medicament</td>
                                <td>Cantitate</td>
                                <td class="actions">Acțiuni rețete</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i=1; $j=1; $ID=1;
                                while ($p = mysqli_fetch_array($r1))
                                {
                                    if ($i%2==0)
                                        echo "<tr class='bg-yellow'>";
                                    else
                                        echo "<tr bgcolor='#ffffff'>";
                                    $i++;
                                    $row=mysqli_fetch_array($r2);
                                    if ($j%2==0)
                                    {
                                        echo "<td rowspan='".($p["nrr"]+1)."' class='bg-yellow'>" . $ID++ . "</td>";
                                        echo "<td rowspan='".($p["nrr"]+1)."' class='bg-yellow'>Medic " . lcfirst($row["Denumire_s"]) . "</td>";
                                        echo "<td rowspan='".($p["nrr"]+1)."' class='bg-yellow'>" . $row["Nume_d"]." ".$row["Prenume_d"] . "</td>";
                                        echo "<td rowspan='".($p["nrr"]+1)."' class='bg-yellow'>" . $row["Nume_p"]." ".$row["Prenume_p"] . "</td>";
                                        $data=date_create($row["Data"]." ".$row["Ora"]);
                                        echo "<td rowspan='".($p["nrr"]+1)."' class='bg-yellow'>" .date_format($data,"d.m.Y, H:i")."</td>";
                                        echo "<td rowspan='".($p["nrr"]+1)."' class='bg-yellow'>" . $row["Observatii"] . "</td>";
                                        echo "<td rowspan='".($p["nrr"]+1)."' class='bg-yellow'><a class='glyphicon glyphicon-edit glyph-orange' href = 'ModificaConsultatie.php?ID=" . $row["ID"] . "' class='yellow'></a> 
                                            <a class='glyphicon glyphicon-trash glyph-orange' href = 'StergeConsultatie.php?ID=" . $row["ID"] . "'></a></td>";
                                    }
                                    else
                                    {    
                                        echo "<td rowspan='".($p["nrr"]+1)."' id='white'>" . $ID++ . "</td>";
                                        echo "<td rowspan='".($p["nrr"]+1)."' id='white'>Medic " . lcfirst($row["Denumire_s"]) . "</td>";
                                        echo "<td rowspan='".($p["nrr"]+1)."' id='white'>" . $row["Nume_d"]." ".$row["Prenume_d"] . "</td>";
                                        echo "<td rowspan='".($p["nrr"]+1)."' id='white'>" . $row["Nume_p"]." ".$row["Prenume_p"] . "</td>";
                                        $data=date_create($row["Data"]." ".$row["Ora"]);
                                        echo "<td rowspan='".($p["nrr"]+1)."' id='white'>" .date_format($data,"d.m.Y, H:i"). "</td>";
                                        echo "<td rowspan='".($p["nrr"]+1)."' id='white'>" . $row["Observatii"] . "</td>";
                                        echo "<td rowspan='".($p["nrr"]+1)." 'id='white'><a class='glyphicon glyphicon-edit glyph-orange' href = 'ModificaConsultatie.php?ID=" . $row["ID"] . "' id='white'></a> 
                                            <a class='glyphicon glyphicon-trash glyph-orange' href = 'StergeConsultatie.php?ID=" . $row["ID"] . "'></a></td>";
                                    }
                                    $j++;
                                    if ($row["Denumire"])
                                    {
                                        echo "<td>" . $row["Denumire"] . "</td>";
                                        echo "<td>" . $row["Cantitate"] . "</td>";  
                                        echo "<td><a class='glyphicon glyphicon-edit glyph-orange' href = 'ModificaReteta.php?ID=" . $row["ID_r"] . "'></a> 
                                            <a class='glyphicon glyphicon-trash glyph-orange' href = 'StergeReteta.php?ID=" . $row["ID_r"] . "'></a></td>";
                                        echo "</tr>";
                                        for ($k=2;  $k<=$p["nrr"]; $k++)
                                        {
                                            $row=mysqli_fetch_array($r2);
                                            if ($i%2==0)
                                                echo "<tr class='bg-yellow'>";
                                            else
                                                echo "<tr bgcolor='#ffffff'>";
                                            $i++;
                                            echo "<td>" . $row["Denumire"] . "</td>";
                                            echo "<td>" . $row["Cantitate"] . "</td>";  
                                            echo "<td><a class='glyphicon glyphicon-edit glyph-orange' href = 'ModificaReteta.php?ID=" . $row["ID_r"] . "'></a> 
                                                <a class='glyphicon glyphicon-trash glyph-orange' href = 'StergeReteta.php?ID=" . $row["ID_r"] . "'></a></td>";
                                            echo "</tr>";
                                        }
                                        if ($i%2==0)
                                            echo "<tr class='bg-yellow'>";
                                        else
                                            echo "<tr bgcolor='#ffffff'>";
                                        $i++;
                                        echo "<td colspan=3><a href='AdaugaReteta.php?ID_consultatie=".$row["ID"]."' class='btn btn-yellow'>
                                            <span class='glyphicon glyphicon-plus'></span> Adaugă rețetă</a></td></tr>";
                                    }
                                    else
                                    {
                                        echo "<td colspan=3><a href='AdaugaReteta.php?ID_consultatie=".$row["ID"]."' class='btn btn-yellow'>
                                            <span class='glyphicon glyphicon-plus'></span> Adaugă rețetă</a></td></tr>";
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                    <a href="Acasa.php" class="btn btn-yellow"><span class="glyphicon glyphicon-home"></span> Acasă</a>
                    <a href="AdaugaConsultatie.php" class="btn btn-yellow"><span class="glyphicon glyphicon-plus"></span> Adaugă consultație</a>
                </div>
                <div class="col-md-1"></div>
                </div>
            </div>
        </div> 
    </body>
</html>