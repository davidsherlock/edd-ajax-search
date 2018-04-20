<?php
/**
 * Ajax Search Widget
 *
 * @package     EDD\Ajax_Search\Widgets\Widget
 * @copyright   Copyright (c) 2018, Sell Comet
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'EDD_Ajax_Search_Widget' ) ) {

    class EDD_Ajax_Search_Widget extends uFramework_Widget {

        /**
         * Setup the widget class
         *
         * @access      public
         * @since       1.0.0
         * @return      void
         */
        public function __construct() {
            $this->widget_slug = 'edd_ajax_search_widget';

            $this->fields = array(
                array(
                    'name'          => __( 'Title:', 'edd-ajax-search' ),
                    'id_key'        => 'title',
                    'id'            => 'title',
                    'type'          => 'text',
                ),
                array(
                    'name'          => __( 'Hide categories filter:', 'edd-ajax-search' ),
                    'id_key'        => 'hide_categories',
                    'id'            => 'hide_categories',
                    'type'          => 'checkbox',
                ),
                array(
                    'name'          => __( 'Hide submit button:', 'edd-ajax-search' ),
                    'id_key'        => 'hide_submit',
                    'id'            => 'hide_submit',
                    'type'          => 'checkbox',
                ),
            );

            $this->defaults = array(
                'title'             => '',
                'hide_categories'   => '',
                'hide_submit'       => '',
            );

            parent::__construct( __( 'EDD Ajax Search', 'edd-ajax-search' ), __( 'Displays a live product search form', 'edd-ajax-search' ) );
        }

        /**
         * Render the widget
         *
         * @access      public
         * @since       1.0.0
         * @return      void
         */
        public function get_widget( $args, $instance ) {
            echo do_shortcode( '[edd_ajax_search
                hide_categories="' . ( $instance['hide_categories'] == 'on' ? 'yes' : 'no' ) . '"
                hide_submit="' . ( $instance['hide_submit'] == 'on' ? 'yes' : 'no' ) . '"
            ]' );
        }
    }

}
