<?php
get_header();
$url = get_template_directory_uri();
$date = get_field('date', get_the_ID());
?>
<style>
    .location-term a{
        color: #000000;
        padding-left: 5px;
    }
    </style>
<main>
    <section class="page-banner-nl">
        <div class="img ratio">
            <img class="w-100 d-block" src="<?= get_field('banner', get_the_ID()) ?>" alt="">
        </div>
    </section>
    <section class="single-rec">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="content-rec">
                        <h1><?= get_the_title()?></h1>
                        <div class="d-flex align-items-center">
                            <a class="btn-custom js-ut" href="javascript:void(0)"><?php pll_e('Ứng tuyển'); ?></a>
                            <div class="kv"><img src="<?= $url ?>/dist/images/kv.png" alt=""> <?php pll_e('Khu vực'); ?>: <?= get_field('location', get_the_ID()) ?></div>
                        </div>
                        <div class="the_content">
                            <h3><strong><?php pll_e('Phúc lợi dành cho bạn'); ?></strong></h3>
                            <ul>
                                <?= get_field('welfare', get_the_ID()) ?>
                            </ul>
                            <h3><strong><?php pll_e('Mô tả công việc'); ?></strong></h3>
                            <p><?= get_field('discript', get_the_ID()) ?></p>

                            <h3><strong><?php pll_e('Yêu cầu công việc'); ?></strong></h3>
                            <p><?= get_field('requirement', get_the_ID()) ?></p>

                            <h3><strong><?php pll_e('Cách thức ứng tuyển'); ?></strong></h3>
                            <?php $methor = get_field('apply', get_the_ID()); ?>
                            <p><?= $methor ?></p>
                         </div>
                        <div class="contact" style="display: <?= (!empty($methor) ? 'none;' : 'block;') ?>">
                            <h3><?php pll_e('Thông tin liên hệ'); ?></h3>
                            <ul>
                                <?php
                                $email =  get_field('email', get_the_ID());
                                $phone =  get_field('phone', get_the_ID());
                                $hotline =  get_field('hotline', get_the_ID());
                                $address =  get_field('address', get_the_ID());
                                ?>
                                <li><img src="<?= $url ?>/dist/images/email.png" alt=""> <?= $email ?></li>
                                <li><img src="<?= $url ?>/dist/images/phone.png" alt=""> <?= $phone ?></li>
                                <li><img src="<?= $url ?>/dist/images/fax.png" alt=""> <?= $hotline ?></li>
                                <li><img src="<?= $url ?>/dist/images/email.png" alt=""><?= $address ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php
                $level =  get_field('level', get_the_ID());
                $career =  get_field('career', get_the_ID());
                $skill =  get_field('skill', get_the_ID());
                $language =  get_field('language', get_the_ID());
                ?>
                <div class="col-md-4">
                    <div class="sidebar-rec-single">
                        <div class="items-infor">
                            <div class="itemns">
                                <img src="<?= $url ?>/dist/images/icon-td1.png" alt="">
                                <div class="text">
                                    <h3><?php pll_e('Ngày đăng tuyển'); ?></h3>
                                    <span><?= (empty($date)) ? get_the_date() : $date ?> </span>
                                </div>
                            </div>
                            <div class="itemns">
                                <img src="<?= $url ?>/dist/images/icon-td2.png" alt="">
                                <div class="text">
                                    <h3><?php pll_e('Cấp bậc'); ?></h3>
                                    <span><?= $level ?></span>
                                </div>
                            </div>
                            <div class="itemns">
                                <img src="<?= $url ?>/dist/images/icon-td3.png" alt="">
                                <div class="text">
                                    <h3><?php pll_e('Ngành nghề'); ?></h3>
                                    <span><?= $career ?></span>
                                </div>
                            </div>
                            <div class="itemns">
                                <img src="<?= $url ?>/dist/images/icon-td4.png" alt="">
                                <div class="text">
                                    <h3><?php pll_e('Kỹ năng'); ?></h3>
                                    <span><?= $skill ?></span>
                                </div>
                            </div>
                            <div class="itemns">
                                <img src="<?= $url ?>/dist/images/icon-td5.png" alt="">
                                <div class="text">
                                    <h3><?php pll_e('Ngn ngữ trình bày hồ sơ'); ?></h3>
                                    <span><?= $language ?></span>
                                </div>
                            </div>
                        </div>
                        <?php
                        $args = new WP_Query(array(
                            'post_type' => 'nhan_luc',
                            'posts_per_page' => get_option('posts_per_page'),
                            'orderby' => 'date'
                        ));
                        $post = $args->posts;
//                        print_r($post);die;
                        ?>
                        <div class="items-like">
                            <h3 class="title"><?php pll_e('Có thể bạn thích'); ?></h3>
                            <ul>
                                <?php foreach ($post as $value){
                                   $term =  get_the_term_list( $value->ID, 'danh_muc_nhan_luc_theo_khu_vuc', '', ', ' );
//                                   print_r($term);die;
                                ?>
                                <li>
                                    <h3><a href="<?= get_permalink($value->ID)?>"><?= get_the_title($value->ID)?></a></h3>
                                    <div class="kv location-term"><img src="<?= $url ?>/dist/images/kv.png" alt=""> <?php pll_e('Khu vực'); ?>:    <?= (empty($term)? get_field('location',$value->ID) : $term) ?></div>
                                </li>
                                <?php }?>
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