<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Instancias AWS</title>
        <meta name="description" content="Sufee Admin - HTML5 Admin Template">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="apple-icon.png">
        <link rel="shortcut icon" href="favicon.ico">

        <link rel="stylesheet" href="assets/css/normalize.css">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/themify-icons.css">
        <link rel="stylesheet" href="assets/css/flag-icon.min.css">
        <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
        <link rel="stylesheet" href="assets/css/lib/datatable/dataTables.bootstrap.min.css">
        <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
        <link rel="stylesheet" href="assets/scss/style.css">

        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

        <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
        
<style>
   ul { overflow:auto; }
</style>

    </head>
    <body>
        <!-- Left Panel -->

        <aside id="left-panel" class="left-panel">
            <nav class="navbar navbar-expand-sm navbar-default">

                <div class="navbar-header">
                    <a class="navbar-brand" href="./copesa.php"><img src="images/aws.png" alt="Logo"></a>
                </div>
                <div id="main-menu">
                    <ul class="nav navbar-nav">
                        <h3 class="menu-title">AWS</h3>
                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-users"></i>Cuentas</a>
                            <ul class="sub-menu children dropdown-menu">
                               <?php
                                $directorio = opendir("./aws/");
                                while ($archivo = readdir($directorio)) { //obtenemos un archivo y luego otro sucesivamente
                                    if (!is_dir($archivo)) {//verificamos si es o no un directorio                                       
                                        ?>
                                        <li><i class="fa fa-user-circle"></i><a href="lista.php?id=<?php echo $archivo; ?>"><?php echo $archivo; ?></a></li>
                                        <?php
                                    }
                                }
                                ?>
			     </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </nav>
        </aside><!-- /#left-panel -->

        <!-- Left Panel -->

        <!-- Right Panel -->

        <div id="right-panel" class="right-panel">

            <!-- Header-->
            <header id="header" class="header">

                <div class="header-menu">
                    <div class="col-sm-7">
                        <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                        <div class="header-left">
                            <div class="dropdown for-message">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="message" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">                              

                                </button>
                            </div>
                            <div class="page-title">
                                <h3>Listado de Instancias</h3>
                            </div>
                        </div>
                    </div>                  
                </div>

            </header><!-- /header -->
            <!-- Header-->

            <div class="content mt-3">
                <div class="animated fadeIn">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="card">                                
                                <div class="card-body">
                                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Cuenta</th>
                                                <th>Access Key</th>
                                                <th>Nombre</th>
                                                <th>PublicDnsName</th>
                                                <th>"PublicIpAddress"</th>
                                                <th>TipoDeInstancia</th>
                                                <th>IdInstancia</th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
// Read JSON file

                                            $directorio = opendir("./aws/"); //ruta actual
                                            while ($archivo = readdir($directorio)) { //obtenemos un archivo y luego otro sucesivamente
                                                if (!is_dir($archivo)) {//verificamos si es o no un directorio
                                                    $readjson = file_get_contents('./aws/' . $archivo);
                                                    $data = json_decode($readjson, true);

                                                    foreach ($data as $objeto) {
                                                        foreach ($objeto as $lista) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $archivo ?></td>
                                                                <td><?php echo $lista['Nombre'] ?></td>
                                                                <td><?php echo $lista['Tags'] ?></td>
                                                                <td><?php echo $lista['PublicDnsName'] ?></td>
                                                                <td><?php echo $lista['PublicIpAddress'] ?></td>
                                                                <td><?php echo $lista['TipoDeInstancia'] ?></td>
                                                                <td><?php echo $lista['IdInstancia'] ?></td>
                                                                <?php if ($lista['Estado'] === "running") { ?>
                                                                    <td><span class="badge badge-success"><?php echo $lista['Estado'] ?></span></td>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <td><span class="badge badge-danger"><?php echo $lista['Estado'] ?></span></td>
                                                                        <?php
                                                                    }
                                                                    ?>

                                                            </tr> 
                <?php
            }
        }
    }
}
?>
                                        </tbody>          
                                    </table>



                                </div>
                            </div>
                        </div>


                    </div>
                </div><!-- .animated -->
            </div><!-- .content -->


        </div><!-- /#right-panel -->

        <!-- Right Panel -->


        <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/plugins.js"></script>
        <script src="assets/js/main.js"></script>


        <script src="assets/js/lib/data-table/datatables.min.js"></script>
        <script src="assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
        <script src="assets/js/lib/data-table/dataTables.buttons.min.js"></script>
        <script src="assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
        <script src="assets/js/lib/data-table/jszip.min.js"></script>
        <script src="assets/js/lib/data-table/pdfmake.min.js"></script>
        <script src="assets/js/lib/data-table/vfs_fonts.js"></script>
        <script src="assets/js/lib/data-table/buttons.html5.min.js"></script>
        <script src="assets/js/lib/data-table/buttons.print.min.js"></script>
        <script src="assets/js/lib/data-table/buttons.colVis.min.js"></script>
        <script src="assets/js/lib/data-table/datatables-init.js"></script>


        <script type="text/javascript">
            $(document).ready(function () {
                $('#bootstrap-data-table-export').DataTable();
            });
        </script>


    </body>
</html>
