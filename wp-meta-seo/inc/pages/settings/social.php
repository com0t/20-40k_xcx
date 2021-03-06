<?php
/* Prohibit direct script loading */
defined('ABSPATH') || die('No direct script access allowed!');
if (isset($_SESSION['_metaseo_settings_social']) && $_SESSION['_metaseo_settings_social']) {
    echo '<div class="save-settings-mess top_bar ju-notice-success"><strong>' . esc_html__('Setting saved successfully', 'wp-meta-seo') . '</strong>
            <button type="button" class="wpms-settings-dismiss notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';
    unset($_SESSION['_metaseo_settings_social']);
}
?>
<div id="social" class="content-box">
    <div class="ju-settings-option height_160 p-lrb-20">
        <div class="wpms_row_full">
            <input type="hidden" name="_metaseo_settings[metaseo_showsocial]"
                   value="0">
            <label class="ju-setting-label" style="padding-left: 0">
                <?php esc_html_e('Social sharing block', 'wp-meta-seo') ?>
            </label>
            <div class="ju-switch-button">
                <label class="switch">
                    <input type="checkbox"
                           name="_metaseo_settings[metaseo_showsocial]"
                           value="1" <?php checked($metaseo_showsocial, 1) ?>>
                    <span class="slider round"></span>
                </label>
            </div>
            <p class="ju-description text_left p-tb-20 border-top-e4e8ed">
                <?php esc_html_e('Customize social networks apparence  when sharing a content', 'wp-meta-seo') ?>
            </p>
        </div>
    </div>

    <div class="ju-settings-option height_160">
        <div class="wpms_row_full">
            <label class="ju-setting-label wpms_width_100 wpms_left"
                   data-tippy="<?php esc_html_e('Choose the Twitter card size generated when sharing a content', 'wp-meta-seo'); ?>">
                <?php esc_html_e('The default card type to use', 'wp-meta-seo') ?>
            </label>
            <p class="p-d-20">
                <label>
                    <select class="select wpms_width_100" name="_metaseo_settings[metaseo_twitter_card]"
                            id="metaseo_twitter_card">
                        <option <?php selected($metaseo_twitter_card, 'summary') ?>
                            value="summary"><?php esc_html_e('Summary', 'wp-meta-seo'); ?></option>
                        <option <?php selected($metaseo_twitter_card, 'summary_large_image') ?>
                            value="summary_large_image"><?php esc_html_e('Summary with large image', 'wp-meta-seo'); ?></option>
                    </select>
                </label>
            </p>
        </div>
    </div>

    <div class="ju-settings-option wpms_width_100 wpms-no-background wpms-no-shadow">
        <div class="ju-settings-option p-d-20">
            <?php
            $image_src = WPMETASEO_PLUGIN_URL . 'assets/images/facebook/facebook.png';
            $srcset2x  = WPMETASEO_PLUGIN_URL . 'assets/images/facebook/facebook@2x.png';
            $srcset3x  = WPMETASEO_PLUGIN_URL . 'assets/images/facebook/facebook@3x.png';
            $img = '<img src="'.esc_url($image_src).'"
                 srcset="'.esc_url($srcset2x).' 2x,'.esc_url($srcset3x).' 3x"
                 class="social-img">';
            // phpcs:ignore WordPress.Security.EscapeOutput -- Content escaped in the method doMetaBox
            echo '<h2 class="wpms-top-h3">' . $img . '<span>' . esc_html__('Facebook', 'wp-meta-seo') .'</span></h2>';
            ?>
            <div class="wpms_row_full">
                <label class="ju-setting-label wpms_width_100 wpms_left" style="padding-left: 0"
                       data-tippy="<?php esc_html_e('Used as profile in case of social sharing content on Facebook', 'wp-meta-seo'); ?>">
                    <?php esc_html_e('Facebook profile URL', 'wp-meta-seo') ?>
                </label>
                <p>
                    <label>
                        <input type="text" class="wpms_width_100" name="_metaseo_settings[metaseo_showfacebook]"
                               value="<?php echo esc_attr($metaseo_showfacebook) ?>">
                    </label>
                </p>
            </div>

            <div class="wpms_row_full">
                <label class="ju-setting-label wpms_width_100 wpms_left" style="padding-left: 0" data-tippy="<?php esc_html_e('Used as facebook app ID in case of
                         social sharing content on Facebook', 'wp-meta-seo'); ?>">
                    <?php esc_html_e('Facebook App ID', 'wp-meta-seo') ?>
                </label>
                <p>
                    <label>
                        <input type="text" class="wpms_width_100" name="_metaseo_settings[metaseo_showfbappid]"
                               value="<?php echo esc_attr($metaseo_showfbappid) ?>">
                    </label>
                </p>
            </div>

            <div class="wpms_row_full">
                <label class="ju-setting-label" style="padding-left: 0"
                       data-tippy="<?php esc_html_e('Enable this feature if you want to set the default image to display when sharing post/page on Facebook', 'wp-meta-seo'); ?>">
                    <?php esc_html_e('Default post Facebook image', 'wp-meta-seo') ?>
                </label>
                <div class="ju-switch-button metaseo_enable_op_markup">
                    <label class="switch">
                        <input type="hidden" name="_metaseo_settings[metaseo_enable_default_fb_image][active]"
                               value="0">
                        <input <?php checked($metaseo_enable_default_fb_image['active'], 1); ?> id="metaseo_enable_op_markup" type="checkbox"
                               name="_metaseo_settings[metaseo_enable_default_fb_image][active]"
                               value="1">
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>

            <?php if ((int)$metaseo_enable_default_fb_image['active'] === 1) { ?>
            <div class="wpms_row_full wpms-op-markup-source" style="display: block">
            <?php } else { ?>
                <div class="wpms_row_full wpms-op-markup-source" style="display: none">
            <?php } ?>
                <label class="ju-setting-label wpms_width_100 wpms_left" style="padding-left: 0;">
                    <?php esc_html_e('Image source', 'wp-meta-seo') ?>
                </label>
                <p>
                    <label>
                        <select id="wpms-op-markup-source" class="select wpms_width_100" name="_metaseo_settings[metaseo_enable_default_fb_image][source]">
                            <option <?php selected($metaseo_enable_default_fb_image['source'], 'featured'); ?> value="featured"><?php esc_html_e('Featured image', 'wp-meta-seo'); ?></option>
                            <option <?php selected($metaseo_enable_default_fb_image['source'], 'firstInContent'); ?> value="firstInContent"><?php esc_html_e('First image in content', 'wp-meta-seo'); ?></option>
                            <option <?php selected($metaseo_enable_default_fb_image['source'], 'author'); ?> value="author"><?php esc_html_e('Post author avatar', 'wp-meta-seo'); ?></option>
                            <option <?php selected($metaseo_enable_default_fb_image['source'], 'setDefaultImage'); ?> value="setDefaultImage"><?php esc_html_e('Default image', 'wp-meta-seo'); ?></option>
                        </select>
                    </label>
                </p>
            </div>

                <?php if ($metaseo_enable_default_fb_image['source'] === 'setDefaultImage' && (int)$metaseo_enable_default_fb_image['active'] === 1) { ?>
            <div class="wpms_row_full wpms_left wpms-op-markup-upload" style="display: block">
                <?php } else { ?>
                <div class="wpms_row_full wpms_left wpms-op-markup-upload" style="display: none">
                <?php } ?>
                <label class="ju-setting-label wpms_width_100 wpms_left" style="padding-left: 0;">
                    <label for=""><?php esc_html_e('Set default image', 'wp-meta-seo') ?></label>
                </label>
                <label class="wpms_width_100 label-input wpms_left">
                    <input id="wpms-op-markup-fb-img" type="text" size="36" class=" wpms-large-input" name="_metaseo_settings[metaseo_enable_default_fb_image][default_set]" value="<?php echo esc_attr($metaseo_enable_default_fb_image['default_set']); ?>">
                    <button id="wpms-op-markup-fb-img-btn" class="ju-button orange-button wpms-small-btn wpmseo_image_upload_button" type="button">Upload</button>
                </label>
            </div>

        </div>

        <div class="ju-settings-option p-d-20">
            <?php
            $image_src = WPMETASEO_PLUGIN_URL . 'assets/images/twitter/twitter.png';
            $srcset2x  = WPMETASEO_PLUGIN_URL . 'assets/images/twitter/twitter@2x.png';
            $srcset3x  = WPMETASEO_PLUGIN_URL . 'assets/images/twitter/twitter@3x.png';
            $img = '<img src="'.esc_url($image_src).'"
                 srcset="'.esc_url($srcset2x).' 2x,'.esc_url($srcset3x).' 3x"
                 class="social-img">';
            // phpcs:ignore WordPress.Security.EscapeOutput -- Content escaped in the method doMetaBox
            echo '<h2 class="wpms-top-h3">' . $img . '<span>' . esc_html__('Twitter', 'wp-meta-seo') .'</span></h2>';
            ?>
            <div class="wpms_row_full">
                <label class="ju-setting-label wpms_width_100 wpms_left" style="padding-left: 0"
                       data-tippy="<?php esc_html_e('Used as profile in case of social sharing content on Twitter', 'wp-meta-seo'); ?>">
                    <?php esc_html_e('Twitter Username', 'wp-meta-seo') ?>
                </label>
                <p>
                    <label>
                        <input type="text" class="wpms_width_100" name="_metaseo_settings[metaseo_showtwitter]"
                               value="<?php echo esc_attr($metaseo_showtwitter) ?>">
                    </label>
                </p>
            </div>

            <div class="wpms_row_full">
                <label class="ju-setting-label" style="padding-left: 0"
                       data-tippy="<?php esc_html_e('Enable this feature if you want to set the default image to display when sharing post/page on Twitter', 'wp-meta-seo'); ?>">
                    <?php esc_html_e('Default post Twitter image', 'wp-meta-seo') ?>
                </label>
                <div class="ju-switch-button metaseo_enable_twitter_img">
                    <label class="switch">
                        <input type="hidden" name="_metaseo_settings[metaseo_enable_default_twitter_image][active]"
                               value="0">
                        <input <?php checked($metaseo_enable_default_twitter_image['active'], 1); ?> id="metaseo_enable_twitter_img" type="checkbox"
                               name="_metaseo_settings[metaseo_enable_default_twitter_image][active]"
                               value="1">
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>

            <?php if ((int)$metaseo_enable_default_twitter_image['active'] === 1) { ?>
            <div class="wpms_row_full wpms-twitter-img-source" style="display: block">
            <?php } else { ?>
                <div class="wpms_row_full wpms-twitter-img-source" style="display: none">
            <?php } ?>
                <label class="ju-setting-label wpms_width_100 wpms_left" style="padding-left: 0;">
                    <?php esc_html_e('Image source', 'wp-meta-seo') ?>
                </label>
                <p>
                    <label>
                        <select id="wpms-twitter-img-source" class="select wpms_width_100" name="_metaseo_settings[metaseo_enable_default_twitter_image][source]">
                            <option <?php selected($metaseo_enable_default_twitter_image['source'], 'featured') ?> value="featured"><?php esc_html_e('Featured image', 'wp-meta-seo'); ?></option>
                            <option <?php selected($metaseo_enable_default_twitter_image['source'], 'firstInContent') ?> value="firstInContent"><?php esc_html_e('First image in content', 'wp-meta-seo'); ?></option>
                            <option <?php selected($metaseo_enable_default_twitter_image['source'], 'author') ?> value="author"><?php esc_html_e('Post author avatar', 'wp-meta-seo'); ?></option>
                            <option <?php selected($metaseo_enable_default_twitter_image['source'], 'setDefaultImage') ?> value="setDefaultImage"><?php esc_html_e('Default image', 'wp-meta-seo'); ?></option>
                        </select>
                    </label>
                </p>
            </div>

             <?php if ($metaseo_enable_default_twitter_image['source'] === 'setDefaultImage' && (int)$metaseo_enable_default_twitter_image['active'] === 1) { ?>
            <div class="wpms_row_full wpms_left wpms-twitter-img-upload" style="display: block">
             <?php } else { ?>
                <div class="wpms_row_full wpms_left wpms-twitter-img-upload" style="display: none">
             <?php } ?>
                <label class="ju-setting-label wpms_width_100 wpms_left" style="padding-left: 0;">
                    <label for=""><?php esc_html_e('Set default image', 'wp-meta-seo') ?></label>
                </label>
                <label class="wpms_width_100 label-input wpms_left">
                    <input id="wpms-default-twitter-img" type="text" size="36" class=" wpms-large-input" name="_metaseo_settings[metaseo_enable_default_twitter_image][default_set]" value="<?php echo esc_attr($metaseo_enable_default_twitter_image['default_set']); ?>">
                    <button id="wpms-default-twitter-img-btn" class="ju-button orange-button wpms-small-btn wpmseo_image_upload_button" type="button">Upload</button>
                </label>
            </div>
        </div>
    </div>

    <div class="wpms_width_100 wpms_left">
        <button type="submit" name="_metaseo_settings[wpms_save_social]"
                class="btn_wpms_save ju-button orange-button waves-effect waves-light"><?php esc_html_e('Save Changes', 'wp-meta-seo') ?></button>
    </div>
</div>