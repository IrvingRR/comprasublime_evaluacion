<?php

// Key Value From Jason
function kvfj($json, $key) {
  if($json == null):
    return null;
  else:
    $json = $json;
    $json = json_decode($json, true);
    if(array_key_exists($key, $json)):
      return $json[$key];
    else:
      return null;
    endif; 
  endif;
}

function getModuleArray() {
  $a = [
    '0' => 'Productos',
    '1' => 'Blog',
  ];

  return $a;
}

function getRoleUserArray($mode, $id) {
    $roles = ['0' => 'Usuario común', '1' => 'Administrador'];
    if(!is_null($mode)):
      return $roles;
    else:
      return $roles[$id];
    endif;


}

function getUserStatusArray($mode, $id) {
    $status = ['0' => 'Registrado', '1' => 'Verificado', '100'=>'Baneado'];
    if(!is_null($mode)):
      return $status;
    else:
      return $status[$id];
    endif;
    return $status[$id];
}

function user_permissions() {
  $p = [
    'dashboard' => [
      'icon' => '<i class="fas fa-home"></i>',
      'title' => 'Modulo Dashboard',
      'keys' => [
        'dashboard' => 'Puede ver el dashboard',
        'dashboard_small_stats' => 'Puede ver las estadísticas',
        'dashboard_sell_today' => 'Puede ver lo facturado hoy'
      ]
      ],
      'products' => [
        'icon' => '<i class="fas fa-boxes"></i>',
        'title' => 'Modulo de productos',
        'keys' => [
          'products' => 'Puede ver el listado de productos.',
          'products_add' => 'Puede agregar productos.',
          'products_edit' => 'Puede editar productos.',
          'product_search' => 'Puede buscar productos.',
          'products_delete' => 'Puede eliminar productos',
          'products_gallery_add' => 'Puede agregar imagenes a la galeria.',
          'products_gallery_delete' => 'Puede eliminar imagenes de la galeria'
        ]
        ],
        'categories' => [
          'icon' => '<i class="fas fa-folders"></i>',
          'title' => 'Modulo de categorias',
          'keys' => [
            'categories' => 'Pude ver la lista de categorias.',
            'categories_add' => 'Puede crear nuevas categorias.',
            'categories_edit' => 'Puede editar las categorias.',
            'categories_delete' => 'Puede eliminar las categorias'
          ]
          ],
          'users' => [
            'icon' => '<i class="fas fa-user-friends"></i>',
            'title' => 'Modulo de usuarios',
            'keys' => [
              'user_list' => 'Puede ver el listado de usuarios.',
              'user_edit' => 'Puede editar usuarios.',
              'user_banned' => 'Pude banear usuarios',
              'user_permissions' => 'Puede administrar permisos de usuarios.'
            ]
            ],

            'settings' => [
              'icon' => '<i class="fas fa-cogs"></i>',
              'title' => 'Modulo de configuraciones',
            'keys' => [
              'settings' => 'Puede modificar la configuración.'
            ]
            ],

            'orders' => [
              'icon' => '<i class="fas fa-clipboard"></i>',
              'title' => 'Modulo de ordenes',
            'keys' => [
              'orders_list' => 'Puede ver el listado de ordenes.',
              'orders_delete' => 'Puede eliminar las ordenes.'
            ]
            ],

            'messages' => [
              'icon' => '<i class="fas fa-envelope"></i>',
              'title' => 'Modulo de mensajes',
            'keys' => [
              'messages_list' => 'Puede ver el listado de los mensajes.',
              'messages_delete' => 'Puede eliminar los mensajes.'
            ]
            ],

            'sliders' => [
              'icon' => '<i class="fas fa-images"></i>',
              'title' => 'Modulo de sliders',
            'keys' => [
              'sliders_list' => 'Puede ver el listado de los sliders.',
              'slider_add' => 'Puede agregar sliders.',
              'slider_edit' => 'Puede editar los sliders',
              'slider_delete' => 'Puede eliminar los sliders'
            ]
            ]
  ];

  return $p;
}

function getUserYears() {
  $ya = date('Y');
  $ym = $ya - 19;
  $yo = $ym - 62;

  return [$ym, $yo];
}

function getMonths($mode, $key) {
  $m = [
    '01' => "Enero",
    '02' => "Febrero",
    '0' => "Marzo",
    '04' => "Abril",
    '05' => "Mayo",
    '06' => "Junio",
    '07' => "Julio",
    '08' => "Agosto",
    '09' => "Septiembre",
    '10' => "Octubre",
    '11' => "Noviembre", 
    '12' => "Diciembre"
  ];

   if($mode == "list") {
     return $m;
   }else{
    return $m[$key];
   }
}

?>
