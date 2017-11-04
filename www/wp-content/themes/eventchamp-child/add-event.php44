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

    var_dump($_POST);
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
                                        <div role="form" class="wpcf7" id="wpcf7-f2236-p2227-o1" lang="ru-RU" dir="ltr">
                                            <div class="screen-reader-response"></div>
                                            <form action="/add-event/?foo=bar" method="post" class="wpcf7-form"
                                                  enctype="multipart/form-data">
                                                <div style="display: none;">
                                                    <input type="hidden" name="_wpcf7" value="2236">
                                                    <input type="hidden" name="_wpcf7_version" value="4.9">
                                                    <input type="hidden" name="_wpcf7_locale" value="ru_RU">
                                                    <input type="hidden" name="_wpcf7_unit_tag"
                                                           value="wpcf7-f2236-p2227-o1">
                                                    <input type="hidden" name="_wpcf7_container_post" value="2227">
                                                </div>
                                                <div class="inputs">
                                                    <p><b>ICO General Info</b></p>

                                                    <div class="form-group name"><span
                                                            class="wpcf7-form-control-wrap ICO"><input type="text"
                                                                                                       name="ICO"
                                                                                                       value=""
                                                                                                       size="40"
                                                                                                       class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                                                                       aria-required="true"
                                                                                                       aria-invalid="false"
                                                                                                       placeholder="ICO Name"></span>
                                                    </div>
                                                    <p><span class="wpcf7-form-control-wrap url-610"><input type="url"
                                                                                                            name="url-610"
                                                                                                            value=""
                                                                                                            size="40"
                                                                                                            class="wpcf7-form-control wpcf7-text wpcf7-url wpcf7-validates-as-required wpcf7-validates-as-url"
                                                                                                            aria-required="false"
                                                                                                            aria-invalid="false"
                                                                                                            placeholder="ICO Website URL"></span>
                                                    </p>

                                                    <p><b>Upload Event logo</b></p>

                                                    <p><span class="wpcf7-form-control-wrap file-955"><input type="file"
                                                                                                             name="file-955"
                                                                                                             size="40"
                                                                                                             class="wpcf7-form-control wpcf7-file"
                                                                                                             aria-invalid="false"></span>
                                                    </p></div>
                                                <p><span class="wpcf7-form-control-wrap textarea-444"><textarea
                                                            name="textarea-444" cols="40" rows="3"
                                                            class="wpcf7-form-control wpcf7-textarea"
                                                            aria-invalid="false"
                                                            placeholder="Short ICO description (1-2 sentences)"></textarea></span>
                                                </p>

                                                <p><span class="wpcf7-form-control-wrap textarea-400"><textarea
                                                            name="textarea-400" cols="40" rows="5"
                                                            class="wpcf7-form-control wpcf7-textarea"
                                                            aria-invalid="false"
                                                            placeholder="Project introduction Less than 500-4000 words ）"></textarea></span>
                                                </p>

                                                <p><b>ICO start date *</b></p>

                                                <p><span class="wpcf7-form-control-wrap date-101"><input type="date"
                                                                                                         name="date-101"
                                                                                                         value="ICO start date"
                                                                                                         class="wpcf7-form-control wpcf7-date wpcf7-validates-as-required wpcf7-validates-as-date"
                                                                                                         aria-required="true"
                                                                                                         aria-invalid="false"></span>
                                                </p>

                                                <p><b>ICO end date *</b></p>

                                                <p><span class="wpcf7-form-control-wrap date-566"><input type="date"
                                                                                                         name="date-566"
                                                                                                         value=""
                                                                                                         class="wpcf7-form-control wpcf7-date wpcf7-validates-as-required wpcf7-validates-as-date"
                                                                                                         aria-required="true"
                                                                                                         aria-invalid="false"
                                                                                                         placeholder="ICO end date *"></span>
                                                </p>

                                                <p><b>Project Category*</b></p>

                                                <p><span class="wpcf7-form-control-wrap menu-145"><select
                                                            name="menu-145"
                                                            class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required"
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

                                                <p><span class="wpcf7-form-control-wrap checkbox-418"><span
                                                            class="wpcf7-form-control wpcf7-checkbox"><span
                                                                class="wpcf7-list-item first"><input type="checkbox"
                                                                                                     name="checkbox-418[]"
                                                                                                     value="Bitcoin"><span
                                                                    class="wpcf7-list-item-label">Bitcoin</span></span><span
                                                                class="wpcf7-list-item"><input type="checkbox"
                                                                                               name="checkbox-418[]"
                                                                                               value="BitShares"><span
                                                                    class="wpcf7-list-item-label">BitShares</span></span><span
                                                                class="wpcf7-list-item"><input type="checkbox"
                                                                                               name="checkbox-418[]"
                                                                                               value="Burst"><span
                                                                    class="wpcf7-list-item-label">Burst</span></span><span
                                                                class="wpcf7-list-item"><input type="checkbox"
                                                                                               name="checkbox-418[]"
                                                                                               value="Counterparty"><span
                                                                    class="wpcf7-list-item-label">Counterparty</span></span><span
                                                                class="wpcf7-list-item"><input type="checkbox"
                                                                                               name="checkbox-418[]"
                                                                                               value="Ethereum"><span
                                                                    class="wpcf7-list-item-label">Ethereum</span></span><span
                                                                class="wpcf7-list-item"><input type="checkbox"
                                                                                               name="checkbox-418[]"
                                                                                               value="Ethereum Classic"><span
                                                                    class="wpcf7-list-item-label">Ethereum Classic</span></span><span
                                                                class="wpcf7-list-item"><input type="checkbox"
                                                                                               name="checkbox-418[]"
                                                                                               value="Graphene"><span
                                                                    class="wpcf7-list-item-label">Graphene</span></span><span
                                                                class="wpcf7-list-item"><input type="checkbox"
                                                                                               name="checkbox-418[]"
                                                                                               value="NEM"><span
                                                                    class="wpcf7-list-item-label">NEM</span></span><span
                                                                class="wpcf7-list-item"><input type="checkbox"
                                                                                               name="checkbox-418[]"
                                                                                               value="NuBits"><span
                                                                    class="wpcf7-list-item-label">NuBits</span></span><span
                                                                class="wpcf7-list-item"><input type="checkbox"
                                                                                               name="checkbox-418[]"
                                                                                               value="Nxt"><span
                                                                    class="wpcf7-list-item-label">Nxt</span></span><span
                                                                class="wpcf7-list-item"><input type="checkbox"
                                                                                               name="checkbox-418[]"
                                                                                               value="Omni"><span
                                                                    class="wpcf7-list-item-label">Omni</span></span><span
                                                                class="wpcf7-list-item"><input type="checkbox"
                                                                                               name="checkbox-418[]"
                                                                                               value="Uniq"><span
                                                                    class="wpcf7-list-item-label">Uniq</span></span><span
                                                                class="wpcf7-list-item"><input type="checkbox"
                                                                                               name="checkbox-418[]"
                                                                                               value="Waves"><span
                                                                    class="wpcf7-list-item-label">Waves</span></span><span
                                                                class="wpcf7-list-item"><input type="checkbox"
                                                                                               name="checkbox-418[]"
                                                                                               value="Own"><span
                                                                    class="wpcf7-list-item-label">Own</span></span><span
                                                                class="wpcf7-list-item last"><input type="checkbox"
                                                                                                    name="checkbox-418[]"
                                                                                                    value="other"><span
                                                                    class="wpcf7-list-item-label">other</span></span></span></span>
                                                </p>

                                                <p><span class="wpcf7-form-control-wrap text-968"><input type="text"
                                                                                                         name="text-968"
                                                                                                         value=""
                                                                                                         size="40"
                                                                                                         class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                                                                         aria-required="true"
                                                                                                         aria-invalid="false"
                                                                                                         placeholder="Token/coin name*"></span>
                                                </p>

                                                <p><span class="wpcf7-form-control-wrap text-968"><input type="text"
                                                                                                         name="text-968"
                                                                                                         value=""
                                                                                                         size="40"
                                                                                                         class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                                                                         aria-required="true"
                                                                                                         aria-invalid="false"
                                                                                                         placeholder="Symbol*"></span>
                                                </p>

                                                <p><span class="wpcf7-form-control-wrap ICOSupply"><input type="text"
                                                                                                          name="ICOSupply"
                                                                                                          value=""
                                                                                                          size="40"
                                                                                                          class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                                                                          aria-required="true"
                                                                                                          aria-invalid="false"
                                                                                                          placeholder="ICOSupply"></span>
                                                </p>

                                                <p><span class="wpcf7-form-control-wrap text-969"><input type="text"
                                                                                                         name="text-969"
                                                                                                         value=""
                                                                                                         size="40"
                                                                                                         class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                                                                         aria-required="true"
                                                                                                         aria-invalid="false"
                                                                                                         placeholder="Max Supply"></span>
                                                </p>

                                                <p><span class="wpcf7-form-control-wrap text-969"><input type="text"
                                                                                                         name="text-969"
                                                                                                         value=""
                                                                                                         size="40"
                                                                                                         class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                                                                         aria-required="true"
                                                                                                         aria-invalid="false"
                                                                                                         placeholder="Start bonus"></span>
                                                </p>

                                                <p><span class="wpcf7-form-control-wrap text-969"><input type="text"
                                                                                                         name="text-969"
                                                                                                         value=""
                                                                                                         size="40"
                                                                                                         class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                                                                         aria-required="true"
                                                                                                         aria-invalid="false"
                                                                                                         placeholder="Hardcap"></span>
                                                </p>

                                                <p><span class="wpcf7-form-control-wrap text-969"><input type="text"
                                                                                                         name="text-969"
                                                                                                         value=""
                                                                                                         size="40"
                                                                                                         class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                                                                         aria-required="true"
                                                                                                         aria-invalid="false"
                                                                                                         placeholder="Whitepaper URL*"></span>
                                                </p>

                                                <p><b>Links:</b></p>

                                                <p><span class="wpcf7-form-control-wrap text-969"><input type="text"
                                                                                                         name="text-969"
                                                                                                         value=""
                                                                                                         size="40"
                                                                                                         class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                                                                         aria-required="true"
                                                                                                         aria-invalid="false"
                                                                                                         placeholder="Twitter"></span>
                                                </p>

                                                <p><span class="wpcf7-form-control-wrap text-969"><input type="text"
                                                                                                         name="text-969"
                                                                                                         value=""
                                                                                                         size="40"
                                                                                                         class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                                                                         aria-required="true"
                                                                                                         aria-invalid="false"
                                                                                                         placeholder="Telegram"></span>
                                                </p>

                                                <p><span class="wpcf7-form-control-wrap text-969"><input type="text"
                                                                                                         name="text-969"
                                                                                                         value=""
                                                                                                         size="40"
                                                                                                         class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                                                                         aria-required="true"
                                                                                                         aria-invalid="false"
                                                                                                         placeholder="Facebook"></span>
                                                </p>

                                                <p><span class="wpcf7-form-control-wrap text-969"><input type="text"
                                                                                                         name="text-969"
                                                                                                         value=""
                                                                                                         size="40"
                                                                                                         class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                                                                         aria-required="true"
                                                                                                         aria-invalid="false"
                                                                                                         placeholder="Medium"></span>
                                                </p>

                                                <p><span class="wpcf7-form-control-wrap text-969"><input type="text"
                                                                                                         name="text-969"
                                                                                                         value=""
                                                                                                         size="40"
                                                                                                         class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                                                                         aria-required="true"
                                                                                                         aria-invalid="false"
                                                                                                         placeholder="Slack"></span>
                                                </p>

                                                <p><span class="wpcf7-form-control-wrap text-969"><input type="text"
                                                                                                         name="text-969"
                                                                                                         value=""
                                                                                                         size="40"
                                                                                                         class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                                                                         aria-required="true"
                                                                                                         aria-invalid="false"
                                                                                                         placeholder="Github"></span>
                                                </p>

                                                <p><span class="wpcf7-form-control-wrap text-969"><input type="text"
                                                                                                         name="text-969"
                                                                                                         value=""
                                                                                                         size="40"
                                                                                                         class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                                                                         aria-required="true"
                                                                                                         aria-invalid="false"
                                                                                                         placeholder="Instagram"></span>
                                                </p>

                                                <p><span class="wpcf7-form-control-wrap text-969"><input type="text"
                                                                                                         name="text-969"
                                                                                                         value=""
                                                                                                         size="40"
                                                                                                         class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                                                                         aria-required="true"
                                                                                                         aria-invalid="false"
                                                                                                         placeholder="YouTube"></span>
                                                </p>

                                                <p><span class="wpcf7-form-control-wrap text-969"><input type="text"
                                                                                                         name="text-969"
                                                                                                         value=""
                                                                                                         size="40"
                                                                                                         class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                                                                         aria-required="true"
                                                                                                         aria-invalid="false"
                                                                                                         placeholder="Bitcointalk"></span>
                                                </p>

                                                <p><span class="wpcf7-form-control-wrap text-969"><input type="text"
                                                                                                         name="text-969"
                                                                                                         value=""
                                                                                                         size="40"
                                                                                                         class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                                                                         aria-required="true"
                                                                                                         aria-invalid="false"
                                                                                                         placeholder="YouTube video link"></span>
                                                </p>

                                                <p><span class="wpcf7-form-control-wrap text-969"><input type="text"
                                                                                                         name="text-969"
                                                                                                         value=""
                                                                                                         size="40"
                                                                                                         class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                                                                         aria-required="true"
                                                                                                         aria-invalid="false"
                                                                                                         placeholder="j. Email for help and relevant info*"></span>
                                                </p>

                                                <h3>Team</h3>

                                                <p><span class="wpcf7-form-control-wrap text-969"><input type="text"
                                                                                                         name="text-969"
                                                                                                         value=""
                                                                                                         size="40"
                                                                                                         class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                                                                         aria-required="true"
                                                                                                         aria-invalid="false"
                                                                                                         placeholder="Full Name*"></span>
                                                </p>

                                                <p><span class="wpcf7-form-control-wrap email-850"><input type="email"
                                                                                                          name="email-850"
                                                                                                          value=""
                                                                                                          size="40"
                                                                                                          class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email"
                                                                                                          aria-required="true"
                                                                                                          aria-invalid="false"
                                                                                                          placeholder="Your contact Email"></span>
                                                </p>

                                                <p><span class="wpcf7-form-control-wrap file-246"><input type="file"
                                                                                                         name="file-246"
                                                                                                         size="40"
                                                                                                         class="wpcf7-form-control wpcf7-file"
                                                                                                         aria-invalid="false"></span>
                                                </p>

                                                <p><span class="wpcf7-form-control-wrap text-969"><input type="text"
                                                                                                         name="text-969"
                                                                                                         value=""
                                                                                                         size="40"
                                                                                                         class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                                                                         aria-required="true"
                                                                                                         aria-invalid="false"
                                                                                                         placeholder="Full Name*"></span>
                                                </p>

                                                <p><span class="wpcf7-form-control-wrap ShortBio"><textarea
                                                            name="ShortBio" cols="40" rows="10"
                                                            class="wpcf7-form-control wpcf7-textarea wpcf7-validates-as-required"
                                                            aria-required="true" aria-invalid="false"></textarea></span>
                                                </p>

                                                <p><span class="wpcf7-form-control-wrap text-969"><input type="text"
                                                                                                         name="text-969"
                                                                                                         value=""
                                                                                                         size="40"
                                                                                                         class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                                                                         aria-required="true"
                                                                                                         aria-invalid="false"
                                                                                                         placeholder="Linkedin"></span>
                                                </p>

                                                <p><span class="wpcf7-form-control-wrap text-969"><input type="text"
                                                                                                         name="text-969"
                                                                                                         value=""
                                                                                                         size="40"
                                                                                                         class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                                                                         aria-required="true"
                                                                                                         aria-invalid="false"
                                                                                                         placeholder="Facebook"></span>
                                                </p>

                                                <p><b>Want to advertise your ICO with us?*</b>
                                                </p>

                                                <p>
                                                    <span class="wpcf7-form-control-wrap acceptance-691"><input
                                                            type="checkbox" name="acceptance-691" value="1"
                                                            class="wpcf7-form-control wpcf7-acceptance"
                                                            aria-invalid="false"></span></p>

                                                <p>
                                                    <button type="submit"> Submit Data!</button>

                                                    <input type="submit" value="Submit info!"
                                                           class="wpcf7-form-control wpcf7-submit"><span
                                                        class="ajax-loader"></span><span class="ajax-loader"></span>

                                                </p>


                                                <div class="wpcf7-response-output wpcf7-display-none"></div>
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