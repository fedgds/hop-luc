<?php
/* Template Name:  Tuyển dụng */
get_header();
$url = get_template_directory_uri();
$banner = get_field('img_banner', get_the_ID());
$culture = get_field('culture', get_the_ID());
$environment = get_field('environment', get_the_ID());
$title = get_field('title', get_the_ID());
$care= get_terms(array(
    'taxonomy' => 'danh_muc_nhan_luc_theo_nganh',
    'hide_empty' => false,
));

$loca = get_terms(array(
    'taxonomy' => 'danh_muc_nhan_luc_theo_khu_vuc',
    'hide_empty' => false,
));
//  query post
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$key = no_sql_injection(xss($_GET['keyword']));
$location = no_sql_injection(xss($_GET['term-location']));
$career = no_sql_injection(xss($_GET['term-career']));
print_r($key);
print_r($location);
print_r($career);

$args = new WP_Query(array(
    'post_type' => 'nhan_luc',
    'paged' => $paged,
    'posts_per_page' => get_option('posts_per_page'),
    's' => $key,
    'orderby' => 'date',
    'order' => 'ASC',
));
if (!empty($location)) {
    $args = array(
        'post_type' => 'nhan_luc',
        'paged' => $paged,
        'posts_per_page' => get_option('posts_per_page'),
        's' => $key,
        'orderby' => 'date',
        'order' => 'ASC',
        'tax_query' => array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'danh_muc_nhan_luc_theo_khu_vuc',
                'field' => 'slug',
                'terms' => $location,
            ),
        ),
    );
//        array_merge($args, $termLocation);
} elseif (!empty($career)) {
    $args = array(
        'post_type' => 'nhan_luc',
        'paged' => $paged,
        'posts_per_page' => get_option('posts_per_page'),
        's' => $key,
        'orderby' => 'date',
        'order' => 'ASC',
        'tax_query' => array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'danh_muc_nhan_luc_theo_nganh',
                'field' => 'slug',
                'terms' => $career,
            ),
        ),
    );
//        array_merge($args, $termCareer);
} elseif (!empty($location) && !empty($career)) {
    $args = array(
        'post_type' => 'nhan_luc',
        'paged' => $paged,
        'posts_per_page' => get_option('posts_per_page'),
        's' => $key,
        'orderby' => 'date',
        'order' => 'ASC',
        'tax_query' => array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'danh_muc_nhan_luc_theo_khu_vuc',
                'field' => 'slug',
                'terms' => $location,
            ),
            array(
                'taxonomy' => 'danh_muc_nhan_luc_theo_nganh',
                'field' => 'slug',
                'terms' => $career,
            ),
        ),
    );
}
$post = $args->posts;

?>
<style>
    .location-term a{
        color: #000000;
        padding-left: 5px;
    }
    .sidebar-rec .items ul li a:active {
        color: var(--color-red);
    }
    .divgif {
        position: fixed;
        width: 100%;
        height: 100%;
        z-index: 1100;
        display: none;
        background: #dedede;
        opacity: 0.5;
        top: 0;
    }
    .iconloadgif {
        top: 0;
        right: 0;
        left: 0;
        bottom: 0;
        position: absolute;
        margin: auto;
        width: auto;
    }

     .wpcf7 .screen-reader-response {
         display: none;
     }

</style>
<main>
    <div class="divgif">
        <img class="iconloadgif" src="<?= $url ?>/dist/images/loading2.gif" alt="">
    </div>
    <section class="page-banner-nl">
        <div class="img ratio">
            <img class="w-100 d-block" src="<?= $banner ?>" alt="">
        </div>
        <a class="btn-custom js-ut wow fadeInDown" data-wow-delay="0.3s" href="javascript:void(0)"><?php pll_e('Nộp đơn ứng tuyển'); ?></a>
    </section>
    <section class="page-td-vh">
        <div class="container">
            <div class="title-main">
                <h2 class="heading wow fadeInLeft" data-wow-delay="0.3s"><?= $culture['title'] ?></h2>
                <p class="wow fadeInRight" data-wow-delay="0.5s"><?= $culture['dis'] ?>
                </p>
            </div>
            <div class="album-td">
                <div class="row row-custom">
                    <div class="col-md-5 col-custom">
                        <div class="video-td wow fadeInUp" data-wow-delay="0.3s">
                            <div class="img ratio">
                                <img src="<?= $culture['video']['imgvideo'] ?>" alt="">
                            </div>
                            <div class="logo"><a href="#"><img src="<?= $url ?>/dist/images/logo.png" alt=""></a></div>
                            <a data-fancybox class="play" href="<?= $culture['video']['linh_video'] ?>">
                                <div><img src="<?= $url ?>/dist/images/play.png" alt=""></div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-7 col-custom">
                        <div class="row row-custom">
                                <div class="col-5 col-custom alumb-custom wow fadeInUp" data-wow-delay="0.3s">
                                    <div class="images ratio">
                                        <img src="<?= $culture['img']['0'] ?>" alt="">
                                    </div>
                                </div>
                                <div class="col-7 col-custom alumb-custom wow fadeInUp" data-wow-delay="0.3s">
                                    <div class="images ratio">
                                        <img src="<?= $culture['img']['1'] ?>" alt="">
                                    </div>
                                </div>
                                <div class="col-7 col-custom alumb-custom wow fadeInUp" data-wow-delay="0.3s">
                                    <div class="images ratio">
                                        <img src="<?= $culture['img']['2'] ?>" alt="">
                                    </div>
                                </div>
                                <div class="col-5 col-custom alumb-custom wow fadeInUp" data-wow-delay="0.3s">
                                    <div class="images ratio">
                                        <img src="<?= $culture['img']['3'] ?>" alt="">
                                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="page-environment">
        <div class="container">
            <div class="title-main text-center">
                <h2 class="heading wow fadeInUp" data-wow-delay="0.3s"><?= $environment['title'] ?></h2>
            </div>
            <div class="row">
                <?php foreach ($environment['avantage'] as $value ): ?>
                    <div class="col-md-4">
                        <div class="items wow fadeInUp" data-wow-delay="0.5s">
                            <?php if(!empty($value['year'])): ?>
                                <div class="icon"><?= $value['year'] ?></div>
                            <?php else:?>
                                <div class="icon"><img src="<?= $value['icon'] ?>"></div>
                            <?php endif;?>
                            <h3><?= $value['avant'] ?></h3>
                            <p><?= $value['discription'] ?></p>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
    </section>
    <section class="page-recruit">
        <div class="container">
            <div class="title-main text-center">
                <h2 class="heading wow fadeInDown" data-wow-delay="0.3s"><?php pll_e('Vị trí tuyển dụng'); ?></h2>
            </div>
            <div class="form wow fadeInUp" data-wow-delay="0.5s">
                <form class="row row-custom">
                    <div class="col-lg-5 col-md-4 col-custom">
                        <div class="form-group">
                            <input class="form-control keyword-search" name="keyword" id="keyword" placeholder="<?php pll_e('Từ khoá tuyển dụng'); ?>" type="text">
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-custom">
                        <div class="form-group">
                            <select class="form-control icon-ff" name="term-location" id="term-location">
                                <option value=""><?php pll_e('Khu vực'); ?></option>
                                <?php foreach ($loca as $item): ?>
                                    <option value="<?= $item->slug ?>"><?= $item->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-custom">
                        <div class="form-group">
                            <select class="form-control icon-ff" name="term-career" id="term-career">
                                <option value=""><?php pll_e('Ngành ngh'); ?></option>
                                <?php foreach ($care as $item): ?>
                                    <option value="<?= $item->slug ?>"><?= $item->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-2 col-custom">
                        <div class="form-group">
                            <button class="btn-custom" type="submit"><?php pll_e('Tìm kiếm'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row row-custom">
                <div class="col-md-9 col-custom">
                    <div class="list-rec">
                        <?php foreach ($post as $key => $value):
                            $term =  get_the_term_list( $value->ID, 'danh_muc_nhan_luc_theo_khu_vuc', '', ', ' );
                            ?>
                            <div class="items wow fadeInDown query-recruit" data-wow-delay="0.5s">
                                <div class="title">
                                    <h3><a href="<?= get_permalink($value->ID) ?>"><?= $value->post_title?></a></h3>
                                    <p><?php pll_e('Số lượng'); ?>: <?= get_field('number', $value->ID)?></p>
                                    <div class="kv location-term"><img src="<?= $url ?>/dist/images/kv.png" alt=""> <?php pll_e('Khu vực'); ?>:  <?= (empty($term)? get_field('location',$value->ID) : $term) ?></div>
                                </div>
                                <a class="btn-custom js-ut wow fadeInDown" data-wow-delay="0.3s" href="javascript:void(0)"><?php pll_e('Ứng tuyển'); ?></a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="navigation">
                        <?php echo paginate_links(array(
                            'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                            'format' => '?paged=%#%',
                            'current' => max(1, get_query_var('paged')),
                            'total' => $args->max_num_pages,
                            'prev_text' => __('<i class="fa-solid fa-arrow-left"></i>'),
                            'next_text' => __('<i class="fa-solid fa-arrow-right"></i>'),
                        )); ?>
                    </div>
                    <?php wp_reset_query(); ?>
                </div>
                <div class="col-md-3 col-custom">
                    <div class="sidebar-rec">
                        <div class="items wow fadeInDown" data-wow-delay="0.5s">
                            <h3><?php pll_e('Việc làm theo ngành'); ?></h3>
                            <ul>
                                <?php foreach ($care as $item): ?>
                                <li><a class="career-active" href="javascript:void(0)"><?= $item->name ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="items">
                            <h3><?php pll_e('Việc làm theo khu vực'); ?></h3>
                            <ul>
                                <?php foreach ($loca as $item): ?>
                                    <li><a  class="location-active" href="javascript:void(0)"><?= $item->name ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php
get_footer();
?>
<script>
    // console.log(1233);
   document.getElementById('choose-file').insertAdjacentHTML('beforebegin', '<?php pll_e('Chon file'); ?>');
</script>

