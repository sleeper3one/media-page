<?php

class neatApi {

    public $test, $adminApi, $mailer;

    function __construct($init = null) {
        define('appversion', 'v103');
        define('apppath', get_stylesheet_directory_uri());
        define('templatepath', get_template_directory());

        if ($init != null) {
            $this->adminApi = new adminApi();
            $this->mailer = new neatMailer();
        }
    }

    function getSiteSettings() {
        $map = [
            'title'         => get_field('settings_title', 1),
            'desc'          => get_field('settings_description', 1),
            'keywords'      => get_field('settings_keywords', 1),
            'global_name'   => get_field('settings_global_name', 1),
            'og_img'        => get_field('settings_og_img', 1),
            'api_analytics' => get_field('settings_api_analytics', 1),
            'api_maps'      => get_field('settings_api_maps', 1),
            'menu'          => [],
        ];

        $tmp = get_field('settings_menu', 1);
        foreach ($tmp as $k => $v):
            $map['menu'][$k] = $v;
            $map['menu'][$k]['slug'] = get_post_field('post_name', $v['menu_section']);
        endforeach;

        return $map;
    }

    function getSiteFooter() {

        $map = [
            'points'    => get_field('settings_footer_points', 1),
            'fb_link'   => 'https://facebook.com/' . get_field('settings_fb_page', 1),
            'ig_link'   => 'https://www.instagram.com/' . get_field('settings_ig_page', 1),
            'tt_link'   => 'https://twitter.com/' . get_field('settings_tt_page', 1),
            'li_link'   => 'https://linkedin.com/company/' . get_field('settings_li_page', 1),
            'yt_link'   => 'https://www.youtube.com/channel/' . get_field('settings_yt_page', 1),
            'fb_nick'   => get_field('settings_fb_page', 1),
            'ig_nick'   => get_field('settings_ig_page', 1),
            'tt_nick'   => get_field('settings_tt_page', 1),
            'li_nick'   => get_field('settings_li_page', 1),
            'yt_nick'   => get_field('settings_yt_page', 1),
            'gdpr'      => [
                'contact_form' => get_field('udhd_contact_form', 1),
                'privacy' => get_field('udhd_privacy', 1),
                'cookies' => get_field('udhd_cookies', 1),
                'conditions' => get_field('udhd_conditions', 1),
                'regulations' => get_field('udhd_regulations', 1),
            ],
        ];
        return $map;

    }

    function getPageCover() {
        $attr = get_field('home_attributes', 11);
        $welcome = get_field('home_welcome', 11);
        $map = [
            'video'     => $attr['home_video'],
            'bg'        => $attr['home_bg'],
            'audio'     => $attr['home_audio'],
            'h1'        => $welcome['welcome_h1'],
            'h2'        => $welcome['welcome_h2'],
            'bttn'      => $welcome['welcome_bttn'],
            'link'      => $welcome['welcome_link'],
            'boxes'    => get_field('home_about', 11),
        ];
        return $map;
    }

    function getWelcomeInfluencers() {
        $list = get_field('home_influencers', 11);
        $map = [];
        foreach ($list as $k => $v):
            $map[] = $this->getInfluencer($v['influencer_id']);
        endforeach;
        return $map;
    }

    function getInfluencer($id) {
        $person_profile = get_field('person_profile', $id);
        $person_icons = get_field('person_icons', $id);
        $map = [
            'id'                => $id,
            'name'              => $person_profile['person_first_name'] . ' ' .$person_profile['person_last_name'],
            'person_avatar'     => get_field('person_avatar', $id),
            'person_silhouette' => get_field('person_silhouette', $id),
            'person_first_name' => $person_profile['person_first_name'],
            'person_last_name'  => $person_profile['person_last_name'],
            'person_position'   => $person_profile['person_position'],
            'person_company'    => $person_profile['person_company'],
            'person_icons'      => get_field('person_icons', $id),
            'person_description' => get_field('person_description', $id),
            'person_photos'     => get_field('person_photos', $id),
            'person_pdf'        => $person_profile['person_pdf'],
        ];
        return $map;
    }

    function getCase($id) {
        $case_info = get_field('case_info', $id);
        $case_icons = get_field('case_icons', $id);
        $map = [
            'id'                => $id,
            'title'             => get_the_title($id),
            'case_logo'         => get_field('case_logo', $id),
            'case_excerpt'      => get_field('case_excerpt', $id),
            'case_description'  => get_field('case_description', $id),
            'case_photos'       => get_field('case_photos', $id),
            'case_icons'        => get_field('case_icons', $id),    
            'case_video'        => get_field('case_video', $id),
        ];
        return $map;
    }

    function getCasesList() {
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        $list = get_posts( array(
            'numberposts'       => -1,
            'posts_per_page'    => 9,
            'paged'             => $paged,
            'post_type'		    => 'casestudies',
            'post_status'       => 'publish',
            'order'			    => 'DESC',
            'orderby'		    => 'post_date'
        ));

        $map = [];
        foreach ($list as $lk => $lv) {
            $id = $lv->ID;
            $map[$id] = $this->getCase($id);
        }
        return $map;
    }
    
    function getPost($id) {
        $map = [
            'id'            => $id,
            'title'         => get_the_title($id),
            'zdjecie'       => get_field('zdjecie', $id, 'post_img-size'),
            'post'          => get_field('post', $id),
            'autor'         => get_field('autor', $id),
            'data'          => get_the_date('d M Y', $id),
            'avatar'        => get_avatar($id), 
        ];
        return $map;
    }

    function getPostsList() {
        $posts = get_posts( array(
            'numberposts'   => -1,
            'post_type'     => 'blog',
            'post_status'   => 'publish',
            'order'         => 'DESC',
            'orderby'       => 'post_date'
        ));

        $map = [];
        foreach ($posts as $pkey => $pvalue) {
            $id = $pvalue->ID;
            $map[$id] = $this->getPost($id);
        }
        return $map;
    }
    
    function getRelatedPost($id) {
        $map = [
            'id'            => $id,
            'title'         => get_the_title($id),
            'zdjecie_mini'  => get_field('zdjecie_mini', $id, 'related_post-img-size'),
            'post'          => get_field('post', $id),
            'autor'         => get_field('autor', $id),
            'data'          => get_the_date('d M Y', $id),
            'avatar'        => get_avatar($id), 
        ];
        return $map;
    }

     function getRelatedPostsList() {
        $posts = get_posts( array(
            'numberposts'   => 3,
            'post_type'     => 'blog',
            'post_status'   => 'publish',
            'order'         => 'DESC',
            'orderby'       => 'post_date'
        ));

        $map = [];
        foreach ($posts as $pkey => $pvalue) {
            $id = $pvalue->ID;
            $map[$id] = $this->getRelatedPost($id);
        }
        return $map;
    }



    function getHomeSections() {

        $influs = get_field('home_influencers_list', 11);
        $cases = get_field('home_case_list', 11);

        $ret = [
            'influs'        => $influs,
            'cases'         => $cases,
        ];
        return $ret;

    }

    function getPortfolio() {
        $list = get_posts( array(
            'numberposts'	=> -1,
            'post_type'		=> 'influencer',
            'post_status'   => 'publish',
            'order'			=> 'DESC',
            'orderby'		=> 'post_date',
        )) ;

        $map = [];
        foreach ($list as $lk => $lv) {
            $map[$lv->ID] = $this->getInfluencer($lv->ID);
        }
        return $map;
    }

    function getProducts() {
        $list = get_posts( array(
            'numberposts'	=> -1,
            'post_type'		=> 'products',
            'post_status'   => 'publish',
            'order'			=> 'DESC',
            'orderby'		=> 'post_date'
        )) ;

        $map = [];
        foreach ($list as $lk => $lv) {
            $id = $lv->ID;
            $map[$id] = $this->getProduct($id);
        }
        return $map;
    }

    function getProduct($id) {
        $map = [
            'id'                   => $id,
            'title'                => get_the_title($id),
            'product_logo'         => get_field('product_logo', $id),
            'product_info'         => get_field('product_info', $id),
            'product_description'  => get_field('product_description', $id),
            'product_photos'       => get_field('product_photos', $id),
            'product_icons'        => get_field('product_icons', $id),
            'product_pdf'          => get_field('product_pdf', $id),
        ];
        return $map;
    }

    function getPageContact() {
        $data = get_field('contact_info', 16);
        $map = [
            'attr_h1'   => get_field('section_h1', 16),
            'attr_h2'   => get_field('section_h2', 16),
            'company'   => $data['contact_company'],
            'desc'      => $data['contact_desc'],
            'tel'       => $data['contact_tel'],
            'email'     => $data['contact_email'],
            'topics'    => get_field('contact_topics', 16),
        ];
        return $map;
    }

    function getPageAbout() {

        $map = [
            'h1'            => get_field('section_h1', 13),
            'intro'         => get_field('about_intro', 13),
            'intro_2'       => get_field('about_intro_second', 13),
            'icons'         => get_field('about_icons', 13),
            'section_1'     => get_field('about_section_1', 13),
            'section_2'     => get_field('about_section_2', 13),
            'section_big'   => get_field('about_section_big', 13),
            'people'        => get_field('about_people', 13),
        ];
        return $map;
    }

}
require  get_template_directory() . '/inc/neat-admin.php';
$api = new neatApi('init');




/*------------------------------------*\
 	admin addons
 \*------------------------------------*/
function admin_style() {
	wp_enqueue_style('sb-admin-style', get_template_directory_uri() . '/css/sb-admin.css');
}
add_action('admin_enqueue_scripts', 'admin_style');


function sbcss_login() {
	echo '
<link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . '/css/sb-login.css' . '" />
';
}
add_action('login_head', 'sbcss_login');


function sblogin_logo_url() {
	return home_url(); //."/produkty/";
}
add_filter( 'login_headerurl', 'sblogin_logo_url' );

function disable_reset_lost_password() 
 {
   return false;
 }
add_filter( 'allow_password_reset', 'disable_reset_lost_password');

function sb_login_title($origtitle) { 
    return get_bloginfo('name');
}
add_filter('login_title', 'sb_login_title', 99);

function neat_login_redirect( $redirect_to, $request, $user ) {
    return ( is_array( $user->roles ) && in_array( 'administrator', $user->roles ) ) 
        ? home_url() . "/wp-admin/edit.php?post_type=page" : home_url();

}
add_filter( 'login_redirect', 'neat_login_redirect', 10, 3 );

function ismobile() {
    $useragent = $_SERVER['HTTP_USER_AGENT'];
    if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))) {
        return true;
    } else {
        return false;
    }
}

?>