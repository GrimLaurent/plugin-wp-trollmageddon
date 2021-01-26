<?php
/**
 *-------------------------------------------------------------------------
 * Pages d'aministration
 *-------------------------------------------------------------------------
 *
 * Ensemble des pages d'aministration du plugin Trollmageddon
 */

function troll_welcome(){
    include_once 'views/troll-welcome.php';
}

function troll_settings(){
    include_once 'views/troll-settings.php';
}

function troll_ver(){
    include_once 'views/troll-version.php';
}

function troll_changelog(){
    include_once 'views/troll-changelog.php';
}

/**
 *-------------------------------------------------------------------------
 * Administration du plugin
 *-------------------------------------------------------------------------
 *
 * Affichage de l'ensemble du menu de navigation du plugin Trollmageddon
 * Mise en place des différentes dénomination des pages du back-office
 *
 * @link : https://www.wpnormandie.fr/creer-un-menu-dans-ladmin-wordpress-pour-votre-plugin/
 * @link : https://codex.wordpress.org/Adding_Administration_Menus
 */
function troll_menu() {
    add_menu_page( 
        __( "Trollmageddon - Hey Ho !", "TrollPlugin" ),  // texte de la balise <title>
        __( "Trollmagedon", "TrollPlugin" ),   // titre de l'option de menu
        "manage_options", // droits requis pour voir l'option de menu
        "trollmageddon_plugin", // slug
        "troll_welcome", // fonction de rappel pour créer la page
        "dashicons-carrot",
		5
    );

    add_submenu_page( 
        "trollmageddon_plugin",  // slug du menu parent
        __( "Trollmageddon - Hey Ho !", "TrollPlugin" ),  // texte de la balise <title> - même que dans add_menu_page()
        __( "Accueil", "TrollPlugin" ),   // titre de l'option de sous-menu
        "manage_options",  // droits requis pour voir l'option de menu
        "trollmageddon_plugin", // réutiliser le slug du menu parent
        "troll_welcome"  // fonction de rappel pour créer la page - même que dans add_menu_page()
    );

    // seconde option du sous-menu
    add_submenu_page( 
        "trollmageddon_plugin",   // slug du menu parent
        __( "Trollmageddon - Paramètres", "TrollPlugin" ),  // texte de la balise <title>
        __( "Paramètres", "TrollPlugin" ),   // titre de l'option de sous-menu
        "manage_options",  // droits requis pour voir l'option de menu
        "Settings", // slug
        "troll_settings"  // fonction de rappel pour créer la page
    );

    add_submenu_page( 
        "trollmageddon_plugin",
        __( "Trollmageddon - Version", "TrollPlugin" ),
        __( "Version", "TrollPlugin" ),
        "manage_options",
        "Version",
        "troll_ver"
     );

    add_submenu_page( 
        "trollmageddon_plugin",
        __( "Trollmageddon - Changelog", "TrollPlugin" ),
        __( "Changelog", "TrollPlugin" ),
        "manage_options",
        "Changelog",
        "troll_changelog"
     );
}

add_action('admin_menu', 'troll_menu');

/**
 *-------------------------------------------------------------------------
 * Custom Post Auth
 *-------------------------------------------------------------------------
 *
 * Création de la Custom Post Auth
 * Cette cutom post type permet de gérer les posts de connexion du site web
 * Cette fonction ne s'active que si Trollmageddon est actif
 *
 * @link : https://www.wp-hasty.com/tools/wordpress-custom-post-type-generator/
 */

function troll_auth_post_type() {
	// On rentre les différentes dénominations de notre custom post type qui seront affichées dans l'administration
	$labels = array(
		// Le nom au pluriel
		'name'                => _x( 'Gestion de connexion', 'Post Type General Name'),
		// Le nom au singulier
		'singular_name'       => _x( 'Authentification', 'Post Type Singular Name'),
		// Le libellé affiché dans le menu
		'menu_name'           => __( 'Connexion'),
		// Les différents libellés de l'administration
		'all_items'           => __( 'Page de connexion'),
		'view_item'           => __( 'Voir les pages de connexions'),
		'add_new_item'        => __( 'Ajouter une nouvelle zone de connexion'),
		'add_new'             => __( 'Ajouter'),
		'edit_item'           => __( 'Editer la connexion'),
		'update_item'         => __( 'Modifier la connexion'),
		'search_items'        => __( 'Rechercher une connexion'),
		'not_found'           => __( 'Non trouvée'),
        'not_found_in_trash'  => __( 'Non trouvée dans la corbeille'),
	);
	
	$args = array(
		'label'               => __( 'auth'),
        'description'         => __( 'Tous sur Uni-Auth'),
        'menu_icon'           => 'dashicons-lock',
		'labels'              => $labels,
		// On définit les options disponibles dans l'éditeur de notre custom post type ( un titre, un auteur...)
		'supports'            => array( 'title','editor', ),
		/* 
		* Différentes options supplémentaires
		*/	
		'hierarchical'        => false,
		'public'              => true,
		'has_archive'         => false,
		'rewrite'			  => array( 'slug' => 'auth'),

	);
	
    // On enregistre notre custom post type qu'on nomme ici "auth" et ses arguments
	register_post_type( 'auth', $args );

}
add_action( 'init', 'troll_auth_post_type', 0 );

/**
 *-------------------------------------------------------------------------
 * Custom Post Legal
 *-------------------------------------------------------------------------
 *
 * Création de la Custom Post Legal
 * Cette cutom post type permet de gérer les posts juridique du site web
 * Cette fonction ne s'active que si Trollmageddon est actif
 *
 * @link : https://www.wp-hasty.com/tools/wordpress-custom-post-type-generator/
 */

function troll_legal_post_type() {
    // On rentre les différentes dénominations de notre custom post type qui seront affichées dans l'administration
    $labels = array(
        // Le nom au pluriel
        'name'                => _x( 'Gestion Juridique', 'Post Type General Name'),
        // Le nom au singulier
        'singular_name'       => _x( 'Legals', 'Post Type Singular Name'),
        // Le libellé affiché dans le menu
        'menu_name'           => __( 'Juridique'),
        // Les différents libellés de l'administration
        'all_items'           => __( 'Page d\'information juridique' ),
        'view_item'           => __( 'Voir les pages légals'),
        'add_new_item'        => __( 'Ajouter une nouvelle page juridique'),
        'add_new'             => __( 'Ajouter'),
        'edit_item'           => __( 'Editer la mention'),
        'update_item'         => __( 'Modifier la mention'),
        'search_items'        => __( 'Rechercher une page juridique'),
        'not_found'           => __( 'Non trouvée'),
        'not_found_in_trash'  => __( 'Non trouvée dans la corbeille'),
    );
    
    $args = array(
        'label'               => __( 'legal'),
        'description'         => __( 'Tous sur Troll-Legal'),
        'menu_icon'           => 'dashicons-hammer',
        'labels'              => $labels,
        // On définit les options disponibles dans l'éditeur de notre custom post type ( un titre, un auteur...)
        'supports'            => array( 'title','editor', ),
        /* 
        * Différentes options supplémentaires
        */  
        'hierarchical'        => false,
        'public'              => true,
        'has_archive'         => false,
        'rewrite'             => array( 'slug' => 'legal'),

    );
    
    // On enregistre notre custom post type qu'on nomme ici "legal" et ses arguments
    register_post_type( 'legal', $args );

}
add_action( 'init', 'troll_legal_post_type', 0 );