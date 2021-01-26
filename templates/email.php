<?php

global $wpdb;

        	$error = '';
        	$success = '';

        	if( isset( $_POST['action'] ) && 'reset' == $_POST['action'] )
        {
            $email = $wpdb->escape(trim($_POST['email']));

            if( empty( $email ) ) {
                $error = 'Veuillez renseigner votre identifiant ou votre email';
            } else if( ! is_email( $email )) {
                $error = 'Adresse email ou identifiant non-valide';
            } else if( ! email_exists( $email ) ) {
                $error = 'Aucun utilisateur enregistré avec cette adresse';
            } else {

                $random_password = wp_generate_password( 12, false );
                $user = get_user_by( 'email', $email );
                $update_user = wp_update_user( array (
                        'ID' => $user->ID,
                        'user_pass' => $random_password
                    )
                );
                if( $update_user ) {
                    $to = $email;
                    $subject = 'LYRE 85 - Forum - Nouveau mot de passe';
                    $sender = get_option('name');
                    $message = 'Bonjour voici votre nouveau mot de passe: '.$random_password;
                    $headers[] = 'MIME-Version: 1.0' . "\r\n";
                    $headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    $headers[] = "X-Mailer: PHP \r\n";
                    $headers[] = 'From: '.$sender.' <'.$email.'>' . "\r\n";
                    $mail = wp_mail( $to, $subject, $message, $headers );

                    if( $mail )
                    $success = 'Votre nouveau mot de passe vous à été envoyé sur votre adresse email';
            ?>

            <script>
                document.location="<?php bloginfo('url'); ?>/auth/login";
            </script>    

        <?php
            } else {
                $error = 'Oops something went wrong updaing your account.';
            }
        }   
    }
?>

