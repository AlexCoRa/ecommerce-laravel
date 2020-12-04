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

function userPermissions() {
    $p = [
        'dashboard' => [
            'icon' => '<i class="fas fa-home"></i>',
            'title' => 'Modulo Dashboard',
            'keys' => [
                'dashboard' => 'Puede ver el dashboard.',
                'dashboard_small_stats' => 'Puede ver las estadísticas rápidas.',
                'dashboard_sell_today' => 'Puede ver lo facturado hoy.'
            ]
        ],
        'users' => [
            'icon' => '<i class="fas fa-users"></i>',
            'title' => 'Modulo Usuarios',
            'keys' => [
                'users_list' => 'Puede ver el listado de los usuarios.',
                'users_edit' => 'Puede editar usuarios.',
                'user_banned' => 'Puede banear usuarios.',
                'user_permission' => 'Puede dar permisos a usuarios.'
            ]
        ],
        'products' => [
            'icon' => '<i class="fas fa-boxes"></i>',
            'title' => 'Modulo Productos',
            'keys' => [
                'products' => 'Puede ver el listado de productos.',
                'products_add' => 'Puede agregar nuevos productos.',
                'products_edit' => 'Puede editar productos.',
                'product_search' => 'Puede buscar productos.',
                'products_delete' => 'Puede eliminar productos.',
                'product_gallery_add' => 'Puede agregar imágenes al producto.',
                'product_gallery_delete' => 'Puede eliminar imágenes del producto.'
            ]
        ],
        'categories' => [
            'icon' => '<i class="fas fa-folder-open"></i>',
            'title' => 'Modulo Categorias',
            'keys' => [
                'categories' => 'Puede ver el listado de categorías.',
                'category_add' => 'Puede crear nuevas categorías.',
                'category_edit' => 'Puede editar categorías.',
                'category_delete' => 'Puede eliminar categorías.'

            ]
        ],
    ];
    return $p;
}

function getUserYears() {
    $ya = date('Y');
    $ym = $ya - 18;
    $yo = $ym - 62;

    return [$ym, $yo];
}

function getMonths($mode, $key) {
    $m = [
        '1' => 'Enero',
        '2' => 'Febrero',
        '3' => 'Marzo',
        '4' => 'Abril',
        '5' => 'Mayo',
        '6' => 'Junio',
        '7' => 'Julio',
        '8' => 'Agosto',
        '9' => 'Septiembre',
        '10' => 'Octubre',
        '11' => 'Noviembre',
        '12' => 'Diciembre'
    ];
    if ($mode == 'list') {
        return $m;
    }else {
        return $m[$key];
    }
}




