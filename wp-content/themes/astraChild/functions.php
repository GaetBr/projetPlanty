<?php
/**
** activation theme
**/
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() 
{

    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'theme-style', get_stylesheet_directory_uri() . '/css/theme.css', array(), filemtime(get_stylesheet_directory() . '/css/theme.css'));

}

function mon_hook_menu( $items, $args ) {
    // Vérifier si l'utilisateur est connecté & si le menu est le menu principal (location = 'primary') & si le menu est le menu mobile (location = 'mobile_menu')
    /* if ( is_user_logged_in() && $args->theme_location === 'primary'|| $args->theme_location === 'mobile_menu' ) {

        // Lien vers la page d'administration
        $admin_link = '<li class="menu-item admin-link"><a href="' . admin_url() . '">Admin</a></li>';
        debug_to_console("1= " . $admin_link);

        // Trouver l'emplacement où insérer le lien "Admin"
        $position = strpos( $items, '</li>', ceil( strlen( $items ) / 2 ) );
        debug_to_console("2= " . $position);
        // Insérer le lien "Admin" à l'emplacement trouvé
        if ( $position !== false ) {
            $items = substr_replace( $items, $admin_link, $position, 0 );
        debug_to_console("3= " . $position);
        }
   }
    debug_to_console("4= " . $items);
    return $items;
} */
    // Vérifier si l'utilisateur est connecté & si le menu est le menu principal (location = 'primary') & si le menu est le menu mobile (location = 'mobile_menu')
    if ( is_user_logged_in() && ( $args->theme_location === 'primary' || $args->theme_location === 'mobile_menu' ) ) {

        // Lien vers la page d'administration
        $admin_link = '<li class="menu-item admin-link"><a href="' . admin_url() . '">Admin</a></li>';

        // Trouver la première occurrence de la balise '</li>'
        $position = strpos( $items, '</li>' );

        // Insérer le lien "Admin" après la première occurrence trouvée
        if ( $position !== false ) {
            $items = substr_replace( $items, $admin_link, $position + 5, 0 );
        }
    }

    return $items;

}

add_filter( 'wp_nav_menu_items', 'mon_hook_menu', 10, 2 );

add_filter( 'astra_off_canvas_menu_content', 'mon_hook_menu', 10, 2 );

/* add_action( 'wp', 'mon_afficher_emplacements_menu' );
function mon_afficher_emplacements_menu() {
    $registered_menus = get_registered_nav_menus();
    echo '<pre>';
    print_r( $registered_menus );
    echo '</pre>';
} */

function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

