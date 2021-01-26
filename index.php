<?php

defined( 'ABSPATH' ) or die( 'Troll pas content , Troll va te chercher et bruler t\'a famille !' );

//defined( 'DOING_AJAX' ) or die( 'Troll pas content , Troll va te chercher et bruler t\'a famille !' );
//defined( 'DOING_CRON' ) or die( 'Troll pas content , Troll va te chercher et bruler t\'a famille !' );
//defined( 'WP_CLI' ) or die( 'Troll pas content , Troll va te chercher et bruler t\'a famille !' );

/**
 * Trollmageddon Plugin.
 *
 * Trollmageddon est un plugin de gestion d'intra/extranet pour wordpress
 *
 * @package Trollmageddon
 * @subpackage Main
 * @since 0.9.2
 * @author Laurent Grimaldi, Simon Chauchet
 */

/**
 *-------------------------------------------------------------------------
 * Base du plugin
 *-------------------------------------------------------------------------
 *
 * Information par défaut du plugin Trollmageddon
 * 
 * @link https://codex.wordpress.org/Writing_a_Plugin
 *
 * WARNING: Vous devez utilisez ces paramètres
 *
 * Si vous ne respectez pas les configurations initials de Trollmageddon , celui-ci risque de devenir instable
 */

/**
 * Plugin Name: Trollmageddon
 * Plugin URI:  https://gitlab.kenjin.fr/nicolaide/LYRE85
 * Description: Trollmageddon est un plugin pour la mise en place d'un intra/extranet Wordpress
 * Author:      Laurent Grimaldi, Simon Chauchet
 * Author URI:  https://laurentgrimaldi.fr/
 * Version:     0.9.2
 * Text Domain: trollmageddon
 * Domain Path: 
 * License:     Owner (licence.txt)
 * Licence URL : https://www.codeproject.com/info/cpol10.aspx
 */

/**
 *------------------------------------------------------------------------
 * Chargement des fonctionnalités de Trollmageddon
 *------------------------------------------------------------------------
 *
 * Cette section appel toutes les fonctions qu'utilise Trollmageddon
 *
 * WARNING : Vous ne devez pas modifier cet valeur
 */

  require_once 'functions.php';
  require_once 'config.php';

/**
 *-------------------------------------------------------------------------
 * Chargement des templates de Trollmageddon
 *-------------------------------------------------------------------------
 *
 * Ajout de l'action de chargement des templates Trollmageddon
 *
 * Auth - Legal
 *
 * WARNING : Ne pas modifier cette action !
 */
  add_action("template_redirect", 'troll_est_vetu');
 
/**
 *-------------------------------------------------------------------------
 * Chargement des emplacements de widget
 *-------------------------------------------------------------------------
 *
 * Ajout de l'action d'emplactement de widget
 */

  add_action( 'widgets_init', 'troll_widget_bar' );
  add_action( 'widgets_init', 'legals_information_form' );
  add_action( 'widgets_init', 'validate_information_form' );
  add_action( 'widgets_init', 'lostpassword_information_form' );
  add_action( 'widgets_init', 'right_elastic_menu_init' );  add_action('wp_head', 'display_event_sidebar');

/**
 *------------------------------------------------------------------------
 * Desctruction de bp_registration
 *------------------------------------------------------------------------
 *
 * Ajout de l'action de désactivation du plugin buddypress register
 * Ajout du filtre de gestion de la page d'inscription
 *
 * WARNING : Ne pas modifier cette action! 
 * 
 * @link : https://wordpress.stackexchange.com/questions/211687/too-many-redirects-error-when-redirecting-buddypress-register-page-to-wordpress/211866#211866
 *
 * Mise en place du hack pour buddypress
 */

  function my_disable_bp_registration() 
  {   
      remove_action( 'bp_init',    'bp_core_wpsignup_redirect' );   
      remove_action( 'bp_screens', 'bp_core_screen_signup' ); 
  } 

  add_action( 'bp_loaded', 'my_disable_bp_registration' ); 
  add_filter( 'bp_get_signup_page', "firmasite_redirect_bp_signup_page");

  function firmasite_redirect_bp_signup_page($page )
  {
      return bp_get_root_domain() . '/wp-login.php?action=register';
  }


/**
 *--------------------------------------------------------------------
 * Redirection vers la page d'accueil après une déconnexion
 *--------------------------------------------------------------------
 *
 * @link : https://wpmarmite.com/snippet/redirection-accueil-deconnexion/
 */

add_action('wp_logout','wpm_home_redirect_after_logout'); 

function wpm_home_redirect_after_logout(){  
// On redirige vers la page d'accueil
  wp_safe_redirect( home_url() );  
  exit();  
}  
