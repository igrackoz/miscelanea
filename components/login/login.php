<?php require_once "../../includes/session.php" ?>
<?php include "../../includes/head.php"; ?>

<body>
    <div class="container">
        <div class="row mt-5 mb-5">
            <img style="height: 130px; width: 150px;" src="../../images/logo.jpg" class="rounded mx-auto d-block">
        </div>
        
        <div class="row justify-content-center">
            <div class="row" style="width: 600px;">
                <div class="col">
                    <div class="row text-center mb-3">
                        <h1 style=" font-size: 30px; font-weight: bold;"> Inicia sesión para empezar a pedir productos! </h1>
                    </div> 
                    <div class="row d-flex justify-content-center mb-3 mx-3">
                        <?php
                        if(isset($_GET['info'])){
                            $info = $_GET['info'];
                            switch($info){
                                case "usuario_invalido":
                                    ?>
                                    <p class="alert alert-danger">Usuario o contraseña invalido</p>
                                    <?php
                                    break;
                                case "registro_exitoso":
                                    ?>
                                    <p class="alert alert-success">Se ha registrado con éxito, ya puede iniciar sesión</p>
                                    <?php
                                    break;
                                default:
                                    ?>
                                    <p class="alert alert-danger">Error desconocido en el registro</p>
                                    <?php
                                    break;
                            }
                        }?>
                        <form action="../login/user_auth.php" method="POST" class="w-100">
                            <div class="mb-3 input-group-lg">
                                <input class="form-control input-lg" type="email" name="email" id="email" placeholder="E-mail" required>
                            </div>
                            <div class="mb-3 input-group-lg">
                                <input class="form-control input-lg" type="password" name="password" id="password" placeholder="Contraseña" required>
                            </div>
                            <div class="mb-3 input-group-lg d-flex justify-content-center">
                                <label class="text-secondary"> ¿No tienes una cuenta? <a href="../register/register.php" style="color: #e64747;"><strong>Registrate aquí</strong></a></label>
                            </div>
                            <div class="input-group-lg d-flex flex-row-reverse">
                                <button class="btn btn-lg" style="background-color: #e64747; color: white;" type="submit" name="submit" id="submit">Ingresar</button>
                            </div>
                        </form>
                    </div> 
                </div>
            </div>
        </div>

        <div class="row" style="height: 200px;"></div>
    </div>
</body>
</html>