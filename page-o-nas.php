<?php
require templatepath . '/header.php';
require templatepath . '/modules/navigation.php';

$page_data = $api->getPageAbout();
$page_cover = $api->getPageCover();
?>

<section id="page-content" class="sb-section sb-page">
	<div class="sb-page-header" style="background-image: url('<?php echo $page_cover['bg']['url']; ?>');">
        <div class="sb-header-single">
            <picture class="sb-header-photo">
                <?php 
                    $image = get_field('about-header-photo');
                    $size = 'full_size';
                        if( $image ) {
                            echo wp_get_attachment_image( $image, $size );
                        }
                ?>
            </picture>
        </div>
    </div>
    <div class="about-page">
        <div class="about-page-header">
            <h1><?php the_field('section_h1'); ?></h1>
            <div class="big-underline"></div>
        </div>
        <div class="about-page-baseline">
            <h2><?php the_field('section_h2'); ?></h2>
        </div>
        <div class="about-intro">
            <div>
                <?php echo $page_data['intro']; ?>
            </div>
            <div>
                <?php echo $page_data['intro_2']; ?>
            </div>
            <div class="slim-underline"></div>
        </div>
        <div class="about-content-part">
            <div class="about-content-header">
                <h3>FILARY <span class="bolder-part">AGENCJI ARSKOM</span></h3>
            </div>
            <div class="about-content">
                <div class="box-for-button">
                <div class="content-box" id="media-sportowe">
                    <?php $media = get_field('media_sportowe');
                        if($media) : ?>
                    <div class="content-text right-align">
                        <?php echo $media['tekst-media']; ?>
                    </div>
                    <div class="content-photo">
                        <div class="content-photo-card">
                            <img src="<?php echo $media['photo-media']; ?>" alt="Media Sportowe">
                            <div class="card-name">
                                MEDIA<br>SPORTOWE
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <a class="cta-btn left-button" href="<?php site_url(); ?>/portfolio/#media-sportowe">
                    <span>ZOBACZ WIĘCEJ</span>
                </a>
                </div>
                <div class="box-for-button">
                <div class="content-box rev-direction" id="ambasadorzy-i-influencerzy">
                    <?php $aif = get_field('ambasadorzy_i_influencerzy');
                        if($aif) : ?>
                    <div class="content-text left-align">
                        <?php echo $aif['tekst-aif']; ?>
                    </div>
                    <div class="content-photo">
                        <div class="content-photo-card">
                            <img src="<?php echo $aif['photo-aif']; ?>" alt="Ambasadorzy i Influencerzy">
                            <div class="card-name">
                                <H4>AMBASADORZY<br>I INFLUENCERZY</H4>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <a class="cta-btn right-button" href="<?php site_url(); ?>/portfolio/#influenserzy">
                    <span>ZOBACZ WIĘCEJ</span>
                </a>
                </div>
                <div class="content-box" id="projekty-specjalne">
                    <?php $projekty = get_field('projekty_specjalne');
                        if($projekty) : ?>
                    <div class="content-text right-align">
                        <?php echo $projekty['tekst-projekty']; ?>
                    </div>
                    <div class="content-photo">
                        <div class="content-photo-card">
                            <img src="<?php echo $projekty['photo-projekty']; ?>" alt="Projekty Specjalne">
                            <div class="card-name">
                                <h4>PROJEKTY<br>SPECJALNE</h4>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="content-box rev-direction" id="licensing">
                    <?php $licensing = get_field('licensing');
                        if($licensing) : ?>
                    <div class="content-text left-align">
                        <?php echo $licensing['tekst-licensing']; ?>
                    </div>
                    <div class="content-photo">
                        <div class="content-photo-card">
                            <img src="<?php echo $licensing['photo-licensing']; ?>" alt="Licensing">
                            <div class="card-name">
                                <h4>LICENSING</h4>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div><!-- .about-page -->

    <div class="our-clients">
        <div class="our-clients-header">
            <h3>NASI <span class="bolder-part">KLIENCI</span></h3>
        </div>
        <div class="our-clients-logotypes">
            <div class="logos-line">
                <?php
                    if( have_rows('logotypes_1') ):
                    while( have_rows('logotypes_1') ) : the_row();
                        $link = get_sub_field('link_1');
                        $image = get_sub_field('logo_1');
                ?>
                        <a href="<?php echo $link ?>"><img src="<?php echo $image ?>" alt="" class="logos-img"></a>
                <?php
                    endwhile;
                    endif;
                ?>
            </div>
            <div class="logos-line">
                <?php
                    if( have_rows('logotypes_2') ):
                    while( have_rows('logotypes_2') ) : the_row();
                        $link = get_sub_field('link_2');
                        $image = get_sub_field('logo_2');
                ?>
                        <a href="<?php echo $link ?>"><img src="<?php echo $image ?>" alt="" class="logos-img"></a>
                <?php
                    endwhile;
                    endif;
                ?>
            </div>
            <div class="logos-line">
                <?php
                    if( have_rows('logotypes_3') ):
                    while( have_rows('logotypes_3') ) : the_row();
                        $link = get_sub_field('link_3');
                        $image = get_sub_field('logo_3');
                ?>
                        <a href="<?php echo $link ?>"><img src="<?php echo $image ?>" alt="" class="logos-img"></a>
                <?php
                    endwhile;
                    endif;
                ?>
            </div>
        </div>
    </div>
</section>

<?php
require templatepath . '/footer.php';
?>