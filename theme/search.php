<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package theme
 */

get_header();
$url = get_template_directory_uri();
$s = no_sql_injection(xss($_GET['s']));
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$arg = array(
    'post_type' => array('du_an', 'nhan_luc', 'post'),
    's' => $s,
    'paged' => $paged,
    'posts_per_page' => -1,
    'orderby' => 'date',
    'order' => 'DESC',
);
$query = new WP_Query($arg);
$post = $query->posts;
?>
<style>
    .news .news-text .news-text-wraper h4{
        font-size: 30px;
        font-weight: 300;
        margin: 20px 0px;
        text-overflow: ellipsis;
        overflow: hidden;
        -webkit-line-clamp: 2;
        /*-moz-line-clamp: 3;*/
        -webkit-box-orient: vertical;
        /*-moz-box-orient: vertical;*/
        display: -webkit-box;
        color: #000000;
    }
    .banner-search {
        filter: brightness(0.5);
    }
    .tabsbar ul li.action{
        color: #D71920;
    }

</style>
<link rel="stylesheet" type="text/css" href="<?= $url ?>/dist/css/tintuc.css">
<section class="page-banner-nl">
    <div class="img ratio banner-search">
        <img class="w-100 d-block" src="<?= get_field('banner', 'option') ?>" alt="">
    </div>
    <div class="content">
        <div class="container">
            <div class="title-main">
                <h2 class="heading"><?php pll_e('KẾT QUẢ TÌM KIẾM'); ?></h2>
                <h2 class="heading">"<?= $s ?>"</h2>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="tabsbar">
        <ul>
            <li class="tabsLi" onclick="openLI(event,'news-1' )" id="defaultOpen-1">Tất cả</li>
            <li class="tabsLi" onclick="openLI(event,'news-2' )">Dự án</li>
            <li class="tabsLi" onclick="openLI(event,'news-3' )">Nhân lực</li>
            <li class="tabsLi" onclick="openLI(event,'news-4' )">Tin tức</li>
        </ul>
    </div>
    <div class="allText" id="news-1">
        <?php foreach ($post as $value): ?>
            <div class="news">
                <div class="news-img">
                    <a href="<?= get_permalink($value->ID) ?>">
                        <img src="<?= get_the_post_thumbnail_url($value->ID) ?>" alt="">
                    </a>
                </div>
                <div class="news-text">
                    <div class="news-text-wraper">
                        <a href="<?= get_permalink($value->ID) ?>">
                            <h4><?= $value->post_title ?></h4>
                        </a>
                        <img src="<?= $url ?>/dist/Img/Vector.png"
                             alt=""><span><?= get_post_modified_time('d/m/Y', true, $value->ID, false); ?></span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="allText" id="news-2">
        <?php foreach ($post as $value): ?>
            <?php if ($value->post_type == 'du_an'): ?>
                <div class="news">
                    <div class="news-img">
                        <a href="<?= get_permalink($value->ID) ?>">
                            <img src="<?= get_the_post_thumbnail_url($value->ID) ?>" alt="">
                        </a>
                    </div>
                    <div class="news-text">
                        <div class="news-text-wraper">
                            <a href="<?= get_permalink($value->ID) ?>">
                                <h4><?= $value->post_title ?></h4>
                            </a>
                            <img src="<?= $url ?>/dist/Img/Vector.png"
                                 alt=""><span><?= get_post_modified_time('d/m/Y', true, $value->ID, false); ?></span>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <div class="allText" id="news-3">
        <?php foreach ($post as $value): ?>
            <?php if ($value->post_type == 'nhan_luc'): ?>
                <div class="news">
                    <div class="news-img">
                        <a href="<?= get_permalink($value->ID) ?>">
                            <img src="<?= get_the_post_thumbnail_url($value->ID) ?>" alt="">
                        </a>
                    </div>
                    <div class="news-text">
                        <div class="news-text-wraper">
                            <a href="<?= get_permalink($value->ID) ?>">
                                <h4><?= $value->post_title ?></h4>
                            </a>
                            <img src="<?= $url ?>/dist/Img/Vector.png"
                                 alt=""><span><?= get_post_modified_time('d/m/Y', true, $value->ID, false); ?></span>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <div class="allText" id="news-4">
        <?php foreach ($post as $value): ?>
            <?php if ($value->post_type == 'post'): ?>
                <div class="news">
                    <div class="news-img">
                        <a href="<?= get_permalink($value->ID) ?>">
                            <img src="<?= get_the_post_thumbnail_url($value->ID) ?>" alt="">
                        </a>
                    </div>
                    <div class="news-text">
                        <div class="news-text-wraper">
                            <a href="<?= get_permalink($value->ID) ?>">
                                <h4><?= $value->post_title ?></h4>
                            </a>
                            <img src="<?= $url ?>/dist/Img/Vector.png"
                                 alt=""><span><?= get_post_modified_time('d/m/Y', true, $value->ID, false); ?></span>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>
<?php
get_footer();
?>
<script>
    function openLI(eve, openDate) {
        var i, information, tabsLi;
        information = document
            .getElementsByClassName("allText");
        for (i = 0; i < information.length; i++) {
            information[i].style.display = "none";
        }
        tabsLi = document.getElementsByClassName("tabsLi");
        for (i = 0; i < tabsLi.length; i++) {
            tabsLi[i].className = tabsLi[i].className.replace(" action", "");
        }
        document.getElementById(openDate).style.display = "block";
        eve.currentTarget.className += " action";
    }

    // document.getElementById("defaultOpen-1").click();

    function corlor(eve) {
        var i, color;
        color = document.getElementsByClassName("color");
        for (i = 0; i < color.length; i++) {
            color[i].className = color[i].className.replace(" action", "");
        }
        eve.currentTarget.className += " action";
    }

    // document.getElementById("defaultOpen-2").click();
</script>
