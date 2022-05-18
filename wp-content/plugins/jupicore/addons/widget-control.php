<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.


class jupitercore_Widgets_Control{ 
    public function __construct(){
        $this->jupitercore_Widgets_Control();
    }        
    public function jupitercore_Widgets_Control(){

        if ( file_exists( __DIR__ . '/widgets/button.php' ) ) {
            require_once __DIR__ . '/widgets/button.php';
        }

        if ( file_exists( __DIR__ . '/widgets/text-box.php' ) ) {
            require_once __DIR__ . '/widgets/text-box.php';
        }
        if ( file_exists( __DIR__ . '/widgets/element.php' ) ) {
            require_once __DIR__ . '/widgets/element.php';
        }
        if ( file_exists( __DIR__ . '/widgets/feature-box.php' ) ) {
            require_once __DIR__ . '/widgets/feature-box.php';
        }
        
        if ( file_exists( __DIR__ . '/widgets/price.php' ) ) {
            require_once __DIR__ . '/widgets/price.php';
        }
        
        if ( file_exists( __DIR__ . '/widgets/testimonial.php' ) ) {
            require_once __DIR__ . '/widgets/testimonial.php';
        }
        
        if ( file_exists( __DIR__ . '/widgets/tab-menu.php' ) ) {
            require_once __DIR__ . '/widgets/tab-menu.php';
        }
        
        if ( file_exists( __DIR__ . '/widgets/portfolio.php' ) ) {
            require_once __DIR__ . '/widgets/portfolio.php';
        }

        if ( file_exists( __DIR__ . '/widgets/social-menu.php' ) ) {
            require_once __DIR__ . '/widgets/social-menu.php';
        }


        if ( file_exists( __DIR__ . '/widgets/shortcode.php' ) ) {
            require_once __DIR__ . '/widgets/shortcode.php';
        }

        if ( file_exists( __DIR__ . '/widgets/grid-bar.php' ) ) {
            require_once __DIR__ . '/widgets/grid-bar.php';
        }
        if ( file_exists( __DIR__ . '/widgets/blog.php' ) ) {
            require_once __DIR__ . '/widgets/blog.php';
        }

        if ( file_exists( __DIR__ . '/widgets/feature-more.php' ) ) {
            require_once __DIR__ . '/widgets/feature-more.php';
        }
        
        if ( file_exists( __DIR__ . '/widgets/team.php' ) ) {
            require_once __DIR__ . '/widgets/team.php';
        }
        
        if ( file_exists( __DIR__ . '/widgets/progress.php' ) ) {
            require_once __DIR__ . '/widgets/progress.php';
        }

        if ( file_exists( __DIR__ . '/widgets/lightbox.php' ) ) {
            require_once __DIR__ . '/widgets/lightbox.php';
        }

        if ( file_exists( __DIR__ . '/widgets/product.php' ) ) {
            require_once __DIR__ . '/widgets/product.php';
        }

        if ( file_exists( __DIR__ . '/widgets/image-carousel.php' ) ) {
            require_once __DIR__ . '/widgets/image-carousel.php';
        }
        
        if ( file_exists( __DIR__ . '/widgets/tooltip.php' ) ) {
            require_once __DIR__ . '/widgets/tooltip.php';
        }
  
        if ( file_exists( __DIR__ . '/widgets/flotingeffect.php' ) ) {
            require_once __DIR__ . '/widgets/flotingeffect.php';
        } 

    }

}

new jupitercore_Widgets_Control();