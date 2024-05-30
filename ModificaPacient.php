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
        <style>
            table, tr, td {
                border: 1px solid #b9f9f8;
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

        $sql = "SELECT p.`ID`, p.`Nume`, p.`Prenume`, p.`Sex`, p.`Data nasterii`, p.`CNP`, p.`Telefon`, p.`E-mail`, p.`Varsta`, p.`ID_judet`, p.`Oras`, p.`Strada`, 
                p.`Cod postal`, p.`Numar`, p.`Bloc`, p.`Apartament` FROM pacienti AS p WHERE p.ID=".$_GET["ID"].";";
        $r = mysqli_query($connection, $sql);
        $row = mysqli_fetch_array($r);
    ?>
    <body>
        <div class="well" id="title-cyan">
            Modifică pacient
        </div>
        <div class="container-fluid">
            <form action="ModificaPacientConfirm.php" method="post">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <fieldset class="bg-cyan">
                            <header>Date indentificare</header>
                            <?php 
                                echo "<input type = 'hidden' name = 'ID' value='".$row["ID"]."'/>";    
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
                                    <td class="legenda">Nume<star>*</star></td>
                                    <td>
                                        <?php 
                                            $in  = "<input type = 'text' name = 'Nume' data-toggle='tooltip' title='Valoarea inițială: ";
                                            $in.=$row["Nume"];
                                            $in.="'";
                                            if (isset($_SESSION["valoareNume"]))
                                                $in .= " value = '" . $_SESSION["valoareNume"] . "'";
                                            else
                                                $in .= " value = '" . $row["Nume"] . "'";
                                            $in .= "/>";
                                            echo $in; 
                                            if (isset($_SESSION["errorNume"]))
                                            {
                                                echo "</td><td class='error'>";   
                                                switch($_SESSION["errorNume"])
                                                {
                                                    case 1: echo "Hackere!"; break;
                                                    case 2: echo "Acest câmp trebuie completat!"; break;  
                                                    case 3: echo "Introdu un număr valid!"; break;  
                                                    case 4: echo "Selectează un câmp valid!"; break; 
                                                    case 5: echo "Acest câmp permite numai litere!"; break;                                        
                                                }                                    
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="legenda">Prenume<star>*</star></td>
                                    <td>
                                        <?php 
                                            $in  = "<input type = 'text' name = 'Prenume' data-toggle='tooltip' title='Valoarea inițială: ";
                                            $in.=$row["Prenume"];
                                            $in.="'";
                                            if (isset($_SESSION["valoarePrenume"]))
                                                $in .= " value = '" . $_SESSION["valoarePrenume"] . "'";
                                            else
                                                $in .= " value = '" . $row["Prenume"] . "'";
                                            echo $in;           
                                            if (isset($_SESSION["errorPrenume"]))
                                            {
                                                echo "</td><td class='error'>"; 
                                                switch($_SESSION["errorPrenume"])
                                                {
                                                    case 1: echo "Hackere!"; break;
                                                    case 2: echo "Acest câmp trebuie completat!"; break;  
                                                    case 3: echo "Introdu un număr valid!"; break;  
                                                    case 4: echo "Selectează un câmp valid!"; break;
                                                    case 5: echo "Acest câmp permite numai litere!"; break;                                        
                                                }                                    
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="legenda">Sex<star>*</star></td>
                                    <td>
                                        <?php    
                                            echo '<input type="radio" name="Sex" value="M"';
                                            if (isset($_SESSION["valoareSex"]))
                                            {
                                                if ($_SESSION["valoareSex"]=="M")
                                                    echo 'checked="checked"';
                                            }
                                            else
                                                if ($row["Sex"]=="M")
                                                    echo 'checked="checked"';
                                            echo 'data-toggle="tooltip" title="Valoarea inițială: ';
                                            echo $row["Sex"];
                                            echo '"';
                                            echo '/>M <br/>';
                                            echo '<input type="radio" name="Sex" value="F"';
                                            if (isset($_SESSION["valoareSex"]))
                                            {
                                                if ($_SESSION["valoareSex"]=="F")
                                                    echo 'checked="checked"';
                                            }
                                            else
                                                if ($row["Sex"]=="F")
                                                    echo 'checked="checked"';
                                            echo 'data-toggle="tooltip" title="Valoarea inițială: ';
                                            echo $row["Sex"];
                                            echo '"';
                                            echo '/>F <br/>'; 
                                            echo '<input type="radio" name="Sex" value="Altele"';
                                            if (isset($_SESSION["valoareSex"]))
                                            {
                                                if ($_SESSION["valoareSex"]=="Altele")
                                                    echo 'checked="checked"';
                                            }
                                            else
                                                if ($row["Sex"]=="Altele")
                                                    echo 'checked="checked"';
                                            echo 'data-toggle="tooltip" title="Valoarea inițială: ';
                                            echo $row["Sex"];
                                            echo '"';
                                            echo '/>Altele <br/>';
                                            if (isset($_SESSION["errorSex"]))
                                            {
                                                echo "</td><td class='error'>";   
                                                switch($_SESSION["errorSex"])
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
                                    <td class="legenda">Data nașterii<star>*</star></td>
                                    <td>
                                        <?php 
                                            $data=date_create($row["Data nasterii"]);
                                            $in  = "<input type = 'date' name = 'Data_nasterii' data-toggle='tooltip' title='Valoarea inițială: ";
                                            $in.=date_format($data,"d.m.Y");
                                            $in.="'";
                                            if (isset($_SESSION["valoareData_nasterii"]))
                                                $in .= " value = '" . $_SESSION["valoareData_nasterii"] . "'";
                                            else
                                                $in .= " value = '" . $row["Data nasterii"] . "'";
                                            $in .= "/>";
                                            echo $in;           
                                            if (isset($_SESSION["errorData_nasterii"]))
                                            {
                                                echo "</td><td class='error'>"; 
                                                switch($_SESSION["errorData_nasterii"])
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
                                    <td class="legenda">CNP<star>*</star></td>
                                    <td>
                                        <?php 
                                            $in  = "<input type = 'number' name = 'CNP' data-toggle='tooltip' title='Valoarea inițială: ";
                                            $in.=$row["CNP"];
                                            $in.="'";
                                            if (isset($_SESSION["valoareCNP"]))
                                                $in .= " value = '" . $_SESSION["valoareCNP"] . "'";
                                            else
                                                $in .= " value = '" . $row["CNP"] . "'";
                                            $in .= "/>";
                                            echo $in;           
                                            if (isset($_SESSION["errorCNP"]))
                                            {
                                                echo "</td><td class='error'>"; 
                                                switch($_SESSION["errorCNP"])
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
                                    <td class="legenda">Telefon<star>*</star></td>
                                    <td>
                                        <?php 
                                            $in  = "<input type = 'number' name = 'Telefon' data-toggle='tooltip' title='Valoarea inițială: ";
                                            $in.=$row["Telefon"];
                                            $in.="'";
                                            if (isset($_SESSION["valoareTelefon"]))
                                                $in .= " value = '" . $_SESSION["valoareTelefon"] . "'";
                                            else
                                                $in .= " value = '" . $row["Telefon"] . "'";
                                            $in .= "/>";
                                            echo $in;           
                                            if (isset($_SESSION["errorTelefon"]))
                                            {
                                                echo "</td><td class='error'>"; 
                                                switch($_SESSION["errorTelefon"])
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
                                    <td class="legenda">E-mail</td>
                                    <td>
                                        <?php 
                                            $in  = "<input type = 'text' name = 'E_mail' data-toggle='tooltip' title='Valoarea inițială: ";
                                            $in.=$row["E-mail"];
                                            $in.="'";
                                            if (isset($_SESSION["valoareE_mail"]))
                                                $in .= " value = '" . $_SESSION["valoareE_mail"] . "'";
                                            else
                                                $in .= " value = '" . $row["E-mail"] . "'";
                                            $in .= "/>";
                                            echo $in;           
                                            if (isset($_SESSION["errorE_mail"]))
                                            {
                                                echo "</td><td class='error'>"; 
                                                switch($_SESSION["errorE_mail"])
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
                            </table>
                        </fieldset> <br/>
                    </div>
                    <div class="col-md-4">
                        <fieldset  class="bg-cyan">
                            <header>Adresa</header>
                            <table class="table">
                                <tr>
                                    <td class="legenda">Județ<star>*</star></td>
                                    <td>
                                        <select name="ID_judet">
                                        <?php 
                                            $sql2 = "SELECT ID, Nume FROM judete ORDER BY ID ASC;";
                                            $r2 = mysqli_query($connection, $sql2); 

                                            $ID=1;
                                            while ($row2 = mysqli_fetch_array($r2))
                                            {
                                                echo "<option value='".$row2["ID"]."'";
                                                if (isset($_SESSION["valoareID_judet"]))
                                                {   
                                                    if ($_SESSION["valoareID_judet"]==$row2["ID"])
                                                        echo ' selected';
                                                }
                                                else
                                                    if ($row["ID_judet"]==$row2["ID"])
                                                        echo ' selected';
                                                echo ">".$ID++." - ".$row2["Nume"]."</option>";
                                            }
                                        ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="legenda">Oraș<star>*</star></td>
                                    <td>
                                        <?php 
                                            $in  = "<input type = 'text' name = 'Oras' data-toggle='tooltip' title='Valoarea inițială: ";
                                            $in.=$row["Oras"];
                                            $in.="'";
                                            if (isset($_SESSION["valoareOras"]))
                                                $in .= " value = '" . $_SESSION["valoareOras"] . "'";
                                            else
                                                $in .= " value = '" . $row["Oras"] . "'";
                                            $in .= "/>";
                                            echo $in;           
                                            if (isset($_SESSION["errorOras"]))
                                            {
                                                echo "</td><td class='error'>"; 
                                                switch($_SESSION["errorOras"])
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
                                    <td class="legenda">Stradă<star>*</star></td>
                                    <td>
                                        <?php 
                                            $in  = "<input type = 'text' name = 'Strada' data-toggle='tooltip' title='Valoarea inițială: ";
                                            $in.=$row["Strada"];
                                            $in.="'";
                                            if (isset($_SESSION["valoareStrada"]))
                                                $in .= " value = '" . $_SESSION["valoareStrada"] . "'";
                                            else
                                                $in .= " value = '" . $row["Strada"] . "'";
                                            $in .= "/>";
                                            echo $in;           
                                            if (isset($_SESSION["errorStrada"]))
                                            {
                                                echo "</td><td class='error'>"; 
                                                switch($_SESSION["errorStrada"])
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
                                    <td class="legenda">Cod poștal<star>*</star></td>
                                    <td>
                                        <?php 
                                            $in  = "<input type = 'number' name = 'Cod_postal' data-toggle='tooltip' title='Valoarea inițială: ";
                                            $in.=$row["Cod postal"];
                                            $in.="'";
                                            if (isset($_SESSION["valoareCod_postal"]))
                                                $in .= " value = '" . $_SESSION["valoareCod_postal"] . "'";
                                            else
                                                $in .= " value = '" . $row["Cod postal"] . "'";
                                            $in .= "/>";
                                            echo $in;           
                                            if (isset($_SESSION["errorCod_postal"]))
                                            {
                                                echo "</td><td class='error'>"; 
                                                switch($_SESSION["errorCod_postal"])
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
                                    <td class="legenda">Număr</td>
                                    <td>
                                        <?php 
                                            $in  = "<input type = 'text' name = 'Numar' data-toggle='tooltip' title='Valoarea inițială: ";
                                            $in.=$row["Numar"];
                                            $in.="'";
                                            if (isset($_SESSION["valoareNumar"]))
                                                $in .= " value = '" . $_SESSION["valoareNumar"] . "'";
                                            else
                                                $in .= " value = '" . $row["Numar"] . "'";
                                            $in .= "/>";
                                            echo $in;           
                                            if (isset($_SESSION["errorNumar"]))
                                            {
                                                echo "</td><td class='error'>"; 
                                                switch($_SESSION["errorNumar"])
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
                                    <td class="legenda">Bloc</td>
                                    <td>
                                        <?php 
                                            $in  = "<input type = 'text' name = 'Bloc' data-toggle='tooltip' title='Valoarea inițială: ";
                                            $in.=$row["Bloc"];
                                            $in.="'";
                                            if (isset($_SESSION["valoareBloc"]))
                                                $in .= " value = '" . $_SESSION["valoareBloc"] . "'";
                                            else
                                                $in .= " value = '" . $row["Bloc"] . "'";
                                            $in .= "/>";
                                            echo $in;           
                                            if (isset($_SESSION["errorBloc"]))
                                            {
                                                echo "</td><td class='error'>"; 
                                                switch($_SESSION["errorBloc"])
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
                                    <td class="legenda">Apartament</td>
                                    <td>
                                        <?php 
                                            $in  = "<input type = 'text' name = 'Apartament' data-toggle='tooltip' title='Valoarea inițială: ";
                                            $in.=$row["Apartament"];
                                            $in.="'";
                                            if (isset($_SESSION["valoareApartament"]))
                                                $in .= " value = '" . $_SESSION["valoareApartament"] . "'";
                                            else
                                                $in .= " value = '" . $row["Apartament"] . "'";
                                            $in .= "/>";
                                            echo $in;           
                                            if (isset($_SESSION["errorApartament"]))
                                            {
                                                echo "</td><td class='error'>"; 
                                                switch($_SESSION["errorApartament"])
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
                            <a href="Acasa.php" class="btn btn-cyan"><span class="glyphicon glyphicon-home"></span> Acasă</a>
                            <a href="VeziPacienti.php" class="btn btn-cyan"><span class="glyphicon glyphicon-eye-open"></span> Vezi pacienți</a>
                            <input type="submit" value="✓ Trimite" class="btn btn-cyan"/>
                        </fieldset>  
                    </form>
                </div>
                <div class="col-md-2"></div>
                </div>
            </div>
        </div> 
    </body>
</html>