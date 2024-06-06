<?php

function esNulo(array $parametros){
    foreach($parametros as $parametros){
        if(strlen(trim($parametros)) < 1){
            return true;
        }
    }
    return false;
}
//hello
function login($usuario, $password, $con){
    $sql = $con->prepare("SELECT id, usuario, password, nombre FROM
    admin WHERE usuario LIKE ? AND activo=1 LIMIT 1");
    $sql->execute([$usuario]);
    if($row = $sql->fetch(PDO::FETCH_ASSOC)){
            if(password_verify($password, $row['password'])){
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_name'] = $row['nombre'];
                $_SESSION['user_type'] = 'admin';
                header('Location:reservaciones/inicio.php');
                exit;
            }
        }
        return 'El usuario y/o contraseña son incorrectos.';
}

function mostrarMensajes(array $errors){
    if(count($errors)>0){
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"></ul>';
        foreach($errors as $error){
            echo '<li>' .$error . '</li>';
        }
        echo '<ul>';
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert"
         aria-label="close"></button></div>';
    }
}

function esActivo($usuario, $con){
    $sql = $con->prepare("SELECT activacion FROM usuarios where usuario LIKE ? LIMIT 1");
    $sql->execute([$usuario]);
    $row = $sql->fetch(PDO::FETCH_ASSOC);
    if($row['activacion']==1){
        return true;
    }
    return false;
}