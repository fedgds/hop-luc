<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package theme
 */

get_header();

$id = get_the_ID();
$date = get_field('date', $id);

?>
<style>
    .aligncenter {
        display: block;
        margin: auto;
    }
</style>
<main>
        <section class="page-banner-nl">
            <div class="img ratio">
                <img class="w-100 d-block" src="<?= get_template_directory_uri() ?>/dist/images/bn-new.png" alt="">
            </div>
        </section>
        <section class="single-news-content">
            <div class="container">
                <div class="row candy-wrapper">
                    <div class="col-xl-9 col-md-8">
                        <div class="news-content">
                            <h1> <?= get_the_title() ?></h1>
                            <div class="d-flex align-items-center">
                                <div class="share">
                                    <span><?php pll_e('Chia s'); ?>:</span>
                                    <a href="http://www.facebook.com/share.php?u=<?= get_permalink($id) ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                                            <circle cx="16" cy="16" r="14" fill="url(#paint0_linear_217_5675)"/>
                                            <path d="M21.2137 20.2816L21.8356 16.3301H17.9452V13.767C17.9452 12.6857 18.4877 11.6311 20.2302 11.6311H22V8.26699C22 8.26699 20.3945 8 18.8603 8C15.6548 8 13.5617 9.89294 13.5617 13.3184V16.3301H10V20.2816H13.5617V29.8345C14.2767 29.944 15.0082 30 15.7534 30C16.4986 30 17.2302 29.944 17.9452 29.8345V20.2816H21.2137Z" fill="white"/>
                                            <defs>
                                                <linearGradient id="paint0_linear_217_5675" x1="16" y1="2" x2="16" y2="29.917" gradientUnits="userSpaceOnUse">
                                                    <stop stop-color="#18ACFE"/>
                                                    <stop offset="1" stop-color="#0163E0"/>
                                                </linearGradient>
                                            </defs>
                                        </svg>
                                    </a>
                                    <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?= get_permalink($id) ?>"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                                    width="35" height="35"
                                                    viewBox="0 0 48 48">
                                            <path fill="#0288d1" d="M24 4A20 20 0 1 0 24 44A20 20 0 1 0 24 4Z"></path><path fill="#fff" d="M14 19H18V34H14zM15.988 17h-.022C14.772 17 14 16.11 14 14.999 14 13.864 14.796 13 16.011 13c1.217 0 1.966.864 1.989 1.999C18 16.11 17.228 17 15.988 17zM35 24.5c0-3.038-2.462-5.5-5.5-5.5-1.862 0-3.505.928-4.5 2.344V19h-4v15h4v-8c0-1.657 1.343-3 3-3s3 1.343 3 3v8h4C35 34 35 24.921 35 24.5z"></path>
                                        </svg></a>
                                </div>
                                <div class="date"><?php pll_e('Ngày đăng'); ?>:  <?= (empty($date)) ? get_the_date() : $date ?> </div>
                            </div>
                            <div class="the_content">
                                <p><?php the_content() ?></p>
                             </div>
                        </div>
                    </div>
                    <?php
                    $slug = '';
                    if(ICL_LANGUAGE_CODE == 'en'){
                        $slug = 'capplus-news';
                    }elseif (ICL_LANGUAGE_CODE == 'zh'){
                        $slug = 'news_cn';
                    }elseif(ICL_LANGUAGE_CODE == ''){
                        $slug = 'tin_tuc';
                    }

                    $cate = wp_get_post_categories($id);
                    $cate_id = $cate[0];
//                    print_r($cate);die;
                    $arg = array(
                        'post_type' => 'post',
                        'posts_per_page' => 5,
                        'orderby' => 'date',
                        'order' => 'DESC',
                        'tax_query' => array(
                            'relation' => 'AND',
                            array(
                                'taxonomy' => 'category',
                                'field' => 'id',
                                'terms' => $cate_id,
                            )
                        )
                    );
                    $query = new WP_Query($arg);
                    $post = $query->posts;
                    ?>
                    <div class="col-xl-3 col-md-4">
                            <div class="sidebar-news ">
                                <?php foreach ($post as $value):?>
                                <div class="items">
                                    <div class="row align-items-center m-0">
                                        <div class="col-4 p-0">
                                            <div class="img ratio">
                                               <?= get_the_post_thumbnail($value->ID)?>
                                            </div>
                                        </div>
                                        <div class="col-8 p-0">
                                            <div class="text">
                                                <h3><a href="<?= get_permalink($value->ID)?>"><?= $value->post_title ?></a></h3>
                                                <p><?= $value->post_excerpt ?></p>
                                                <a class="more" href="<?= get_permalink($value->ID)?>"><?php pll_e('Tìm hiểu thêm'); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach;?>
                            </div>
                    </div>
                </div>
            </div>
        </section>
    <?php
    $arg1 = array(
        'post_type' => 'post',
        'posts_per_page' => 3,
        'orderby' => 'date',
        'order' => 'DESC',
    );
    $query1 = new WP_Query($arg1);
    $post1 = $query1->posts;
    ?>
        <section class="page-news-lq">
            <div class="container">
                <div class="title-main">
                    <h2 class="heading"><?php pll_e('bài viết cùng chuyên mục'); ?></h2>
                </div>
                <div class="news-archive">
                    <div class="row">
                        <?php foreach ($post1 as $value): ?>
                            <div class="col-md-4 col-6">
                                <div class="items-news">
                                    <a class="img ratio" href="<?= get_permalink($value->ID)?>">
									<span class="overflow-news">
									<?= get_the_post_thumbnail($value->ID)?>
									</span>
                                    </a>
                                    <h3><a href="<?= get_permalink($value->ID)?>"><?= $value->post_title ?></a></h3>
                                    <a class="more" href="<?= get_permalink($value->ID)?>"><?php pll_e('Tìm hiểu thêm'); ?></a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php
get_footer();
?>