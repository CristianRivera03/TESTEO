<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Formulario de inicio de sesión</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <style>
            body {
                background-color: #f8f9fa;
            }

            .container {
                margin-top: 100px;
            }

            .bg-purple {
                background-color: #BF4080 !important;
            }

            .text-purple {
                color: #BF4080 !important;
            }

            .btn-purple {
                background-color: #BF4080;
                border-color: #BF4080;
            }

            .btn-purple:hover {
                background-color: #9C3570;
                border-color: #9C3570;
            }

            .center-button {
                display: flex;
                justify-content: center;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-purple text-white">
                            <h5 class="mb-0">Iniciar sesión</h5>
                        </div>
                        <div class="card-body">
                            <?php
                            session_start();
                            include_once 'conexion.php';
                            include_once 'login.php';

                            $host = "localhost";
                            $dbname = "tiendaalbumes";
                            $usuario = "root";
                            $contraseña = "";
                            $conexion = new ConexionPDO($host, $dbname, $usuario, $contraseña);
                            $conexion->conectar();

                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                $usuario = $_POST['user'];
                                $password = MD5($_POST['pwd']);

                                $login = new Login($conexion);

                                if ($login->login($usuario, $password)) {
                                    $_SESSION['usuario'] = $usuario;
                                    header("Location: dash.php");
                                    exit();
                                } else {
                                    $error_message = "Nombre de usuario o contraseña incorrectos.";
                                }
                            }

                            $conexion->desconectar();
                            ?>
                            <form action="" method="POST">
                                <div class="mb-3">
                                    <label for="user" class="form-label">Usuario</label>
                                    <input type="text" class="form-control" name="user" required>
                                </div>
                                <div class="mb-3">
                                    <label for="pwd" class="form-label">Contraseña</label>
                                    <input type="password" class="form-control" name="pwd" required>
                                </div>
                                <div class="mb-3 center-button">
                                    <input type="submit" class="btn btn-purple text-white" value="Entrar">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
            integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS"
            crossorigin="anonymous"></script>
    </body>
</html>