<?php

return[
    'title' => [
        'index' => 'Listado de usuarios',
        'trash' => 'Papelera de usuarios'
    ],
    'profiles' => ['admin'=>'Administrator','user'=>'User'],
    'deletes' =>['active' =>'Active','inactive' => 'Inactive'],
    'filters' => [
        'roles' => ['admin'=> 'Administrators', 'user' => 'Users'],
        'deletes' => [
            'all'=>['title'=>'All','color'=>'primary','icon'=>'users'],
            'active'=> ['title'=>'Active Users','color'=>'success','icon'=>'thumbs-up'],
            'inactive' =>['title'=> 'Inactive Users','color'=>'danger','icon'=>'thumbs-down']
        ]
    ]
];