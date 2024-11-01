<?php
/* Template Name:  Liên hệ */

get_header();
$url = get_template_directory_uri();
$banner = get_field('banner', get_the_ID());
$title = get_field('title_contact', get_the_ID());
$note = get_field('note', get_the_ID());
$website = get_field('website', get_the_ID());
$hotline = get_field('hotline', get_the_ID());
$fax = get_field('fax', get_the_ID());
$address = get_field('address', get_the_ID());
$maptle = get_field('map', get_the_ID());


?>
<style>
    /*.wpcf7 .screen-reader-response {*/
    /*    display: none;*/
    /*}*/
</style>
<main>
    <section class="page-banner-nl">
        <div class="img ratio">
            <img class="w-100 d-block" src="<?= $banner['img'] ?>" alt="">
        </div>
        <div class="content">
            <div class="container">
                <div class="title-main text-left">
                    <h2 class="heading"><?= $banner['title'] ?></h2>
                </div>
            </div>
        </div>
    </section>
    <section class="page-contact">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="content">
                        <div class="title-main">
                            <h2 class="heading"><?= $title ?></h2>
                            <p><?= $note ?></p>
                         </div>
                        <ul>
                            <li><img src="<?= $url ?>/dist/images/email.png" alt=""><?= $website ?></li>
                            <li><img src="<?= $url ?>/dist/images/phone.png" alt=""><?= $hotline ?></li>
                            <li><img src="<?= $url ?>/dist/images/fax.png" alt=""><?= $fax ?></li>
                            <li><img src="<?= $url ?>/dist/images/email.png" alt=""><?= $address ?></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <?php
                    if(ICL_LANGUAGE_CODE == 'vi' || ICL_LANGUAGE_CODE == ''){
                        echo do_shortcode('[contact-form-7 id="607" title="Liên hệ"]');
                    }elseif (ICL_LANGUAGE_CODE == 'en'){
                        echo do_shortcode('[contact-form-7 id="796" title="Liên hệ_en"]');
                    }elseif (ICL_LANGUAGE_CODE == 'zh'){
                        echo do_shortcode('[contact-form-7 id="3040" title="Liên hệ_cn"]');
                    }?>
                </div>
            </div>
        </div>
    </section>
    <section class="maps">
        <?= $maptle ?>
    </section>
</main>
<?php
get_footer();
?>
