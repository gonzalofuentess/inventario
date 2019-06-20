<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Gestor de Instancias</title>
        <meta name="description" content="Gestor de Instancias">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- <link rel="apple-touch-icon" href="apple-icon.png" -->
        <!-- <link rel="shortcut icon" href="favicon.ico">-->

        <link rel="stylesheet" href="assets/css/normalize.css">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/themify-icons.css">
        <link rel="stylesheet" href="assets/css/flag-icon.min.css">
        <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
        <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
        <link rel="stylesheet" href="assets/scss/style.css">
        <script src="assets/js/vendor/jquery-3.3.1.min.js"></script>

        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

    </head>
    <body class="bg-white">
        <div class="sufee-login d-flex align-content-center flex-wrap">
            <div class="container">
                <div class="login-content">
                    <div class="login-logo">
                        <!-- <a href="index.html"> -->
                        <img class="align-content" src="images/copesa.gif" alt="">
                        <!-- </a>-->
                    </div>
                    <div class="login-form" >
                        <form role="form" action="return false" onsubmit="return false">
                            <div class="form-group">
                                <label>Usuario</label>
                                <input type="text" class="form-control" placeholder="Usuario" name="user" id="user" required> 
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" placeholder="Password" name="pass" id="pass" required>
                            </div>    
                            <br>
                            <div id="resultado"></div>
                            <!--<button onclick="Validar();" class="btn btn-success btn-flat m-b-30 m-t-30">Iniciar Sesión</button>                                      -->  
                            <button class="btn btn-success btn-flat m-b-30 m-t-30" onclick="Validar(document.getElementById('user').value, document.getElementById('pass').value);">Iniciar Sesión</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
         <script>
        function Validar(user, pass)
        {
            $.ajax({
                url: "validar.php",
                type: "POST",
                data: "user="+user+"&pass="+pass,
                success: function(resp){
                    $('#resultado').html(resp)
                }        
            });
        }
        </script>
        <script src="assets/js/vendor/jquery-3.3.1.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/plugins.js"></script>
        <script src="assets/js/main.js"></script>

    </body>
</html>
