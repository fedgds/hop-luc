<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package theme
 */

get_header();
$url = get_template_directory_uri();
$id = get_the_ID();
$highlight = get_field('highlights', $id);
$scale = get_field('scale', $id);
$area = get_field('project_area', $id);
$area_flow = get_field('area_flow', $id);
$investor = get_field('investor', $id);
$address = get_field('address', $id);
$range = get_field('range', $id);
$complete = get_field('complete', $id);

$img_video = get_field('img_video', $id);
$img_update = get_field('update_img', $id);
//print_r($img_update);die;

$project_time = get_field('project_time', $id);
$project_progress = get_field('project_progress', $id);
//print_r($project_area);die;
$sub = 'youtu';
?>
    <main>
        <section class="single-project-top">
            <?php if (!empty($img_update)): ?>
                <div class="slider-for">
                    <?php foreach ($img_update as $item): ?>
                        <?php if (strlen(strstr($item['url_img'], $sub)) == 0): ?>
                            <div class="items">
                                <div class="img ratio">
                                    <img src="<?= $item['url_img'] ?>" alt="">
                                </div>
                                <div class="content">
                                    <div class="title-main text-center m-0">
                                        <h2 class="heading wow fadeInUp"
                                            data-wow-delay="0.3s"><?= get_the_title() ?></h2>
                                        <p class="wow fadeInUp" data-wow-delay="0.7s"><?= get_the_excerpt() ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <?php foreach ($img_update as $item): ?>
                        <?php if (strlen(strstr($item['url_img'], $sub)) > 0): ?>
                            <div class="items">
                                <div class="img ratio">
                                    <video controls>
                                        <source src="<?= $item['url_img'] ?>" type="video/mp4">
                                        <source src="<?= $item['url_img'] ?>" type="video/ogg">
                                        <?php pll_e('Your browser does not support HTML video.'); ?>
                                    </video>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <div class="slider-custom-details">
                    <div class="container">
                        <div class="slider-nav slick-nav-custom">
                            <?php foreach ($img_update as $item): ?>
                                <?php if (strlen(strstr($item['url_img'], $sub)) == 0): ?>
                                    <div class="items">
                                        <div class="img ratio">
                                            <img src="<?= $item['url_img'] ?>" alt="">
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <?php foreach ($img_update as $item): ?>
                                <?php if (strlen(strstr($item['url_img'], $sub)) > 0): ?>
                                    <div class="items">
                                        <div class="img ratio">
                                            <img src="<?= $url ?>/dist/images/da-dt1.png" alt="">
                                            <video class="d-none" controls>
                                                <source src="<?= $item['url_img'] ?>" type="video/mp4">
                                                <source src="<?= $item['url_img'] ?>" type="video/ogg">
                                                <?php pll_e('Your browser does not support HTML video.'); ?>
                                            </video>
                                        </div>
                                        <div class="play">
                                            <div><img src="<?= $url ?>/dist/images/play.png" alt=""></div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if(!empty($img_video)){ ?>
            <div class="slider-for">
                <?php foreach ($img_video as $img) { ?>
                    <?php if (empty($img['link_video'])): ?>
                        <div class="items">
                            <div class="img ratio">
                                <img src="<?= $img['img'] ?>" alt="">
                            </div>
                            <div class="content">
                                <div class="title-main text-center m-0">
                                    <h2 class="heading wow fadeInUp" data-wow-delay="0.3s"><?= get_the_title() ?></h2>
                                    <p class="wow fadeInUp" data-wow-delay="0.7s"><?= get_the_excerpt() ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php } ?>
                <?php foreach ($img_video as $img) { ?>
                    <?php if (!empty($img['link_video'])): ?>
                        <div class="items">
                            <div class="img ratio">
                                <video controls>
                                    <source src="<?= $img['link_video'] ?>" type="video/mp4">
                                    <source src="<?= $img['link_video'] ?>" type="video/ogg">
                                    <?php pll_e('Your browser does not support HTML video.'); ?>
                                </video>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php } ?>
            </div>
            <div class="slider-custom-details">
                <div class="container">
                    <div class="slider-nav slick-nav-custom">
                        <?php foreach ($img_video as $img) { ?>
                            <?php if (empty($img['link_video'])): ?>
                                <div class="items">
                                    <div class="img ratio">
                                        <img src="<?= $img['img'] ?>" alt="">
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php } ?>
                        <?php foreach ($img_video as $img) { ?>
                            <?php if (!empty($img['link_video'])): ?>
                                <div class="items">
                                    <div class="img ratio">
                                        <img src="<?= $img['img'] ?>" alt="">
                                        <video class="d-none" controls>
                                            <source src="<?= $img['link_video'] ?>" type="video/mp4">
                                            <source src="<?= $img['link_video'] ?>" type="video/ogg">
                                            <?php pll_e('Your browser does not support HTML video.'); ?>
                                        </video>
                                    </div>
                                    <div class="play">
                                        <div><img src="<?= $url ?>/dist/images/play.png" alt=""></div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        </section>
        <section class="single-project-content">
            <div class="container">
                <div class="title-main">
                    <h2 class="heading wow zoomIn" data-wow-delay="0.1s"><?php pll_e('Nét nổi bật'); ?></h2>
                </div>
                <div class="content-project">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="text wow fadeInLeft" data-wow-delay="0.3s">
                                <p><?= $highlight ?></p>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="hd wow fadeInLeft" data-wow-delay="0.5s">
                                <h3><?= $area ?></h3>
                                <span><?php pll_e('Diện tích đất'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="hd wow fadeInLeft" data-wow-delay="0.7s">
                                <h3><?= $area_flow ?></h3>
                                <span><?php pll_e('Diện tích sàn'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="information">
                    <ul class="row">
                        <li class="col-xl-3 col-md-6">
                            <div class="items wow fadeInLeft" data-wow-delay="1s">
                                <img src="<?= get_template_directory_uri() ?>/dist/images/i-da1.png" alt="">
                                <div class="text">
                                    <h4><?php pll_e('Chủ đầu tư'); ?></h4>
                                    <span><?= $investor ?></span>
                                </div>
                            </div>
                        </li>
                        <li class="col-xl-3 col-md-6">
                            <div class="items wow fadeInLeft" data-wow-delay="1s">
                                <img src="<?= get_template_directory_uri() ?>/dist/images/i-da2.png" alt="">
                                <div class="text">
                                    <h4><?php pll_e('Địa chỉ'); ?></h4>
                                    <span><?= $address ?></span>
                                </div>
                            </div>
                        </li>
                        <li class="col-xl-3 col-md-6">
                            <div class="items wow fadeInLeft" data-wow-delay="1s">
                                <img src="<?= get_template_directory_uri() ?>/dist/images/i-da3.png" alt="">
                                <div class="text">
                                    <h4><?php pll_e('Tiến độ'); ?></h4>
                                    <span><?= $complete ?></span>
                                </div>
                            </div>
                        </li>
                        <li class="col-xl-3 col-md-6">
                            <div class="items wow fadeInLeft" data-wow-delay="1s">
                                <img src="<?= get_template_directory_uri() ?>/dist/images/i-da4.png" alt="">
                                <div class="text">
                                    <h4><?php pll_e('Phạm vi công việc'); ?></h4>
                                    <span><?= $range ?></span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <?php
        $args = new WP_Query(array(
            'post_type' => 'du_an',
            'posts_per_page' => get_option('posts_per_page'),
            'orderby' => 'date',
            'order' => 'DESC',
        ));
        $post = $args->posts;
        ?>
        <section class="single-project-lq">

            <div class="container">
                <div class="title-main">
                    <h2 class="heading wow fadeInUp" data-wow-delay="0.3s"><?php pll_e('dự án liên quan'); ?></h2>
                </div>
                <div class="slick-project-lq slick-nav-custom">
                    <?php foreach ($post as $value): ?>
                        <div class="items">
                            <div class="items-project wow fadeInUp" data-wow-delay="0.7s">
                                <a class="img ratio" href="<?= get_permalink($value->ID) ?>">
                                    <img src="<?= get_the_post_thumbnail($value->ID) ?>" alt="">
                                </a>
                                <div class="content">
                                    <h3><a href="<?= get_permalink($value->ID) ?>"><?= $value->post_title ?></a></h3>
                                    <p><?= $value->post_excrept ?></p>
                                    <div class="icon">
                                        <div class="icon_text1">
                                            <img src="<?= $url ?>/dist/images/icon-da1.png" alt="">
                                            <div class="text">
                                                <p><?php pll_e('Quy mô'); ?></p>
                                                <span><?= get_field('scale', $value->ID) ?>m2</span>
                                            </div>
                                        </div>
                                        <div class="icon_text1">
                                            <img src="<?= $url ?>/dist/images/icon-da2.png" alt="">
                                            <div class="text">
                                                <p><?php pll_e('Tiến độ'); ?></p>
                                                <span><?= get_field('complete', $value->ID) ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </main>
<?php
get_footer();
?>
<script>
      document.addEventListener("contextmenu", (event) => {
         event.preventDefault();
      });
   </script>