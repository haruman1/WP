<?php
/*
Plugin Name: Jupi Core
Description: Jupi Core Is Helper Plugin For Jupi WordPress Theme.
Version:     1.0.0
Author:      QuomodoTheme
Author URI:  http://www.quomdosoft.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/


if( ! defined( 'ABSPATH' ) ) exit(); // Exit if accessed directly

if( !class_exists( 'jupitercore' ) ){
    class jupitercore{        
        public function __construct(){
            add_action( 'plugins_loaded', [ $this, 'jupitercore_plugin_loaded' ], 10 );
            add_action( 'wp_enqueue_scripts', [$this,'jupitercore_enqueue_script' ], 15 );
            add_action( 'widgets_init', [$this,'jupitercore_widgets_init' ], 20 );
            /*-- Elementor-Functions --*/
            add_action( 'elementor/init', [ $this, 'jupitercore_elementor_init' ], 25 );
            add_action( 'elementor/widgets/widgets_registered', [ $this, 'jupitercore_includes_widgets' ], 30 );
            add_action( 'elementor/frontend/after_register_styles', array ( $this, 'jupitercore_register_fronted_style' ), 35 );            
            add_action( 'elementor/frontend/after_register_scripts', array ( $this, 'jupitercore_register_fronted_scripts' ), 40 );
            add_action( 'elementor/preview/enqueue_styles', [$this , 'jupitercore_enqueue_styles' ], 45 );
        }

        
        public function jupitercore_enqueue_script(){
            wp_enqueue_style( 'slick', plugins_url( '/assets/css/slick.css', __FILE__ ), array(), '1.9.0' );
            // Add Slick Slider Theme, Used For Carousel Slider Design.
            wp_enqueue_style( 'slick-theme', plugins_url( '/assets/css/slick-theme.css', __FILE__ ), array(), '1.9.0' );
            wp_enqueue_style( 'font-awesome-5', plugins_url( '/assets/css/font-awesome-5.css', __FILE__ ), array(), '1.0.0' );
            // Add jupiter Core Style, Used For Stylist Dropdown Select Box
            wp_enqueue_style( 'jupitercore-style', plugins_url( '/assets/css/jupiter-core.css', __FILE__ ), array(), '1.0.0' );
            // Add Slick Slider, Used For Carousel Slider.
            wp_enqueue_script( 'slick', plugins_url( '/assets/js/slick-min.js', __FILE__ ), array('jquery'), '1.9.0', true );
            wp_enqueue_script( 'jupitercore-active', plugins_url( '/assets/js/jupiter-core.js', __FILE__ ), array('jquery'), '1.0.0', true );  
        }
        
        public function jupitercore_plugin_loaded(){
            load_plugin_textdomain( 'jupitercore', false, basename(dirname(__FILE__)) . '/language/' );
            require_once( dirname(__FILE__) . '/include/jupiter-core-functinos.php');
            require_once( dirname(__FILE__) . '/metabox/metabox.php');
            require_once( dirname(__FILE__) . '/widgets/instagram.php');
            require_once( dirname(__FILE__) . '/widgets/social-menu.php');
            require_once( dirname(__FILE__) . '/widgets/popular-post.php');
            require_once( dirname(__FILE__) . '/post-type/portfolio.php');
            //require_once( dirname(__FILE__) . '/addons/icons.php');
        }
        
        
        
        public function jupitercore_widgets_init(){
            register_widget( 'jupiter_social_menu' );
            register_widget( 'jupiter_popular_posts' );
        }
        
        
        public function jupitercore_elementor_init(){
            \Elementor\Plugin::instance()->elements_manager->add_category( 'jupiter-addons',[ 'title'  => 'jupiter' ], 1 );
        }
        
        public function jupitercore_includes_widgets(){
            require_once( dirname(__FILE__) . '/addons/widget-control.php' );
        }
        
        
        public function jupitercore_register_fronted_scripts(){
            wp_register_script( 'el-widget-active', plugins_url( '/assets/js/el-widget-active.js', __FILE__ ), array('jquery'), '1.0.0', true );
            wp_register_script( 'isotope', plugins_url( '/assets/js/isotope-min.js', __FILE__ ), array('jquery'), '1.9.0', true );
            wp_register_script( 'lity-lightbox-js', plugins_url( '/assets/js/lity-min.js', __FILE__ ), array('jquery'), '1.9.0', true );
            wp_register_script( 'tilt-js', plugins_url( '/assets/js/tilt-min.js', __FILE__ ), array('jquery'), '1.9.0', true );
            wp_register_script( 'animate-js', plugins_url( '/assets/js/anime.js', __FILE__ ), array('jquery'), '2.3.1', true );
        }
        
        public function jupitercore_register_fronted_style(){
            wp_register_style( 'lity-lightbox-css', plugins_url( '/assets/css/lity-min.css', __FILE__ ), array(), '1.0.0' );
        }
        
        public function jupitercore_enqueue_styles(){
            wp_enqueue_style( 'lity-lightbox-css' );
            wp_enqueue_style( 'jupitercore-effect' );
            wp_enqueue_script( 'isotope' );
        }
        
    }
    
    new jupitercore();
}