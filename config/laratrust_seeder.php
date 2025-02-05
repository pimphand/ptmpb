<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'developer' => [
            'users' => 'c,r,u,d',
            'profile' => 'r,u',
            'blog' => 'c,r,u,d',
            'products' => 'c,r,u,d',
            'categories' => 'c,r,u,d',
            'blog-categories' => 'c,r,u,d',
            'sku' => 'c,r,u,d',
            'order' => 'c,r,u,d',
            'message' => 'c,r,u,d',
            'contact' => 'c,r,u,d',
            'gallery' => 'c,r,u,d',
            'about' => 'c,r,u,d',
            'team' => 'c,r,u,d',
            'banner' => 'c,r,u,d',
            'testimonial' => 'c,r,u,d',
            'faq' => 'c,r,u,d',
            'setting' => 'c,r,u,d',
        ],

        'admin' => [
            'users' => 'c,r,u,d',
            'profile' => 'r,u',
            'products' => 'c,r,u,d',
            'categories' => 'c,r,u,d',
            'sku' => 'c,r,u,d',
            'order' => 'c,r,u,d',
            'message' => 'c,r,u,d',
        ],
        'content' => [
            'profile' => 'r,u',
            'blog-categories' => 'c,r,u,d',
            'blog' => 'c,r,u,d',
        ],
        //
        'sales' => [
            'profile' => 'r,u',
            'order' => 'c,r',
        ],
        'driver' => [
            'profile' => 'r,u',
            'order' => 'r,u',
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
    ],
];
