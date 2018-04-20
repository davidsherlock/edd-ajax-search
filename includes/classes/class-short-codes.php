<?php
/**
 * EDD Ajax Search Shortcodes
 *
 * This class provides the shortcode functionality
 *
 * @package     EDD\Ajax_Search\Classes\Shortcodes
 * @copyright   Copyright (c) 2018, Sell Comet
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'EDD_Ajax_Search_Shortcodes' ) ) {

    class EDD_Ajax_Search_Shortcodes {

        /**
         * Setup our class
         *
         * @since       1.0.0
         * @return      void
         */
        public function __construct() {
            // [edd_ajax_search]
            add_shortcode( 'edd_ajax_search', array( $this, 'ajax_search' ) );
        }

        /**
         * Render the [edd_ajax_search] short code
         *
         * @since       1.0.0
         * @return      void
         */
        public function ajax_search( $atts, $content = null ) {
            $hide_categories_option = (bool) edd_ajax_search()->options->get( 'categories_hide', false );
            $hide_submit_option = (bool) edd_ajax_search()->options->get( 'submit_hide', false );
            $search_restrict_option = (bool) edd_ajax_search()->options->get( 'search_restrict', false );

            $atts = shortcode_atts( array(
                'hide_categories'   => $hide_categories_option ? 'yes' : 'no',
                'hide_submit'       => $hide_submit_option ? 'yes' : 'no',
            ), $atts, 'edd_ajax_search' );

            ob_start();

            /**
             * Before search form container
             */
            do_action( 'edd_ajax_search_form_before' );

            ?>

            <div class="edd-ajax-search-container ui-front">

                <form role="search" method="get" id="edd-ajax-search-form" action="<?php echo esc_url( home_url( '/' ) ) ?>">

                    <?php
                    /**
                     * Search form before
                     */
                    do_action( 'edd_ajax_search_fields_top' );
                    ?>

                    <input type="search"
                           value="<?php echo get_search_query() ?>"
                           name="s"
                           id="edd-ajax-search-search"
                           class="edd-ajax-search-search edd-ajax-search-input"
                           placeholder="<?php echo edd_ajax_search()->options->get( 'search_placeholder', __ ( 'Type to start search...', 'edd-ajax-search' ) ); ?>" />

                    <?php if( $atts[ 'hide_categories' ] == 'no' ) :
                        echo wp_dropdown_categories( array(
                            'hierarchical'     => 1,
                            'orderby'          => 'name',
                            'order'            => 'asc',
                            'depth'            => 0,
                            'hide_empty'       => 0,
                            'show_count'       => 0,
                            'name'             => 'cat',
                            'id'               => 'edd-ajax-search-categories',
                            'taxonomy'         => 'download_category',
                            'echo'             => 0,
                            'title_li'         => '',
                            'class'            => 'edd-ajax-search-categories edd-ajax-search-select',
                            'include'          => array(),
                            'show_option_all'  => __( 'All', 'edd-ajax-search' )
                        ) );
                    endif; ?>

                    <?php if( $atts[ 'hide_submit' ] == 'no' ) : ?>
                        <input type="submit"
                               id="edd-ajax-search-submit"
                               class="edd-ajax-search-submit edd-ajax-search-button"
                               value="<?php echo edd_ajax_search()->options->get( 'submit_label', __ ( 'Search', 'edd-ajax-search' ) ); ?>" />
                    <?php endif; ?>

                    <?php
                    /**
                     * Only search downloads
                     */
                    ?>
                    <?php if ( $search_restrict_option ) : ?>
                    <input type="hidden" name="post_type" value="download" />
                    <?php endif; ?>

                    <?php
                    /**
                     * Search form after
                     */
                    do_action( 'edd_ajax_search_fields_bottom' );
                    ?>

                </form>

            </div>

            <?php
            /**
             * After search form container
             */
            do_action( 'edd_ajax_search_form_after' );

            $content = ob_get_clean();

            return $content;
        }

    }

}// End if class_exists check
