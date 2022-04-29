<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AndicApp</title>
    <link rel="stylesheet" href="static/media/icons/LogoWeb.png">
    <link rel="stylesheet" href="static/libs/bootstrap-5/css/bootstrap.min.css">
    <link rel="stylesheet" href="static/libs/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="static/css/plantilla.css">
    <link rel="stylesheet" href="static/css/main.css">
</head>

<body>

    <div class="cont-log">
        <form class="form-login mb-5 mt-5" id="form-log" method="POST" onsubmit="return log_in()">
            <div class="icon-box">
            </div>
            <center>
                <h2 style="margin: 0px; padding: 0px; color: #fff;">A<span style="font-size: 18px;">NDIC A.C.</span></h2>
            </center>
            <hr class="separador">
            <div class="body-form">
                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text">
                        <i class="fa fa-user-circle" aria-hidden="true"></i>
                    </span>
                    <input type="text" maxlength="60" placeholder="someMail@andic.org.mx" class="form-control" name="user" required>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                    </span>
                    <input type="password" class="form-control" placeholder="***" maxlength="15" name="pass" required>
                </div>

                <center>
                    <button class="btn btn-success">
                        Ingresar
                    </button>
                </center>

            </div>
        </form>

        <div class="form-foot">
            <center>
                <h6>
                    Sistema administrativo creado con ayuda de
                    <a class="" href="https://lumega-mx.com" target="_blank">LUMEGA-MX</a>
                    estudio Abril-2022
                </h6>
            </center>
        </div>
    </div>

    <script src="static/libs/jquery.js"></script>
    <script src="static/libs/bootstrap-5/js/bootstrap.min.js"></script>
    <script src="static/libs/fontawesome/js/all.min.js"></script>
    <script src="static/libs/sweetalert.js"></script>
    <script src="static/js/main.js"></script>
</body>

</html>