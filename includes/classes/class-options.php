<?php
/**
 * EDD Ajax Search Settings
 *
 * This class provides the options/settings functionality
 *
 * @package     EDD\Ajax_Search\Classes\Options
 * @copyright   Copyright (c) 2018, Sell Comet
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'EDD_Ajax_Search_Settings' ) ) {

    class EDD_Ajax_Search_Options extends uFramework_Options {

        /**
         * Setup our class
         *
         * @since       1.0.0
         * @return      void
         */
        public function __construct() {
            $this->options_key = 'edd-ajax-search';

            add_filter( 'sellcomet_' . $this->options_key . '_settings', array( $this, 'register_settings_url' ) );

            parent::__construct();
        }

        public function register_settings_url( $url ) {
            return 'admin.php?page=' . $this->options_key;
        }

        public function reset_form() {
            // Restores default options
            edd_ajax_search_activation();
        }

        /**
         * Add the options metabox to the array of metaboxes
         * @since  0.1.0
         */
        public function register_form() {
            // Options page configuration
            $args = array(
                'key'      => $this->options_key,
                'title'    => __( 'EDD Ajax Search', 'edd-ajax-search' ),
                'topmenu'  => 'sellcomet',
                'cols'     => 2,
                'boxes'    => $this->boxes(),
                'tabs'     => $this->tabs(),
                'menuargs' => array(
                    'menu_title' => __( 'EDD Ajax Search', 'edd-ajax-search' ),
                ),
                'savetxt'   => __( 'Save Settings', 'edd-ajax-search' ),
                'resettxt'  => __( 'Reset Settings', 'edd-ajax-search' ),
                'admincss'  => '.' . $this->options_key . ' #side-sortables{padding-top: 0 !important;}' .
                      '.' . $this->options_key . '.cmo-options-page .columns-2 #postbox-container-1{margin-top: 0 !important;}' .
                      '.' . $this->options_key . '.cmo-options-page .nav-tab-wrapper{display: none;}'
            );

            // Create the options page
            new Cmb2_Metatabs_Options( $args );
        }

        /**
         * Setup form in settings page
         *
         * @return array
         */
        public function boxes() {
            // Holds all CMB2 box objects
            $boxes = array();

            // Default options to all boxes
            $show_on = array(
                'key'               => 'options-page',
                'value'             => array( $this->options_key ),
            );

            // Search input box
            $cmb = new_cmb2_box( array(
                'id'                => $this->options_key . '-search-input',
                'title'             => __( 'Search Input', 'edd-ajax-search' ),
                'show_on'           => $show_on,
                'display_cb'        => false,
                'admin_menu_hook'   => false,
            ) );

            $cmb->add_field( array(
                'name'              => __( 'Search Placeholder', 'edd-ajax-search' ),
                'desc'              => __( 'Text shown when search input is empty', 'edd-ajax-search' ),
                'id'                => 'search_placeholder',
                'type'              => 'text',
                'default'           => __( 'Type to start search...', 'edd-ajax-search' ),
            ) );

            $cmb->add_field( array(
                'name'              => __( 'Minimum Characters', 'edd-ajax-search' ),
                'desc'              => __( 'Minimum number of characters required to execute the search', 'edd-ajax-search' ),
                'id'                => 'minimum_characters',
                'type'              => 'text_small',
                'attributes'        => array(
                    'type'          => 'number',
                    'pattern'       => '\d*',
                ),
                'default'           => 3,
            ) );

            $cmb->add_field( array(
                'name'              => __( 'Maximum Results', 'edd-ajax-search' ),
                'desc'              => __( 'Maximum number of search results returned', 'edd-ajax-search' ),
                'id'                => 'maximum_results',
                'type'              => 'text_small',
                'attributes'        => array(
                    'type'          => 'number',
                    'pattern'       => '\d*',
                ),
                'default'           => 5,
            ) );

            $cmb->object_type( 'options-page' );

            $boxes[] = $cmb;

            // Submit Button Box
            $cmb = new_cmb2_box( array(
                'id'                => $this->options_key . '-submit-button',
                'title'             => __( 'Submit Button', 'edd-ajax-search' ),
                'show_on'           => $show_on,
                'display_cb'        => false,
                'admin_menu_hook'   => false,
            ) );

            $cmb->add_field( array(
                'name'              => __( 'Hide Submit Button', 'edd-ajax-search' ),
                'desc'              => __( 'Hide submit button by default (overwritable by hide_submit="no")', 'edd-ajax-search' ),
                'id'                => 'submit_hide',
                'type'              => 'checkbox',
            ) );

            $cmb->add_field( array(
                'name'              => __( 'Button Label', 'edd-ajax-search' ),
                'desc'              => __( 'Text shown on the submit button', 'edd-ajax-search' ),
                'id'                => 'submit_label',
                'type'              => 'text',
                'default'           => __( 'Search', 'edd-ajax-search' ),
            ) );

            $cmb->object_type( 'options-page' );

            $boxes[] = $cmb;

            // Categories Filter box
            $cmb = new_cmb2_box( array(
                'id'                => $this->options_key . '-categories-input',
                'title'             => __( 'Categories Filter', 'edd-ajax-search' ),
                'show_on'           => $show_on,
                'display_cb'        => false,
                'admin_menu_hook'   => false,
            ) );

            $cmb->add_field( array(
                'name'              => __( 'Hide Categories Filter', 'edd-ajax-search' ),
                'desc'              => __( 'Hide categories filter by default (overwritable by hide_categories="no")', 'edd-ajax-search' ),
                'id'                => 'categories_hide',
                'type'              => 'checkbox',
            ) );

            $cmb->object_type( 'options-page' );

            $boxes[] = $cmb;

            // Search integration box
            $cmb = new_cmb2_box( array(
                'id'                => $this->options_key . '-search-integration',
                'title'             => __( 'Search Integration', 'edd-ajax-search' ),
                'show_on'           => $show_on,
                'display_cb'        => false,
                'admin_menu_hook'   => false,
            ) );

            $cmb->add_field( array(
                'name'              => __( 'Restrict Search Results', 'edd-ajax-search' ),
                'desc'              => __( 'If checked, the search results will be restricted to downloads only.', 'edd-ajax-search' ),
                'id'                => 'search_restrict',
                'type'              => 'checkbox',
            ) );

            $cmb->object_type( 'options-page' );

            $boxes[] = $cmb;

            // Save Changes Box
            $cmb = new_cmb2_box( array(
                'id'                => $this->options_key . '-submit',
                'title'             => __( 'Save Changes', 'edd-ajax-search' ),
                'show_on'           => $show_on,
                'display_cb'        => false,
                'admin_menu_hook'   => false,
                'context'           => 'side',
            ) );

            $cmb->add_field( array(
                'name'              => '',
                'desc'              => '',
                'id'                => 'submit_box',
                'type'              => 'title',
                'render_row_cb'     => array( $this, 'submit_box' )
            ) );

            $cmb->object_type( 'options-page' );

            $boxes[] = $cmb;

            // Shortcode generator box
            $cmb = new_cmb2_box( array(
                'id'                => $this->options_key . '-shortcode',
                'title'             => __( 'Shortcode Generator', 'edd-ajax-search' ),
                'show_on'           => $show_on,
                'display_cb'        => false,
                'admin_menu_hook'   => false,
                'context'           => 'side',
            ) );

            $cmb->add_field( array(
                'name'              => '',
                'desc'              =>  __( 'From this options page you can configure the default parameters for the [edd_ajax_search] shortcode. Using the form bellow you can generate a custom shortcode to place on any page.', 'edd-ajax-search' ),
                'id'                => 'shortcode_generator',
                'type'              => 'title',
                'after'             => array( $this, 'shortcode_generator' ),
            ) );

            $cmb->object_type( 'options-page' );

            $boxes[] = $cmb;

            return $boxes;
        }


        /**
         * Settings page tabs
         *
         * @return array
         */
        public function tabs() {
            $tabs = array();

            $tabs[] = array(
                'id'    => 'general',
                'title' => 'General',
                'desc'  => '',
                'boxes' => array(
                    $this->options_key . '-search-input',
                    $this->options_key . '-submit-button',
                    $this->options_key . '-categories-input',
                    $this->options_key . '-search-integration',
                ),
            );

            return $tabs;
        }

        /**
         * Submit Box
         *
         * @param array      $field_args
         * @param CMB2_Field $field
         */
        public function submit_box( $field_args, $field ) {
        ?>
            <p>
                <a href="<?php echo sellcomet_product_docs_url( $this->options_key ); ?>" target="_blank" class="uframework-icon-link"><i class="dashicons dashicons-media-text"></i> <?php _e( 'Documentation' ); ?></a>
                <a href="<?php echo sellcomet_product_url( $this->options_key ); ?>" target="_blank" class="uframework-icon-link"><i class="dashicons dashicons-cart"></i> <?php _e( 'Get support and pro features', 'edd-ajax-search' ); ?></a>
            </p>
            <div class="cmb2-actions">
                <input type="submit" name="reset-cmb" value="<?php _e( 'Reset Settings' ); ?>" class="button">
                <input type="submit" name="submit-cmb" value="<?php _e( 'Save Settings' ); ?>" class="button-primary">
            </div>
        <?php
        }

        /**
         * Shortcode Generator
         *
         * @param array      $field_args
         * @param CMB2_Field $field
         */
        public function shortcode_generator( $field_args, $field ) {
        ?>
            <div id="edd-ajax-search-shortcode-form" class="uframework-shortcode-generator">
                <p>
                    <textarea type="text" id="edd-ajax-search-shortcode-input" data-shortcode="edd_ajax_search" readonly="readonly">[edd_ajax_search hide_submit="no" hide_categories="no"]</textarea>
                </p>

                <p>
                    <input type="checkbox" id="shortcode_hide_submit" data-shortcode-attr="hide_submit">
                    <label for="shortcode_hide_submit"><?php _e( 'Hide Submit Button', 'edd-ajax-search' ); ?></label>
                </p>

                <p>
                    <input type="checkbox" id="shortcode_hide_categories" data-shortcode-attr="hide_categories">
                    <label for="shortcode_hide_categories"><?php _e( 'Hide Categories', 'edd-ajax-search' ); ?></label>
                </p>
            </div>
        <?php
        }

    }

} // End if class_exists check
