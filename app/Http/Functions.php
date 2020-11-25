<?php

//Key Value From Json
function kvfj($json, $key) {
    if ($json == null):
        return null;
    else:
        $json = $json;
        $json = json_decode($json, true);
        if (array_key_exists($key, $json)):
            return $json[$key];
        else:
            return null;
        endif;
    endif;
}

function getModulesArray() {
    $a = [
      '0' => 'Productos',
      '1' => 'Blog'
    ];
    return $a;
}

function getUserRoleArray($mode, $id) {
    $roles = [
        '0' => 'Usuario',
        '1' => 'Administrador'
    ];
    if(!is_null($mode)):
        return $roles;
    else:
        return $roles[$id];
    endif;
}

function getUserStatusArray($mode, $id) {
    $status = [
        '0' => 'Registrado',
        '1' => 'Verifícado',
        '100' => 'Baneado'
    ];
    if (!is_null($mode)):
        return $status;
    else:
        return $status[$id];
    endif;
}




