<?php
/**
 * EDD Ajax Search Scripts
 *
 * This class provides the scripts functionality
 *
 * @package     EDD\Ajax_Search\Classes\Scripts
 * @copyright   Copyright (c) 2018, Sell Comet
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'EDD_Ajax_Search_Scripts' ) ) {

    class EDD_Ajax_Search_Scripts {

        /**
         * Setup our class
         *
         * @since       1.0.0
         * @return      void
         */
        public function __construct() {
            // Register scripts
            add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ) );
            add_action( 'admin_enqueue_scripts', array( $this, 'register_scripts' ) );

            // Enqueue frontend scripts
            add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ), 100 );
        }

        /**
         * Register scripts
         *
         * @since       1.0.0
         * @return      void
         */
        public function register_scripts() {
            // Use minified libraries if SCRIPT_DEBUG is turned off
            $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

            // Register stylesheets
            wp_register_style( 'edd-ajax-search-css', EDD_AJAX_SEARCH_URL . 'assets/css/edd-ajax-search' . $suffix . '.css', array(), EDD_AJAX_SEARCH_VER, 'all' );

            // Register scripts
            wp_register_script( 'edd-ajax-search-js', EDD_AJAX_SEARCH_URL . 'assets/js/edd-ajax-search' . $suffix . '.js', array( 'jquery', 'jquery-ui-autocomplete' ), EDD_AJAX_SEARCH_VER, true );
        }

        /**
         * Enqueue frontend scripts
         *
         * @since       1.0.0
         * @return      void
         */
        public function enqueue_scripts( $hook ) {

            // Localize scripts
            $script_parameters = array(
                'ajax_url'              => admin_url( 'admin-ajax.php' ),
                'nonce'	                => wp_create_nonce( 'edd_ajax_search_nonce' ),
                'minimum_characters'    => edd_ajax_search()->options->get( 'minimum_characters', 3 ),
            );

            wp_localize_script( 'edd-ajax-search-js', 'edd_ajax_search', $script_parameters );

            // Enqueue Stylesheets
            wp_enqueue_style( 'edd-ajax-search-css' );

            // Enqueue Scripts
            wp_enqueue_script( 'edd-ajax-search-js' );
        }

    }

} // End if class_exists check
