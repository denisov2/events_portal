<?php
/*
Template Name: Добавление собьытия
*/
?>

<?php get_header(); ?>

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


if (!empty ($_POST)) {

    //saving enent to database
    $fields_data = [
        ['key' => 'ico_name', 'require' => true],
        ['key' => 'ico_url', 'require' => true],
        ['key' => 'logo', 'require' => false],
        ['key' => 'description', 'require' => true],
        ['key' => 'introduction', 'require' => true],
        ['key' => 'start_date', 'require' => true],
        ['key' => 'end_date', 'require' => true],
        ['key' => 'category', 'require' => true],
        ['key' => 'platform', 'require' => true],
        ['key' => 'coin_name', 'require' => true],
        ['key' => 'symbol', 'require' => true],


        ['key' => 'ico_supply', 'require' => false],
        ['key' => 'max_supply', 'require' => false],
        ['key' => 'start_bonus', 'require' => false],
        ['key' => 'hardcap', 'require' => false],
        ['key' => 'whitepaper_url', 'require' => false],
        ['key' => 'twitter', 'require' => false],
        ['key' => 'telegram', 'require' => false],
        ['key' => 'facebook', 'require' => false],
        ['key' => 'medium', 'require' => false],
        ['key' => 'ico_name', 'require' => false],
        ['key' => 'github', 'require' => false],
        ['key' => 'instagram', 'require' => false],
        ['key' => 'youtube', 'require' => false],
        ['key' => 'bitcointalk', 'require' => false],
        ['key' => 'bitcointalk', 'require' => false],
        ['key' => 'help_email', 'require' => false],
        ['key' => 'full_name', 'require' => false],
        ['key' => 'contact_email', 'require' => false],
        ['key' => 'picture', 'require' => false],
        ['key' => 'short_bio', 'require' => false],
        ['key' => 'linkedin', 'require' => false],
        ['key' => 'personal_facebook', 'require' => false],
        ['key' => 'advertise', 'require' => false],
    ];

    $data = [];
    $errors = [];
    foreach ($fields_data as $field) {

        if (!empty ($_POST[$field['key']])) {

            $data[$field['key']] = $_POST[$field['key']];
        } else {

            if ($field['require']) {

                $errors[$field['key']] = 'Field ' . $field['key'] . ' is required ';
            }
        }
    }

    if (empty($errors)) {

        $post_arg = [
            'post_content' => $data['description'],
            'post_excerpt' => $data['introduction'],
            'post_name' => $data['ico_name'],
            'post_status' => 'publish',
            'post_title' => $data['ico_name'],
            'post_type' => 'event',
            'tax_input' => ['eventcat' => array(111, 113)],
            'meta_input' => [
                'event_start_date' => $data['start_date'],
                'event_end_date' => $data['end_date'],
            ]
        ];

        $wp_error = false;
        $post_id = wp_insert_post($post_arg, $wp_error);
        $success_message = null;
        if($post_id) {

            $success_message = "Post is send for revision. Temporary link <a href='". get_post_permalink($post_id) ."'>". get_post_permalink($post_id) ."</a>";
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
                                            <form action="/add-event/" method="post" class="wp-my-cf7-form"
                                                  enctype="multipart/form-data">

                                                <div class="inputs">
                                                    <p><b>ICO General Info</b></p>

                                                    <div class="form-group name"><span
                                                            class="wp-my-cf7-form-control-wrap ICO">
                                                            <input type="text" name="ico_name" value=""
                                                                   size="40"
                                                                   class="wp-my-cf7-form-control wp-my-cf7-text wp-my-cf7-validates-as-required"
                                                                   aria-required="true"
                                                                   aria-invalid="false"
                                                                   placeholder="ICO Name"></span>
                                                    </div>

                                                    <p><span class="wp-my-cf7-form-control-wrap url-610"><input
                                                                type="text"
                                                                name="ico_url"
                                                                value=""
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
                                                            placeholder="Short ICO description (1-2 sentences)"></textarea></span>
                                                </p>

                                                <p><span class="wp-my-cf7-form-control-wrap textarea-400"><textarea
                                                            name="introduction" cols="40" rows="5"
                                                            class="wp-my-cf7-form-control wp-my-cf7-textarea"
                                                            aria-invalid="false"
                                                            placeholder="Project introduction Less than 500-4000 words ）"></textarea></span>
                                                </p>

                                                <p><b>ICO start date *</b></p>

                                                <p><span class="wp-my-cf7-form-control-wrap date-101"><input type="date"
                                                                                                             name="start_date"
                                                                                                             value="ICO start date"
                                                                                                             class="wp-my-cf7-form-control wp-my-cf7-date wp-my-cf7-validates-as-required wp-my-cf7-validates-as-date"
                                                                                                             aria-required="true"
                                                                                                             aria-invalid="false"></span>
                                                </p>

                                                <p><b>ICO end date *</b></p>

                                                <p><span class="wp-my-cf7-form-control-wrap date-566"><input type="date"
                                                                                                             name="end_date"
                                                                                                             value=""
                                                                                                             class="wp-my-cf7-form-control wp-my-cf7-date wp-my-cf7-validates-as-required wp-my-cf7-validates-as-date"
                                                                                                             aria-required="true"
                                                                                                             aria-invalid="false"
                                                                                                             placeholder="ICO end date *"></span>
                                                </p>

                                                <p><b>Project Category*</b></p>

                                                <p><span class="wp-my-cf7-form-control-wrap menu-145"><select
                                                            name="category"
                                                            class="wp-my-cf7-form-control wp-my-cf7-select wp-my-cf7-validates-as-required"
                                                            aria-required="true" aria-invalid="false">
                                                            <option value="">---</option>
                                                            <option value="Supply &amp; Logistics">Supply &amp;
                                                                Logistics
                                                            </option>
                                                            <option value="Commerce &amp; Advertising">Commerce &amp;
                                                                Advertising
                                                            </option>
                                                            <option value="Social Network">Social Network</option>
                                                            <option value="Content Management">Content Management
                                                            </option>
                                                            <option value="Governance">Governance</option>
                                                            <option value="Gambling &amp; Betting">Gambling &amp;
                                                                Betting
                                                            </option>
                                                            <option value="Data Analytics">Data Analytics</option>
                                                            <option value="Mining">Mining</option>
                                                            <option value="Energy &amp; Utilities">Energy &amp;
                                                                Utilities
                                                            </option>
                                                            <option value="Provenance &amp; Notary">Provenance &amp;
                                                                Notary
                                                            </option>
                                                            <option value="Compliance &amp; Security">Compliance &amp;
                                                                Security
                                                            </option>
                                                            <option value="Gaming &amp; VR">Gaming &amp; VR</option>
                                                            <option value="Trading &amp; Investing">Trading &amp;
                                                                Investing
                                                            </option>
                                                            <option value="Finance">Finance</option>
                                                            <option value="Payments">Payments</option>
                                                            <option value="Identity &amp; Reputation">Identity &amp;
                                                                Reputation
                                                            </option>
                                                            <option value="Legal">Legal</option>
                                                            <option value="Drugs &amp; Healthcare">Drugs &amp;
                                                                Healthcare
                                                            </option>
                                                            <option value="Infrastructure">Infrastructure</option>
                                                            <option value="Recruitment">Recruitment</option>
                                                            <option value="Events &amp; Entertainment">Events &amp;
                                                                Entertainment
                                                            </option>
                                                            <option value="Real Estate">Real Estate</option>
                                                            <option value="Art &amp; Music">Art &amp; Music</option>
                                                            <option value="Privacy &amp; Security">Privacy &amp;
                                                                Security
                                                            </option>
                                                            <option value="Transport">Transport</option>
                                                            <option value="Machine Learning &amp; AI">Machine Learning
                                                                &amp; AI
                                                            </option>
                                                            <option value="Commodities">Commodities</option>
                                                            <option value="Communications">Communications</option>
                                                            <option value="Data Storage">Data Storage</option>
                                                            <option value="Travel &amp; Tourism">Travel &amp; Tourism
                                                            </option>
                                                            <option value="Other">Other</option>
                                                        </select></span></p>

                                                <p><b>Platform (Smart contract blockchain)*</b></p>

                                                <p><span class="wp-my-cf7-form-control-wrap platform"><span
                                                            class="wp-my-cf7-form-control wp-my-cf7-checkbox"><span
                                                                class="wp-my-cf7-list-item first"><input type="checkbox"
                                                                                                         name="platform[]"
                                                                                                         value="Bitcoin"><span
                                                                    class="wp-my-cf7-list-item-label">Bitcoin</span></span><span
                                                                class="wp-my-cf7-list-item"><input type="checkbox"
                                                                                                   name="platform[]"
                                                                                                   value="BitShares"><span
                                                                    class="wp-my-cf7-list-item-label">BitShares</span></span><span
                                                                class="wp-my-cf7-list-item"><input type="checkbox"
                                                                                                   name="platform[]"
                                                                                                   value="Burst"><span
                                                                    class="wp-my-cf7-list-item-label">Burst</span></span><span
                                                                class="wp-my-cf7-list-item"><input type="checkbox"
                                                                                                   name="platform[]"
                                                                                                   value="Counterparty"><span
                                                                    class="wp-my-cf7-list-item-label">Counterparty</span></span><span
                                                                class="wp-my-cf7-list-item"><input type="checkbox"
                                                                                                   name="platform[]"
                                                                                                   value="Ethereum"><span
                                                                    class="wp-my-cf7-list-item-label">Ethereum</span></span><span
                                                                class="wp-my-cf7-list-item"><input type="checkbox"
                                                                                                   name="platform[]"
                                                                                                   value="Ethereum Classic"><span
                                                                    class="wp-my-cf7-list-item-label">Ethereum Classic</span></span><span
                                                                class="wp-my-cf7-list-item"><input type="checkbox"
                                                                                                   name="platform[]"
                                                                                                   value="Graphene"><span
                                                                    class="wp-my-cf7-list-item-label">Graphene</span></span><span
                                                                class="wp-my-cf7-list-item"><input type="checkbox"
                                                                                                   name="platform[]"
                                                                                                   value="NEM"><span
                                                                    class="wp-my-cf7-list-item-label">NEM</span></span><span
                                                                class="wp-my-cf7-list-item"><input type="checkbox"
                                                                                                   name="platform[]"
                                                                                                   value="NuBits"><span
                                                                    class="wp-my-cf7-list-item-label">NuBits</span></span><span
                                                                class="wp-my-cf7-list-item"><input type="checkbox"
                                                                                                   name="platform[]"
                                                                                                   value="Nxt"><span
                                                                    class="wp-my-cf7-list-item-label">Nxt</span></span><span
                                                                class="wp-my-cf7-list-item"><input type="checkbox"
                                                                                                   name="platform[]"
                                                                                                   value="Omni"><span
                                                                    class="wp-my-cf7-list-item-label">Omni</span></span><span
                                                                class="wp-my-cf7-list-item"><input type="checkbox"
                                                                                                   name="platform[]"
                                                                                                   value="Uniq"><span
                                                                    class="wp-my-cf7-list-item-label">Uniq</span></span><span
                                                                class="wp-my-cf7-list-item"><input type="checkbox"
                                                                                                   name="platform[]"
                                                                                                   value="Waves"><span
                                                                    class="wp-my-cf7-list-item-label">Waves</span></span><span
                                                                class="wp-my-cf7-list-item"><input type="checkbox"
                                                                                                   name="platform[]"
                                                                                                   value="Own"><span
                                                                    class="wp-my-cf7-list-item-label">Own</span></span><span
                                                                class="wp-my-cf7-list-item last"><input type="checkbox"
                                                                                                        name="platform[]"
                                                                                                        value="other"><span
                                                                    class="wp-my-cf7-list-item-label">other</span></span></span></span>
                                                </p>

                                                <p><span class="wp-my-cf7-form-control-wrap text-968"><input type="text"
                                                                                                             name="coin_name"
                                                                                                             value=""
                                                                                                             size="40"
                                                                                                             class="wp-my-cf7-form-control wp-my-cf7-text wp-my-cf7-validates-as-required"
                                                                                                             aria-required="true"
                                                                                                             aria-invalid="false"
                                                                                                             placeholder="Token/coin name*"></span>
                                                </p>

                                                <p><span class="wp-my-cf7-form-control-wrap text-968"><input type="text"
                                                                                                             name="symbol"
                                                                                                             value=""
                                                                                                             size="40"
                                                                                                             class="wp-my-cf7-form-control wp-my-cf7-text wp-my-cf7-validates-as-required"
                                                                                                             aria-required="true"
                                                                                                             aria-invalid="false"
                                                                                                             placeholder="Symbol*"></span>
                                                </p>

                                                <p><span class="wp-my-cf7-form-control-wrap ICOSupply"><input
                                                            type="text"
                                                            name="ico_supply"
                                                            value=""
                                                            size="40"
                                                            class="wp-my-cf7-form-control wp-my-cf7-text wp-my-cf7-validates-as-required"
                                                            aria-required="true"
                                                            aria-invalid="false"
                                                            placeholder="ICOSupply"></span>
                                                </p>

                                                <p><span class="wp-my-cf7-form-control-wrap text-969"><input type="text"
                                                                                                             name="max_supply"
                                                                                                             value=""
                                                                                                             size="40"
                                                                                                             class="wp-my-cf7-form-control wp-my-cf7-text wp-my-cf7-validates-as-required"
                                                                                                             aria-required="true"
                                                                                                             aria-invalid="false"
                                                                                                             placeholder="Max Supply"></span>
                                                </p>

                                                <p><span class="wp-my-cf7-form-control-wrap text-969"><input type="text"
                                                                                                             name="start_bonus"
                                                                                                             value=""
                                                                                                             size="40"
                                                                                                             class="wp-my-cf7-form-control wp-my-cf7-text wp-my-cf7-validates-as-required"
                                                                                                             aria-required="true"
                                                                                                             aria-invalid="false"
                                                                                                             placeholder="Start bonus"></span>
                                                </p>

                                                <p><span class="wp-my-cf7-form-control-wrap text-969"><input type="text"
                                                                                                             name="hardcap"
                                                                                                             value=""
                                                                                                             size="40"
                                                                                                             class="wp-my-cf7-form-control wp-my-cf7-text wp-my-cf7-validates-as-required"
                                                                                                             aria-required="true"
                                                                                                             aria-invalid="false"
                                                                                                             placeholder="Hardcap"></span>
                                                </p>

                                                <p><span class="wp-my-cf7-form-control-wrap text-969"><input type="text"
                                                                                                             name="whitepaper_url"
                                                                                                             value=""
                                                                                                             size="40"
                                                                                                             class="wp-my-cf7-form-control wp-my-cf7-text wp-my-cf7-validates-as-required"
                                                                                                             aria-required="true"
                                                                                                             aria-invalid="false"
                                                                                                             placeholder="Whitepaper URL*"></span>
                                                </p>

                                                <p><b>Links:</b></p>

                                                <p><span class="wp-my-cf7-form-control-wrap text-969"><input type="text"
                                                                                                             name="twitter"
                                                                                                             value=""
                                                                                                             size="40"
                                                                                                             class="wp-my-cf7-form-control wp-my-cf7-text wp-my-cf7-validates-as-required"
                                                                                                             aria-required="true"
                                                                                                             aria-invalid="false"
                                                                                                             placeholder="Twitter"></span>
                                                </p>

                                                <p><span class="wp-my-cf7-form-control-wrap text-969"><input type="text"
                                                                                                             name="telegram"
                                                                                                             value=""
                                                                                                             size="40"
                                                                                                             class="wp-my-cf7-form-control wp-my-cf7-text wp-my-cf7-validates-as-required"
                                                                                                             aria-required="true"
                                                                                                             aria-invalid="false"
                                                                                                             placeholder="Telegram"></span>
                                                </p>

                                                <p><span class="wp-my-cf7-form-control-wrap text-969"><input type="text"
                                                                                                             name="facebook"
                                                                                                             value=""
                                                                                                             size="40"
                                                                                                             class="wp-my-cf7-form-control wp-my-cf7-text wp-my-cf7-validates-as-required"
                                                                                                             aria-required="true"
                                                                                                             aria-invalid="false"
                                                                                                             placeholder="Facebook"></span>
                                                </p>

                                                <p><span class="wp-my-cf7-form-control-wrap text-969"><input type="text"
                                                                                                             name="medium"
                                                                                                             value=""
                                                                                                             size="40"
                                                                                                             class="wp-my-cf7-form-control wp-my-cf7-text wp-my-cf7-validates-as-required"
                                                                                                             aria-required="true"
                                                                                                             aria-invalid="false"
                                                                                                             placeholder="Medium"></span>
                                                </p>

                                                <p><span class="wp-my-cf7-form-control-wrap text-969"><input type="text"
                                                                                                             name="slack"
                                                                                                             value=""
                                                                                                             size="40"
                                                                                                             class="wp-my-cf7-form-control wp-my-cf7-text wp-my-cf7-validates-as-required"
                                                                                                             aria-required="true"
                                                                                                             aria-invalid="false"
                                                                                                             placeholder="Slack"></span>
                                                </p>

                                                <p><span class="wp-my-cf7-form-control-wrap text-969"><input type="text"
                                                                                                             name="github"
                                                                                                             value=""
                                                                                                             size="40"
                                                                                                             class="wp-my-cf7-form-control wp-my-cf7-text wp-my-cf7-validates-as-required"
                                                                                                             aria-required="true"
                                                                                                             aria-invalid="false"
                                                                                                             placeholder="Github"></span>
                                                </p>

                                                <p><span class="wp-my-cf7-form-control-wrap text-969"><input type="text"
                                                                                                             name="instagram"
                                                                                                             value=""
                                                                                                             size="40"
                                                                                                             class="wp-my-cf7-form-control wp-my-cf7-text wp-my-cf7-validates-as-required"
                                                                                                             aria-required="true"
                                                                                                             aria-invalid="false"
                                                                                                             placeholder="Instagram"></span>
                                                </p>

                                                <p><span class="wp-my-cf7-form-control-wrap text-969"><input type="text"
                                                                                                             name="youtube"
                                                                                                             value=""
                                                                                                             size="40"
                                                                                                             class="wp-my-cf7-form-control wp-my-cf7-text wp-my-cf7-validates-as-required"
                                                                                                             aria-required="true"
                                                                                                             aria-invalid="false"
                                                                                                             placeholder="YouTube"></span>
                                                </p>

                                                <p><span class="wp-my-cf7-form-control-wrap text-969"><input type="text"
                                                                                                             name="bitcointalk"
                                                                                                             value=""
                                                                                                             size="40"
                                                                                                             class="wp-my-cf7-form-control wp-my-cf7-text wp-my-cf7-validates-as-required"
                                                                                                             aria-required="true"
                                                                                                             aria-invalid="false"
                                                                                                             placeholder="Bitcointalk"></span>
                                                </p>

                                                <p><span class="wp-my-cf7-form-control-wrap text-969"><input type="text"
                                                                                                             name="video_link"
                                                                                                             value=""
                                                                                                             size="40"
                                                                                                             class="wp-my-cf7-form-control wp-my-cf7-text wp-my-cf7-validates-as-required"
                                                                                                             aria-required="true"
                                                                                                             aria-invalid="false"
                                                                                                             placeholder="YouTube video link"></span>
                                                </p>

                                                <p><span class="wp-my-cf7-form-control-wrap text-969"><input
                                                            type="email"
                                                            name="help_email"
                                                            value=""
                                                            size="40"
                                                            class="wp-my-cf7-form-control wp-my-cf7-text wp-my-cf7-validates-as-required"
                                                            aria-required="true"
                                                            aria-invalid="false"
                                                            placeholder="j. Email for help and relevant info*"></span>
                                                </p>

                                                <h3>Team</h3>

                                                <p><span class="wp-my-cf7-form-control-wrap text-969"><input type="text"
                                                                                                             name="full_name"
                                                                                                             value=""
                                                                                                             size="40"
                                                                                                             class="wp-my-cf7-form-control wp-my-cf7-text wp-my-cf7-validates-as-required"
                                                                                                             aria-required="true"
                                                                                                             aria-invalid="false"
                                                                                                             placeholder="Full Name*"></span>
                                                </p>

                                                <p><span class="wp-my-cf7-form-control-wrap email-850"><input
                                                            type="email"
                                                            name="contact_email"
                                                            value=""
                                                            size="40"
                                                            class="wp-my-cf7-form-control wp-my-cf7-text wp-my-cf7-email wp-my-cf7-validates-as-required wp-my-cf7-validates-as-email"
                                                            aria-required="true"
                                                            aria-invalid="false"
                                                            placeholder="Your contact Email"></span>
                                                </p>

                                                <p><b>Picture*</b></p>

                                                <p><span class="wp-my-cf7-form-control-wrap file-246"><input type="file"
                                                                                                             name="picture"
                                                                                                             size="40"
                                                                                                             class="wp-my-cf7-form-control wp-my-cf7-file"
                                                                                                             aria-invalid="false"></span>
                                                </p>


                                                <p><span class="wp-my-cf7-form-control-wrap ShortBio"><textarea
                                                            name="short_bio" cols="40" rows="10"
                                                            class="wp-my-cf7-form-control wp-my-cf7-textarea wp-my-cf7-validates-as-required"
                                                            aria-required="true" aria-invalid="false"></textarea></span>
                                                </p>

                                                <p><span class="wp-my-cf7-form-control-wrap text-969"><input type="text"
                                                                                                             name="text-969"
                                                                                                             value=""
                                                                                                             size="40"
                                                                                                             class="wp-my-cf7-form-control wp-my-cf7-text wp-my-cf7-validates-as-required"
                                                                                                             aria-required="true"
                                                                                                             aria-invalid="false"
                                                                                                             placeholder="Linkedin"></span>
                                                </p>

                                                <p><span class="wp-my-cf7-form-control-wrap text-969"><input type="text"
                                                                                                             name="text-969"
                                                                                                             value=""
                                                                                                             size="40"
                                                                                                             class="wp-my-cf7-form-control wp-my-cf7-text wp-my-cf7-validates-as-required"
                                                                                                             aria-required="true"
                                                                                                             aria-invalid="false"
                                                                                                             placeholder="Facebook"></span>
                                                </p>

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