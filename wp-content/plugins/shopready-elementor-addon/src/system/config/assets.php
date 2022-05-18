<?php

return [

    // admin and public 
    // handle name will be converted to - hyphen 
    'css' => [

        [
            'handle_name' => 'shop_ready_admin_base',
            'src'         => SHOP_READY_URL.'src/system/base/assets/css/admin-base.css',
            'file'        => SHOP_READY_DIR_PATH.'src/system/base/assets/css/admin-base.css',
            'minimize'    => false,
            'public'      => false,
            'media'=> 'all',
            'deps' => [

            ]
        ],

        [
            'handle_name' => 'shop_ready_admin_notice',
            'src'         => SHOP_READY_URL.'src/system/base/assets/css/admin-notice.css',
            'file'        => SHOP_READY_DIR_PATH.'src/system/base/assets/css/admin-notice.css',
            'minimize'    => false,
            'public'      => false,
            'media'=> 'all',
            'deps' => [

            ]
        ],

        [
            'handle_name' => 'nifty',
            'src'         => SHOP_READY_URL.'src/system/base/assets/css/nifty.css',
            'file'        => SHOP_READY_DIR_PATH.'src/system/base/assets/css/nifty.css',
            'minimize'    => false,
            'public'      => true,
            'admin'       => true,
            'media'=> 'all',
            'deps' => [
              
            ]
          
        ],

        [
            'handle_name' => 'shop-ready-public-base',
            'src'         => SHOP_READY_URL.'src/system/base/assets/css/public-base.css',
            'file'        => SHOP_READY_DIR_PATH.'src/system/base/assets/css/public-base.css',
            'minimize'    => false,
            'public'      => true,
            'media'       => 'all',
            'deps'        => [
              'nifty'
            ]
          
        ], 
        
        [
            'handle_name' => 'shop-ready-public-default',
            'src'         => SHOP_READY_URL.'src/system/base/assets/css/public-default.css',
            'file'        => SHOP_READY_DIR_PATH.'src/system/base/assets/css/public-default.css',
            'minimize'    => false,
            'public'      => true,
            'media'=> 'all',
            'deps' => [
              'nifty'
            ]
          
        ], 
     
        [
            'handle_name' => 'shop_ready_admin_grid',
            'src'         => SHOP_READY_URL.'src/system/base/assets/css/admin-grid.css',
            'file'        => SHOP_READY_DIR_PATH.'src/system/base/assets/css/admin-grid.css',
            'minimize'    => false,
            'public'      => false,
            'media'=> 'all',
            'deps' => [

            ]
        ],
        
        [
            'handle_name' => 'swiper',
            'src'         => SHOP_READY_URL.'src/system/base/assets/css/swiper-bundle.min.css',
            'file'        => SHOP_READY_DIR_PATH.'src/system/base/assets/css/swiper-bundle.min.css',
            'minimize' => false,
            'public'   => true,
            'media'    => 'all',
            'deps'     => [

            ]
        ],
        [
            'handle_name' => 'slick',
            'src'         => SHOP_READY_URL.'src/system/base/assets/css/slick.min.css',
            'file'        => SHOP_READY_DIR_PATH.'src/system/base/assets/css/slick.min.css',
            'minimize' => false,
            'public'   => true,
            'media'    => 'all',
            'deps'     => [

            ]
        ], 
        
        [
            'handle_name' => 'fontawesome',
            'src'         => SHOP_READY_URL.'src/system/base/assets/css/font-awesome.min.css',
            'file'        => SHOP_READY_DIR_PATH.'src/system/base/assets/css/font-awesome.min.css',
            'minimize' => false,
            'public'   => true,
            'media'    => 'all',
            'deps'     => [

            ]
        ],
        [
            'handle_name' => 'owl-carousel',
            'src'         => SHOP_READY_URL.'src/system/base/assets/css/owl/owl.carousel.min.css',
            'file'        => SHOP_READY_DIR_PATH.'src/system/base/assets/css/owl/owl.carousel.min.css',
            'minimize' => true,
            'public'   => true,
            'media'    => 'all',
            'deps'     => [

            ]
        ],
        [
            'handle_name' => 'owl-carousel-theme',
            'src'         => SHOP_READY_URL.'src/system/base/assets/css/owl/owl.theme.default.css',
            'file'        => SHOP_READY_DIR_PATH.'src/system/base/assets/css/owl/owl.theme.default.css',
            'minimize' => true,
            'public'   => true,
            'media'    => 'all',
            'deps'     => [
                'owl-carousel'
            ]
        ],
        [
            'handle_name' => 'qsocial-share',
            'src'         => SHOP_READY_URL.'src/system/base/assets/css/social-share.css',
            'file'        => SHOP_READY_DIR_PATH.'src/system/base/assets/css/social-share.css',
            'minimize'    => true,
            'public'      => true,
            'media'       => 'all',
            'deps'        => [
                
            ]
        ],
        [
            'handle_name' => 'nice-select',
            'src'         => SHOP_READY_URL.'src/system/base/assets/css/nice-select.css',
            'file'        => SHOP_READY_DIR_PATH.'src/system/base/assets/css/nice-select.css',
            'minimize' => true,
            'public'   => true,
            'media'    => 'all',
            'deps'     => [
                
            ]
        ],
        [
            'handle_name' => 'bvselect',
            'src'         => SHOP_READY_URL.'src/system/base/assets/css/bvselect.css',
            'file'        => SHOP_READY_DIR_PATH.'src/system/base/assets/css/bvselect.css',
            'minimize' => true,
            'public'   => false,
            'media'    => 'all',
            'deps'     => [
                
            ]
        ]   
        
        

    ],
    
    'js' => [

        [
            'handle_name' => 'shop-ready-admin-base',
            'src'         => SHOP_READY_URL.'src/system/base/assets/js/admin-base.js',
            'file'        => SHOP_READY_DIR_PATH.'src/system/base/assets/js/admin-base.js',
            'minimize'    => false,
            'public'      => false, // will load in_admin panel
            'in_footer'   => false,
            'media'=> 'all',
            'deps' => [
                 
            ]
        ],
     
        [
            'handle_name' => 'swiper',
            'src'         => SHOP_READY_URL.'src/system/base/assets/js/swiper-bundle.min.js',
            'file'        => SHOP_READY_DIR_PATH.'src/system/base/assets/js/swiper-bundle.min.js',
            'minimize'    => true,
            'public'      => true, // will load frontend panel
            'in_footer'   => false,
            'media'=> 'all',
            'deps' => [
                 
            ]
        ],

        [
            'handle_name' => 'slick',
            'src'         => SHOP_READY_URL.'src/system/base/assets/js/slick.min.js',
            'file'        => SHOP_READY_DIR_PATH.'src/system/base/assets/js/slick.min.js',
            'minimize'    => true,
            'public'      => true, // will load frontend panel
            'in_footer'   => false,
            'media'=> 'all',
            'deps' => [
                 
            ]
        ],
        
        [
            'handle_name' => 'owl-carousel',
            'src'         => SHOP_READY_URL.'src/system/base/assets/js/owl/owl.carousel.min.js',
            'file'        => SHOP_READY_DIR_PATH.'src/system/base/assets/js/owl/owl.carousel.min.js',
            'minimize'    => true,
            'public'      => true, // will load frontend panel
            'in_footer'   => false,
            'media'=> 'all',
            'deps' => [
              'jquery'   
            ]
        ], 
        
        [
            'handle_name' => 'goodshare',
            'src'         => SHOP_READY_URL.'src/system/base/assets/js/goodshare.min.js',
            'file'        => SHOP_READY_DIR_PATH.'src/system/base/assets/js/goodshare.min.js',
            'minimize'    => true,
            'public'      => true, // will load frontend panel
            'in_footer'   => false,
            'media'=> 'all',
            'deps' => [
              'jquery'   
            ]
        ],
         
        [
            'handle_name' => 'nice-select',
            'src'         => SHOP_READY_URL.'src/system/base/assets/js/jquery.nice-select.min.js',
            'file'        => SHOP_READY_DIR_PATH.'src/system/base/assets/js/jquery.nice-select.min.js',
            'minimize'    => false,
            'public'      => true, // will load frontend panel
            'in_footer'   => false,
            'media'=> 'all',
            'deps' => [
              'jquery'   
            ]
        ], 
        
        [
            'handle_name' => 'bvselect',
            'src'         => SHOP_READY_URL.'src/system/base/assets/js/bvselect.js',
            'file'        => SHOP_READY_DIR_PATH.'src/system/base/assets/js/bvselect.js',
            'minimize'    => true,
            'public'      => false, // will load frontend panel
            'in_footer'   => false,
            'media'=> 'all',
            'deps' => [
              
            ]
        ],
     
        [
            'handle_name' => 'nifty',
            'src'         => SHOP_READY_URL.'src/system/base/assets/js/nifty.js',
            'file'        => SHOP_READY_DIR_PATH.'src/system/base/assets/js/nifty.js',
            'minimize'    => true,
            'public'      => true, // will load frontend panel
            'admin'       => true, // will load frontend panel
            'in_footer'   => false,
            'media'=> 'all',
            'deps' => [
              'jquery'
            ]
        ],

        [
            'handle_name' => 'shop-ready-public-base',
            'src'         => SHOP_READY_URL.'src/system/base/assets/js/public-base.js',
            'file'        => SHOP_READY_DIR_PATH.'src/system/base/assets/js/public-base.js',
            'minimize'    => false,
            'public'      => true, // will load in_admin panel
            'in_footer'   => true,
            'media'=> 'all',
            'deps' => [
                'jquery', 'nifty','wp-util','wc-add-to-cart-variation'
            ]
        ]

      
    ],
    
];