<?php
/**
 * Functions
 *
 * @package     uFramework\Sell_Comet\Funtions
 * @since       1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Setup "Sell Comet" plugin license classes
 *
 * @since       1.0.0
 * @return      void
 */
if ( ! function_exists( 'sellcomet_license_plugin' ) ) {
    function sellcomet_license_plugin( $plugin_path ) {
        if ( is_admin() && function_exists( 'get_plugin_data' ) ) {
            $file = uframework_scandir( $plugin_path, 'php' );

            if ( is_array( $file ) ) {
                $filename = array_keys( $file )[0];

                $plugin_data = get_plugin_data( $file[$filename], false );

                if ( strpos( $plugin_data["PluginURI"], 'wordpress.org' ) === FALSE ) {
                    $license = new Sell_Comet_License(
                        realpath( $file[$filename] ),
                        $plugin_data['Title'],
                        $plugin_data['Version']
                    );
                }
            }
        }
    }
}

/**
 * Returns "Sell Comet" URL
 *
 * @since       1.0.0
 * @return      string URL
 */
if ( ! function_exists( 'sellcomet_url' ) ) {
    function sellcomet_url() {
        return 'https://sellcomet.com';
    }
}

/**
 * Returns "Sell Comet" support URL
 *
 * @since       1.0.0
 * @return      string URL
 */
if ( ! function_exists( 'sellcomet_support_url' ) ) {
    function sellcomet_support_url() {
        return sellcomet_url() . '/support';
    }
}

/**
 * Returns "Sell Comet" product URL
 *
 * @since       1.0.0
 * @return      string URL
 */
if ( ! function_exists( 'sellcomet_product_url' ) ) {
    function sellcomet_product_url( $product_slug ) {
        $product_slug = ( strpos( $product_slug, 'pro' ) === false ) ? $product_slug . '-pro' : $product_slug;
        return sellcomet_url() . '/downloads/' . $product_slug;
    }
}

/**
 * Returns "Sell Comet" product documentation URL
 *
 * @since       1.0.0
 * @return      string URL
 */
if ( ! function_exists( 'sellcomet_product_docs_url' ) ) {
    function sellcomet_product_docs_url( $product_slug ) {
        return sellcomet_url() . '/docs/' . $product_slug;
    }
}

/**
 * Render "Sell Comet" logo
 *
 * @since       1.0.0
 * @return      void
 */
if ( ! function_exists( 'sellcomet_product_logo' ) ) {
    function sellcomet_product_logo() {
    ?>
        <div id="logo" class="sellcomet-logo">
            <svg width="64" height="64" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve">
            <path d="M32.29.47,59.58,16.23V47.74L52.1,52.06V20.55L24.81,4.79ZM11.4,12.56,38.68,28.32V59.8l7.07-4.08V24.27L18.42,8.49ZM5,16.23V47.74L32.29,63.49l0,0V32L5,16.26"/>
            </svg>
        </div>
    <?php
    }
}
