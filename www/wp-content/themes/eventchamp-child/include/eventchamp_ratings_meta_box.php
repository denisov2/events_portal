<?php
/**
 * Created by PhpStorm.
 * User: denisov
 * Date: 29.11.2017
 * Time: 10:11
 */

//add_meta_box($id, $title, $callback, $post_type, $context, $priority, $args);
function ratings_meta_box()
{
    add_meta_box('ratings_meta_box', 'Ratings', 'output_ratings_box', 'event', 'side', 'high');
}

add_action('admin_menu', 'ratings_meta_box');
/*
 * также можно использовать и другие хуки:
 * add_action( 'add_meta_boxes', 'tr_meta_boxes' );
 * если версия WordPress ниже 3.0, то
 * add_action( 'admin_init', 'tr_meta_boxes', 1 );
 */

/*
 * Этап 2. Заполнение
 */
function output_ratings_box($post)
{

    $ratings_titles = [
        1 => 'Idea and market size',
        2 => 'Team',
        3 => 'Quality of website, marketing etc',
        4 => 'Development level',
        5 => 'Competition',
        6 => 'Investment security',
    ];


    wp_nonce_field(basename(__FILE__), 'ratings_metabox_nonce');
    /*
     * добавляем текстовое поле
     */

    $html = "<p><strong>Set up ratings from 1 to 10</strong></p>";
    foreach ($ratings_titles as $key => $rating_title) {

        $cur_rating_value = get_post_meta($post->ID, 'event_rating_' . $key, true);

        $html .= "<p>$rating_title <select name='event_rating_$key'>";
        $html .= "<option value='0'>Not set</option>";
        for ($i = 1; $i <= 10; $i++) {
            $selected = $i == $cur_rating_value ? " selected=1 " : "";
            $html .= "<option $selected value='$i'>$i</option>";
        }
        $html .= "</p></select>";

    }

    /*
     * добавляем чекбокс
     */

    echo $html;
}

/*
 * Этап 3. Сохранение
 */
function ratings_save_box_data($post_id)
{
    $ratings_titles = [
        1 => 'Idea and market size',
        2 => 'Team',
        3 => 'Quality of website, marketing etc',
        4 => 'Development level',
        5 => 'Competition',
        6 => 'Investment security',
    ];

    // проверяем, пришёл ли запрос со страницы с метабоксом
    if (!isset($_POST['ratings_metabox_nonce'])
        || !wp_verify_nonce($_POST['ratings_metabox_nonce'], basename(__FILE__))
    )
        return $post_id;
    // проверяем, является ли запрос автосохранением
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post_id;
    // проверяем, права пользователя, может ли он редактировать записи
    if (!current_user_can('edit_post', $post_id))
        return $post_id;
    // теперь также проверим тип записи
    $post = get_post($post_id);
    if ($post->post_type == 'event') { // укажите собственный

        foreach ($ratings_titles as $key => $rating_title) {
            if($_POST['event_rating_' . $key] > 0) update_post_meta($post_id, 'event_rating_' . $key, $_POST['event_rating_' . $key]);
            elseif ( isset($_POST['event_rating_' . $key]) && $_POST['event_rating_' . $key] == 0 ) {
                delete_post_meta($post_id, 'event_rating_' . $key);
            }
        }
    }
    return $post_id;
}

add_action('save_post', 'ratings_save_box_data');