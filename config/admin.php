<?php

return [

    /*
     * Laravel-admin name.
     */
    'name' => 'Laravel Shop',

    /*
     * Logo in admin panel header.
     */
    'logo' => '<b>Laravel</b> Shop',

    /*
     * Mini-logo in admin panel header.
     */
    'logo-mini' => '<b>LS</b>',



    /*
     * Laravel-admin install directory.
     */
    'directory' => app_path('Admin'),

    /*
     * Laravel-admin html title.
     */
    'title' => 'Laravel Shop 管理后台',

    /*
     * Use `https`.
     */
    'secure' => false,


    /*
     * Laravel-admin upload setting. 文件上传设置
     */
    'upload' => [

        'disk' => 'public',

        'directory' => [
            'image' => 'images',
            'file'  => 'files',
        ],
    ],


    /*
     * @see https://adminlte.io/docs/2.4/layout
     */
    'skin' => 'skin-blue-light',

    /*
    |---------------------------------------------------------|
    |LAYOUT OPTIONS | fixed                                   |
    |               | layout-boxed                            |
    |               | layout-top-nav                          |
    |               | sidebar-collapse                        |
    |               | sidebar-mini                            |
    |---------------------------------------------------------|
     */
    'layout' => ['sidebar-mini', 'sidebar-collapse'],

    /*
     * Background image in login page
     */
    'login_background_image' => '',

    /*
     * Version displayed in footer.
     */
    'version' => '1.5.x-dev',

    /*
     * Settings for extensions.
     */
    'extensions' => [

    ],
];
