<?php
/**
 *-------------------------------------------------------------------------
 * Frocer la redirection
 *-------------------------------------------------------------------------
 * Cette appel de function permet de forcer la redirection vers la page auth
 */
    return troll_redirect();
/**
 *-------------------------------------------------------------------------
 * Version du Plugin
 *-------------------------------------------------------------------------
 * Cette fonction permet l'affichage de la version de Trollmageddon
 *
 * WARNING : Ne pas modifier
 */

function troll_version() {
    echo "Trollmageddon - version 0.9.2";
}

/**
 *-------------------------------------------------------------------------
 * Rediréction de la connexion Wordpress
 *-------------------------------------------------------------------------
 *
 * Cette fonction permet la redirection obligatoire des utilisateurs non connecté, L'objectif de ce module est suivant le paramètre séléectionné dans le back-office , le plugin Trollmageddon affiche une section de connexion
 * 
 * Choix des options : 
 * Return = False: connexion obligateyr depuis la page wp-login (wp-admin)
 * Return = True: connexion obligatoire redirigé depuis la custom post Auth 
 *
 * WARNING : L'ensemble des éléments mis en place dans cette section ne doivent pas être modifier
 *
 * @link : https://developer.wordpress.org/reference/functions/wp_redirect/
 * @link : https://trickspanda.com/force-users-login-viewing-wordpress/
 */

function troll_redirect() {

    global $wpdb;

    $etat_du_troll = $wpdb->get_var( "SELECT troll_value FROM ".$wpdb->prefix."troll_options WHERE troll_name = 'troll_redirect'" );

    if ($etat_du_troll == "true") {
        function troll_custom_redirect() {
            //vérification des injections et accès interne . ( Autorisation des Crons / Ajax)
            if ( ( defined( 'DOING_AJAX' ) && DOING_AJAX ) || ( defined( 'DOING_CRON' ) && DOING_CRON ) || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
                return;
            }

            // Redirection des utilisateurs
            if ( !is_user_logged_in() ) {
                // Récupération des urls
                $url  = isset( $_SERVER['HTTPS'] ) && 'on' === $_SERVER['HTTPS'] ? 'https' : 'http';
                $url .= '://' . $_SERVER['HTTP_HOST'];
                // Vérification des ports
                if ( strpos( $_SERVER['HTTP_HOST'], ':' ) === FALSE ) {
                    $url .= in_array( $_SERVER['SERVER_PORT'], array('80', '443') ) ? '' : ':' . $_SERVER['SERVER_PORT'];
                }
                $url .= $_SERVER['REQUEST_URI'];

            // Mise en place des filtres
            $whitelist = apply_filters( 'troll_doit_laisser_passer', array() );
            $url_login = "/auth/login/";

            if ( preg_replace('/\?.*/', '', $url) != preg_replace('/\?.*/', '', site_url($url_login)) && !in_array($url, $whitelist) ) {
                wp_safe_redirect( site_url($url_login), 302 ); exit();
            }
        }
        }
        add_action( 'template_redirect', 'troll_custom_redirect' );
		
	//Redirection vers la login du troll et passage d'infos en $_GET pour afficher le message d'erreur
		//Si mauvais identifiant ou mdp
		function troll_login_failed(){
			$login_page  = home_url( '/auth/login/' );
		  wp_redirect( $login_page . '?login=failed' );
		  exit;
		}
		add_action( 'wp_login_failed', 'troll_login_failed' );
		 
		//Si identifiant ou mdp vide
		function troll_verify_username_password( $user, $username, $password ) {
		  $login_page  = home_url( '/auth/login/' );
			if( $username == "" || $password == "" ) {
				wp_redirect( $login_page . "?login=empty" );
				exit;
			}
		}
		add_filter( 'authenticate', 'troll_verify_username_password', 1, 3);


        /**
         *-------------------------------------------------------------------------
         * Autorisation d'accès à ces pages
         *-------------------------------------------------------------------------
         *
         * Cette fonction permet d'autoriser l'accès à des pages précices suivant un permalien défini
         * 
         * WARNING: Si les permaliens ne correspondent pas à ceux indiqué ci-dessous alors elle ne seront pas accessible
         *
         * @link : https://developer.wordpress.org/reference/functions/wp_redirect/
         * @link : https://trickspanda.com/force-users-login-viewing-wordpress/
         * @link : https://codex.wordpress.org/Function_Reference/site_url
         *
         * $whitelist[] = site_url();
         */

        function troll_laisse_passer( $whitelist ) {
            $whitelist[] = site_url( '/auth/login/' );
            $whitelist[] = site_url( '/auth/register/' );
            $whitelist[] = site_url( '/auth/validate/' );
            $whitelist[] = site_url( '/auth/lostpassword/' );
            $whitelist[] = site_url( '/legal/report/' );
            $whitelist[] = site_url( '/legal/general-condition/' );
            $whitelist[] = site_url( '/legal/user-condition/' );
            $whitelist[] = site_url( '/legal/regulation/' );
            $whitelist[] = site_url( '/legal/status/' );
            $whitelist[] = site_url( '/legal/general-information/' );
            $whitelist[] = site_url( '/legal/legal-documentation/' );
            return $whitelist;
        }
        add_filter('troll_doit_laisser_passer', 'troll_laisse_passer', 10, 1);

    } else {
    
    function troll_default_redirect() {

        //vérification des injections et accès interne . ( Autorisation des Crons / Ajax)
        if ( ( defined( 'DOING_CRON' ) && DOING_CRON ) || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
            return;
        }

        // Redirection des utilisateurs
        if ( !is_user_logged_in() ) {
            // Récupération des urls
            $url  = isset( $_SERVER['HTTPS'] ) && 'on' === $_SERVER['HTTPS'] ? 'https' : 'http';
            $url .= '://' . $_SERVER['HTTP_HOST'];
            // Vérification des ports
            if ( strpos( $_SERVER['HTTP_HOST'], ':' ) === FALSE ) {
                $url .= in_array( $_SERVER['SERVER_PORT'], array('80', '443') ) ? '' : ':' . $_SERVER['SERVER_PORT'];
            }
            $url .= $_SERVER['REQUEST_URI'];

            // Redirection automatique
            if ( preg_replace('/\?.*/', '', $url) != preg_replace('/\?.*/', '', wp_login_url())) {
                wp_safe_redirect( wp_login_url( $redirect_url ), 302 ); exit();
            }
        } 
    }
    add_action( 'template_redirect', 'troll_default_redirect' );
    }
}

/**
 *------------------------------------------------------------------------
 * Mise en place des templates
 *------------------------------------------------------------------------
 *
 * Cette fonction permet le chargement des templates necessaire à l'interface Front-End du plugin Trollmageddon
 *
 * single_post_auth
 * single_post_legal
 * 
 * WARNING : Ne pas modifier, l'ensemble du plugin ce base sur ces templates
 *
 * @link : https://stackoverflow.com/questions/4647604/wp-use-file-in-plugin-directory-as-custom-page-template
 */

function troll_est_vetu() {

    global $wp;
    $plugindir = dirname( __FILE__ );

    //Sécofication du post type 
    if ($wp->query_vars["post_type"] == 'auth') {
        //nom du template
        $templatefilename = 'single-auth.php';
        if (file_exists(TEMPLATEPATH . '/' . $templatefilename)) {
            $return_template = TEMPLATEPATH . '/' . $templatefilename;
        } else {
            $return_template = $plugindir . '/templates/' . $templatefilename;
        }
        troll_prend_ses_habits($return_template);
    } elseif ($wp->query_vars["post_type"] == 'legal') {
        //nom du template
        $templatefilename = 'single-legal.php';
        if (file_exists(TEMPLATEPATH . '/' . $templatefilename)) {
            $return_template = TEMPLATEPATH . '/' . $templatefilename;
        } else {
            $return_template = $plugindir . '/templates/' . $templatefilename;
        }
        troll_prend_ses_habits($return_template);
    }
}

function troll_prend_ses_habits($url) {
    global $post, $wp_query;
    if (have_posts()) {
        include($url);
        die();
    } else {
        $wp_query->is_404 = true;
    }
}

/**
 *-------------------------------------------------------------------------
 * Ajout d'emplacement widget
 *-------------------------------------------------------------------------
 *
 * Cet ensemble de fonction permet la création d'emplacement de widget
 *
 * @link : https://wpformation.com/wordpress-widget-header/
 */

//Zone de widget - Barre vertical
function troll_widget_bar() {
 
    register_sidebar( array(
    'name' => 'Widget Bar',
    'id' => 'new-widget-area',
    'before_widget' => '<div class="nwa-widget">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="nwa-title">',
    'after_title' => '</h2>',
    ) );
   }   

//Zone de widget - Information légal des formulaires
function legals_information_form() {
 
 register_sidebar( array(

 'name' => 'Légals - Formulaire (1 Module Texte)',
 'id' => 'legals-information-form',
 'before_widget' => '<div class="nwa-widget col-12">',
 'after_widget' => '</div>',
 'before_title' => '<h2 class="nwa-title">',
 'after_title' => '</h2>',
 ) );
}

//Zone de widget - Information pour la page de validation
function validate_information_form() {
 
 register_sidebar( array(

 'name' => 'Validation - Formulaire (1 Module Texte)',
 'id' => 'validate-information-form',
 'before_widget' => '<div class="nwa-widget col-12">',
 'after_widget' => '</div>',
 'before_title' => '<h2 class="nwa-title">',
 'after_title' => '</h2>',
 ) );
}

//Zone de widget - Information pour la page de récupération de mot de passe
function lostpassword_information_form() {
 
 register_sidebar( array(

 'name' => 'Récupération de MDP - Formulaire (1 Module Texte)',
 'id' => 'lostpassword-information-form',
 'before_widget' => '<div class="nwa-widget">',
 'after_widget' => '</div>',
 'before_title' => '<h2 class="nwa-title">',
 'after_title' => '</h2>',
 ) );
}


/*A VOIR AVEC SIMON*/
////// ZONE DE WIGDJET - MENU EVENT
 function right_elastic_menu_init() {
	/*$args = array(
        'name' => 'Right Elastic Menu',
		'before_widget' => '<div class="widget_right_elastic_menu">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    );	
	register_sidebar($args);*/
	
	register_sidebar( array(
   
    'name' => 'Widget Bar - Connecté',
    'id' => 'widget-siderbar-unicom',
    'before_widget' => '<div class="nwa-widget">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="nwa-title">',
    'after_title' => '</h2>',
    ) );
} 

//AFFICHAGE DE LA ZONE DE WIDGET DANS LE HEADER DE TOUT LES PAGES

/*<li>#_EVENTLINK<ul><li>#_EVENTDATES</li><li>#_LOCATIONTOWN</li></ul></li>*/

function display_event_sidebar(){
	?>
	<div class="btnLastEvent">
		<span class="dashicons dashicons-calendar-alt"></span>
	</div>
	<div class="col-sm-12 col-md-5 col-lg-4 col-xl-3" id="lastEvent">
			<div id="mn_event">
                <div class="btn_close_mn">
					<span class="dashicons dashicons-no-alt"></span>
				</div>
			<div id="event-item">
				<!-- ajout de ma nouvelle widget area -->
				<?php if ( is_active_sidebar( 'widget-siderbar-unicom' ) ) : ?>
				<div id="widget_siderbar_unicom" class="nwa-header-widget widget-area" role="complementary">
				<?php dynamic_sidebar( 'widget-siderbar-unicom' ); ?>
				</div>
				<?php endif; ?>
				<!-- fin nouvelle widget area -->
			</div>
		</div>
	</div>
	<?php
}

   //------------------------------------- AJAX LOGIN ------------------------------------------

  /*
|--------------------------------------------------------------------------
| Ajout de la function pour un logo via le back-end
|--------------------------------------------------------------------------
|
| Cette function ajoute une option de personnalisation côté back-end, l'administrateur
| Peut ajouter une image qui sera intégré au plugin
| 
| @link : https://developer.wordpress.org/themes/functionality/custom-logo/
  */


add_action( 'wp_enqueue_scripts', 'load_dashicons' );
function load_dashicons() {
    wp_enqueue_style( 'dashicons' );
}

//------------------------ Walker personnalisé pour le menu social-------------------------

 class social_walker extends Walker_Nav_Menu{
	 
    function start_el(&$output, $item, $depth=0, $args=array(), $id = 0) {
		$object = $item->object;
    	$type = $item->type;
    	$title = $item->title;
    	$description = $item->description;
    	$permalink = $item->url;
		
		$output .= "<li class='item-container'>";
        
		//Add SPAN if no Permalink
		if( $permalink && $permalink != '#' ) {
			$output .= '<a class="' .  implode(" ", $item->classes) . '" href="' . $permalink . '">';
		} else {
			$output .= '<span>';
		}
		
		if( $description != '' && $depth == 0 ) {
			$output .= '<small class="description">' . $description . '</small>';
		}
		if( $permalink && $permalink != '#' ) {
			$output .= '</a>';
		} else {
			$output .= '</span>';
		}

    } 

} 

/* add_action( 'wp_head', 'social_walker_style');
function social_walker_style(){
	?>
	<style>
		.item-container {
			float: left;
			display: block;
		}
		
		
	</style>
<?php
} */