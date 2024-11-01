<?php
/* Template Name:  Thành tựu */
get_header();
$img_banner = get_field('img_banner', get_the_ID());
$title = get_field('title', get_the_ID());
$certificate = get_field('certificate', get_the_ID());
$url = get_template_directory_uri();
?>
<style>
    .slick-dots {
        display: none;
    }
</style
<main>
    <section class="page-banner-nl">
        <div class="img ratio">
            <img class="w-100 d-block" src="<?= $img_banner ?>" alt="">
        </div>
        <div class="content">
            <div class="container">
                <div class="title-main text-banner-left">
                    <h2 class="heading color-red"><?= $title ?></h2>
                </div>
            </div>
        </div>
    </section>
    <section class="page-archive-tt">
        <div class="container">
            <div class="slick-archive-tt-tt slick-nav-custom">
                <?php for($k=1; $k<6; $k++){ ?>
                    <div class="items">
                        <div class="row">
                            <?php foreach ($certificate as $cert) { ?>
                                <div class="col-md-3 col-6 col-custom">
                                    <div class="items-tt">
                                        <a data-fancybox="tt" class="img ratio" href="<?= $cert['img_certificates'] ?>">
                                            <img src="<?= $cert['img_certificates'] ?>" alt="">
                                        </a>
                                        <h3><a href="#"><?= $cert['name_certificate'] ?></a></h3>
                                    </div>
                                </div>
                            <?php } ?>
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
