<?php
/* Template Name:  Công ty Cổ phần Capplus */
get_header();
$overview = get_field('overview', get_the_ID());
$title_leaders = get_field('title_leaders', get_the_ID());
$diagram_leaders = get_field('diagram_leaders', get_the_ID());
$title_field = get_field('title_field', get_the_ID());
$content_field = get_field('content_field', get_the_ID());
$title_library = get_field('title_library', get_the_ID());
$img_library = get_field('img_library', get_the_ID());
?>
<main>
    <section class="page-banner-nl">
        <div class="img ratio">
            <img class="w-100 d-block" src="<?= $overview['banner'] ?>" alt="">
        </div>
        <div class="content">
            <div class="container">
                <div class="title-main">
                    <h2 class="heading"><?= $overview['title'] ?></h2>
                </div>
            </div>
        </div>
    </section>
    <section class="page-linhvuc page-tonquan">
        <div class="container">
            <div class="content">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="text">
                            <div class="title-main wow fadeInLeft" data-wow-delay="0.3s">
                                <h2 class="heading">
                                    <img src="<?= $overview['logo'] ?>" alt="">
                                    <?= $overview['title_overview'] ?>
                                </h2>
                                <p><?= $overview['content_company'] ?></p>
                               <a class="btn-custom" href="<?= $overview['file'] ?>" download>
                                    <?php if(pll_current_language() == 'vi'): ?>
                                        Tải tài liệu
                                    <?php elseif(pll_current_language() == 'en'): ?>
                                        Download profile
                                    <?php else: ?>
                                        下载文件
                                    <?php endif; ?>
                               </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="images wow fadeInRight" data-wow-delay="0.7s">
                            <div class="img ratio">
                                <img src="<?= $overview['img1'] ?>" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="page-sodo">
        <div class="container">
            <div class="title-main wow fadeInUp" data-wow-delay="0.3s">
                <h2 class="heading"><?= $title_leaders ?></h2>
            </div>
            <div class="images wow fadeInUp" data-wow-delay="0.7s">
                <img src="<?= $diagram_leaders ?>" alt="">
            </div>
        </div>
    </section>
    <?php if(!empty($content_field)): ?>
    <section class="site-category page-lvhd">
        <div class="title-main text-center">
            <h2 class="heading wow fadeInUp" data-wow-delay="0.3s"><?= $title_field ?></h2>
        </div>
        <div class="slick-category-custom slick-nav-custom">
            <?php foreach ($content_field as $cont): ?>
            <div class="items wow fadeInUp" data-wow-delay="0.7s">
                <div class="img">
                    <img class="w-100 d-block" src="<?= $cont['img_field'] ?>" alt="">
                </div>
                <div class="content">
                    <h3><?= $cont['name_field'] ?></h3>
                    <p><?= $cont['introduction_field'] ?></p>
                </div>
            </div>
            <?php endforeach;?>
        </div>
    </section>
    <?php endif;?>
    <section class="page-media">
        <div class="container">
            <div class="title-main text-center">
                <h2 class="heading wow fadeInUp" data-wow-delay="0.3s"><?= $title_library ?></h2>
            </div>
            <div class="media-custom">
                <div class="slick-media slick-nav-custom">
                    <?php foreach ($img_library as $img): ?>
                    <div class="items wow fadeInUp" data-wow-delay="0.5s">
                        <div class="images">
                            <div class="img ratio">
                                <img src="<?= $img['imgs'] ?>" alt="">
                            </div>
                        </div>
                    </div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </section>
</main>
<?php
get_footer();
?>
