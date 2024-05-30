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
        <style>
            table, tr, td {
                border: 1px solid #fbc9b6;
            }
        </style>
    </head>
    <?php
        session_start();
    ?>
    <body>
        <div class="well" id="title-orange">
            Adaugă specializare
        </div>
        <div class="container-fluid">
            <form action="AdaugaSpecializareConfirm.php" method="post">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <fieldset class="bg-orange">
                            <header>Detalii specializare</header>
                            <table class="table">
                                <tr>
                                    <td class="legenda">Denumire<star>*</star></td>
                                    <td>
                                        <?php 
                                            $in  = "<input type = 'text' name = 'Denumire'";
                                            if (isset($_SESSION["valoareDenumire"]))
                                                $in .= " value = '" . $_SESSION["valoareDenumire"] . "'";
                                            $in .= "/>";
                                            echo $in; 
                                            if (isset($_SESSION["errorDenumire"]))
                                            {
                                                echo "</td><td class='error'>";   
                                                switch($_SESSION["errorDenumire"])
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
                                    <td class="legenda">Salariu de bază<star>*</star></td>
                                    <td>
                                        <?php 
                                            $in  = "<input type = 'number' name = 'Salariu_baza'";
                                            if (isset($_SESSION["valoareSalariu_baza"]))
                                                $in .= " value = '" . $_SESSION["valoareSalariu_baza"] . "'";
                                            $in .= "/>";
                                            echo $in;           
                                            if (isset($_SESSION["errorSalariu_baza"]))
                                            {
                                                echo "</td><td class='error'>"; 
                                                switch($_SESSION["errorSalariu_baza"])
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
                        </fieldset> <br/>
                        <fieldset>
                            <a href="Acasa.php" class="btn btn-orange"><span class="glyphicon glyphicon-home"></span> Acasă</a>
                            <a href="VeziSpecializari.php" class="btn btn-orange"><span class="glyphicon glyphicon-eye-open"></span> Vezi specializări</a>
                            <input type="submit" value="✓ Trimite" class="btn btn-orange"/>
                        </fieldset>  
                    </form>
                </div>
                <div class="col-md-4"></div>
                </div>
            </div>
        </div> 
    </body>
</html>