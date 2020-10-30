<?php

function getModulesArray() {
    $a = [
      '0' => 'Productos',
      '1' => 'Blog'
    ];
    return $a;
}

function getUserRoleArrayKey($id) {
    $roles = [
        '0' => 'Usuario',
        '1' => 'Administrador'
    ];
    return $roles[$id];
}

function getUserStatusArrayKey($id) {
    $status = [
        '0' => 'Registrado',
        '1' => 'Verifícado',
        '100' => 'Baneado'
    ];
    return $status[$id];
}


