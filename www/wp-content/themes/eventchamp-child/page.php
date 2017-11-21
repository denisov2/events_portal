<?php
/*
	* The template for displaying page
*/
get_header(); ?>

<?php eventchamp_sub_content_before(); ?>
<?php
$featured_image_status = get_post_meta(get_the_ID(), 'featured_image_status', true);
$post_post_title_each = get_post_meta(get_the_ID(), 'page_title', true);
$full_with_container = get_post_meta(get_the_ID(), 'full_with_container', true);
$post_post_title = ot_get_option('post_post_title');
if (!$post_post_title == 'off' or $post_post_title == 'on') {
    if (!$post_post_title_each == 'off' or $post_post_title_each == 'on') {
        eventchamp_archive_title();
    }
}
?>
<?php
if ($full_with_container == "off" or !$full_with_container == "on") {
    eventchamp_container_before();
}
?>

<?php while (have_posts()) : the_post(); ?>
    <?php
    if ($full_with_container == "off" or !$full_with_container == "on") {
        eventchamp_row_before();
    }
    ?>
    <?php eventchamp_post_content_before(); ?>
    <div class="page-list page-content-list">
        <?php if (!$featured_image_status == 'off' or $featured_image_status == 'on') { ?>
            <?php eventchamp_featured_image_post($post_id = get_the_ID()); ?>
        <?php } ?>
        <article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="page-wrapper">
                <div class="page-content">
                    <div class="page-content-body">
                        <?php
                        the_content();

                        wp_link_pages(array(
                            'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__('Pages:', 'eventchamp') . '</span>',
                            'after' => '</div>',
                            'link_before' => '<span>',
                            'link_after' => '</span>',
                        ));

                        edit_post_link(esc_html__('Edit Page', 'eventchamp'), '<span class="edit-link">', '</span>');
                        ?>
                    </div>
                </div>
            </div>
        </article>
    </div>
    <?php
    $page_comment_area = ot_get_option('page_comment_area');
    if ($page_comment_area == "on" or !$page_comment_area == "off") {
        if (comments_open() || get_comments_number()) {
            comments_template();
        }
    }
    ?>
    <?php eventchamp_content_area_after(); ?>
    <?php get_sidebar(); ?>
    <?php
    if ($full_with_container == "off" or !$full_with_container == "on") {
        eventchamp_row_after();
    }
    ?>
<?php endwhile; ?>
<?php
if ($full_with_container == "off" or !$full_with_container == "on") {
    eventchamp_container_after();
}
?>
<?php eventchamp_sub_content_after(); ?>
    <!-- SendPulse Form -->
    <style>.sp-force-hide {
            display: none;
        }

        .sp-form[sp-id="87033"] {
            display: block;
            background: #ffffff;
            padding: 15px;
            width: 450px;
            max-width: 100%;
            border-radius: 8px;
            -moz-border-radius: 8px;
            -webkit-border-radius: 8px;
            border-color: #dddddd;
            border-style: solid;
            border-width: 1px;
            font-family: Arial, "Helvetica Neue", sans-serif;
            background-repeat: no-repeat;
            background-position: center;
            background-size: auto;
        }

        .sp-form[sp-id="87033"] .sp-form-fields-wrapper {
            margin: 0 auto;
            width: 420px;
        }

        .sp-form[sp-id="87033"] .sp-form-control {
            background: #ffffff;
            border-color: #cccccc;
            border-style: solid;
            border-width: 1px;
            font-size: 15px;
            padding-left: 8.75px;
            padding-right: 8.75px;
            border-radius: 5px;
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            height: 35px;
            width: 100%;
        }

        .sp-form[sp-id="87033"] .sp-field label {
            color: #444444;
            font-size: 13px;
            font-style: normal;
            font-weight: bold;
        }

        .sp-form[sp-id="87033"] .sp-button {
            border-radius: 4px;
            -moz-border-radius: 4px;
            -webkit-border-radius: 4px;
            background-color: #ffbb00;
            color: #ffffff;
            width: auto;
            font-weight: 700;
            font-style: normal;
            font-family: Arial, sans-serif;
            box-shadow: inset 0 -2px 0 0 #c28e00;
            -moz-box-shadow: inset 0 -2px 0 0 #c28e00;
            -webkit-box-shadow: inset 0 -2px 0 0 #c28e00;
            border-width: 1px;
            border-color: #ffbb00;
            border-style: solid;
        }

        .sp-form[sp-id="87033"] .sp-button-container {
            text-align: center;
        }

        .sp-popup-outer {
            background: rgba(0, 0, 0, 0.5);
        }</style>
    <div class="sp-form-outer sp-popup-outer sp-force-hide" style="background: rgba(0, 0, 0, 0.5);">
        <div id="sp-form-87033" sp-id="87033" sp-hash="4836eb24208c13f1ba4a1c42eb9fb6e0a51b2b7bbab0f825748fcc03b54137b1"
             sp-lang="ru" class="sp-form sp-form-regular sp-form-popup"
             sp-show-options="%7B%22satellite%22%3Afalse%2C%22maDomain%22%3A%22login.sendpulse.com%22%2C%22formsDomain%22%3A%22forms.sendpulse.com%22%2C%22condition%22%3A%22onButtonClick%22%2C%22scrollTo%22%3A25%2C%22delay%22%3A10%2C%22repeat%22%3A3%2C%22background%22%3A%22rgba(0%2C%200%2C%200%2C%200.5)%22%2C%22position%22%3A%22bottom-right%22%2C%22animation%22%3A%22%22%2C%22hideOnMobile%22%3Afalse%2C%22urlFilter%22%3Afalse%2C%22urlFilterConditions%22%3A%5B%7B%22force%22%3A%22hide%22%2C%22clause%22%3A%22contains%22%2C%22token%22%3A%22%22%7D%5D%7D">
            <div class="sp-form-fields-wrapper">
                <button class="sp-btn-close ">&nbsp;</button>
                <div class="sp-message">
                    <div></div>
                </div>
                <div class="sp-element-container sp-lg">
                    <div class="sp-field " sp-id="sp-218ecad7-5655-4cc9-a684-67f9b01e32eb">
                        <div style="font-family: inherit; line-height: 1.2;"><p><strong>Subscribe to the newsletter to
                                    get the latest information about all ICOs</strong></p></div>
                    </div>
                    <div class="sp-field " sp-id="sp-91bf9231-517f-4604-a526-20591aa31bfb"><label
                            class="sp-control-label"><span>Name</span><strong>*</strong></label><input type="text"
                                                                                                       sp-type="input"
                                                                                                       name="sform[0LjQvNGP]"
                                                                                                       class="sp-form-control "
                                                                                                       placeholder="Your name..."
                                                                                                       sp-tips="%7B%22required%22%3A%22%D0%9E%D0%B1%D1%8F%D0%B7%D0%B0%D1%82%D0%B5%D0%BB%D1%8C%D0%BD%D0%BE%D0%B5%20%D0%BF%D0%BE%D0%BB%D0%B5%22%7D"
                                                                                                       required="required">
                    </div>
                    <div class="sp-field " sp-id="sp-36973b63-39dd-45f8-94d0-e90edaa3fffb"><label
                            class="sp-control-label"><span>Email</span><strong>*</strong></label><input type="email"
                                                                                                        sp-type="email"
                                                                                                        name="sform[email]"
                                                                                                        class="sp-form-control "
                                                                                                        placeholder="username@gmail.com"
                                                                                                        sp-tips="%7B%22required%22%3A%22%D0%9E%D0%B1%D1%8F%D0%B7%D0%B0%D1%82%D0%B5%D0%BB%D1%8C%D0%BD%D0%BE%D0%B5%20%D0%BF%D0%BE%D0%BB%D0%B5%22%2C%22wrong%22%3A%22%D0%9D%D0%B5%D0%B2%D0%B5%D1%80%D0%BD%D1%8B%D0%B9%20email-%D0%B0%D0%B4%D1%80%D0%B5%D1%81%22%7D"
                                                                                                        required="required">
                    </div>
                    <div class="sp-field sp-button-container " sp-id="sp-086a770b-7995-4b9a-873a-8c509b525832">
                        <button id="sp-086a770b-7995-4b9a-873a-8c509b525832" class="sp-button">Subscribe now!</button>
                    </div>

                </div>
                <div class="sp-link-wrapper sp-brandname__left"></div>
            </div>
        </div>
    </div>
    <script type="text/javascript"
            src="//static-login.sendpulse.com/apps/fc3/build/default-handler.js?1510764758183"></script>
    <!-- /SendPulse Form -->

<?php get_footer();