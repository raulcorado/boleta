<!DOCTYPE html>
<?php
include 'mivar.php';
?>

<html>
    <head>
        <!--  500 0.6      <link rel="shortcut icon" href="i.ico"/>-->
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!--        <meta name="viewport" charset="utf-8" content="width=device-width, initial-scale=0.5, user-scalable=no" />-->
        <meta name="viewport" charset="utf-8" content="width=device-width, initial-scale=0.3" />

        <title><?php echo $miapp ?></title>

        <link href="css/jquery.bdt.min.css" rel="stylesheet" type="text/css"/>        
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="css/c3.min.css" rel="stylesheet" type="text/css"/>        
        <link href="css/custom.css" rel="stylesheet" type="text/css"/>

        <script src="js/jquery-2.1.4.min.js" type="text/javascript"></script>        
        <script src="js/bootstrap.js" type="text/javascript"></script>              

        <script src="js/jquery.bdt.js" type="text/javascript"></script>
        <script src="js/awesomplete.min.js" type="text/javascript"></script>

        <script src="js/d3.min.js" type="text/javascript"></script>
        <script src="js/c3.min.js" type="text/javascript"></script>

        <script type="text/javascript">
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
        </script>

        
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index"> <strong> <?php echo $miapp ?></strong></a>
                </div>

                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="casos"><span class="glyphicon glyphicon-book" aria-hidden="true"> </span>CASOS</a></li>
                        <li><a href="dashboard"><span class="glyphicon glyphicon-stats" aria-hidden="true"> </span>CUADRO DE MANDO</a></li>                        
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-print" aria-hidden="true"></span>REPORTES <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="repFacilitador"><span class="glyphicon glyphicon-print" aria-hidden="true"> </span>A - Reporte Facilitador</a></li>                                                                                               
                            </ul>
                        </li>
                        


                    </ul> 
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span><?php echo "OPCIONES DE $_SESSION[username]" ?><span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="importar"><span class="glyphicon glyphicon-import" aria-hidden="true"> </span>IMPORTAR CD</a></li>
                                <li role="separator" class="divider"></li>
                                <li class="active"><a href="users"><span class="glyphicon glyphicon-user" aria-hidden="true"> </span>USUARIO</a></li>
                                <li role="separator" class="divider"></li>

                                <li><a href="logout"><span class="glyphicon glyphicon-log-out " aria-hidden="true"> </span>CERRAR SESION</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="container">
            <img src="img/logo.png" width="200px" alt=""/>
            <br />
            <br />