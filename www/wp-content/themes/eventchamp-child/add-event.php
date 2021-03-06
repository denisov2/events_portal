<?php
/*
Template Name: Добавление собьытия
*/
?>

<?php get_header(); ?>

<?php


?>

<?php eventchamp_sub_content_before(); ?>
<?php
// config
$speakers_count = 4;
$success_message = null;
$errors = [];


$featured_image_status = get_post_meta(get_the_ID(), 'featured_image_status', true);
$post_post_title_each = get_post_meta(get_the_ID(), 'page_title', true);
$full_with_container = get_post_meta(get_the_ID(), 'full_with_container', true);
$post_post_title = ot_get_option('post_post_title');
if (!$post_post_title == 'off' or $post_post_title == 'on') {
    if (!$post_post_title_each == 'off' or $post_post_title_each == 'on') {
        eventchamp_archive_title();
    }
}


if (!empty ($_POST)) {

//    var_dump($_POST);
    //  var_dump($_FILES);


    //saving enent to database
    $fields_data = [
        ['key' => 'ico_name', 'require' => true,],
        ['key' => 'ico_url', 'require' => true,  'meta' => 'event_official_web_site'],
        ['key' => 'logo', 'require' => false],
        ['key' => 'description', 'require' => true],
        ['key' => 'introduction', 'require' => true],
        ['key' => 'start_date', 'require' => true],
        ['key' => 'end_date', 'require' => true],
        ['key' => 'category', 'require' => true, 'taxonomy' => 'eventcat',],
        ['key' => 'platform', 'require' => true, 'taxonomy' => 'event_tags',],
        ['key' => 'coin_name', 'require' => true, 'meta' => 'event_coin_name'],
        ['key' => 'symbol', 'require' => true, 'meta' => 'event_symbol'],


        ['key' => 'ico_supply', 'require' => false, 'meta' => 'event_ico_supply'],
        ['key' => 'max_supply', 'require' => false, 'meta' => 'event_max_supply'],
        ['key' => 'start_bonus', 'require' => false, 'meta' => 'event_start_bonus'],
        ['key' => 'hardcap', 'require' => false, 'meta' => 'event_hardcap'],
        ['key' => 'whitepaper_url', 'require' => false, 'meta' => 'event_whitepaper_url'],

        ['key' => 'twitter', 'require' => false, 'meta' => 'event_social_media_twitter'],
        ['key' => 'telegram', 'require' => false, 'meta' => 'event_social_media_telegram'],
        ['key' => 'facebook', 'require' => false, 'meta' => 'event_social_media_facebook'],
        ['key' => 'medium', 'require' => false, 'meta' => 'event_social_media_medium'],
        ['key' => 'slack', 'require' => false, 'meta' => 'event_social_media_slack'],
        ['key' => 'github', 'require' => false, 'meta' => 'event_social_media_github'],
        ['key' => 'instagram', 'require' => false, 'meta' => 'event_social_media_instagram'],
        ['key' => 'youtube', 'require' => false, 'meta' => 'event_social_media_youtube'],
        ['key' => 'bitcointalk', 'require' => false, 'meta' => 'event_social_media_bitcointalk'],

        ['key' => 'video_link', 'require' => false, 'meta' => 'event_video_link'],
        ['key' => 'help_email', 'require' => true, 'meta' => 'event_help_email'],

        ['key' => 'full_name', 'require' => false],
        ['key' => 'contact_email', 'require' => false],
        ['key' => 'picture', 'require' => false],
        ['key' => 'short_bio', 'require' => false],
        ['key' => 'linkedin', 'require' => false],
        ['key' => 'personal_facebook', 'require' => false],
        ['key' => 'advertise', 'require' => false],
    ];

    $data = [];

    $tax_input = [];
    $meta_input = [];

    foreach ($fields_data as $field) {

        if (!isset($_POST[$field['key']])) continue;

        $form_element_value = $_POST[$field['key']];

        if (empty ($form_element_value)) {

            if ($field['require']) {

                $errors[$field['key']] = 'Field ' . $field['key'] . ' is required ';
            }

        } elseif (!empty ($field['taxonomy'])) {

            $taxonomy_args = array(
                'taxonomy' => $field['taxonomy'],
                'hide_empty' => false,
            );
            $eventcat_terms = get_terms($taxonomy_args);
            $eventcat_terms_ids = [];
            foreach ($eventcat_terms as $eventcat_term) {
                $eventcat_terms_ids[] = $eventcat_term->term_id;
            }


            if (is_array($form_element_value)) {
                // TODO: обработчик

                foreach ($form_element_value as $form_element_value_item) {

                    if (in_array($form_element_value_item, $eventcat_terms_ids)) {

                        $data[$field['key']][] = $form_element_value_item;
                        $tax_input[$field['taxonomy']][] = $form_element_value_item;
                    } else $errors[$field['key']] = 'Field ' . $field['key'] . ' is no a value of taxonomy ' . $field['taxonomy'];

                }

            } else {
                if (in_array($form_element_value, $eventcat_terms_ids)) {

                    $data[$field['key']] = $form_element_value;
                    $tax_input[$field['taxonomy']] = [$form_element_value];
                } else $errors[$field['key']] = 'Field ' . $field['key'] . ' is no a value of taxonomy ' . $field['taxonomy'];
            }

        } elseif (!empty ($field['meta'])) {

            // елси это мета поле
            $data[$field['key']] = $form_element_value;
            $meta_input[$field['meta']] = $form_element_value;


        } else {
            $data[$field['key']] = $form_element_value;
        }
    }

    $meta_input['event_start_date'] = isset ($data['start_date']) ? $data['start_date'] : null;
    $meta_input['event_end_date'] = isset($data['end_date']) ? $data['end_date'] : null;


    if (empty($errors)) {

        $post_arg = [

            'post_content' => $data['introduction'],
            'post_excerpt' => $data['description'],
            'post_name' => $data['ico_name'],
            'post_status' => 'publish',
            'post_title' => $data['ico_name'],
            'post_type' => 'event',
            'tax_input' => $tax_input,
            'meta_input' => $meta_input
        ];

        $wp_error = true;
        $post_id = wp_insert_post($post_arg, $wp_error);

        if (!is_wp_error($post_id)) {
            $success_message = "<p>Post is send for revision. Temporary link <a href='" . get_post_permalink($post_id) . "'>" . get_post_permalink($post_id) . "</a></p>";

            if (wp_verify_nonce($_POST['nonce_field'], 'add-event')) {
                if (!function_exists('wp_handle_upload'))
                    require_once(ABSPATH . 'wp-admin/includes/file.php');

                //save speaker data
                $speakers_ids = [];
                $speaker_data = [];
                for ($i = 0; $i <= $speakers_count - 1; $i++) {


                    // Если заполнены минимальные поля по спикерам - сохранить!
                    if (!empty ($_POST['full_name'][$i]) && !empty($_POST['contact_email'][$i]) && !empty($_POST['short_bio'][$i])) {


                        $speaker_arg = [

                            'post_content' => $_POST['short_bio'][$i],
                            'post_excerpt' => $_POST['short_bio'][$i],
                            'post_name' => $_POST['full_name'][$i],
                            'post_status' => 'publish',
                            'post_title' => $_POST['full_name'][$i],
                            'post_type' => 'speaker',
                            'meta_input' => [
                                'speaker_email' => $_POST['contact_email'][$i]
                            ]
                        ];


                        $wp_error = true;
                        $speaker_post_id = wp_insert_post($speaker_arg, $wp_error);

                        if (is_wp_error($speaker_post_id)) {
                            var_dump('Error creating speaker' . $i);
                            var_dump($speaker_post_id);
                        } else {
                            $success_message .= '<p>Speaker created....' . $speaker_post_id . '</p>';
                            $speakers_ids[] = $speaker_post_id;


                            $file = &$_FILES['picture_' . $i];
                            //  var_dump($_FILES);

                            $overrides = array('test_form' => false);
                            $file_picture = wp_handle_upload($file, $overrides);

                            if ($file_picture && empty($file_picture['error'])) {

                                $filename = $file_picture['file'];

                                $filetype = wp_check_filetype(basename($filename), null);
                                $wp_upload_dir = wp_upload_dir();

                                $attachment = array(
                                    'guid' => $wp_upload_dir['url'] . '/' . basename($filename),
                                    'post_mime_type' => $filetype['type'],
                                    'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
                                    'post_content' => '',
                                    'post_status' => 'inherit'
                                );

                                $attach_id = wp_insert_attachment($attachment, $filename, $speaker_post_id);


                                require_once(ABSPATH . 'wp-admin/includes/image.php');

                                $attach_data = wp_generate_attachment_metadata($attach_id, $filename);

                                wp_update_attachment_metadata($attach_id, $attach_data);

                                if (set_post_thumbnail($speaker_post_id, $attach_id)) {

                                    // var_dump($attach_data);
                                } else {
                                    $errors[] = 'Unable to attache picture to speacker';
                                }
                            }
                        }
                    }
                    $speaker_data[$i]['full_name'] = $_POST['full_name'][$i];
                }
                if (!empty($speakers_ids)) {


                    //Update inserts a new entry if it doesn't exist, updates otherwise
                    update_post_meta($post_id, 'event_speakers', $speakers_ids);
                    //$event_speakers = get_post_meta(get_the_ID(), 'event_speakers', true);
                    //  echo eventchamp_speakers($post_id = get_the_ID(), $column = "3");

                }

                $file = &$_FILES['logo'];
                $overrides = array('test_form' => false);
                $file_logo = wp_handle_upload($file, $overrides);

                if ($file_logo && empty($file_logo['error'])) {

                    $filename = $file_logo['file'];

                    $filetype = wp_check_filetype(basename($filename), null);
                    $wp_upload_dir = wp_upload_dir();

                    $attachment = array(
                        'guid' => $wp_upload_dir['url'] . '/' . basename($filename),
                        'post_mime_type' => $filetype['type'],
                        'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
                        'post_content' => '',
                        'post_status' => 'inherit'
                    );

                    $attach_id = wp_insert_attachment($attachment, $filename, $post_id);

                    require_once(ABSPATH . 'wp-admin/includes/image.php');

                    $attach_data = wp_generate_attachment_metadata($attach_id, $filename);
                    wp_update_attachment_metadata($attach_id, $attach_data);

                    if (set_post_thumbnail($post_id, $attach_id)) {
                    } else {
                        $errors[] = 'Unable to attache logo to event';
                    }

                }
            }

        } else {

            $errors[] = " Post does not saved";
        }


    } else {

        $error_message = "Form is not submitted. Fix error listed below:<br>";
        foreach ($errors as $error) {

            $error_message .= '<br>' . $error;
        }
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
    <?php eventchamp_post_content_before();

    ?>
    <div class="page-list page-content-list">
        <?php
        if (!$featured_image_status == 'off' or $featured_image_status == 'on') { ?>
            <?php eventchamp_featured_image_post($post_id = get_the_ID());

            ?>
        <?php } ?>


        <article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="page-wrapper">
                <div class="page-content">
                    <div class="page-content-body">
                        <div id="Contact"
                             class="vc_row wpb_row vc_row-fluid container containerNoPadding vc_row-o-content-middle vc_row-flex">
                            <div class="wpb_column vc_column_container vc_col-sm-12">
                                <div class="vc_column-inner ">
                                    <div class="wpb_wrapper">
                                        <div class="content-title-element dark size2">
                                            <div class="title">Add <span>New Event!</span></div>
                                            <div class="separate"><i class="fa fa-cube" aria-hidden="true"></i></div>
                                            <div class="description">Fill detailed data about future event!</div>
                                        </div>
                                        <div class="vc_empty_space" style="height: 20px"><span
                                                class="vc_empty_space_inner"></span></div>
                                        <div role="form" class="wp-my-cf7" id="wp-my-cf7-f2236-p2227-o1" lang="ru-RU"
                                             dir="ltr">
                                            <?php if ($success_message) { ?>
                                                <div class="success-message"><p><?= $success_message ?></p></div>
                                            <?php } ?>
                                            <?php if ($errors) { ?>
                                                <div class="error-message"><p><?= $error_message ?></p></div>
                                            <?php } ?>

                                            <!-- // FORM START -->

                                            <form action="" method="post" class="wp-my-cf7-form"
                                                  enctype="multipart/form-data">
                                                <?php wp_nonce_field('add-event', 'nonce_field'); ?>

                                                <div class="inputs">
                                                    <p><b>ICO General Info</b></p>

                                                    <div class="form-group name"><span
                                                            class="wp-my-cf7-form-control-wrap ICO">
                                                            <input type="text" name="ico_name"
                                                                   value="<?= !empty($data['ico_name']) ? $data['ico_name'] : '' ?>"
                                                                   size="40"
                                                                   class="wp-my-cf7-form-control wp-my-cf7-text wp-my-cf7-validates-as-required"
                                                                   aria-required="true"
                                                                   aria-invalid="false"
                                                                   placeholder="ICO Name"></span>
                                                    </div>

                                                    <p><span class="wp-my-cf7-form-control-wrap url-610"><input
                                                                type="text"
                                                                name="ico_url"
                                                                value="<?= !empty($data['ico_url']) ? $data['ico_url'] : '' ?>"
                                                                size="40"
                                                                class="wp-my-cf7-form-control wp-my-cf7-text wp-my-cf7-url wp-my-cf7-validates-as-required wp-my-cf7-validates-as-url"
                                                                aria-required="false"
                                                                aria-invalid="false"
                                                                placeholder="ICO Website URL"></span>
                                                    </p>


                                                    <p><b>Upload Event logo</b></p>

                                                    <p><span class="wp-my-cf7-form-control-wrap file-955"><input
                                                                type="file"
                                                                name="logo"
                                                                size="40"
                                                                class="wp-my-cf7-form-control wp-my-cf7-file"
                                                                aria-invalid="false"></span>
                                                    </p></div>


                                                <p><span class="wp-my-cf7-form-control-wrap textarea-444"><textarea
                                                            name="description" cols="40" rows="3"
                                                            class="wp-my-cf7-form-control wp-my-cf7-textarea"
                                                            aria-invalid="false"
                                                            placeholder="Short ICO description (1-2 sentences)"><?= !empty($data['description']) ? $data['description'] : '' ?></textarea></span>
                                                </p>

                                                <p><span class="wp-my-cf7-form-control-wrap textarea-400"><textarea
                                                            name="introduction" cols="40" rows="5"
                                                            class="wp-my-cf7-form-control wp-my-cf7-textarea"
                                                            aria-invalid="false"
                                                            placeholder="Project introduction Less than 500-4000 words ）"><?= !empty($data['introduction']) ? $data['introduction'] : '' ?></textarea></span>
                                                </p>

                                                <p><b>ICO start date *</b></p>


                                                <p><span class="wp-my-cf7-form-control-wrap date-101">
                                                    <input type="text" name="start_date"
                                                           value="<?= !empty($data['start_date']) ? $data['start_date'] : '' ?>"
                                                           placeholder="Start Date"
                                                           class="eventsearchdate-datepicker wp-my-cf7-form-control wp-my-cf7-date wp-my-cf7-validates-as-required wp-my-cf7-validates-as-date"/>

                                                </span>
                                                </p>

                                                <p><b>ICO end date *</b></p>

                                                <p><span class="wp-my-cf7-form-control-wrap date-566">
                                                <input type="text" name="end_date"
                                                       value="<?= !empty($data['end_date']) ? $data['end_date'] : '' ?>"
                                                       placeholder="End date"
                                                       class="eventsearchdate-datepicker wp-my-cf7-form-control wp-my-cf7-date wp-my-cf7-validates-as-required wp-my-cf7-validates-as-date"/>
                                                            </span>
                                                </p>

                                                <p><b>Project Category*</b></p>

                                                <p><span class="wp-my-cf7-form-control-wrap menu-145">
                                                        <select
                                                            name="category"
                                                            class="wp-my-cf7-form-control wp-my-cf7-select wp-my-cf7-validates-as-required"
                                                            aria-required="true" aria-invalid="false">
                                                            <option value="" <?= empty($data['category']) || $data['category']== ''   ? ' selected="selected" ' : '' ?>>---</option>
                                                            <?php


                                                            $taxonomy_args = array(
                                                                'taxonomy' => 'eventcat',
                                                                'hide_empty' => false,
                                                                'orderby' => 'slug',
                                                                'order' => 'ASC'
                                                            );
                                                            $eventcat_terms = get_terms($taxonomy_args);

                                                            foreach ($eventcat_terms as $eventcat_term) {
                                                                $selected = !empty ($data['category']) && $eventcat_term->term_id ==  $data['category'] ? " selected=selected " : "";
                                                                ?>
                                                                <option <?= $selected ?>
                                                                        value="<?= $eventcat_term->term_id ?>">
                                                                    <?= $eventcat_term->name ?>
                                                                </option>
                                                                <?php
                                                            } ?>
                                                        </select></span></p>

                                                <p><b>Platform (Smart contract blockchain)*</b></p>

                                                <p><span class="wp-my-cf7-form-control-wrap platform">

                                                    <?php
                                                    $taxonomy_args = array(
                                                        'taxonomy' => 'event_tags',
                                                        'hide_empty' => false,
                                                    );
                                                    $event_tags_terms = get_terms($taxonomy_args);
                                                    foreach ($event_tags_terms as $event_tags_term) {
                                                    $checked = !empty ($data['platform']) && in_array($event_tags_term->term_id, $data['platform']) ? " checked=checked " : "";

                                                    ?>
                                                        <span class="wp-my-cf7-form-control wp-my-cf7-checkbox"><span
                                                                class="wp-my-cf7-list-item first">
                                                        <input <?= $checked ?> type="checkbox" name="platform[]"
                                                                               value="<?= $event_tags_term->term_id ?>">
                                                        <span
                                                            class="wp-my-cf7-list-item-label"><?= $event_tags_term->name ?></span></span>
                                                            <?php } ?>

                                                </span>
                                                </p>

                                                <p><span class="wp-my-cf7-form-control-wrap text-968"><input type="text"
                                                                                                             name="coin_name"
                                                                                                             value="<?= !empty($data['coin_name']) ? $data['coin_name'] : '' ?>"
                                                                                                             size="40"
                                                                                                             class="wp-my-cf7-form-control wp-my-cf7-text wp-my-cf7-validates-as-required"
                                                                                                             aria-required="true"
                                                                                                             aria-invalid="false"
                                                                                                             placeholder="Token/coin name*"></span>
                                                </p>

                                                <p><span class="wp-my-cf7-form-control-wrap text-968"><input type="text"
                                                                                                             name="symbol"
                                                                                                             value="<?= !empty($data['symbol']) ? $data['symbol'] : '' ?>"
                                                                                                             size="40"
                                                                                                             class="wp-my-cf7-form-control wp-my-cf7-text wp-my-cf7-validates-as-required"
                                                                                                             aria-required="true"
                                                                                                             aria-invalid="false"
                                                                                                             placeholder="Symbol*"></span>
                                                </p>

                                                <p><span class="wp-my-cf7-form-control-wrap ICOSupply"><input
                                                            type="text"
                                                            name="ico_supply"
                                                            value="<?= !empty($data['ico_supply']) ? $data['ico_supply'] : '' ?>"
                                                            size="40"
                                                            class="wp-my-cf7-form-control wp-my-cf7-text wp-my-cf7-validates-as-required"
                                                            aria-required="true"
                                                            aria-invalid="false"
                                                            placeholder="ICOSupply"></span>
                                                </p>

                                                <p><span class="wp-my-cf7-form-control-wrap text-969"><input type="text"
                                                                                                             name="max_supply"
                                                                                                             value="<?= !empty($data['max_supply']) ? $data['max_supply'] : '' ?>"
                                                                                                             size="40"
                                                                                                             class="wp-my-cf7-form-control wp-my-cf7-text wp-my-cf7-validates-as-required"
                                                                                                             aria-required="true"
                                                                                                             aria-invalid="false"
                                                                                                             placeholder="Max Supply"></span>
                                                </p>

                                                <p><span class="wp-my-cf7-form-control-wrap text-969"><input type="text"
                                                                                                             name="start_bonus"
                                                                                                             value="<?= !empty($data['start_bonus']) ? $data['start_bonus'] : '' ?>"
                                                                                                             size="40"
                                                                                                             class="wp-my-cf7-form-control wp-my-cf7-text wp-my-cf7-validates-as-required"
                                                                                                             aria-required="true"
                                                                                                             aria-invalid="false"
                                                                                                             placeholder="Start bonus"></span>
                                                </p>

                                                <p><span class="wp-my-cf7-form-control-wrap text-969"><input type="text"
                                                                                                             name="hardcap"
                                                                                                             value="<?= !empty($data['hardcap']) ? $data['hardcap'] : '' ?>"
                                                                                                             size="40"
                                                                                                             class="wp-my-cf7-form-control wp-my-cf7-text wp-my-cf7-validates-as-required"
                                                                                                             aria-required="true"
                                                                                                             aria-invalid="false"
                                                                                                             placeholder="Hardcap"></span>
                                                </p>

                                                <p><span class="wp-my-cf7-form-control-wrap text-969"><input type="text"
                                                                                                             name="whitepaper_url"
                                                                                                             value="<?= !empty($data['whitepaper_url']) ? $data['whitepaper_url'] : '' ?>"
                                                                                                             size="40"
                                                                                                             class="wp-my-cf7-form-control wp-my-cf7-text "
                                                                                                             aria-required="false"
                                                                                                             aria-invalid="false"
                                                                                                             placeholder="Whitepaper URL*"></span>
                                                </p>

                                                <p><b>Email for help (will be public):</b></p>

                                                <p><span class="wp-my-cf7-form-control-wrap text-969"><input
                                                            type="email"
                                                            name="help_email"
                                                            value="<?= !empty($data['help_email']) ? $data['help_email'] : '' ?>"
                                                            size="40"
                                                            class="wp-my-cf7-form-control wp-my-cf7-text wp-my-cf7-validates-as-required"
                                                            aria-required="true"
                                                            aria-invalid="false"
                                                            placeholder="Email for help and relevant info*"></span>
                                                </p>

                                                <p><b>Links:</b></p>

                                                <p><span class="wp-my-cf7-form-control-wrap text-969"><input type="text"
                                                                                                             name="twitter"
                                                                                                             value="<?= !empty($data['twitter']) ? $data['twitter'] : '' ?>"
                                                                                                             size="40"
                                                                                                             class="wp-my-cf7-form-control wp-my-cf7-text wp-my-cf7-validates-as-required"
                                                                                                             aria-required="true"
                                                                                                             aria-invalid="false"
                                                                                                             placeholder="Twitter"></span>
                                                </p>

                                                <p><span class="wp-my-cf7-form-control-wrap text-969"><input type="text"
                                                                                                             name="facebook"
                                                                                                             value="<?= !empty($data['facebook']) ? $data['facebook'] : '' ?>"
                                                                                                             size="40"
                                                                                                             class="wp-my-cf7-form-control wp-my-cf7-text wp-my-cf7-validates-as-required"
                                                                                                             aria-required="true"
                                                                                                             aria-invalid="false"
                                                                                                             placeholder="Facebook"></span>
                                                </p>


                                                <p><span class="wp-my-cf7-form-control-wrap text-969"><input type="text"
                                                                                                             name="telegram"
                                                                                                             value="<?= !empty($data['telegram']) ? $data['telegram'] : '' ?>"
                                                                                                             size="40"
                                                                                                             class="wp-my-cf7-form-control wp-my-cf7-text wp-my-cf7-validates-as-required"
                                                                                                             aria-required="true"
                                                                                                             aria-invalid="false"
                                                                                                             placeholder="Telegram"></span>
                                                </p>


                                                <p><span class="wp-my-cf7-form-control-wrap text-969"><input type="text"
                                                                                                             name="medium"
                                                                                                             value="<?= !empty($data['medium']) ? $data['medium'] : '' ?>"
                                                                                                             size="40"
                                                                                                             class="wp-my-cf7-form-control wp-my-cf7-text wp-my-cf7-validates-as-required"
                                                                                                             aria-required="true"
                                                                                                             aria-invalid="false"
                                                                                                             placeholder="Medium"></span>
                                                </p>

                                                <p><span class="wp-my-cf7-form-control-wrap text-969"><input type="text"
                                                                                                             name="slack"
                                                                                                             value="<?= !empty($data['slack']) ? $data['slack'] : '' ?>"
                                                                                                             size="40"
                                                                                                             class="wp-my-cf7-form-control wp-my-cf7-text wp-my-cf7-validates-as-required"
                                                                                                             aria-required="true"
                                                                                                             aria-invalid="false"
                                                                                                             placeholder="Slack"></span>
                                                </p>

                                                <p><span class="wp-my-cf7-form-control-wrap text-969"><input type="text"
                                                                                                             name="github"
                                                                                                             value="<?= !empty($data['github']) ? $data['github'] : '' ?>"
                                                                                                             size="40"
                                                                                                             class="wp-my-cf7-form-control wp-my-cf7-text wp-my-cf7-validates-as-required"
                                                                                                             aria-required="true"
                                                                                                             aria-invalid="false"
                                                                                                             placeholder="Github"></span>
                                                </p>

                                                <p><span class="wp-my-cf7-form-control-wrap text-969"><input type="text"
                                                                                                             name="instagram"
                                                                                                             value="<?= !empty($data['instagram']) ? $data['instagram'] : '' ?>"
                                                                                                             size="40"
                                                                                                             class="wp-my-cf7-form-control wp-my-cf7-text wp-my-cf7-validates-as-required"
                                                                                                             aria-required="true"
                                                                                                             aria-invalid="false"
                                                                                                             placeholder="Instagram"></span>
                                                </p>

                                                <p><span class="wp-my-cf7-form-control-wrap text-969"><input type="text"
                                                                                                             name="youtube"
                                                                                                             value="<?= !empty($data['youtube']) ? $data['youtube'] : '' ?>"
                                                                                                             size="40"
                                                                                                             class="wp-my-cf7-form-control wp-my-cf7-text wp-my-cf7-validates-as-required"
                                                                                                             aria-required="true"
                                                                                                             aria-invalid="false"
                                                                                                             placeholder="YouTube"></span>
                                                </p>

                                                <p><span class="wp-my-cf7-form-control-wrap text-969"><input type="text"
                                                                                                             name="bitcointalk"
                                                                                                             value="<?= !empty($data['bitcointalk']) ? $data['bitcointalk'] : '' ?>"
                                                                                                             size="40"
                                                                                                             class="wp-my-cf7-form-control wp-my-cf7-text wp-my-cf7-validates-as-required"
                                                                                                             aria-required="true"
                                                                                                             aria-invalid="false"
                                                                                                             placeholder="Bitcointalk"></span>
                                                </p>

                                                <p><span class="wp-my-cf7-form-control-wrap text-969"><input type="text"
                                                                                                             name="video_link"
                                                                                                             value="<?= !empty($data['video_link']) ? $data['video_link'] : '' ?>"
                                                                                                             size="40"
                                                                                                             class="wp-my-cf7-form-control wp-my-cf7-text wp-my-cf7-validates-as-required"
                                                                                                             aria-required="true"
                                                                                                             aria-invalid="false"
                                                                                                             placeholder="YouTube video link"></span>
                                                </p>


                                                <h3>Team</h3>

                                                <div id="accordion">
                                                    <?php
                                                    for ($speaker_number = 0; $speaker_number <= $speakers_count - 1; $speaker_number++) {
                                                        ?>
                                                        <h3>Team member <?= ($speaker_number + 1) ?></h3>
                                                        <div>
                                                            <p><span class="wp-my-cf7-form-control-wrap text-969"><input
                                                                        type="text"
                                                                        name="full_name[<?= $speaker_number ?>]"
                                                                        value="<?= !empty($_POST['full_name'][$speaker_number]) ? $_POST['full_name'][$speaker_number] : '' ?>"
                                                                        size="40"
                                                                        class="wp-my-cf7-form-control wp-my-cf7-text wp-my-cf7-validates-as-required"
                                                                        aria-required="true"
                                                                        aria-invalid="false"
                                                                        placeholder="Full Name*"></span>
                                                            </p>

                                                            <p><span
                                                                    class="wp-my-cf7-form-control-wrap email-850"><input
                                                                        type="text"
                                                                        name="contact_email[<?= $speaker_number ?>]"
                                                                        value="<?php echo !empty($_POST['contact_email'][$speaker_number]) ? $_POST['contact_email'][$speaker_number] : '' ?>"
                                                                        size="40"
                                                                        class="wp-my-cf7-form-control wp-my-cf7-text wp-my-cf7-email wp-my-cf7-validates-as-required wp-my-cf7-validates-as-email"
                                                                        aria-required="true"
                                                                        aria-invalid="false"
                                                                        placeholder="Your contact Email"></span>
                                                            </p>

                                                            <p><b>Picture*</b></p>

                                                            <p><span class="wp-my-cf7-form-control-wrap file-246"><input
                                                                        type="file"
                                                                        name="picture_<?= $speaker_number ?>"
                                                                        size="40"
                                                                        class="wp-my-cf7-form-control wp-my-cf7-file"
                                                                        aria-invalid="false"></span>
                                                            </p>

                                                            <p><b>Short Bio*</b></p>

                                                            <p><span
                                                                    class="wp-my-cf7-form-control-wrap ShortBio"><textarea
                                                                        name="short_bio[<?= $speaker_number ?>]"
                                                                        cols="40" rows="10"
                                                                        class="wp-my-cf7-form-control wp-my-cf7-textarea wp-my-cf7-validates-as-required"
                                                                        aria-required="true"
                                                                        aria-invalid="false"><?= !empty($_POST['short_bio'][$speaker_number]) ? $_POST['short_bio'][$speaker_number] : '' ?></textarea></span>
                                                            </p>

                                                            <p><span class="wp-my-cf7-form-control-wrap text-969"><input
                                                                        type="text"
                                                                        name="linkedin[<?= $speaker_number ?>]"
                                                                        value="<?= !empty($_POST['linkedin'][$speaker_number]) ? $_POST['linkedin'][$speaker_number] : '' ?>"
                                                                        size="40"
                                                                        class="wp-my-cf7-form-control wp-my-cf7-text wp-my-cf7-validates-as-required"
                                                                        aria-required="true"
                                                                        aria-invalid="false"
                                                                        placeholder="Linkedin"></span>
                                                            </p>

                                                            <p><span class="wp-my-cf7-form-control-wrap text-969"><input
                                                                        type="text"
                                                                        name="personal_facebook[<?= $speaker_number ?>]"
                                                                        value="<?= !empty($_POST['personal_facebook'][$speaker_number]) ? $_POST['personal_facebook'][$speaker_number] : '' ?>"
                                                                        size="40"
                                                                        class="wp-my-cf7-form-control wp-my-cf7-text wp-my-cf7-validates-as-required"
                                                                        aria-required="true"
                                                                        aria-invalid="false"
                                                                        placeholder="Facebook"></span>
                                                            </p>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>


                                                </div>


                                                <p></p>

                                                <p><b>Want to advertise your ICO with us?*</b>
                                                </p>

                                                <p>
                                                    <span class="wp-my-cf7-form-control-wrap acceptance-691"><input
                                                            type="checkbox" name="advertise" value="1"
                                                            class="wp-my-cf7-form-control wp-my-cf7-acceptance"
                                                            aria-invalid="false"></span></p>

                                                <p>


                                                    <input type="submit" value="Submit info!"
                                                           class="wp-my-cf7-form-control wp-my-cf7-submit">

                                                </p>


                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
        </article>
    </div>



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

<?php get_footer();