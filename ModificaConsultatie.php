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

        $sql0 = "SELECT ID, ID_medic, ID_pacient, Data, Ora, Observatii FROM consultatii WHERE ID=".$_GET["ID"].";";
        $r0 = mysqli_query($connection, $sql0);
        $row0=mysqli_fetch_assoc($r0);

        $sql1 = "SELECT ID, Nume, Prenume FROM pacienti ORDER BY ID ASC;";
        $r1 = mysqli_query($connection, $sql1);

        $sql2 = "SELECT d.ID, d.Nume, d.Prenume, s.Denumire FROM doctori as d LEFT JOIN specializari AS s ON d.ID_specializare=s.ID ORDER BY s.ID ASC;";
        $r2 = mysqli_query($connection, $sql2); 
    ?>
    <body>
        <div class="well" id="title-yellow">
            Modifica consultație
        </div>
        <div class="container-fluid">
            <form action="ModificaConsultatieConfirm.php" method="post">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <fieldset  class="bg-yellow">
                            <header>Detalii consultație</header>
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
                                    <td class="legenda">Doctor<star>*</star></td>
                                    <td>
                                        <select name="ID_medic">
                                        <?php 
                                            $ID=1;
                                            while ($row2 = mysqli_fetch_array($r2))
                                            {
                                                echo "<option value='".$row2["ID"]."'";
                                                if ($row0["ID_medic"]==$row2["ID"])
                                                    echo ' style="font-weight: bold;"';
                                                if (isset($_SESSION["valoareID_medic"]))
                                                {
                                                    if ($_SESSION["valoareID_medic"]==$row2["ID"])
                                                        echo ' selected';
                                                }
                                                else
                                                    if ($row0["ID_medic"]==$row2["ID"])
                                                        echo ' selected';
                                                echo ">".$ID++." - ".$row2["Nume"]." ".$row2["Prenume"]." - Medic " . lcfirst($row2["Denumire"])."</option>";
                                            }
                                        ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="legenda">Pacient<star>*</star></td>
                                    <td>
                                        <select name="ID_pacient">
                                        <?php 
                                            $ID=1;
                                            while ($row1 = mysqli_fetch_array($r1))
                                            {
                                                echo "<option value='".$row1["ID"]."'";
                                                if ($row0["ID_pacient"]==$row1["ID"])
                                                    echo ' style="font-weight: bold;"';
                                                if (isset($_SESSION["valoareID_pacient"]))
                                                {
                                                    if ($_SESSION["valoareID_pacient"]==$row1["ID"])
                                                        echo ' selected';
                                                }
                                                else
                                                    if ($row0["ID_pacient"]==$row1["ID"])
                                                        echo ' selected';
                                                echo ">".$ID++." - ".$row1["Nume"]." ".$row1["Prenume"]."</option>";
                                            }
                                        ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="legenda">Data<star>*</star></td>
                                    <td>
                                        <?php 
                                            $data=date_create($row0["Data"]);
                                            $in  = "<input type = 'date' name = 'Data' data-toggle='tooltip' title='Valoarea inițială: ";
                                            $in.=date_format($data,"d.m.Y");
                                            $in.="'";
                                            if (isset($_SESSION["valoareData"]))
                                                $in .= " value = '" . $_SESSION["valoareData"] . "'";
                                            else
                                                $in .= " value = '" . $row0["Data"] . "'";
                                            $in .= "/>";
                                            echo $in;           
                                            if (isset($_SESSION["errorData"]))
                                            {
                                                echo "</td><td class='error'>"; 
                                                switch($_SESSION["errorData"])
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
                                    <td class="legenda">Ora<star>*</star></td>
                                    <td>
                                        <?php 
                                            $ora=date_create($row0["Ora"]);
                                            $in  = "<input type = 'time' name = 'Ora' data-toggle='tooltip' title='Valoarea inițială: ";
                                            $in.=date_format($ora,"H:i");
                                            $in.="'";
                                            if (isset($_SESSION["valoareOra"]))
                                                $in .= " value = '" . $_SESSION["valoareOra"] . "'";
                                            else
                                                $in .= " value = '" . $row0["Ora"] . "'";
                                            $in .= "/>";
                                            echo $in;           
                                            if (isset($_SESSION["errorOra"]))
                                            {
                                                echo "</td><td class='error'>"; 
                                                switch($_SESSION["errorOra"])
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
                                    <td class="legenda">Observații</td>
                                    <td>
                                        <?php 
                                            echo '<textarea name="Observatii" rows="4" cols="50" data-toggle="tooltip" title="Valoarea inițială: ';
                                            echo $row0["Observatii"];
                                            echo '">';
                                            if (isset($_SESSION["valoareObservatii"]))
                                                echo $_SESSION["valoareObservatii"];
                                            else
                                                echo $row0["Observatii"];
                                            if (isset($_SESSION["errorObservatii"]))
                                            {
                                                echo "</td><td class='error'>"; 
                                                switch($_SESSION["errorObservatii"])
                                                {
                                                    case 1: echo "Hackere!"; break;
                                                    case 2: echo "Acest câmp trebuie completat!"; break;  
                                                    case 3: echo "Introdu un număr valid!"; break;  
                                                    case 4: echo "Selectează un câmp valid!"; break;                                      
                                                }                                    
                                            }
                                        ?>
                                        </textarea>
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
                <div class="col-md-4"></div>
                </div>
            </div>
        </div> 
    </body>
</html>