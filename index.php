<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RPA</title>

    <!-- CSS de Bootstrap -->
    <link href="MDB/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="MDB/css/style.css" rel="stylesheet" media="screen">
    <link href="MDB/css/mdb.min.css" rel="stylesheet" media="screen">
</head>
<body class="fondoIndex">
<div class ="container ">
    <div class="row">
    <div class="col-xs-3 col-sm-3"></div>
    <div class="col-xs-6 col-sm-6">
        <!--Naked Form-->
        <div class="">
            <div class="card-block fondoIndex">

                    <h3 class="text-center white-text">RPA ADMINISTRATION & ANALYTICS</h3>

                <form action="./class/identificacion/identificacion.php?modo=login" method="POST">
                    <!--Body-->
                    <div class="md-form">
                        <i class="fa fa-user prefix"></i>
                        <input required name="codigo" type="text" id="form2" class="form-control ">
                        <label class="white-text" for="form2">Usuario</label>
                    </div>

                    <div class="md-form">
                        <i class="fa fa-lock prefix"></i>
                        <input required name="pass" type="password" id="form4" class="form-control">
                        <label class="white-text" for="form4">Contraseña</label>
                    </div>

                    <div class="text-center">
                        <button class="btn 1c2a48 mdb-color darken-3">Login</button>
                        <input type="hidden" name="login" value="1" />

                    </div>
                </form>


            </div>
            <!--Naked Form-->
        </div>
    </div>
    </div>
    <div class="col-xs-12 col-sm-12 fondo ">

    </div>
</div>

<!-- Librería jQuery requerida por los plugins de JavaScript -->
<script src="MDB/js/jquery.min.js"></script>
<script src="MDB/js/popper.min.js"></script>
<script src="MDB/js/bootstrap.min.js"></script>
<script src="MDB/js/mdb.min.js"></script>
<script src="MDB/js/sweetalert2.min.js"></script>
</body>
</html>