<?php
/**
 * Kadence Child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Kadence Child
 */

add_action( 'wp_enqueue_scripts', 'kadence_child_enqueue_styles' );
/**
 * Enqueue styles for the child theme.
 */
function kadence_child_enqueue_styles() {
	// Enqueue the parent theme's stylesheet.
    wp_enqueue_style( 'kadence-parent-style', get_template_directory_uri() . '/style.css' );

	// Enqueue the child theme's stylesheet.
	// This will load after the parent theme's stylesheet, allowing for overrides.
    wp_enqueue_style( 'kadence-child-style', get_stylesheet_uri(), array( 'kadence-parent-style' ) );

	// Enqueue custom_style.css for temporary design changes.
    wp_enqueue_style( 'tango-kingdom-custom-style', get_stylesheet_directory_uri() . '/custom_style.css', array( 'kadence-child-style' ), null );
}


// Onetime script to update home access section - this can be removed after it has run once.
add_action( 'admin_notices', 'onetime_update_home_access_section' );
function onetime_update_home_access_section() {
    // Use a persistent option to ensure this runs only once.
    if ( get_option( 'home_access_section_updated_flag_2' ) ) {
        return;
    }

    $post_id = 27; // Target HOME page
    $post = get_post( $post_id );

    if ( ! $post ) {
        // No need to show an error if the post doesn't exist.
        return;
    }

    $content = $post->post_content;

    // Define the new access information block.
    $new_access_info = <<<HTML
<!-- wp:paragraph -->
<p><strong>住所：</strong> 〒627-0133 京都府京丹後市弥栄町鳥取123</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"level":3} -->
<h3>アクセス</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p><strong>電車でお越しの場合：</strong><br>京都丹後鉄道「峰山」駅下車、タクシーで約10分</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph -->
<p><strong>お車でお越しの場合：</strong><br>京都縦貫自動車道より<br>・京丹後大宮ICより約15km(20分)<br>・与謝・天橋立ICより約30km(30分)</p>
<!-- /wp:paragraph -->
HTML;

    // Find the end of the Google Map iframe to insert the new content after it.
    $iframe_end_tag = '</iframe>';
    $iframe_end_pos = strpos( $content, $iframe_end_tag );

    if ( $iframe_end_pos !== false ) {
        // Find the closing tag of the container right after the iframe, if it exists
        $insertion_point = $iframe_end_pos + strlen( $iframe_end_tag );
        $new_content = substr_replace( $content, $new_access_info, $insertion_point, 0 );

        // Only update if the content doesn't already contain the new info.
        if ( strpos( $content, '〒627-0133' ) === false ) {
            $updated_post = array(
                'ID'           => $post_id,
                'post_content' => $new_content,
            );

            wp_update_post( $updated_post );
        }
    }

    // Set the flag so this doesn't run again.
    update_option( 'home_access_section_updated_flag_2', true );

    // Optionally, display a success message for debugging, but it's better to hide it for clean UI.
    // echo '<div class="notice notice-success is-dismissible"><p>HOMEページ (ID: ' . $post_id . ') のアクセスセクションをチェック・更新しました。</p></div>';
}
