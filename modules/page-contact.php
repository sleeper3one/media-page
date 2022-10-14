<?php
$page_contact = $api->getPageContact();
?>
<section id="contact" class="breyers-section breyers-contact">
    <h2 class="h1">
        <span class="section-title"><?php echo $page_contact['attr_h1']; ?></span>
        <span class="section-claim"><?php echo $page_contact['attr_h2']; ?></span>
    </h2>
    <form id="contact-form" class="container-fluid" data-action="addlead">
        <div class="row">
            <span class="form-fields-error">Wypełnij wszystkie pola</span>
        </div>
        <div class=" row">

            <textarea
                name="contact_<?php echo sanitize_title( $fv['form_field_title'] ); ?>" 
                id="contact-<?php echo sanitize_title( $fv['form_field_title'] ); ?>" 
                placeholder="<?php echo $fv['form_field_title']; ?>" 
                class="col-12 req"></textarea>

            <input type="<?php echo $fv['form_field_type']; ?>"
                name="contact_<?php echo sanitize_title( $fv['form_field_title'] ); ?>" 
                id="contact-<?php echo sanitize_title( $fv['form_field_title'] ); ?>" 
                placeholder="<?php echo $fv['form_field_title']; ?>" 
                class="col-12 <?php echo $fv['form_field_type']; ?>-field req" />

        </div>

        <div class="row">
            <span class="form-agree-error">Zgoda musi być zanaczona</span>
            <div class="field-checkbox check-req" id="form-agreement">
                <div><?php echo get_field( 'global_agree_privacy', 'options' ); ?></div>
            </div>
            <div class="field-checkbox-caption">
                <?php echo get_field( 'global_agree_info', 'options' ); ?>
            </div>
        </div>
        <a href="#contact-form" class="cta-bttn more-bttn bttn-cta-form">
            wyślij
            <?php echo $api->get_svg( "arrow_right" ); ?>
        </a>
    </form>
</section>