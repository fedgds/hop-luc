<?php
/**
 * theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package theme
 */

if (!function_exists('theme_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function theme_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on theme, use a find and replace
         * to change 'theme' to the name of your theme in all the template files.
         */
        load_theme_textdomain('theme', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'menu-1' => esc_html__('Primary', 'theme'),
            'menu-language' => esc_html__('Language', 'theme'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('theme_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support('custom-logo', array(
            'height' => 250,
            'width' => 250,
            'flex-width' => true,
            'flex-height' => true,
        ));
    }
endif;
add_action('after_setup_theme', 'theme_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function theme_content_width()
{
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters('theme_content_width', 640);
}

add_action('after_setup_theme', 'theme_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function theme_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'theme'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'theme'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}

add_action('widgets_init', 'theme_widgets_init');


function reg_scripts() {
    wp_enqueue_script( 'jquery' );
}
add_action('wp_enqueue_scripts', 'reg_scripts');
/**
 * Enqueue scripts and styles.
 */
function theme_scripts()
{
    wp_enqueue_style('theme-style', get_stylesheet_uri());

    wp_enqueue_script('theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true);

    wp_enqueue_script('theme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'theme_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}

if (function_exists('acf_add_options_page')) {
    // add parent
    $parent = acf_add_options_page(array(
        'page_title' => 'Tùy chỉnh chung',
        'menu_title' => 'Tùy chỉnh chung',
        'redirect' => false
    ));
    // add sub page
//    acf_add_options_sub_page( array(
//        'page_title'  => '',
//        'menu_title'  => '',
//        'parent_slug' => $parent['menu_slug'],
//    ) );

}

show_admin_bar(false);
define('posts_per_page_duan', 21);
function checkImage($id)
{
    $avatar_hot = get_the_post_thumbnail_url($id, 'full');
    if ($avatar_hot == '') {
        $avatar_hot = get_field('no_image', 'option');
    }
    return $avatar_hot;
}

// pagination page đoi tac
function paginationPage ($page, $arr) {
    $num = $page;
    $arg = $arr;
    $limit = 9;
    $count = count($arg);
    $countpage = ceil($count / $limit);
    $list = [];
    $a = array_slice($arg, 18, 19);
//    print_r($a);die;
    // đếm và lấy phần tử theo number page
        $start = ($num-1)*$limit;
        $dem0 = $num+$limit;

        $end = $count-1;
        if($num == 1){
            $list = array_slice($arg, $start, $dem0, true); // gữi lại phn tử thứ 0 đến $dem0 ca mng
        }
        if($num > 1){
            if($num < $countpage){
                $list = array_slice($arg, ($start+1) , 10, true); // gữi lại phần t thứ $dem với đ dài 10 ca mảng
            }elseif ($num == $countpage){

                $list = array_slice($arg, ($start+1), $end, true); // gữi li phần tử thứ $dem ến $end của mng
            }
        }

    return $list;
}

function getIdPage($name)
{
    // Ly dữ liệu data
    $pages_data = get_pages(array(
        'meta_key' => '_wp_page_template',
        'meta_value' => 'templates/' . $name . '.php'
    ));
    $id_dv = $pages_data[0]->ID;
    return $id_dv;
}


function no_sql_injection($input)
{
    $arr = array("from", "select", "insert", "insert", "delete", "where", "drop", "drop table", "show tables", "*", "=", "update");
    $sql = str_replace($arr, "", $input);
    return trim(strip_tags(addslashes($sql))); #strtolower()
}

function xss($input)
{
    $input = str_replace('=', '', $input);
    $input = str_replace(';', '', $input);
    $input = str_replace(':', '', $input);
    $input = str_replace('[', '', $input);
    $input = str_replace(']', '', $input);
    $input = str_replace('?', '', $input);
    $input = str_replace('AND', '', $input);
    $input = str_replace('OR ', '', $input);
//    $input = str_replace('&', '', $input);
    $input = str_replace('\'', '', $input);
    $input = str_replace('"', '', $input);
    $input = str_replace('`', '', $input);
    $input = str_replace("'", '', $input);
    $input = str_replace('%', '', $input);
    $input = str_replace('<', '', $input);
    $input = str_replace('>', '', $input);
    $input = str_replace('*', '', $input);
    $input = str_replace('+', '', $input);
    $input = str_replace('#', '', $input);
    $input = str_replace(')', '', $input);
    $input = str_replace('(', '', $input);
    $input = str_replace('\\', '', $input);
    $input = str_replace('\/', '', $input);
//    $input = str_replace('-', '', $input);
    $input = str_replace('SHUTDOWN', '', $input);
    $input = str_replace('DROP', '', $input);
    $input = preg_replace("/[`]/", '', $input);
    $input = addslashes($input);
    $input = htmlspecialchars($input);
    $input = strip_tags($input);

    return $input;
}

// Hàm cắt chui
function cutString($string = '', $size = 100, $link = '...')
{
    $string = strip_tags(trim($string));
    $strlen = strlen($string);
    $str = substr($string, $size, 20);
    $exp = explode(" ", $str);
    $sum = count($exp);
    $yes = "";
    for ($i = 0; $i < $sum; $i++) {
        if ($yes == "") {
            $a = strlen($exp[$i]);
            if ($a == 0) {
                $yes = "no";
                $a = 0;
            }
            if (($a >= 1) && ($a <= 12)) {
                $yes = "no";
                $a;
            }
            if ($a > 12) {
                $yes = "no";
                $a = 12;
            }
        }
    }
    $sub = substr($string, 0, $size + $a);
    if ($strlen - $size > 0) {
        $sub .= $link;
    }
    return $sub;
}
// Duplicate language
add_action('init', function () {
    pll_register_string('mytheme-language', 'Tm hiểu thêm');
    pll_register_string('mytheme-language', 'Download Profile');
    pll_register_string('mytheme-language', 'i tác quc t');
    pll_register_string('mytheme-language', 'ối tác trong nước');
    pll_register_string('mytheme-language', 'Tt cả');
    pll_register_string('mytheme-language', 'Thi gian');
    pll_register_string('mytheme-language', 'Tin đ');
    pll_register_string('mytheme-language', 'Từ kho tuyn dụng');
    pll_register_string('mytheme-language', 'Đã hoàn thành');
    pll_register_string('mytheme-language', 'Chưa hoàn thnh');
    pll_register_string('mytheme-language', 'Tìm kiếm');
    pll_register_string('mytheme-language', 'Xem thm');
    pll_register_string('mytheme-language', 'LCH SỬ');
    pll_register_string('mytheme-language', 'HÌNH THÀNH');
    pll_register_string('mytheme-language', 'Lch S');
    pll_register_string('mytheme-language', 'Hình Thnh');
    pll_register_string('mytheme-language', 'VNĐ');
    pll_register_string('mytheme-language', 'dự án lin quan');
    pll_register_string('mytheme-language', 'Np đơn ứng tuyển');
    pll_register_string('mytheme-language', 'Vị trí tuyn dng');
    pll_register_string('mytheme-language', 'Khu vực');
    pll_register_string('mytheme-language', 'Ngành ngh');
    pll_register_string('mytheme-language', 'ng tuyn');
    pll_register_string('mytheme-language', 'S lưng');
    pll_register_string('mytheme-language', 'Khu vc');
    pll_register_string('mytheme-language', 'Việc làm theo ngnh');
    pll_register_string('mytheme-language', 'Vic lm theo khu vực');
    pll_register_string('mytheme-language', 'Ngày đăng');
    pll_register_string('mytheme-language', 'Chia s');
    pll_register_string('mytheme-language', 'Phạm vi công vic');
    pll_register_string('mytheme-language', 'bài vit cùng chuyn mục');
    pll_register_string('mytheme-language', 'Nét ni bt');
    pll_register_string('mytheme-language', 'Diện tch đất');
    pll_register_string('mytheme-language', 'Din tch sàn');
    pll_register_string('mytheme-language', 'Ch đu tư');
    pll_register_string('mytheme-language', 'a chỉ');
    pll_register_string('mytheme-language', 'Quy mô');
    pll_register_string('mytheme-language', 'Your browser does not support HTML video.');
    pll_register_string('mytheme-language', 'C th bn thích');
    pll_register_string('mytheme-language', 'Ngn ng trình by h sơ');
    pll_register_string('mytheme-language', 'Kỹ năng');
    pll_register_string('mytheme-language', 'V tr');
    pll_register_string('mytheme-language', 'Cp bậc');
    pll_register_string('mytheme-language', 'ang cp nht');
    pll_register_string('mytheme-language', 'Liên hệ');
    pll_register_string('mytheme-language', 'TUYỂN DNG');
    pll_register_string('mytheme-language', 'Ngy ng tuyển');
    pll_register_string('mytheme-language', 'Cch thức ng tuyển');
    pll_register_string('mytheme-language', 'Yêu cu công vic');
    pll_register_string('mytheme-language', 'M tả công vic');
    pll_register_string('mytheme-language', 'Phúc lợi dnh cho bn');
    pll_register_string('mytheme-language', 'Thng tin liên h');
    pll_register_string('mytheme-language', 'Nhp tên d n');
    pll_register_string('mytheme-language', 'dự án');
    pll_register_string('mytheme-language', 'Tìm kiếm dự án');
    pll_register_string('mytheme-language', 'Nét nổi bật');
    pll_register_string('mytheme-language', 'Tiến độ');
    pll_register_string('mytheme-language', 'Tinh / Thanh pho');
    pll_register_string('mytheme-language', 'Quan / Huyen');
    pll_register_string('mytheme-language', 'Quy mo');
    pll_register_string('mytheme-language', 'Tien do');
    pll_register_string('mytheme-language', 'Vi tri');
    pll_register_string('mytheme-language', 'Tat ca');
    pll_register_string('mytheme-language', 'Chon file');
});
// language
function languageArr()
{
    $arr_lang = [
        [
            'title' => 'Ting Vit',
            'link' => '',
            'number' => '',
            'lang' => 'vi',
            'lang_datetime' => 'vi',
            'active' => '',
            'name_lang' => 'VIE',
            'name_eng' => 'Vietnamese',
            'name_img' => 'lang-VN',
        ],
        [
            'title' => 'Tiếng Anh',
            'link' => '/en',
            'number' => '-2',
            'lang' => 'en',
            'lang_datetime' => 'en',
            'active' => '',
            'name_lang' => 'EN',
            'name_eng' => 'English',
            'name_img' => 'lang',
        ],
        [
            'title' => 'Ting Trung Quốc',
            'link' => '/cn',
            'number' => '-3',
            'lang' => 'zh',
            'lang_datetime' => 'cn',
            'active' => '',
            'name_lang' => 'CN',
            'name_eng' => 'China',
            'name_img' => 'lang-CN',
        ]

    ];
//    print_r($arr_lang);die;
    foreach ($arr_lang as $key => $arr) {
        if (ICL_LANGUAGE_CODE == $arr['lang']) {
            $arr_lang[$key]['active'] = $arr['lang'];
        }
    }
    return $arr_lang;
}

// ajax du an ( query post = call ajax )
add_action('wp_ajax_query_all_post', 'query_post');
add_action('wp_ajax_nopriv_query_all_post', 'query_post');
function query_post()
{
    $html = '';
    $html_one = '';
    $html_two = '';
    $html_three = '';
    $number = $_POST['number'];
    $keyWord = $_POST['keyWord'];
    $year = $_POST['year'];
    $progress = $_POST['progress'];
//    $slug = $_POST['slug'];
    $location = $_POST['location'];
    $add = $number + posts_per_page_duan;
    // Dự án nổi bật
    $feature_products = get_field('feature_project', getIdPage('du_an'));
    //không c điu kin query tất cả bài post
    $args = new WP_Query(array(
        'post_type' => 'du_an',
        'posts_per_page' => $add,
        's' => $keyWord,
        'post__not_in' => $feature_products
    ));

    //tồn ti v trí, năm và tin  query bi post th custom field project_time và project_progress
    if (!empty($year) && !empty($progress) && !empty($location)) {
        $args = new WP_Query(array(
            'post_type' => 'du_an',
            'posts_per_page' => $add,
            's' => $keyWord,
            'tax_query' => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'danh_muc_vi_tri',
                    'field' => 'slug',
                    'terms' => $location,
                ),
            ),
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key' => 'project_time',
                    'value' => $year,
                    'type' => 'NUMERIC',
                    'compare' => '='
                ),
                array(
                    'key' => 'project_progress',
                    'value' => $progress,
                    'type' => 'CHAR',
                    'compare' => '='
                )
            )
        ));
    } else {
        //Nu tồn ti nm query bài post th custom field project_time
        if (!empty($year)) {
            $args = new WP_Query(array(
                'post_type' => 'du_an',
                'posts_per_page' => $add,
                's' => $keyWord,
                'meta_query' => array(
                    'relation' => 'AND',
                    array(
                        'key' => 'project_time',
                        'value' => $year,
                        'type' => 'NUMERIC',
                        'compare' => '='
                    ),
                )
            ));
        }
        //Nu tồn ti tin  query bài post thẻ custom field project_progress
        if (!empty($progress)) {
            $args = new WP_Query(array(
                'post_type' => 'du_an',
                'posts_per_page' => $add,
                's' => $keyWord,
                'meta_query' => array(
                    'relation' => 'AND',
                    array(
                        'key' => 'project_progress',
                        'value' => $progress,
                        'type' => 'CHAR',
                        'compare' => '='
                    )
                )
            ));
        }
        //Nu tn ti nm query bài post th custom field project_time
        if (!empty($location)) {
            $args = new WP_Query(array(
                'post_type' => 'du_an',
                'posts_per_page' => $add,
                's' => $keyWord,
                'tax_query' => array(
                    'relation' => 'AND',
                    array(
                        'taxonomy' => 'danh_muc_vi_tri',
                        'field' => 'slug',
                        'terms' => $location,
                    ),
                ),
            ));
        }
    }
    $post = $args->posts;
    $count = count($post);
    if(!empty($year) || !empty($progress) || !empty($location)) {
        foreach ($post as $key => $value) {
            if($key == 0) {
                $html_three .= '<div class="col-lg-8 col-custom">
                        <input type="hidden" id="taxonomy-key" class="taxonomy-key" value="'.$key.'">
                        <div class="items-project">
                            <a class="img ratio" href="'. get_permalink($value->ID).'" target="_blank">
                                <img src="'. get_the_post_thumbnail($value->ID).'" >
                            </a>
                            <div class="content">
                                <h3><a href="'. get_permalink($value->ID).'" target="_blank">'. $value->post_title.'</a></h3>
                                <p>'. $value->post_excrept.'</p>
                                <div class="icon">
                                    <div class="icon_text1">
                                        <img src="'. get_template_directory_uri() .'/dist/images/icon-da1.png" alt="">
                                        <div class="text">
                                            <p>' . pll__('Quy mo') . '</p>
                                            <span>'. get_field('scale',$value->ID ) .'m2</span>
                                        </div>
                                    </div>
                                    <div class="icon_text1">
                                        <img src="'. get_template_directory_uri() .'/dist/images/icon-da2.png" alt="">
                                        <div class="text">
                                            <p>' . pll__('Tien do') . '</p>
                                            <span>'. get_field('complete',$value->ID ) .'</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
            }elseif ($key==1 || $key==2){
                $html_one.= ' <div class="col-md-h">
                            <input type="hidden" id="taxonomy-key" class="taxonomy-key" value="'.$key.'">
                                <div class="items-project">
                                    <a class="img ratio" href="'. get_permalink($value->ID).'" target="_blank">
                                        <img src="'.get_the_post_thumbnail($value->ID) .'" >
                                    </a>
                                    <div class="content">
                                        <h3><a href="'. get_permalink($value->ID).'" target="_blank">'. $value->post_title.'</a></h3>
                                        <p>'. $value->post_excrept.'</p>
                                        <div class="icon">
                                            <div class="icon_text1">
                                                <img src="'. get_template_directory_uri() .'/dist/images/icon-da1.png" alt="">
                                                <div class="text">
                                                    <p>' . pll__('Quy mô') . '</p>
                                                    <span>'. get_field('scale',$value->ID ) .' m2</span>
                                                </div>
                                            </div>
                                            <div class="icon_text1">
                                                <img src="'. get_template_directory_uri() .'/dist/images/icon-da2.png" alt="">
                                                <div class="text">
                                                    <p>' . pll__('Tiến độ') . '</p>
                                                    <span>'. get_field('complete',$value->ID ) .'</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>';
            }
            else{
                $html_two .= '<div class="col-lg-4 col-6 col-custom">
                        <input type="hidden" id="taxonomy-key" class="taxonomy-key" value="'.$key.'">
                            <div class="items-project">
                                <a class="img ratio" href="'. get_permalink($value->ID).'" target="_blank">
                                    <img src="'.get_the_post_thumbnail($value->ID) .'">
                                </a>
                                <div class="content">
                                    <h3><a href="'. get_permalink($value->ID).'" target="_blank">'. $value->post_title.'</a></h3>
                                    <p>'. $value->post_excrept.'</p>
                                    <div class="icon">
                                        <div class="icon_text1">
                                            <img src="'. get_template_directory_uri() .'/dist/images/icon-da1.png" alt="">
                                            <div class="text">
                                                <p>' . pll__('Quy mô') . '</p>
                                                <span>'. get_field('scale',$value->ID ) .' m2</span>
                                            </div>
                                        </div>
                                        <div class="icon_text1">
                                            <img src="'. get_template_directory_uri() .'/dist/images/icon-da2.png" alt="">
                                            <div class="text">
                                                <p>' . pll__('Tien do') . '</p>
                                                <span>'. get_field('complete',$value->ID ) .'</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
            }
        }
    } else {
        foreach($feature_products as $key => $item) {
            if($key == 3) break;
            if($key == 0) {
                $html_three .= '<div class="col-lg-8 col-custom">
                        <input type="hidden" id="taxonomy-key" class="taxonomy-key" value="'.$key.'">
                        <div class="items-project">
                            <a class="img ratio" href="'. get_permalink($item).'" target="_blank">
                                <img src="'. get_the_post_thumbnail($item).'" >
                            </a>
                            <div class="content">
                                <h3><a href="'. get_permalink($item).'" target="_blank">'. get_the_title($item).'</a></h3>
                                <p></p>
                                <div class="icon">
                                    <div class="icon_text1">
                                        <img src="'. get_template_directory_uri() .'/dist/images/icon-da1.png" alt="">
                                        <div class="text">
                                            <p>' . pll__('Quy mo') . '</p>
                                            <span>'. get_field('scale',$item ) .'m2</span>
                                        </div>
                                    </div>
                                    <div class="icon_text1">
                                        <img src="'. get_template_directory_uri() .'/dist/images/icon-da2.png" alt="">
                                        <div class="text">
                                            <p>' . pll__('Tien do') . '</p>
                                            <span>'. get_field('complete',$item ) .'</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
            }elseif ($key==1 || $key==2){
                $html_one.= ' <div class="col-md-h">
                            <input type="hidden" id="taxonomy-key" class="taxonomy-key" value="'.$key.'">
                                <div class="items-project">
                                    <a class="img ratio" href="'. get_permalink($item).'" target="_blank">
                                        <img src="'.get_the_post_thumbnail($item) .'" >
                                    </a>
                                    <div class="content">
                                        <h3><a href="'. get_permalink($item).'" target="_blank">'. get_the_title($item).'</a></h3>
                                        <p></p>
                                        <div class="icon">
                                            <div class="icon_text1">
                                                <img src="'. get_template_directory_uri() .'/dist/images/icon-da1.png" alt="">
                                                <div class="text">
                                                    <p>' . pll__('Quy mô') . '</p>
                                                    <span>'. get_field('scale',$item ) .' m2</span>
                                                </div>
                                            </div>
                                            <div class="icon_text1">
                                                <img src="'. get_template_directory_uri() .'/dist/images/icon-da2.png" alt="">
                                                <div class="text">
                                                    <p>' . pll__('Tiến độ') . '</p>
                                                    <span>'. get_field('complete',$item ) .'</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>';
            }
        }
        foreach ($post as $key => $value) {
            $html_two .= '<div class="col-lg-4 col-6 col-custom">
                        <input type="hidden" id="taxonomy-key" class="taxonomy-key" value="'.$key.'">
                            <div class="items-project">
                                <a class="img ratio" href="'. get_permalink($value->ID).'" target="_blank">
                                    <img src="'.get_the_post_thumbnail($value->ID) .'">
                                </a>
                                <div class="content">
                                    <h3><a href="'. get_permalink($value->ID).'" target="_blank">'. $value->post_title.'</a></h3>
                                    <p>'. $value->post_excrept.'</p>
                                    <div class="icon">
                                        <div class="icon_text1">
                                            <img src="'. get_template_directory_uri() .'/dist/images/icon-da1.png" alt="">
                                            <div class="text">
                                                <p>' . pll__('Quy mô') . '</p>
                                                <span>'. get_field('scale',$value->ID ) .' m2</span>
                                            </div>
                                        </div>
                                        <div class="icon_text1">
                                            <img src="'. get_template_directory_uri() .'/dist/images/icon-da2.png" alt="">
                                            <div class="text">
                                                <p>' . pll__('Tien do') . '</p>
                                                <span>'. get_field('complete',$value->ID ) .'</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
        }
    }
    $html .=''.$html_three.'
					<div class="col-lg-4 col-custom">
						<div class="hightlight-sidebar">
							'.$html_one.'
						</div>
					</div>
					'. $html_two.'';
    $result['check'] = 'show'; //mng check hin th nt xem thm
    if ($add > $count) {
        $result['check'] = 'hide';
    }
    $result['html'] = $html;
    $result['number'] = $add;
    echo json_encode($result); //tr v d liu kiu json
    die;
}

// end funtion query post = call ajax

add_action('wp_ajax_query_post_terms', 'query_terms');
add_action('wp_ajax_nopriv_query_post_terms', 'query_terms');
function query_terms()
{

    $html = '';
    $number = $_POST['number'];
    $add = $number + posts_per_page_duan;

    $keyWord = $_POST['keyWord'];
    $year = $_POST['year'];
    $progress = $_POST['progress'];
    $slug = $_POST['slug'];
    $location = $_POST['location'];
    //khng có iu kin query tt c bi post
    $args = new WP_Query(array(
        'post_type' => 'du_an',
        'posts_per_page' => $add,
        's' => $keyWord,
        'tax_query' => array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'danh_muc_du_an',
                'field' => 'slug',
                'terms' => $slug,
            ),
        ),
    ));

    // tn ti năm, tin ộ, v tr
    if (!empty($year) && !empty($progress) && !empty($location)) {
        $args = new WP_Query(array(
            'post_type' => 'du_an',
            'posts_per_page' => $add,
            's' => $keyWord,
            'tax_query' => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'danh_muc_du_an',
                    'field' => 'slug',
                    'terms' => $slug,
                ),
                array(
                    'taxonomy' => 'danh_muc_vi_tri',
                    'field' => 'slug',
                    'terms' => $location,
                ),
            ),
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key' => 'project_time',
                    'value' => $year,
                    'type' => 'NUMERIC',
                    'compare' => '='
                ),
                array(
                    'key' => 'project_progress',
                    'value' => $progress,
                    'type' => 'CHAR',
                    'compare' => '='
                )
            )
        ));
    } else {
        //Nếu tn ti nm query bài post th custom field project_time
        if (!empty($year)) {
            $args = new WP_Query(array(
                'post_type' => 'du_an',
                'posts_per_page' => $add,
                's' => $keyWord,
                'tax_query' => array(
                    'relation' => 'AND',
                    array(
                        'taxonomy' => 'danh_muc_du_an',
                        'field' => 'slug',
                        'terms' => $slug,
                    ),
                ),
                'meta_query' => array(
                    'relation' => 'AND',
                    array(
                        'key' => 'project_time',
                        'value' => $year,
                        'type' => 'NUMERIC',
                        'compare' => '='
                    ),
                )
            ));
        }
        //Nu tn ti tin  query bi post th custom field project_progress
        if (!empty($progress)) {
            $args = new WP_Query(array(
                'post_type' => 'du_an',
                'posts_per_page' => $add,
                's' => $keyWord,
                'tax_query' => array(
                    'relation' => 'AND',
                    array(
                        'taxonomy' => 'danh_muc_du_an',
                        'field' => 'slug',
                        'terms' => $slug,
                    ),
                ),
                'meta_query' => array(
                    'relation' => 'AND',
                    array(
                        'key' => 'project_progress',
                        'value' => $progress,
                        'type' => 'CHAR',
                        'compare' => '='
                    )
                )
            ));
        }
        //Nu tn ti năm query bài post th custom field project_time
        if (!empty($location)) {
            $args = new WP_Query(array(
                'post_type' => 'du_an',
                'posts_per_page' => $add,
                's' => $keyWord,
                'tax_query' => array(
                    'relation' => 'AND',
                    array(
                        'taxonomy' => 'danh_muc_du_an',
                        'field' => 'slug',
                        'terms' => $slug,
                    ),
                    array(
                        'taxonomy' => 'danh_muc_vi_tri',
                        'field' => 'slug',
                        'terms' => $location,
                    ),
                ),
            ));
        }
    }
    $post = $args->posts;
    $count = count($post);
    foreach ($post as $key => $value) {
        if($key == 0) {
            $html_three .= '<div class="col-lg-8 col-custom">
                      
                        <div class="items-project">
                            <a class="img ratio" href="'. get_permalink($value->ID).'">
                                <img src="'. get_the_post_thumbnail($value->ID).'" >
                            </a>
                            <div class="content">
                                <h3><a href="'. get_permalink($value->ID).'">'. $value->post_title.'</a></h3>
                                <p>'. $value->post_excrept.'</p>
                                <div class="icon">
                                    <div class="icon_text1">
                                        <img src="'. get_template_directory_uri() .'/dist/images/icon-da1.png" alt="">
                                        <div class="text">
                                            <p>' . pll__('Quy mô') . '</p>
                                            <span>'. get_field('scale',$value->ID ) .'m2</span>
                                        </div>
                                    </div>
                                    <div class="icon_text1">
                                        <img src="'. get_template_directory_uri() .'/dist/images/icon-da2.png" alt="">
                                        <div class="text">
                                            <p>' . pll__('Tin ') . '</p>
                                            <span>'. get_field('complete',$value->ID ) .'</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
        }elseif ($key==1 || $key==2){
            $html_one.= ' <div class="col-md-h">
                            <input type="hidden" id="taxonomy-key" class="taxonomy-key" value="'.$key.'">
                                <div class="items-project">
                                    <a class="img ratio" href="'. get_permalink($value->ID).'">
                                        <img src="'.get_the_post_thumbnail($value->ID) .'" >
                                    </a>
                                    <div class="content">
                                        <h3><a href="'. get_permalink($value->ID).'">'. $value->post_title.'</a></h3>
                                        <p>'. $value->post_excrept.'</p>
                                        <div class="icon">
                                            <div class="icon_text1">
                                                <img src="'. get_template_directory_uri() .'/dist/images/icon-da1.png" alt="">
                                                <div class="text">
                                                    <p>' . pll__('Quy m') . '</p>
                                                    <span>'. get_field('scale',$value->ID ) .' m2</span>
                                                </div>
                                            </div>
                                            <div class="icon_text1">
                                                <img src="'. get_template_directory_uri() .'/dist/images/icon-da2.png" alt="">
                                                <div class="text">
                                                    <p>' . pll__('Tin ộ') . '</p>
                                                    <span>'. get_field('complete',$value->ID ) .'</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>';
        }
        else{
            $html_two .= '<div class="col-lg-4 col-6 col-custom">
                        <input type="hidden" id="taxonomy-key" class="taxonomy-key" value="'.$key.'">
                            <div class="items-project">
                                <a class="img ratio" href="'. get_permalink($value->ID).'">
                                    <img src="'.get_the_post_thumbnail($value->ID) .'">
                                </a>
                                <div class="content">
                                    <h3><a href="'. get_permalink($value->ID).'">'. $value->post_title.'</a></h3>
                                    <p>'. $value->post_excrept.'</p>
                                    <div class="icon">
                                        <div class="icon_text1">
                                            <img src="'. get_template_directory_uri() .'/dist/images/icon-da1.png" alt="">
                                            <div class="text">
                                                <p>' . pll__('Quy m') . '</p>
                                                <span>'. get_field('scale',$value->ID ) .' m2</span>
                                            </div>
                                        </div>
                                        <div class="icon_text1">
                                            <img src="'. get_template_directory_uri() .'/dist/images/icon-da2.png" alt="">
                                            <div class="text">
                                                <p> ' . pll__('Tin ') . '</p>
                                                <span>'. get_field('complete',$value->ID ) .'</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
        }
    }
    $html .=''.$html_three.'
					<div class="col-lg-4 col-custom">
						<div class="hightlight-sidebar">
							'.$html_one.'
						</div>
					</div>
					'. $html_two.'';
    $result['check'] = 'show'; //mảng check hin thị nút xem thêm
    if ($add > $count) {
        $result['check'] = 'hide';
    }
//mng tr v kt quả query
    $result['html'] = $html;
    $result['number'] = $add; // mng tr v giá tr (posts_per_page)
    echo json_encode($result); //tr v d liu kiểu json
    die;
}

// ajax tuyển dng
add_action('wp_ajax_query_recruit', 'queryRecruit');
add_action('wp_ajax_nopriv_query_recruit', 'queryRecruit');

function queryRecruit()
{
    $html = '';
    $key = $_POST['keyWord'];
    $career = $_POST['career'];
    $location = $_POST['location'];
    $args = array(
        'post_type' => 'nhan_luc',
        'posts_per_page' => get_option('posts_per_page'),
        's' => $key,
        'orderby' => 'date',
        'order' => 'ASC',
    );
//        print_r(array_merge($args, $termLocation));die;
    if (!empty($location)) {
        $args = array(
            'post_type' => 'nhan_luc',
            'posts_per_page' => get_option('posts_per_page'),
            's' => $key,
            'orderby' => 'date',
            'order' => 'ASC',
            'tax_query' => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'danh_muc_nhan_luc_theo_khu_vuc',
                    'field' => 'slug',
                    'terms' => $location,
                ),
            ),
        );
//        array_merge($args, $termLocation);
    } elseif (!empty($career)) {
        $args = array(
            'post_type' => 'nhan_luc',
            'posts_per_page' => get_option('posts_per_page'),
            's' => $key,
            'orderby' => 'date',
            'order' => 'ASC',
            'tax_query' => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'danh_muc_nhan_luc_theo_nganh',
                    'field' => 'slug',
                    'terms' => $career,
                ),
            ),
        );
//        array_merge($args, $termCareer);
    } elseif (!empty($location) && !empty($career)) {
        $args = array(
            'post_type' => 'nhan_luc',
            'posts_per_page' => get_option('posts_per_page'),
            's' => $key,
            'orderby' => 'date',
            'order' => 'ASC',
            'tax_query' => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'danh_muc_nhan_luc_theo_khu_vuc',
                    'field' => 'slug',
                    'terms' => $location,
                ),
                array(
                    'taxonomy' => 'danh_muc_nhan_luc_theo_nganh',
                    'field' => 'slug',
                    'terms' => $career,
                ),
            ),
        );
//        array_merge($args, $all);
    }
    $arr = new WP_Query($args);
    $post = $arr->posts;
    $count = count($post);
    foreach ($post as $value) {
        $term = get_the_term_list($value->ID, 'danh_muc_nhan_luc_theo_khu_vuc', '', ', ');
        $html .= '<div class="items wow fadeInDown" data-wow-delay="0.5s">
                                <div class="title">
                                    <h3><a href=" ' . get_permalink($value->ID) . '">' . $value->post_title . '</a></h3>
                                    <p>S lưng:' . get_field('number', $value->ID) . '</p>
                                    <div class="kv"><img src="' . get_template_directory_uri() . '/dist/images/kv.png" alt="">Khu vc: ' . $term . '</div>
                                </div>
                                <a class="btn-custom js-ut wow fadeInDown" data-wow-delay="0.3s" href="javascript:void(0)">ng tuyn</a>
                            </div>';
    }
//    $result['check'] = 'show'; //mng check hin th nút xem thm

    $result = $html; //mng tr v kt qu query
    echo json_encode($result); //tr v d liu kiểu json
    die;

}

// Validate s in thoi
function custom_filter_wpcf7_is_tel( $result, $tel ) {
    $result = preg_match( '/^0(1\d{9}|9\d{8})$/', $tel );
    return $result;
}
add_filter( 'wpcf7_is_tel', 'custom_filter_wpcf7_is_tel', 10, 2 );

function wp_corenavi_table($custom_query = null) {
    global $wp_query;
    if($custom_query) $main_query = $custom_query;
    else $main_query = $wp_query;
    $big = 999999999;
    $total = isset($main_query->max_num_pages)?$main_query->max_num_pages:'';
    if($total > 1) echo '<div class="paginate_links">';
    echo paginate_links( array(
        'base'        => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format'   => '?paged=%#%',
        'current'  => max( 1, get_query_var('paged') ),
        'total'    => $total,
        'mid_size' => '10',
        'prev_text'    => __('Trc','devvn'),
        'next_text'    => __('Tiếp','devvn'),
    ) );
    if($total > 1) echo '</div>';
}


function callProvince()
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://provinces.open-api.vn/api/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $response_province = curl_exec($curl);
    $arr_province = json_decode($response_province);


    $list_province = [];


    foreach ($arr_province as $key => $value) {
        $id_province = $value->code;
        $list_province[$key]['id_province'] = $id_province;
        $list_province[$key]['name'] = $value->name;
        $list_province[$key]['division_type'] = $value->division_type;
        $list_province[$key]['codename'] = $value->codename;
        $list_province[$key]['phone_code'] = $value->phone_code;


    }
//    print_r($list_province);die;
    return $list_province;
}

add_action('wp_ajax_get_ditricts', 'callDitricts');
add_action('wp_ajax_nopriv_get_ditricts', 'callDitricts');
function callDitricts()
{
    $codeProvince = $_POST['keycode'];
//    $codeProvince = 1;
    $curl_one = curl_init();
    curl_setopt_array($curl_one, array(
        CURLOPT_URL => 'https://provinces.open-api.vn/api/d',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
    ));
    $response_ditricts = curl_exec($curl_one);
    $arr_ditricts = json_decode($response_ditricts);
    $list_ditricts = [];
    foreach ($arr_ditricts as $chi => $item) {
        $id_ditricts = $item->province_code;
//            print_r($item->province_code);die;
        if ($codeProvince == $item->province_code) {
            $list_ditricts[$chi]['province_code'] = $item->province_code;
            $list_ditricts[$chi]['name'] = $item->name;
            $list_ditricts[$chi]['code'] = $item->code;
            $list_ditricts[$chi]['division_type'] = $item->division_type;
            $list_ditricts[$chi]['codename'] = $item->codename;
        }

    }
    $option = '';
    $html = '';
    foreach ($list_ditricts as $value) {
        $option .= '<option name="ditricts" id="ditricts" data-key="' . $value['name'] . '" value="' . $value['codename'] . '">' . $value['name'] . '</option>';
    }
    $html .= '<option value="">' . pll__('Qun / Huyn') . '</option>' . $option;
//    print_r($html);die;
    $result['html'] = $html;
    echo json_encode($result);
    die;
}

add_action('wp_ajax_province_ditricts', 'dataPost');
add_action('wp_ajax_nopriv_province_ditricts', 'dataPost');

function dataPost()
{
   
    $province = $_POST['province'];
    $district = $_POST['district'];
    $id = $_POST['id'];

    $replace_pro = str_replace('tinh_','', $province);
    if($replace_pro == false){
        $replace_pro = str_replace('thanh_pho_','', $province);
    }
    $pro_end = str_replace('_', '-', $replace_pro);
    $replace_dis = str_replace('Huyn','', $district);
    if($replace_dis == false){
        $replace_dis = str_replace('Qun','', $district);
    }

//    print_r($pro_end);
//    print_r($replace_dis);die;
    $args = array(
        'post_type' => 'du_an',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'DESC',
        );
    if(!empty($id)){
        $args = array(
            'post_type' => 'du_an',
            'posts_per_page' => -1,
            'post__in' => array($id),
            'orderby' => 'date',
            'order' => 'DESC',
        );
    }
    if(!empty($province) && !empty($district)){
        $args = array(
            'post_type' => 'du_an',
            'posts_per_page' => -1,
            'orderby' => 'date',
            'order' => 'DESC',
            'tax_query' => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'danh_muc_vi_tri',
                    'field' => 'slug',
                    'terms' => $pro_end,
                ),
            ),
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key' => 'ditricts',
                    'value' =>  $replace_dis,
                    'type' => 'CHAR',
                    'compare' => 'LIKE'
                ),
            ),
        );
    }

    $arr = new WP_Query($args);
    $post = $arr->posts;
    $html = '';
    $arr_post = [];
    foreach ($post as $key => $value) {
        $arr_post[$key]->id = $value->ID;
        $arr_post[$key]->post_title = $value->post_title;
        $arr_post[$key]->image = get_the_post_thumbnail($value->ID);
        $arr_post[$key]->link = get_permalink($value->ID);

        $investor = get_field('investor', $value->ID);
        $address = get_field('address', $value->ID);
        $range = get_field('range', $value->ID);
        $highlights = get_field('highlights', $value->ID);
        $project_progress = get_field('project_progress', $value->ID);
        $ditricts = get_field('ditricts', $value->ID);
        $longitude = get_field('longitude', $value->ID);
        $latitude = get_field('latitude', $value->ID);

        $arr_post[$key]->investor = $investor;
        $arr_post[$key]->address = $address;
        $arr_post[$key]->range = $range;
        $arr_post[$key]->highlights = $highlights;
        $arr_post[$key]->project_progress = $project_progress;
        $arr_post[$key]->ditricts = $ditricts;
        $arr_post[$key]->longitude = $longitude;
        $arr_post[$key]->latitude = $latitude;
        $html .='<div class="items">
                            <div class="image">
                                <img src="'. get_template_directory_uri().'/dist/images/i-da2.png" alt="">
                            </div>
                            <div class="title-map" id="show-map" data-key="'.$value->ID.'">          
                                    <div class="location"> '. $value->address .'</div>
                                    <h3>'. $value->post_title .'</h3>
                            </div>
                        </div>';
    }
    $result['html'] = $html; //mng tr về kt qu query
    $result['post'] = json_encode ($arr_post); //mng trả v kt qu query
    echo json_encode($result); //tr v d liệu kiu json
    die;

}

add_action('wp_ajax_province_ditricts', 'postProvinceDitricts');
add_action('wp_ajax_nopriv_province_ditricts', 'postProvinceDitricts');
function postProvinceDitricts()
{
    $provi = $_POST['province'];
    $re_provi = str_replace('tinh_', '', $provi);
    $end_provi = str_replace('_', '-', $re_provi);
    $ditr = $_POST['district'];
    $re_ditr = str_replace('Huyn ', '', $ditr);
//    echo($provi);die;
//    $end_ditr = str_replace('_', '-', $re_ditr);
    $args = new WP_Query(array(
        'post_type' => 'du_an',
        'posts_per_page' => -1,
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => 'ditricts',
                'value' => $re_ditr,
                'type' => 'CHAR',
                'compare' => '=',
            ),
        ),
        'tax_query' => array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'danh_muc_vi_tri',
                'field' => 'slug',
                'terms' => $end_provi,
            ),
        ),
    ));
    $post = $args->posts;
    $arr_post = [];
    foreach ($post as $key => $value){
        $arr_post[$key]->id = $value->ID;
        $arr_post[$key]->post_title = $value->post_title;
        $arr_post[$key]->image = get_the_post_thumbnail($value->ID);
        $arr_post[$key]->link = get_permalink($value->ID);

        $investor = get_field('investor',$value->ID);
        $address = get_field('address',$value->ID);
        $range = get_field('range',$value->ID);
        $highlights = get_field('highlights',$value->ID);
        $project_progress = get_field('project_progress',$value->ID);
        $ditricts = get_field('ditricts',$value->ID);
        $longitude = get_field('longitude',$value->ID);
        $latitude = get_field('latitude',$value->ID);

        $arr_post[$key]->investor = $investor;
        $arr_post[$key]->address = $address;
        $arr_post[$key]->range = $range;
        $arr_post[$key]->highlights = $highlights;
        $arr_post[$key]->project_progress = $project_progress;
        $arr_post[$key]->ditricts = $ditricts;
        $arr_post[$key]->longitude = $longitude;
        $arr_post[$key]->latitude = $latitude;

    }
    echo json_encode($arr_post);
    die;
}
function wpse_81939_post_types_admin_order( $wp_query ) {
    if (is_admin()) {

        // Get the post type from the query
        $post_type = $wp_query->query['post_type'];

        if ( $post_type == 'du_an') {

            $wp_query->set('orderby', 'date');

            $wp_query->set('order', 'DESC');
        }
    }
}
add_filter('pre_get_posts', 'wpse_81939_post_types_admin_order');