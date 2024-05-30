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
        <style>
            table, tr, td {
                border: 1px solid #dccbe7;
            }
        </style>
    </head>
    <?php
        session_start();

        require 'constante.php';

        $connection = mysqli_connect($host, $username, $password) or die ("Nu am putut sa ma conectez la serverul mysql");
        
        mysqli_select_db($connection, $database) or die (mysqli_error($connection));

        $sql = "SELECT ID, Denumire, Salariu_baza FROM specializari ORDER BY ID ASC;";
        $r = mysqli_query($connection, $sql); 
    ?>
    <body>
        <div class="well" id="title-purple">
            Adaugă doctor
        </div>
        <div class="container-fluid">
            <form action="AdaugaDoctorConfirm.php" method="post">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <fieldset class="bg-purple">
                            <header>Date indentificare</header>
                            <table class="table">
                                <tr>
                                    <td class="legenda">Nume<star>*</star></td>
                                    <td>
                                        <?php 
                                            $in  = "<input type = 'text' name = 'Nume'";
                                            if (isset($_SESSION["valoareNume"]))
                                                $in .= " value = '" . $_SESSION["valoareNume"] . "'";
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
                                            $in  = "<input type = 'text' name = 'Prenume'";
                                            if (isset($_SESSION["valoarePrenume"]))
                                                $in .= " value = '" . $_SESSION["valoarePrenume"] . "'";
                                            $in .= "/>";
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
                                                if ($_SESSION["valoareSex"]=="M")
                                                    echo 'checked="checked"';
                                            echo '/>M <br/>';
                                            echo '<input type="radio" name="Sex" value="F"';
                                            if (isset($_SESSION["valoareSex"]))
                                                if ($_SESSION["valoareSex"]=="F")
                                                    echo 'checked="checked"';
                                            echo '/>F <br/>'; 
                                            echo '<input type="radio" name="Sex" value="Altele"';
                                            if (isset($_SESSION["valoareSex"]))
                                            {
                                                if ($_SESSION["valoareSex"]=="Altele")
                                                    echo 'checked="checked"';
                                            }
                                            else
                                                echo 'checked="checked"';
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
                                            $in  = "<input type = 'date' name = 'Data_nasterii'";
                                            if (isset($_SESSION["valoareData_nasterii"]))
                                                $in .= " value = '" . $_SESSION["valoareData_nasterii"] . "'";
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
                                            $in  = "<input type = 'number' name = 'CNP'";
                                            if (isset($_SESSION["valoareCNP"]))
                                                $in .= " value = '" . $_SESSION["valoareCNP"] . "'";
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
                                            $in  = "<input type = 'number' name = 'Telefon'";
                                            if (isset($_SESSION["valoareTelefon"]))
                                                $in .= " value = '" . $_SESSION["valoareTelefon"] . "'";
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
                                    <td class="legenda">E-mail<star>*</star></td>
                                    <td>
                                        <?php 
                                            $in  = "<input type = 'text' name = 'E_mail'";
                                            if (isset($_SESSION["valoareE_mail"]))
                                                $in .= " value = '" . $_SESSION["valoareE_mail"] . "'";
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
                        <fieldset  class="bg-purple">
                            <header>Detalii specializare</header>
                            <table class="table">
                                <tr>
                                    <td class="legenda">Specializare<star>*</star></td>
                                    <td>
                                        <select name="ID_specializare">
                                        <?php 
                                            $ID=1;
                                            while ($row = mysqli_fetch_array($r))
                                            {
                                                echo "<option value='".$row["ID"]."'";
                                                if (isset($_SESSION["valoareID_specializare"]))
                                                    if ($_SESSION["valoareID_specializare"]==$row["ID"])
                                                        echo ' selected';
                                                echo ">".$ID++." - Medic " . lcfirst($row["Denumire"])." - Salariu bază: ".$row["Salariu_baza"]."</option>";
                                            }
                                        ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="legenda">Sporuri salariu<star>*</star></td>
                                    <td>
                                        <?php 
                                            $in  = "<input type = 'number' name = 'Sporuri_salariu'";
                                            if (isset($_SESSION["valoareSporuri_salariu"]))
                                                $in .= " value = '" . $_SESSION["valoareSporuri_salariu"] . "'";
                                            $in .= "/>";
                                            echo $in;           
                                            if (isset($_SESSION["errorSporuri_salariu"]))
                                            {
                                                echo "</td><td class='error'>"; 
                                                switch($_SESSION["errorSporuri_salariu"])
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
                                    <td class="legenda">Data angajării<star>*</star></td>
                                    <td>
                                        <?php 
                                            $in  = "<input type = 'date' name = 'Data_angajarii'";
                                            if (isset($_SESSION["valoareData_angajarii"]))
                                                $in .= " value = '" . $_SESSION["valoareData_angajarii"] . "'";
                                            $in .= "/>";
                                            echo $in;           
                                            if (isset($_SESSION["errorData_angajarii"]))
                                            {
                                                echo "</td><td class='error'>"; 
                                                switch($_SESSION["errorData_angajarii"])
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
                        <fieldset  class="bg-purple">
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
                                                    if ($_SESSION["valoareID_judet"]==$row2["ID"])
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
                                            $in  = "<input type = 'text' name = 'Oras'";
                                            if (isset($_SESSION["valoareOras"]))
                                                $in .= " value = '" . $_SESSION["valoareOras"] . "'";
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
                                            $in  = "<input type = 'text' name = 'Strada'";
                                            if (isset($_SESSION["valoareStrada"]))
                                                $in .= " value = '" . $_SESSION["valoareStrada"] . "'";
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
                                            $in  = "<input type = 'number' name = 'Cod_postal'";
                                            if (isset($_SESSION["valoareCod_postal"]))
                                                $in .= " value = '" . $_SESSION["valoareCod_postal"] . "'";
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
                                            $in  = "<input type = 'text' name = 'Numar'";
                                            if (isset($_SESSION["valoareNumar"]))
                                                $in .= " value = '" . $_SESSION["valoareNumar"] . "'";
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
                                            $in  = "<input type = 'text' name = 'Bloc'";
                                            if (isset($_SESSION["valoareBloc"]))
                                                $in .= " value = '" . $_SESSION["valoareBloc"] . "'";
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
                                            $in  = "<input type = 'text' name = 'Apartament'";
                                            if (isset($_SESSION["valoareApartament"]))
                                                $in .= " value = '" . $_SESSION["valoareApartament"] . "'";
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
                            <a href="Acasa.php" class="btn btn-purple"><span class="glyphicon glyphicon-home"></span> Acasă</a>
                            <a href="VeziDoctori.php" class="btn btn-purple"><span class="glyphicon glyphicon-eye-open"></span> Vezi doctori</a>
                            <input type="submit" value="✓ Trimite" class="btn btn-purple"/>
                        </fieldset>  
                    </form>
                </div>
                <div class="col-md-2"></div>
                </div>
            </div>
        </div> 
    </body>
</html>