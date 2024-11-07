<?php

    return [
        'user_management' => [
            'title' => 'User Management',
        ],
        'user'  => [
            'title' => 'Users',
            'title_singular' => 'User',
            'fields'=> [
                'name'  =>  'Name',
                'email' =>  'Email',
                'role'  =>  'Role',
                'password' => 'Password',
                'confirm_password' => 'Confirm Password',
            ]
        ],
        'role'  => [
            'title' => 'Roles',
            'title_singular' => 'Role',
            'fields'=> [
                'name'  =>  'Name',
            ]
        ],
        'permission'  => [
            'title' => 'Permissions',
            'title_singular' => 'Permission',
        ],
        'product'  => [
            'title' => 'Products',
            'title_singular' => 'Product',
            'fields'=> [
                'name'  =>  'Name',
                'price' =>  'Price',
                'quantity'  =>  'Quantity',
            ]
        ],
        'transaction'  => [
            'title' => 'Transactions',
            'title_singular' => 'Transaction',
            'no' => 'Transaction No',
            'user_name' => 'User Name',
        ],
    ];
