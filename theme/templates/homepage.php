<?php
/**
 * Created by PhpStorm.
 * User: truongnt
 * Date: 27/04/2020
 * Time: 6:05 PM
 */
/* Template Name:  Trang chủ */
get_header();

$url = get_template_directory_uri();
$id = get_the_ID();
$slider = get_field('slider', $id);
$introduce = get_field('introduce', $id);
$video = get_field('video', $id);
$number = get_field('number', $id);
$news = get_field('news', $id);
$partners = get_field('partners', $id);
$link_page = get_field('link_page', 'option');
$loading = get_field('loading', 'option');
//print_r($loading);die;
?>
<style>
    @media screen and (max-width: 991px) {
        .preloading .loader img {
            height: 1200px;
        }
    }
    @media screen and (max-width: 480px) {
        .preloading .loader img {
            height: 900px;
            object-fit: cover ;
        }
    }

</style>
<main>
    <div class="preloading">
        <!-- Hiệu ứng load -->
        <div class="loader">
            <img src="<?= $loading ?>">
        </div>

    </div>
    <section class="slides body-hide" id="fullpage">
        <div class="slide section fp-section" id="page12">
            <section class="site-banner h-custom">
                <div class="slick-banner m-0">
                    <?php foreach ($slider as $item): ?>
                        <div class="items">
                            <div class="img">
                                <img class="w-100 d-block" src="<?= $item['banner_slide'] ?>" alt="">
                                <span><?= $item['title'] ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        </div>
        <div class="slide section fp-section" id="page22">
            <section class="site-about h-custom">
                <div class="row m-0 row-custom-a align-items-center">
                    <div class="col-md-6 p-0">
                        <div class="content ">
                            <div class="title-main wow fadeInLeft" data-wow-delay="1s">
                                <span><?= $introduce['title_project'] ?></span>
                                <h2 class="heading"><?= $introduce['name'] ?></h2>
                            </div>
                            <div class="border-left-custom wow fadeInLeft" data-wow-delay="1.1s">
                                <p><?= $introduce['dis'] ?></p>
                            </div>
                            <div class="text wow fadeInLeft" data-wow-delay="1.2s">
                                <p><?= $introduce['content'] ?> </p>
                            </div>
                            <a class="red-more wow fadeInLeft" data-wow-delay="1.3s" href="<?= $introduce['link'] ?> "><?php pll_e('Tìm hiểu thêm'); ?> <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-md-6 p-0">
                        <div class="row row-custom-h m-0">
                            <?php foreach ($introduce['history'] as $item): ?>
                            <div class="col-4 p-0 wow fadeInDown" data-wow-delay="0.3s">
                                <div class="items">
                                    <a href="<?= $item['link'] ?>">
                                        <div class="img">
                                            <img class="w-100 d-block img-custom" src="<?= $item['image'] ?>" alt="">
                                        </div>
                                        <div class="content">
                                            <div>
                                                <img src="<?= $item['icon'] ?>" alt="">
                                                <h3><?= $item['title'] ?></h3>
                                            </div>
                                        </div>
                                    </a>

                                </div>
                            </div>
                               <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="slide section fp-section" id="page32">
            <section class="site-video h-custom">
                <div class="slick-video slick-custom-nav">
                    <?php foreach ($video as $value): ?>
                    <div class="items">
                        <div class="img">
                            <img class="w-100 d-block" src="<?= $value['backround'] ?>" alt="">
                        </div>
                        <div class="content">
                            <div>
                                <h3 class="wow fadeInUp" data-wow-delay="0.3s"><?= $value['title'] ?></h3>
                                <span class="wow fadeInUp" data-wow-delay="0.7s"><?= $value['name'] ?></span>
                            </div>
                        </div>
                        <div class="play">
                            <div><a data-fancybox href="<?= $value['link_video'] ?>"><img src="<?= $url ?>/dist/images/play.png" alt=""></a></div>
                        </div>
                    </div>
                    <?php endforeach;?>
                </div>
            </section>
        </div>
        <div class="slide section fp-section" id="page42">
            <section class="site-number h-custom" style="background-image: url(<?= $url ?>/dist/images/bg-number.png);">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="content">
                                <div class="title-main wow fadeInLeft" data-wow-delay="0.2s">
                                    <h2 class="heading"><?= $number['title_number'] ?></h2>
                                    <span><?= $number['title_copy'] ?></span>
                                </div>
                                <div class="row m-0" id="counter">
                                    <?php foreach ($number['content_number'] as $value): ?>
                                    <div class="col-6 p-0">
                                        <div class="items wow fadeInLeft" data-wow-delay="0.5s">
                                            <img src="<?= $value['icon'] ?>" alt="">
                                            <span class="number js-number"><?= $value['number'] ?></span>
                                            <p class="m-0"><?= $value['icon_content'] ?></p>
                                        </div>
                                    </div>
                                    <?php endforeach;?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="images wow fadeInRight" data-wow-delay="0.8s">
                    <div class="img">
                        <img src="<?= $number['backround'] ?>" alt="">
                    </div>
                </div>
            </section>
        </div>
        <div class="slide section fp-section" id="page52">
            <section class="site-category h-custom">
                <div class="slick-category-custom">
                    <?php foreach ($number['content_img'] as $value): ?>
                        <a href="<?= $value['link'] ?>">
                            <div class="items wow fadeIn" data-wow-delay="0.5s">
                                <div class="img">
                                    <img class="w-100 d-block" src="<?= $value['img'] ?>" alt="">
                                </div>
                                <div class="content">
                                    <?= $value['title_img'] ?>
                                </div>
                            </div>
                        </a>

                    <?php endforeach;?>
                </div>
            </section>
        </div>
        <div class="slide section fp-section" id="page62">
            <section class="site-news h-custom">
                <div class="container">
                    <div class="title">
                        <h2 class="heading wow fadeInDown" data-wow-delay="0.3s"><?= $news['title_news'] ?></h2>
                    </div>
                    <div class="row row-custom">
                        <div class="col-lg-8 col-custom">
                            <div class="items-news-hl wow fadeInLeft" data-wow-delay="0.7s">
                                <?php foreach ($news['post_news'] as $key => $new): ?>
                                <?php if($key == 0): ?>
                                <div class="row m-0">
                                    <div class="col-md-8 p-0">
                                        <a class="img" href="<?= get_permalink($new->ID)?>"><img src="<?= get_the_post_thumbnail($new->ID) ?>" alt=""></a>
                                    </div>
                                    <div class="col-md-4 p-0">
                                        <div class="content">
                                            <h3><a href="<?= get_permalink($new->ID)?>"><?= $new->post_title ?></a></h3>
                                            <p><?= $new->post_excerpt ?></p>
                                            <a class="details" href="<?= get_permalink($new->ID)?>"><i class="fa-solid fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <?php endif;?>
                                <?php endforeach;?>
                            </div>
                        </div>
                        <div class="col-lg-4 col-custom">
                            <div class="sidebar-news">
                                <?php foreach ($news['post_news'] as $key => $new): ?>
                                <?php if($key != 0): ?>
                                <div class="itesm wow fadeInRight" data-wow-delay="1s">
                                    <div class="row m-0">
                                        <div class="col-4 p-0">
                                            <a class="img ratio" href="<?= get_permalink($new->ID)?>"><img src="<?= get_the_post_thumbnail($new->ID) ?>"></a>
                                        </div>
                                        <div class="col-8 p-0">
                                            <div class="content">
                                                <h3><a href="<?= get_permalink($new->ID)?>"><?= $new->post_title ?></a></h3>
                                                <p><?= $new->post_excerpt ?></p>
                                                <a class="details" href="<?= get_permalink($new->ID)?>"><?php pll_e('Tìm hiểu thêm'); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <?php endif;?>
                                <?php endforeach;?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="slide section fp-section" id="page72">
            <section class="site-pn">
                <div class="row m-0 align-items-center ">
                    <div class="col-left">
                        <div class="title-main">
                            <h2 class="heading"><?= $partners['partner_copy'] ?> </h2>
                            <span><?= $partners['title_partner'] ?></span>
                        </div>
                    </div>
                    <div class="col-right">
                        <div class="slick-pn slick-custom-nav">
                            <?php foreach ($partners['logo'] as $logo): ?>
                            <div class="items">
                                <img src="<?= $logo ?>" alt="">
                            </div>
                            <?php endforeach;?>
                        </div>
                        <a class="btn-all" href="<?= $partners['link'] ?>">ALL</a>
                    </div>
                </div>
            </section>
            <?php
            $url = get_template_directory_uri();
// Footer
            $logo = get_field('logo_footer', 'option');
            $follow = get_field('follow', 'option');
            $networks = get_field('networks', 'option');
            $qrcode = get_field('qrcode', 'option');
            $copyright = get_field('copyright', 'option');
            $brach1 = get_field('brach1', 'option');
            $contact = get_field('contact', 'option');

// Header
            $logo_header = get_field('logo_header', 'option');
            $company = get_field('company', 'option');
            $facebook = get_field('facebook', 'option');
            $youtube = get_field('youtube', 'option');
            ?>
            <footer class="footer footer-none" style="background-image: url(<?= $url ?>/dist/images/bg-footer.png);">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-custom">
                            <div class="footer_content footer_logo">
                                <div class="logo">
                                    <a href="<?= home_url() ?>"><img src="<?= $logo ?>" alt=""></a>
                                    <div class="qr">
                                        <img src="<?= $qrcode ?>" alt="">
                                    </div>
                                </div>
                                <div>
                                    <div class="flow">
                                        <span><?= $follow ?></span>
                                        <div class="mxh">
                                            <a href="<?= $networks['linkfa'] ?>"><i class="fa-brands fa-facebook-f"></i></a>
                                            <a href="<?= $networks['linkyu'] ?>"><i class="fa-brands fa-youtube"></i></a>
                                        </div>
                                    </div>
                                    <div class="coppy"><?= $copyright ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-custom">
                            <div class="footer_content">
                                <?php foreach ($brach1 as $value): ?>
                                    <div class="items-address">
                                        <h4 class="heading-ft"><?= $value['name_brach'] ?></h4>
                                        <p><?= $value['address'] ?></p>
                                    </div>
                                <?php endforeach;?>
                            </div>
                        </div>
                        <div class="col-md-4 col-custom">
                            <div class="footer_content">
                                <h4 class="heading-ft"><?php pll_e('Liên hệ'); ?></h4>
                                <ul>
                                    <li><img src="<?= $url ?>/dist/images/icon dia chi-01.png" alt=""><span><?= $contact['address_footer'] ?></span></li>
                                    <li><img src="<?= $url ?>/dist/images/icon dia chi-02.png" alt=""><span><?= $contact['hotline'] ?></span></li>
                                    <li><img src="<?= $url ?>/dist/images/icon dia chi-03.png" alt=""><span><?= $contact['email'] ?></span></li>
                                    <li><a class="btn-custom" href="<?= $link_page ?>"><?php pll_e('TUYỂN DỤNG'); ?></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </section>
    <div id="navigation">
        <div id="nav_wrapper">
            <div class="nav_icon active" id="page_1">
                <a href="#page1">01</a>
            </div>
            <div class="nav_icon" id="page_2">
                <a href="#page2">02</a>
            </div>
            <div class="nav_icon" id="page_3">
                <a href="#page3">03</a>
            </div>
            <div class="nav_icon" id="page_4">
                <a href="#page4">04</a>
            </div>
            <div class="nav_icon" id="page_5">
                <a href="#page5">05</a>
            </div>
            <div class="nav_icon" id="page_6">
                <a href="#page6">06</a>
            </div>
            <div class="nav_icon" id="page_7">
                <a href="#page7">07</a>
            </div>
            <div id="nav_signifier"></div>
        </div>
    </div>
    <div class="navigation-mobile">
        <div id="nav_wrapper">
            <div class="nav_icon active">
                <a class="" href="#page12">01</a>
            </div>
            <div class="nav_icon">
                <a href="#page22">02</a>
            </div>
            <div class="nav_icon">
                <a href="#page32">03</a>
            </div>
            <div class="nav_icon">
                <a href="#page42">04</a>
            </div>
            <div class="nav_icon">
                <a href="#page52">05</a>
            </div>
            <div class="nav_icon">
                <a href="#page62">06</a>
            </div>
            <div class="nav_icon">
                <a href="#page72">07</a>
            </div>
        </div>
    </div>
</main>
<?php
get_footer();
?>
<script>
    $(window).on('load', function(event) {
        $('body').removeClass('preloading');
        // $('.load').delay(1000).fadeOut('fast');
        $('.loader').delay(4000).fadeOut('fast');
    });
</script>