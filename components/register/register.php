<?php

$bp = "../../includes/";
require_once $bp."session.php";
require_once $bp."head.php";

?>

<body>
    <div class="container">
        <div class="row mt-5 mb-5">
            <img style="height: 130px; width: 150px;" src="../../images/logo.jpg" class="rounded mx-auto d-block">
        </div>
        
        <div class="row justify-content-center">
            <div class="row" style="width: 600px;">
                <div class="col">
                    <div class="row text-center mb-3">
                        <h1 style=" font-size: 30px; font-weight: bold;"> Registrate para ordenar a domicilio! </h1>
                    </div> 
                    <div class="row d-flex justify-content-center mb-3 mx-3">
                        <?php
                        if(isset($_GET['info'])){
                            $info = $_GET['info'];
                            switch($info){
                                case "correo_duplicado":
                                    ?>
                                    <p class="alert alert-danger">Este usuario ya se encuentra registrado</p>
                                    <?php
                                    break;
                                case "password_invalido":
                                    ?>
                                    <p class="alert alert-success">Usuario o contraseña invalido</p>
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
                        <?php
                            if (isset($_GET['info']) && $_GET['info'] == 1) {
                            ?>
                                <p class="alert alert-danger">Contraseñas no coinciden</p>
                            <?php
                            }
                        ?>
                        <?php
                            if (isset($_GET['info']) && $_GET['info'] = 1) {
                            ?>
                                <p class="alert alert-danger">Este correo ya ha sido registrado</p>
                            <?php
                            }
                        ?>
                        <form action="insertar_usuario.php" method="POST" class="w-100">
                            <div class="d-flex mb-3 d-flex justify-content-between">
                                <div class="input-group-lg">
                                    <input class="col form-control input-lg" type="text" name="nombre" id="nombre" placeholder="Nombre(s)" required>
                                </div>
                                <div class="input-group-lg">
                                    <input class="col form-control input-lg" type="text" name="apellido" id="apellido" placeholder="Apellido(s)" required>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-3 input-group-lg">
                            </div>
                            <div class="mb-3 input-group-lg">
                                <input class="form-control input-lg" type="email" name="email" id="email" placeholder="E-mail" required>
                            </div>
                            <div class="mb-3 input-group-lg">
                                <input class="form-control input-lg" type="password" name="password" id="password" placeholder="Contraseña" required>
                            </div>
                            <div class="mb-3 input-group-lg">
                                <input class="form-control input-lg" type="password" name="password_verif" id="password_verif" placeholder="Repetir contraseña" required>
                            </div>
                            <div class="mb-3 input-group-lg">
                                <input class="form-control input-lg" type="text" name="calle" id="calle" placeholder="Calle" required>
                            </div>
                            <div class="mb-3 input-group-lg">
                                <input class="form-control input-lg" type="text" name="numero" id="numero" placeholder="#Número" maxlenght="4" required>
                            </div>
                            <div class="mb-3 input-group-lg d-flex justify-content-center">
                                <label class="text-secondary"> ¿Ya tienes cuenta? <a href="../login/login.php" style="color: #e64747;"><strong>Inicia sesión aquí</strong></a></label>
                            </div>
                            <div class="input-group-lg d-flex flex-row-reverse">
                                <button class="btn btn-lg" style="background-color: #e64747; color: white;" type="submit" name="submit" id="submit">Registrarse</button>
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

<script>

document.getElementById("numero").addEventListener("input", function(event) {

    this.value = this.value.replace(/[^0-9]/g, '');

    if (this.value.length > 4) {
        
        this.value = this.value.slice(0, 4);
    }

});
  
</script>