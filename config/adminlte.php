<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#61-title
    |
    */

    'title' => 'Cargo Trends',
    'title_prefix' => '',
    'title_postfix' => '',

    'mailJetFromEmail' => env('MAILJET_FROM_EMAIL', 'cargotrends@gmail.com'),
    'mailJetFromName' => env('MAILJET_FROM_NAME', 'Cargo Trends'),

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#62-favicon
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => true,
    'use_custom_favicon' => false,
    'path_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#63-logo
    |
    */

    'logo' => '<b>Cargo Trends</b>',
    'logo_img' => '',
    'logo_img_auth' => 'img/logo-auth.png',
    'logo_img_class' => 'brand-image elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Cargo Trends',

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#64-user-menu
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => true,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => true,
    'usermenu_desc' => true,
    'usermenu_profile_url' => true,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#65-layout
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#661-authentication-views-classes
    |
    */

    'classes_auth_card' => '',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#662-admin-panel-classes
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => 'container-fluid',
    'classes_content' => 'container-fluid',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => 'nav-legacy',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#67-sidebar
    |
    */

    'sidebar_mini' => true,
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#68-control-sidebar-right-sidebar
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#69-urls
    |
    */

    'use_route_url' => false,

    'dashboard_url' => 'admin',

    'logout_url' => 'logout',

    'login_url' => 'login',

    'register_url' => 'register',

    'password_reset_url' => 'password/reset',

    'password_email_url' => 'password/email',

    'profile_url' => true,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#610-laravel-mix
    |
    */

    'enabled_laravel_mix' => true,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#611-menu
    |
    */

    'menu' => [
        [
            'text' => 'Visit Site',
            'url' => '/',
            'icon'        => 'fas fa-desktop',
            'target' => '_blank',
            'topnav' => true,
        ],
        [
            'text'          => 'dashboard',
            'url'           => 'jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/dashboard',
            'icon'          => 'fas fa-tachometer-alt',
        ],
        ['header'   => 'manage_content', 'can'  => ['read-posts','read-pages']],
        [
            'text'          => 'Posts',
            'icon'          => 'fas fa-book',
            'can'           => 'read-posts',
            'submenu'       => [
                [
                    'text'      => 'All Posts',
                    'url'       => 'jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/manage/posts',
                    'can'       => 'read-posts',
                    'active'    => ['jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/manage/posts', 'jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/manage/posts/*/edit'],
                ],
                [
                    'text'      => 'Add New Post',
                    'can'       => 'add-posts',
                    'url'       => 'jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/manage/posts/create',
                ],
                [
                    'text'      => 'Categories',
                    'url'       => 'jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/manage/categories',
                    'can'       => 'read-categories',
                    'active'    => ['jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/manage/categories', 'jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/manage/categories/*/edit'],
                ],
                [
                    'text'      => 'Tags',
                    'url'       => 'jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/manage/tags',
                    'can'       => 'read-tags',
                    'active'    => ['jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/manage/tags', 'jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/manage/tags/*/edit'],
                ]
            ]
        ],
        [
            'text'              => 'Pages',
            'icon'              => 'fas fa-copy',
            'can'               => 'read-pages',
            'submenu'           => [
                [
                    'text'          => 'All Pages',
                    'url'           => 'jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/manage/pages',
                    'can'           => 'read-pages',
                ],
                [
                    'text'          => 'Add New',
                    'url'           => 'jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/manage/pages/create',
                    'can'           => 'create-pages',
                ]
            ]
        ],
        [
            'text'        => 'Contacts',
            'url'         => 'jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/manage/contacts',
            'can'         => 'read-contacts',
            'icon'        => 'fa fa-envelope'
        ],
        [
            'text'        => 'Magazines',
            'url'         => 'jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/magazines',
            'can'         => 'read-magazines',
            'icon'        => 'fa fa-newspaper'
        ],
        [
            'text'        => 'View Newsletter',
            'url'         => '/view-news-letter',
            'can'         => 'read-magazines',
            'icon'        => 'fas fa-envelope'
        ],
        [
            'text'        => 'Latest Edition',
            'url'         => 'jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/manage/latest-edition',
            'can'         => 'read-edition',
            'icon'        => 'fas fa-print'
        ],
        [
            'text'        => 'Sponsored Video',
            'url'         => 'jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/manage/sponsor-video',
            'can'         => 'read-edition',
            'icon'        => 'fab fa-youtube'
        ],
        [
            'text'          => 'Appearance',
            'icon'          => 'fas fa-brush',
            'can'           => 'read-menus',
            'submenu'       => [
                [
                    'text'      => 'Menu',
                    'url'       => 'jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/manage/menu?menu=1',
                    'can'       => 'read-menus',
                    'active'    => ['jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/manage/menu']
                ],
                // [
                //     'text'      => 'Themes',
                //     'url'       => 'jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/manage/themes',
                // ],
            ]
        ],
        [
            'text'        => 'Advertisement',
            'url'         => 'jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/manage/advertisement',
            'can'         => 'read-ad',
            'icon'        => 'fas fa-bullhorn',
            'active'      => ['jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/manage/advertisement', 'jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/manage/advertisement/*/edit'],
        ],
        [
            'text'        => 'Newsletter',
            'url'         => 'jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/manage/newsletter',
            'can'         => 'read-ad',
            'icon'        => 'fas fa-mail-bulk',
            'active'      => ['jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/manage/newsletter', 'jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/manage/newsletter/*/edit'],
        ],
        [
            'text'        => 'Subscriber',
            'url'         => 'jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/manage/subscriber',
            'can'         => 'read-ad',
            'icon'        => 'fas fa-id-card',
            'active'      => ['jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/manage/subscriber', 'jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/manage/subscriber/*/edit'],
        ],
        // ['header' => 'manage_files', 'can'  => 'read-galleries',],
        // [
        //     'text'        => 'Media',
        //     'icon'        => 'fas fa-hdd',
        //     'can'         => 'read-galleries',
        //     'submenu'     => [
        //         [
        //             'text'      => 'Gallery',
        //             'url'       => 'jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/manage/galleries',
        //             'can'       => 'read-galleries',
        //             'active'    => ['jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/manage/galleries', 'jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/manage/galleries/*/edit'],
        //         ],
        //         [
        //             'text'      => 'Filemanager',
        //             'can'       => 'read-filemanager',
        //             'url'       => 'jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/manage/filemanager',
        //         ],
        //     ]
        // ],
        ['header' => 'account_settings'],
        [
            'text' => 'profile',
            'url'  => 'jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/profile',
            'active' => ['jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/profile/*'],
            'icon' => 'fas fa-fw fa-user',
        ],
        [
            'text' => 'change_password',
            'url'  => 'jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/change-password',
            'icon' => 'fas fa-fw fa-lock',
        ],
        // ['header' => 'manage_users', 'can'  => 'read-users'],
        // [
        //     'text'        => 'Users',
        //     'icon'        => 'fas fa-users',
        //     'can'         => 'read-users',
        //     'submenu'     => [
        //         [
        //             'text'      => 'All Users',
        //             'url'       => 'jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/manage/users',
        //             'can'       => 'read-users',
        //             'active'    => ['jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/manage/users', 'jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/manage/users/*/edit'],
        //         ],
        //         [
        //             'text'      => 'Add New Users',
        //             'can'       => 'add-users',
        //             'url'       => 'jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/manage/users/create',
        //         ],
        //         [
        //             'text'      => 'Roles',
        //             'url'       => 'jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/manage/roles',
        //             'can'       => 'read-roles',
        //             'active'    => ['jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/manage/roles', 'jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/manage/roles/*', 'jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/manage/roles/*/edit']
        //         ],
        //         [
        //             'text'      => 'Permission',
        //             'url'       => 'jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/manage/permissions',
        //             'can'       => 'read-permissions',
        //             'active'    => ['jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/manage/permissions', 'jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/manage/permissions/*', 'jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/manage/permissions/*/edit']
        //         ]

        //     ]
        // ],
        [
            'text'        => 'Social Media',
            'url'         => 'jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/manage/socialmedia',
            'can'         => 'read-social-media',
            'icon'        => 'fa fa-globe',
        ],
        ['header' => 'manage_settings', 'can'  => 'read-settings'],
        [
            'text'        => 'Settings',
            'url'         => 'jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/manage/settings',
            'can'         => 'read-settings',
            'icon'        => 'fas fa-cogs',
        ],
        // [
        //     'text'        => 'Env Editor',
        //     'url'         => 'jKr4lBh9EFkCuAJ2xMZ2pxcU9WC9s7uXSl1ZuUwNo9KE4UJXml3jVNiqIkIx/admin/manage/env',
        //     'can'         => 'read-env',
        //     'icon'        => 'far fa-file',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#612-menu-filters
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#613-plugins
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],
];
