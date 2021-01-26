<?php

if (is_single('login')) {
    $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

    if (strpos($url, 'login/?user=empty')!==false) {
        echo "<p class='alert alert-danger'>Champs d'identifiant vide</div>";
    }

    if (strpos($url, 'login/?pwd=empty')!==false) {
        echo "<p class='alert alert-danger'>Champs de mote de passe vide</div>";
    }

    if (strpos($url, 'login/?login=empty')!==false) {
        echo "<p class='alert alert-danger'>Champs d'identifiant et de mote de passe vide</div>";
    }	

    if (strpos($url,'login/?login=failed') !== false) {
        echo "<p class='alert alert-danger'>Mot de passe ou nom d'utilisateur incorrect</div>";
    }
} elseif (is_single('register')) {
    $err = '';
    $success = '';

    global $wpdb, $PasswordHash, $current_user, $user_ID;

    if(isset($_POST['task']) && $_POST['task'] == 'register' ) {

        $pwd1 = $wpdb->escape(trim($_POST['pwd1']));
        $pwd2 = $wpdb->escape(trim($_POST['pwd2']));
        $first_name = $wpdb->escape(trim($_POST['first_name']));
        $last_name = $wpdb->escape(trim($_POST['last_name']));
        $email = $wpdb->escape(trim($_POST['email']));
        $username = $wpdb->escape(trim($_POST['username']));
        $url_validate = "/auth/validate/";

        if( $email == "" || $pwd1 == "" || $pwd2 == "" || $username == "" || $first_name == "" || $last_name == "") {

            $err = 'Veuillez remplir les champs obligatoires';

        } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $err = 'Adresse email non-valide';

        } else if(email_exists($email) ) {

            $err = 'L\'adresse email existe déjà';

        } else if($pwd1 <> $pwd2 ){

            $err = 'Le mot de passe ne correspond pas';

        } else {

            $user_id = wp_insert_user( array ('first_name' => apply_filters('pre_user_first_name', $first_name), 'last_name' => apply_filters('pre_user_last_name', $last_name), 'user_pass' => apply_filters('pre_user_user_pass', $pwd1), 'user_login' => apply_filters('pre_user_user_login', $username), 'user_email' => apply_filters('pre_user_user_email', $email), 'role' => 'subscriber' ) );

            if( is_wp_error($user_id) ) {

                 $err = 'Une erreur est survenu lors de la création de l\'utilisateur';

            } else {

				$string = '<script type="text/javascript">';
				$string .= 'window.location.replace ( "' . site_url($url_validate) . '")';
				$string .= '</script>';

				echo $string;

            }
        }
    }
}
