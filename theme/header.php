<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package theme
 */
$url = get_template_directory_uri();
$menu_one = wp_get_nav_menu_items('Language');
//print_r($menu_one);

//die;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Xây Dựng Hợp Lực</title>
    <meta name="google-site-verification" content="aOgGUNujPOK6Spu4l71LDoZo_O4lF4agZzBcdFpUr1E"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
          <meta http-equiv="Permissions-Policy" content="interest-cohort=()">
    <link rel="shortcut icon" href="<?= get_field('icon_url', 'option') ?>">
    <link rel="stylesheet" href="<?= $url ?>/dist/fullpage/fullpage.min.js">
    <link rel="stylesheet" type="text/css" href="<?= $url ?>/dist/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= $url ?>/dist/carousel/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="<?= $url ?>/dist/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?= $url ?>/dist/box/jquery.fancybox.min.css">
    <link rel="stylesheet" type="text/css" href="<?= $url ?>/dist/fonts/text/stylesheet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/css/swiper.css">
    <link rel="stylesheet" href="<?= $url ?>/dist/wowjs/css/libs/animate.css">
    <link rel="stylesheet" type="text/css" href="<?= $url ?>/dist/tiah-slick/slick/slick-theme.css">
    <link rel="stylesheet" type="text/css" href="<?= $url ?>/dist/tiah-slick/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="<?= $url ?>/dist/css/style.css">
    <link rel="stylesheet" href="<?= $url ?>/Assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?= $url ?>/dist/css/responsive.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">

    <script type="text/javascript" src="<?= $url ?>/dist/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?= $url ?>/dist/tiah-slick/slick/slick.min.js"></script>
    <script type="text/javascript" src="<?= $url ?>/dist/carousel/dist/owl.carousel.min.js"></script>


</head>
<style>
    .footer_content li img {
        padding-right: 10px;
        width: 13%;
    }
</style>
<header class="header">
    <div class="logo">
        <a href="<?= home_url() ?>">
            <img src="<?= $url ?>/dist/images/logo.png" alt="">
        </a>
        <?php
        $queried = get_queried_object();
        $id_category = $queried->term_id;
        $id_post_page = $queried->ID;
        $taxonomy = $queried->taxonomy;

        // Check language
        $arr_lang = languageArr();
        //
        ?>
        <div class="leng">
            <ul>
                <?php foreach ($arr_lang as $key => $arr) : ?>
                <?php if (ICL_LANGUAGE_CODE == $arr['lang']) : ?>
                <li class="pll-parent-menu-item menu-item"><a href="javascript:void(0) "><img src="<?= $url ?>/dist/images/<?= $arr['lang'] ?>.png" alt=""><span><?= $arr['name_lang'] ?></span></a>
                    <?php endif; ?>
                    <?php endforeach; ?>
                    <ul class="sub-menu">
                        <?php foreach ($arr_lang as $key => $arr) : ?>
                            <?php if ($arr['lang'] != (ICL_LANGUAGE_CODE == $arr['lang'])) : ?>
                                <?php
                                if (!empty($id_category && !empty($taxonomy))) :
                                    $id_taxonomy_language = apply_filters('wpml_object_id', $id_category, 'category', false, $arr['lang']);
                                ?>
                                    <li class="lang-item"><a href="<?php echo get_category_link($id_taxonomy_language); ?>" hreflang="<?= $arr['lang'] ?>" lang="<?= $arr['lang'] ?>"><img src="<?= $url ?>/dist/images/<?= $arr['lang'] ?>.png" alt=""><span><?= $arr['name_lang'] ?></span></a></li>
                                <?php elseif (!empty($id_post_page)) : ?>
                                    <li class="lang-item"><a href="<?= get_permalink(apply_filters('wpml_object_id', $id_post_page, 'page', false, $arr['lang'])); ?>" hreflang="<?= $arr['lang'] ?>" lang="<?= $arr['lang'] ?>"><img src="<?= $url ?>/dist/images/<?= $arr['lang'] ?>.png" alt=""><span><?= $arr['name_lang'] ?></span></a></li>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                    <span class="dropdown-js"><i class="fa-solid fa-chevron-down"></i></span></li>
            </ul>
        </div>
        <div class="js-menu">
            <i class="fa-solid fa-bars"></i>
        </div>
        <div class="js-search">
            <i class="fa-solid fa-magnifying-glass"></i>
        </div>
    </div>
    <?php wp_head(); ?>
</header>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
  

