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
        <style>
            table, tr, td {
                border: 1px solid #fbecd0;
            }
        </style>
        <script>
            $(document).ready(function()
            {
                $('[data-toggle="tooltip"]').tooltip();   
            });
        </script>
    </head>
    <?php
        session_start();

        require 'constante.php';

        $connection = mysqli_connect($host, $username, $password) or die ("Nu am putut sa ma conectez la serverul mysql");
        
        mysqli_select_db($connection, $database) or die (mysqli_error($connection));

        $sql0 = "SELECT ID, ID_consultatie, ID_medicament, Cantitate FROM retete WHERE ID=".$_GET["ID"].";";
        $r0 = mysqli_query($connection, $sql0);
        $row0=mysqli_fetch_assoc($r0);

        $sql1 = "SELECT c.ID, c.Data, c.Ora, p.Nume AS Nume_p, p.Prenume AS Prenume_p, d.Nume AS Nume_d, d.Prenume AS Prenume_d, s.Denumire AS Denumire_s FROM consultatii AS c 
                LEFT JOIN pacienti AS p ON c.ID_pacient=p.ID LEFT JOIN doctori AS d ON c.ID_medic=d.ID LEFT JOIN specializari AS s ON d.ID_specializare=s.ID ORDER BY c.ID ASC";
        $r1 = mysqli_query($connection, $sql1); 

        $sql2 = "SELECT ID, Denumire FROM medicamente ORDER BY ID ASC;";
        $r2 = mysqli_query($connection, $sql2); 
    ?>
    <body>
        <div class="well" id="title-yellow">
            Modifică rețetă
        </div>
        <div class="container-fluid">
            <form action="ModificaRetetaConfirm.php" method="post">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <fieldset  class="bg-yellow">
                            <header>Consultație</header>
                            <?php 
                                echo "<input type = 'hidden' name = 'ID' value='".$row0["ID"]."'/>";    
                                if (isset($_SESSION["errorID"]))
                                {
                                    echo "</td><td class='error'>"; 
                                    switch($_SESSION["errorID"])
                                    {
                                        case 1: echo "Hackere!"; break;
                                        case 2: echo "Acest câmp trebuie completat!"; break;  
                                        case 3: echo "Introdu un număr valid!"; break;  
                                        case 4: echo "Selectează un câmp valid!"; break;                                      
                                    }                                    
                                }
                            ?>
                            <table class="table">
                                <tr>
                                    <td class="legenda">Consultație<star>*</star></td>
                                    <td>
                                        <select name="ID_consultatie">
                                        <?php 
                                            $ID=1;
                                            while ($row1 = mysqli_fetch_array($r1))
                                            {
                                                $data=date_create($row1["Data"]." ".$row1["Ora"]);
                                                echo "<option value='".$row1["ID"]."'";
                                                if ($row0["ID_consultatie"]==$row1["ID"])
                                                    echo ' style="font-weight: bold;"';
                                                if (isset($_SESSION["valoareID_consultatie"]))
                                                {
                                                    if ($_SESSION["valoareID_consultatie"]==$row1["ID"])
                                                        echo ' selected';
                                                }
                                                else
                                                    if ($row0["ID_consultatie"]==$row1["ID"])
                                                        echo ' selected';
                                                echo ">".$ID++." - Medic " . lcfirst($row1["Denumire_s"])." ".$row1["Nume_d"]." ".$row1["Prenume_d"]." - ".$row1["Nume_p"]." ".
                                                    $row1["Prenume_p"]." - ".date_format($data,"d.m.Y, H:i")."</option>";
                                            }
                                        ?>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </fieldset> <br/>
                        <fieldset  class="bg-yellow">
                            <header>Conținut rețetă</header>
                            <table class="table">
                                <tr>
                                    <td class="legenda">Medicament<star>*</star></td>
                                    <td>
                                        <select name="ID_medicament">
                                        <?php 
                                            $ID=1;
                                            while ($row2 = mysqli_fetch_array($r2))
                                            {
                                                echo "<option value='".$row2["ID"]."'";
                                                if ($row0["ID_medicament"]==$row2["ID"])
                                                    echo ' style="font-weight: bold;"';
                                                if (isset($_SESSION["valoareID_medicament"]))
                                                {
                                                    if ($_SESSION["valoareID_medicament"]==$row2["ID"])
                                                        echo ' selected';
                                                }
                                                else
                                                    if ($row0["ID_medicament"]==$row2["ID"])
                                                        echo ' selected';
                                                echo ">".$ID++." - ".$row2["Denumire"]."</option>";
                                            }
                                        ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="legenda">Cantitate<star>*</star></td>
                                    <td>
                                        <?php 
                                            $in  = "<input type = 'text' name = 'Cantitate' data-toggle='tooltip' title='Valoarea inițială: ";
                                            $in.=$row0["Cantitate"];
                                            $in.="'";
                                            if (isset($_SESSION["valoareCantitate"]))
                                                $in .= " value = '" . $_SESSION["valoareCantitate"] . "'";
                                            else
                                                $in .= " value = '" . $row0["Cantitate"] . "'";
                                            $in .= "/>";
                                            echo $in;           
                                            if (isset($_SESSION["errorCantitate"]))
                                            {
                                                echo "</td><td class='error'>"; 
                                                switch($_SESSION["errorCantitate"])
                                                {
                                                    case 1: echo "Hackere!"; break;
                                                    case 2: echo "Acest câmp trebuie completat!"; break;  
                                                    case 3: echo "Introdu un număr valid!"; break;  
                                                    case 4: echo "Selectează un câmp valid!"; break;                                      
                                                }                                    
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"> Câmpurile marcate cu <star>*</star> sunt obligatorii.</td>
                                </tr>
                            </table>
                        </fieldset>
                        <br/>
                        <fieldset>
                            <a href="Acasa.php" class="btn btn-yellow"><span class="glyphicon glyphicon-home"></span> Acasă</a>
                            <a href="VeziConsultatii.php" class="btn btn-yellow"><span class="glyphicon glyphicon-eye-open"></span> Vezi consultații</a>
                            <input type="submit" value="✓ Trimite" class="btn btn-yellow"/>
                        </fieldset>  
                    </form>
                </div>
                <div class="col-md-3"></div>
                </div>
            </div>
        </div> 
    </body>
</html>