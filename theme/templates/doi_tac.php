<?php
/* Template Name:  Đối tác */
get_header();
$banner = get_field('banner', get_the_ID());

?>
<style>
    .slick-list {
        overflow: hidden;
    }
</style>
<main>
    <section class="page-banner-nl">
        <div class="img ratio">
            <img class="w-100 d-block" src="<?= $banner['image'] ?>" alt="">
        </div>
        <div class="content">
            <div class="container">
                <div class="title-main">
                    <h2 class="heading"><?= $banner['title'] ?></h2>
                </div>
            </div>
        </div>
    </section>
    <?php if(have_rows('all_doitact')){ ?>
    <?php $h=0; ?>
    <section class="page-archive-dt">
        <div class="container">
            <?php while(have_rows('all_doitact')): the_row() ?>
            <div class="archive-dt" id="<?php echo $h ?>">
                <div class="title-main">
                    <h2 class="heading"><?php the_sub_field('title_dt') ?></h2>
                    <div class="tab-lv">
                    <?php if(have_rows('all_partners')){ ?>
                        <?php $i=$h ?>
                        <ul class="nav">
                            <?php while(have_rows('all_partners')): the_row() ?>
                                <li class="nav-items"><a data-toggle="tab" class="nav-link <?php if($i==$h) echo 'active' ?> tab-item-one" href="#tab<?php echo $h ?><?php echo $i ?>"><?php the_sub_field('title') ?></a></li>
                                <?php $i++ ?>
                            <?php endwhile; ?>
                        </ul>
                    <?php } ?>
                    <?php wp_reset_postdata() ?>
                    </div>
                </div>
                <?php if(have_rows('all_partners')){ ?>
                    <?php $k=$h  ?>
                    <div class="tab-content">
                    <?php while(have_rows('all_partners')): the_row() ?>
                        <div class="tab-pane fade <?php if($k==$h) echo 'active show' ?>" id="tab<?php echo $h ?><?php echo $k ?>">
                            <div class="slick-archive-tt-tt slick-nav-custom">
                                <?php if(have_rows('doi_tac')){ ?>
                                    <?php while(have_rows('doi_tac')): the_row() ?>
                                        <?php
                                            $images = get_sub_field('logo_partners');
                                            $total = ceil(count($images) / 10);
                                        ?>
                                        <?php for($i = 0; $i < $total; $i++): ?>
                                            <div class="items">
                                                <div class="row">
                                                    <?php for($j = (10 * $i); $j < (10 * $i + 10); $j++): ?>
                                                        <?php if(empty($images[$j])) break; ?>
                                                        <div class="col-md-custom">
                                                            <div class="img ratio">
                                                                <img src="<?php echo esc_url($images[$j]['url']); ?>" alt="<?php echo esc_attr($images[$j]['alt']); ?>">
                                                            </div>
                                                        </div>
                                                    <?php endfor; ?>
                                                </div>
                                            </div>
                                        <?php endfor; ?>
                                    <?php endwhile; ?>
                                <?php } ?>
                            </div>
                        </div>
                        <?php $k++ ?>
                    <?php endwhile; ?>
                    </div>
                <?php } ?>
            </div>
            <?php $h++ ?>
            <?php endwhile ?>
        </div>
    </section>
    <?php } ?>
    <?php wp_reset_postdata() ?>
</main>
<?php
get_footer();
?>


