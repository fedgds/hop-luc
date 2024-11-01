<?php
/* Template Name:  Lĩnh vực hoạt động */
get_header();
$banner = get_field('img_build', get_the_ID());
$title_build = get_field('title_build', get_the_ID());
$page = get_field('page', get_the_ID());
$title_slogan = get_field('title_slogan', get_the_ID());
$content_build = get_field('content_build', get_the_ID());
$image = get_field('image', get_the_ID());
$title_sevice = get_field('title_sevice', get_the_ID());
$discription = get_field('discription', get_the_ID());
$content = get_field('content', get_the_ID());
?>
<main>
    <section class="page-banner-nl">
        <div class="img ratio">
            <img class="w-100 d-block" src="<?= $banner ?>" alt="">
        </div>
        <div class="content">
            <div class="container">
                <div class="title-main text-left">
                    <h2 class="heading wow fadeInLeft" data-wow-delay="0.3s"><?= $title_build ?></h2>
                </div>
            </div>
        </div>
    </section>
    <section class="page-linhvuc">
        <div class="container">
            <div class="tab-lv wow fadeInDown" data-wow-delay="0.5s">
                <ul>
                    <li><a class="active" href="#"><?= get_the_title() ?></a></li>
                    <?php foreach ($page as $pag): ?>
                    <li><a href="<?= $pag['link'] ?>"><?= $pag['name'] ?></a></li>
                    <?php endforeach;?>
                </ul>
            </div>
            <div class="content">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="text">
                            <div class="title-main wow fadeInLeft" data-wow-delay="0.3s">
                                <h2 class="heading"><?= $title_slogan ?></h2>
                                <p><?= $content_build ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="images wow fadeInRight" data-wow-delay="0.7s">
                            <div class="img ratio">
                                <img src="<?= $image ?>" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="page-sevices">
        <div class="container">
            <div class="title-main wow fadeInUp" data-wow-delay="0.3s">
                <h2 class="heading"><?= $title_sevice ?></h2>
                <p><?= $discription ?></p>
            </div>
            <div class="row row-custom">
                <?php foreach ($content as $con) { ?>
                    <div class="col-md-4 col-custom">
                        <div class="items wow fadeInUp" data-wow-delay="0.7s">
                            <div class="img">
                                <img src="<?= $con['img'] ?>" alt="">
                            </div>
                            <div class="content">
                                <p><?= $con['content'] ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
</main>
<?php
get_footer();
?>
