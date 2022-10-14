<?php
class adminApi {
    
    function __construct() {
        $this->init_admin_columns();
        $this->clean_admin();
        $this->initRewrites();
            
        add_action('init', array($this, 'init_posts')); 
        add_action('save_post', array($this, 'neat_save_post'));

    }

    function initRewrites() {
        add_filter('query_vars', 'add_state_var', 0, 1);
        function add_state_var($vars){
            $vars[] = 'state';
            $vars[] = 'neatdata';
            return $vars;
        }
        add_rewrite_rule('^kontakt/([^/]*)/?','index.php?page_id=16&state=$matches[1]','top');
    }

    function init_posts() {
        register_post_type('blog',
        array(
            'labels' => array(
                'name'          => __('Blog', 'blog'),
                'singular_name' => __('Blog', 'blog'),
                'add_new'       => __('Dodaj wpis', 'blog'),
                'add_new_item'  => __('Dodaj nowy wpis', 'blog'),
                'edit'          => __('Edytuj', 'blog'),
                'edit_item'     => __('Edytuj wpis', 'blog'),
                'new_item'      => __('Nowy wpis', 'blog'),
                'view'          => __('Zobacz wpisy', 'blog'),
                'view_item'     => __('Zobacz wpis', 'blog'),
                'search_items'  => __('Szukaj', 'blog'),
                'not_found'     => __('Brak', 'blog'),
                'not_found_in_trash' => __('Brak w koszu', 'blog')
            ),
            'menu_position' => 25,
            'public' => true,
            'hierarchical' => false,
            'has_archive' => true,
            'menu_icon' => 'dashicons-admin-post',
            'rewrite'            => array('slug' => 'post'),
            'supports' => array('title', 'thumbnail', 'comments', 'editor', 'author')
        ));

        register_post_type('influencer',
        array(
            'labels' => array(
                'name'          => __('Influencerzy', 'influencer'),
                'singular_name' => __('Influencer', 'influencer'),
                'add_new'       => __('Dodaj osobę', 'influencer'),
                'add_new_item'  => __('Dodaj nową osobę', 'influencer'),
                'edit'          => __('Edytuj', 'influencer'),
                'edit_item'     => __('Edytuj osobę', 'influencer'),
                'new_item'      => __('Nowa osoba', 'influencer'),
                'view'          => __('Zobacz influencera', 'influencer'),
                'view_item'     => __('Zobacz osobę', 'influencer'),
                'search_items'  => __('Szukaj', 'influencer'),
                'not_found'     => __('Brak', 'influencer'),
                'not_found_in_trash' => __('Brak w koszu', 'influencer')
            ),
            'public' => true,
            'hierarchical' => false,
            'has_archive' => true,
            'menu_icon' => 'dashicons-universal-access-alt',
        ));

        register_post_type('products',
        array(
            'labels' => array(
                'name'          => __('Produkty', 'produkt'),
                'singular_name' => __('Produkt', 'produkt'),
                'add_new'       => __('Dodaj produkt', 'produkt'),
                'add_new_item'  => __('Dodaj nowy produkt', 'produkt'),
                'edit'          => __('Edytuj', 'produkt'),
                'edit_item'     => __('Edytuj produkt', 'produkt'),
                'new_item'      => __('Nowy produkt', 'produkt'),
                'view'          => __('Zobacz produkt', 'produkt'),
                'view_item'     => __('Zobacz produkt', 'produkt'),
                'search_items'  => __('Szukaj', 'produkt'),
                'not_found'     => __('Brak', 'produkt'),
                'not_found_in_trash' => __('Brak w koszu', 'produkt')
            ),
            'public' => true,
            'hierarchical' => false,
            'has_archive' => true,
            'menu_icon' => 'dashicons-welcome-view-site',
        ));

        register_post_type('casestudies',
        array(
            'labels' => array(
                'name'          => __('Case studies', 'case'),
                'singular_name' => __('Case studies', 'case'),
                'add_new'       => __('Dodaj case', 'case'),
                'add_new_item'  => __('Dodaj nowy case', 'case'),
                'edit'          => __('Edytuj', 'case'),
                'edit_item'     => __('Edytuj case', 'case'),
                'new_item'      => __('Nowy case', 'case'),
                'view'          => __('Zobacz case', 'case'),
                'view_item'     => __('Zobacz case', 'case'),
                'search_items'  => __('Szukaj', 'case'),
                'not_found'     => __('Brak', 'case'),
                'not_found_in_trash' => __('Brak w koszu', 'case')
            ),
            'public'        => true,
            'hierarchical'  => false,
            'has_archive'   => true,
            'taxonomies'    => array( 'category' ),
            'menu_icon'     => 'dashicons-media-interactive',
            'supports'      => array('title'),
        ));

        register_post_type('leads',
        array(
            'labels' => array(
                'name'          => __('Leady', 'leads'),
                'singular_name' => __('Lead', 'leads'),
                'add_new'       => __('Dodaj lead', 'leads'),
                'add_new_item'  => __('Dodaj nowy lead', 'leads'),
                'edit'          => __('Edytuj', 'leads'),
                'edit_item'     => __('Edytuj lead', 'leads'),
                'new_item'      => __('Nowy lead', 'leads'),
                'view'          => __('Zobacz lead', 'leads'),
                'view_item'     => __('Zobacz lead', 'leads'),
                'search_items'  => __('Szukaj lead', 'leads'),
                'not_found'     => __('Brak lead', 'leads'),
                'not_found_in_trash' => __('Brak w koszu', 'leads')
            ),
            'public' => true,
            'hierarchical' => false,
            'has_archive' => true,
            'menu_icon' => 'dashicons-clipboard',
        ));


// Thumbnails for Blog post page
add_image_size( 'post_img-size', 540, 540, true );
add_image_size( 'related_post-img-size', 330, 180, true );
add_image_size( 'cards-thumb', 300, 220, true );
add_image_size( 'case_logo_thumb', 360, 222, true );
add_image_size( 'case_single', 650, 350, true );


//Loading script for Infinite Scrolling of Case Studies
function infinite_scrolling() {
    
    wp_enqueue_script('infinite', get_stylesheet_directory_uri() . '/scripts/loadmore.js', array('jquery'), '1.0', true);

    wp_localize_script('infinite', 'WpAjax',
        array(
            'AjaxUrl' => admin_url('admin-ajax.php')
        ));
}
add_action( 'wp_enqueue_scripts', 'infinite_scrolling' );


//Infinite Scroll function
function load_more() {

    $paged = $_POST["page"]+1;

    $query = new WP_Query( array(
        'post_type'     => 'casestudies',
        'post_status'   => 'publish',
        'order'			=> 'DESC',
        'orderby'		=> 'post_date',
        'paged'         => $paged
    ));

       if($query->have_posts()) {
        while($query->have_posts()) : $query->the_post();

        $response .=  get_template_part('/modules/ajax/case-studies-clear');

        endwhile;
    } else {
    echo 0;
    }
    wp_reset_postdata();

    die;
}
add_action('wp_ajax_nopriv_load_more', 'load_more');
add_action('wp_ajax_load_more', 'load_more');


//Loading script for ajax filtering case studies
function load_scripts() {
 
 wp_enqueue_script('ajax', get_stylesheet_directory_uri() . '/scripts/ajax-filtering.js', array('jquery'), '1.0', true);

 wp_localize_script('ajax' , 'wpAjax',
  array(
   'ajaxUrl' => admin_url('admin-ajax.php')
   )
);
}
add_action( 'wp_enqueue_scripts', 'load_scripts' );


//Ajax filtering casestudies
function filter_ajax() {
    $category = $_POST['category'];

    $ajaxposts = new WP_Query([
            'numberposts'       => -1,
            'post_type'		    => 'casestudies',
            'post_status'       => 'publish',
            'order'			    => 'DESC',
            'orderby'		    => 'post_date',
            'tax_query' => array(
        array (
            'taxonomy' => 'category',
            'field' => 'ID',
            'terms' => $category,
        )
    ),
    ]);

    if($ajaxposts->have_posts()) {
    while($ajaxposts->have_posts()) : $ajaxposts->the_post();

      $response .=  get_template_part('/modules/ajax/case-studies');

    endwhile;
    } else {
    $response = 'Nie znaleziono';
    }
    wp_reset_postdata();
    exit;
    die;
}
add_action('wp_ajax_nopriv_filter', 'filter_ajax');
add_action('wp_ajax_filter', 'filter_ajax');

}

    function clean_admin() {

        function neat_admin_menus() {
            remove_menu_page( 'jetpack' );
            remove_menu_page( 'edit.php' );
            remove_menu_page( 'edit-comments.php' );
            remove_menu_page( 'upload.php' );               //Media
            // remove_menu_page( 'edit.php?post_type=page' );  //Pages
            remove_menu_page( 'index.php' );              //Dashboard
            
            if( !current_user_can('administrator') ) {
                remove_menu_page( 'themes.php' );
                remove_menu_page( 'plugins.php' );
                remove_menu_page( 'tools.php' );
                remove_menu_page( 'users.php' );
                remove_menu_page( 'options-general.php' );
                remove_menu_page( 'edit.php?post_type=acf-field-group' );
                remove_menu_page( 'admin.php?page=faulh-admin-listing' );
            }
        }
        add_action( 'admin_menu', 'neat_admin_menus' );

        // function sb_menu_page() {
        //     add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
        //     add_menu_page( 'Ustawienia strony', 'Ustawienia strony', 'manage_options', 'post.php?post=1&action=edit', '', 'dashicons-schedule', 21 );
        // }
        // add_action( 'admin_menu', 'sb_menu_page' );

    }

    function neat_save_post($post_id) {
        remove_action('save_post', array($this, 'neat_save_post'));
        
        if (get_post_type($post_id) == "influencer") {
            $name = get_field('person_profile', $post_id);
            $post_title = $name['person_first_name'] . ' ' . $name['person_last_name'];
            if ($post_title != "") {
                wp_update_post(array('ID' => $post_id, 'post_title' => $post_title ) );
            }
        }

        add_action('save_post', array($this, 'neat_save_post'));
    }


    function init_admin_columns() {

        function influencer_columns_head($defaults) {
            // unset($defaults['title']);
            unset($defaults['date']);
            $defaults['shop_brand']  = 'Brand';
            $defaults['shop_address']  = 'Adres';
            $defaults['shop_status']  = 'Status';
            return $defaults;
        }
        
        function influencer_columns_content($column_name, $post_ID) {
            if ($column_name == 'shop_brand') {
                $brand = get_field('shop_brand', $post_id);
                $term = get_term($brand);
                $link = '<a href="'.get_site_url().'/wp-admin/post.php?post=' . $post_ID . '&action=edit"><strong>' . $term->name . '</strong></a>';
                echo $link;
            }
            if ($column_name == 'shop_status') {
                $title = get_field('shop_status', $post_id);
                $map = [
                    'on' => 'aktywny',
                    'off' => 'wyłączony'
                ];
                echo $map[$title];
            }
            if ($column_name == 'shop_address') {
                $title = get_field('shop_address', $post_id);
                $link = '<a href="'.get_site_url().'/wp-admin/post.php?post=' . $post_ID . '&action=edit"><strong>' . $title . '</strong></a>';
                echo $link;
            }
        }

        // add_filter( 'manage_influencer_posts_columns', 'influencer_columns_head');
        // add_action( 'manage_influencer_posts_custom_column', 'influencer_columns_content', 10, 2);

    }
    
}



class neatMailer {
	
	public $mailer, $emails;
	function __construct($init = null) {
        $sett = get_field('contact_settings', 16);
        $emails = [
            'email'         => $sett['global_mailer_email'],
            'sender'        => $sett['global_mailer_sender'],
            'admins'        => $sett['global_mailer_admin'],
            'ty_contact'    => get_field('ty_contact_mail', 1),
        ];
        $this->emails = $emails;
	}
	
	function send_mail($mail_info) {

        $from = $this->emails['email'];
		$to = $mail_info['to'];
		$mail_subject = $mail_info['subject'];
		$subject =  '=?utf-8?B?' . base64_encode($mail_subject) . '?=';
        $sender = 'From: ' . $this->emails['sender'];
        $sender .= ' <' . $from . '>' . "\r\n";
		
		$message = $this->mail_html('head', $mail_subject);
		$message .= $mail_info['message'];
		$message .= $this->mail_html('footer');
		
		$headers[] = 'MIME-Version: 1.0' . "\r\n";
		$headers[] = 'Content-type: text/html; charset=utf-8' . "\r\n";
		$headers[] = "X-Mailer: PHP \r\n";
		$headers[] = $sender;
		
		$mail = wp_mail($to, $subject, $message, $headers);
		
    }


    function mail_html($part, $subject = null) {
		
		$head = '<!doctype html>
		<html lang="pl">
		<head>
		  <meta charset="utf-8">
		  <title>' . $subject . '</title>
		</head>
		<body bgcolor="#ffffff" style="background: #ffffff; padding: 50px 0; margin: 0px; text-align: center;">
			<table width="650" border="0" cellspacing="0" cellpadding="0" style="margin: auto;" align="center">
			<tr>
				<td align="center" valign="middle">
 					<img src="' . get_template_directory_uri() . '/assets/sb-logo-black.png" alt="Sport Brokers" width="300" style="margin: 50px auto;">
				</td>
			</tr>
			<tr>
				<td style="padding: 25px 30px; line-height: 21px; font-family: Arial; color: #333; font-size: 15px; text-align: left; background: #efefef;">';
		
		$footer = '
				</td>
			</tr>
			<tr>
				<td style="padding: 11px; text-align: center; font-family: Arial; color: #a0a0a0; font-size: 10px; text-align: center; border-top: 1px solid #cecece;">
				Ten e-mail został wygenerowany automatycznie. Nie odpowiadaj na niego.<br/>
			</td>
			</tr>
			</table>
		</body>
		</html>';
		
		switch($part) {
			case "head": return $head; break;
			case "footer": return $footer; break;
		}

    }


    function add_lead($arr = null) {
		
		$api = new neatApi();
		$info = (is_array($arr)) ? $arr : $_POST;
		unset( $info['action'] );
	
		$lead_meta = array(
		    'lead_sender'     => sanitize_email( $info['email'] ),
		    'lead_telephone'  => sanitize_text_field( $info['telephone'] ),
		    'lead_first_name' => sanitize_text_field( $info['first_name'] ),
		    'lead_last_name'  => sanitize_text_field( $info['last_name'] ),
		    'lead_topic'      => sanitize_text_field( $info['topic'] ),
		    'lead_content'    => sanitize_textarea_field( $info['content'] ),
		    'lead_privacy'    => (( $info['lead_privacy'] == 0 ) ? false : true),
        );

        if (strlen($lead_meta['lead_first_name']) < 3
            || strlen($lead_meta['lead_last_name']) < 3
            || strlen($lead_meta['lead_sender']) < 3) {

            echo json_encode( array(
                'success'    => false,
                'msg'        => get_field('notify_ty_error', 1),
            ) );
            die();
        }

		
		/* add lead post */
		$lead_args = array(
			'post_title'     => sanitize_email($info['email']),
			'post_type'      => "leads",
		    'post_content'   => $lead_meta['lead_telephone'] . ' - ' . $lead_meta['lead_sender'],
			'post_status'    => 'publish'
		);
		$new_lead = wp_insert_post($lead_args);
		
		/* lead post update fields */
		foreach ($lead_meta as $mk => $mv):
			add_post_meta($new_lead, $mk, $mv, true);
		endforeach;
		
		
		/* mail */
		$neatMailer = new neatMailer();
		$mail_msg = $this->emails['ty_contact'] . '<br/><br/>';
        if (!empty($lead_meta['lead_topic'])) {
            $$mail_msg .= '<strong>Temat:</strong> ' . $lead_meta['lead_topic'] . '<br/><br/>';
		}
		$mail_msg .= '<strong>' . $lead_meta['lead_first_name'] . ' ' . $lead_meta['lead_last_name'] . '</strong><br/>';
        $mail_msg .= $lead_meta['lead_sender'] . '<br/>';
        if (!empty($lead_meta['lead_telephone'] ) ) {
            $mail_msg .= $lead_meta['lead_telephone'] . '<br/>';
        }
        $mail_msg .= '<br/>Wiadomość:<br/>' . nl2br($lead_meta['lead_content']);
		
		
		$mail_info = array(
			'to'         => $lead_meta['lead_sender'],
			'subject'    => 'Zapytanie ze strony www.sportbrokers.pl', //$lead_meta['lead_topic'],
			'message'    => $mail_msg ,
		);
		$neatMailer->send_mail( $mail_info );
		
		/* send to admin */
		$admin_email = $this->emails['admins']; // get_field( 'global_admin_email', 'options' );
		$admin_info = $mail_info;
        $admin_info['to'] = $admin_email;
        // print_r($admin_info);
		$neatMailer->send_mail( $admin_info );
		
		echo json_encode( array(
			'success'    => true,
			'msg'        => get_field('notify_ty_contact', 1),
		) );
		
		die();
		
    }
    
    function add_newsletter() {
	    
	    $data = $_POST;
	    $email = sanitize_email($data['mailing-mail']);

	    $is_user = get_user_by('email', $email);
	    if( !$is_user ) {
	        
	        $random_password = wp_generate_password( 8, false );
	        $userdata = array(
	            'user_login'  =>  sanitize_title( $email ),
	            'user_email'  =>  $email,
	            'user_pass'   =>  $random_password,
	        );
	        $user_id = wp_insert_user( $userdata );
	            
	        $title = explode( '@', $email );
	        $args = array(
	            'post_title'     => $title[0],
                'post_type'      => "clients",
                'post_content'   => $email,
                'post_status'    => 'publish'
            );
            $new_client = wp_insert_post( $args );
            update_field( 'client_email', $email, $new_client );
            update_field( 'client_user', $user_id, $new_client );
            update_field( 'client_status', 'newsletter', $new_client );
            update_field( 'client_agree_newsletter', 1, $new_client );
            update_field( 'client_agree_reg_newsletter', 1, $new_client );
            
            echo json_encode( array(
                'success'      => true,
                'msg'          => 'Dziękujemy za zapisanie się do newslettera',
            ));
	            
	        
	    } else {

	        $client = $this->clientProfileInfo($is_user->ID);
	        if (!$client) {
	            
                $title = explode('@', $email);
                $args = array(
                    'post_title'     => $title[0],
                    'post_type'      => "clients",
                    'post_content'   => $email,
                    'post_status'    => 'publish'
                );
                $new_client = wp_insert_post( $args );
                update_field( 'client_email', $email, $new_client );
                update_field( 'client_user', $is_user->ID, $new_client );
                update_field( 'client_status', 'newsletter', $new_client );
                update_field( 'client_agree_newsletter', 1, $new_client );
                update_field( 'client_agree_reg_newsletter', 1, $new_client );
                
            } else {

                $newsletter_status = get_field('client_agree_newsletter', $client->ID);
                if ($newsletter_status == 1) {
                    
                    echo json_encode(array(
                        'success'      => false,
                        'msg'          => 'Podany adres e-mail jest już zapisany do newslettera',
                    ));
                    die();
                    
                } else {
    	            update_field('client_agree_newsletter', 1, $client->ID);
    	            update_field('client_agree_reg_newsletter', 1, $client->ID);
                }

	            echo json_encode(array(
	                'success'      => true,
	                'msg'          => 'Dziękujemy za zapisanie się do newslettera',
	            ));
	        }
	    }
	    die();
	}

}


?>