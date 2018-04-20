<?php
/**
 * EDD Ajax Search Shortcodes
 *
 * This class provides the shortcode functionality
 *
 * @package     EDD\Ajax_Search\Classes\Widgets
 * @copyright   Copyright (c) 2018, Sell Comet
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'EDD_Ajax_Search_Widgets' ) ) {

    class EDD_Ajax_Search_Widgets {

        /**
         * Setup our class
         *
         * @since       1.0.0
         * @return      void
         */
        public function __construct() {
            require_once EDD_AJAX_SEARCH_DIR . 'widgets/edd-ajax-search-widget.php';

            add_action( 'widgets_init', array( $this, 'widgets_init' ) );
        }

        /**
         * Register our widget (EDD_Ajax_Search_Widget)
         *
         * @since       1.0.0
         * @return      void
         */
        public function widgets_init() {
            register_widget( 'EDD_Ajax_Search_Widget' );
        }

    }

}
