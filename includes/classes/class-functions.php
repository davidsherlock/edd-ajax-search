<?php
/**
 * EDD Ajax Search Functions
 *
 * This class provides the core functionality for the Ajax Search plugin
 *
 * @package     EDD\Ajax_Search\Classes\Functions
 * @copyright   Copyright (c) 2018, Sell Comet
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'EDD_Ajax_Search_Functions' ) ) {

    class EDD_Ajax_Search_Functions {

        /**
         * Setup our class
         *
         * @since       1.0.0
         * @return      void
         */
        public function __construct() {

            // WordPress Ajax requests
            add_action( 'wp_ajax_edd_ajax_search', array( $this, 'ajax_search' ) );
            add_action( 'wp_ajax_nopriv_edd_ajax_search', array( $this, 'ajax_search' ) );
        }

        /**
         * Executes the search query to match best results
         */
        public function ajax_search() {
            $search = sanitize_text_field( $_REQUEST['s'] );

            $transient_name = 'edd_ajax_search_' . $search;

            $excerpt_length = apply_filters( 'edd_ajax_search_excerpt_length', 30 );

            // If this search has been cached already, then use cached result
            if ( false === ( $results = get_transient( $transient_name ) ) ) {

                $limit = edd_ajax_search()->options->get( 'maximum_results', 5 );

                $query_args = apply_filters( 'edd_ajax_search_query_args', array(
                    'post_status'       => 'publish',
                    'post_type'         => 'download',
                    's'                 => $search,
                    'posts_per_page'    => $limit,
                ) );

                // Categories check
                if( ( isset( $_REQUEST['cat'] ) && intval( $_REQUEST['cat'] ) > 0 ) ) {
                    $query_args['tax_query'] = array(
                        'relation'      => 'OR'
                    );

                    $query_args['tax_query'][] = array(
                        'taxonomy'      => 'download_category',
                        'field'         => 'term_id',
                        'terms'         => sanitize_text_field( $_REQUEST['cat'] ),
                    );
                }

                $query = new WP_Query( $query_args );

                if ( $query->have_posts() ) {
                    while ( $query->have_posts() ) {
                        $query->the_post();

                        ob_start(); ?>

                        <div class="edd-ajax-search-result edd-ajax-search-result-download">
                            <?php if ( apply_filters( 'edd_ajax_search_show_download_image', true ) ) : ?>
                            <div class="edd_download_image">
                                <a href="<?php the_permalink(); ?>">
                                    <?php echo get_the_post_thumbnail( get_the_ID(), array( 52, 52 ), array( 'title' => esc_attr( get_the_title() ) ) ); ?>
                                </a>
                            </div>
                            <?php endif; ?>

                            <?php if ( apply_filters( 'edd_ajax_search_show_download_title', true ) ) : ?>
                            <div class="edd_download_title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </div>
                            <?php endif; ?>

                            <?php if ( apply_filters( 'edd_ajax_search_show_download_price', true ) ) : ?>
                            <div class="edd_price edd_download_price">
                                <?php edd_price( get_the_ID() ); ?>
                            </div>
                            <?php endif; ?>

                            <?php if ( apply_filters( 'edd_ajax_search_show_download_excerpt', true ) ) : ?>
                                <?php if ( has_excerpt() ) : ?>
                                    <div class="edd_download_excerpt">
                                        <?php echo wp_trim_words( get_post_field( 'post_excerpt', get_the_ID() ), $excerpt_length ); ?>
                                    </div>
                                <?php elseif ( get_the_content() ) : ?>
                                    <div class="edd_download_excerpt">
                                        <?php echo wp_trim_words( get_post_field( 'post_content', get_the_ID() ), $excerpt_length ); ?>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>

                        <?php $result_html = ob_get_clean();

                        $results[] = array(
                            'value' => get_the_title(),
                            'html'  => $result_html,
                            'link'  => get_the_permalink(),
                        );
                    }

                    $view_more_url_args = apply_filters( 'edd_ajax_search_view_more_url_args', array(
                        's'         => $search,
                        'post_type' => 'download',
                    ) );

                    if ( isset( $_REQUEST['cat'] ) && intval( $_REQUEST['cat'] ) > 0 ) {
                        $view_more_url_args['cat'] = sanitize_text_field( $_REQUEST['cat'] );
                    }

                    $view_more_url = add_query_arg( $view_more_url_args, home_url( '/' ) );

                    $results[] = array(
                        'value'     => $search,
                        'html'      => '<a href="' . $view_more_url . '" class="edd-ajax-search-more">' . __( 'View More', 'edd-search-ajax' ) . '</a>',
                        'link'      => $view_more_url,
                    );
                } else {
                    $results[] = array(
                        'value'     => $search,
                        'html'      => '<div class="edd-ajax-search-no-results">' . __( 'No results found', 'edd-search-ajax' ) . '</div>',
                    );
                }

                // Set a transient of 12 hours for the current search
                set_transient( $transient_name, $results, 12 * HOUR_IN_SECONDS );

            }

            wp_send_json( $results );
            wp_die();
        }

    }

}
