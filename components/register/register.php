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
                                    <p class="alert alert-danger">Este correo ya se encuentra registrado.</p>
                                    <?php
                                    break;
                                case "password_match":
                                    ?>
                                    <p class="alert alert-danger">Contraseñas no coinciden.</p>
                                    <?php
                                    break;
                                default:
                                    ?>
                                    <p class="alert alert-danger">Error desconocido en el registro.</p>
                                    <?php
                                    break;
                            }
                        }?>
                        <form action="insertar_usuario.php" id="commentForm" method="POST" class="w-100">
                        <fieldset>
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
                                <input class="form-control input-lg" type="tel" name="telefono" id="telefono" placeholder="telefono" maxlenght="13" required>
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
                            <div id="error-message" class="text-danger mt-3"></div>
                        </fieldset>
                        </form>
                        <script>
                            $("#commentForm").validate();
                        </script>
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

document.getElementById("telefono").addEventListener("input", function(event) {
    // Eliminar cualquier carácter no numérico
    this.value = this.value.replace(/[^0-9]/g, '');
    
    // Limitar a 10 dígitos
    if (this.value.length > 10) {
        this.value = this.value.slice(0, 10);
    }

    // Formatear con espacios después de cada bloque de 3 dígitos
    this.value = this.value.replace(/(\d{3})(\d{1,3})(\d{1,4})?/, function(_, g1, g2, g3) {
        return [g1, g2, g3].filter(Boolean).join(' ');
    });
});
  
</script>

<script>
    document.getElementById('#commentForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Evita el envío del formulario

        const emailInput = document.getElementById('email').value;
        const errorMessage = document.getElementById('error-message');

        // Expresión regular para validar el email
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!emailPattern.test(emailInput)) {
            errorMessage.textContent = 'Por favor, ingrese un correo electrónico válido que contenga un punto en el dominio.';
        } else {
            errorMessage.textContent = ''; // Limpia el mensaje de error
            // Aquí puedes proceder con el envío del formulario o cualquier otra acción
            alert('Correo electrónico válido: ' + emailInput);
        }
    });
</script>