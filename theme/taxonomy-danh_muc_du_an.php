<?php

get_header();
//print_r(12365489);die;
$host = $_SERVER['HTTP_HOST'];
$url = '';
if(ICL_LANGUAGE_CODE == 'vi'){
    $url = get_page_link(399);
}elseif (ICL_LANGUAGE_CODE == 'en'){
    $url = get_page_link(2921);
}elseif(ICL_LANGUAGE_CODE == 'zh'){
    $url = get_page_link(2922);
}


$terms = get_queried_object();

$args = new WP_Query(array(
    'post_type' => 'du_an',
    'posts_per_page' => posts_per_page_duan,
    's' => $_POST['keyWord'],
    'tax_query' => array(
        'relation' => 'AND',
        array(
            'taxonomy' => 'danh_muc_du_an',
            'field' => 'slug',
            'terms' => $terms->slug,
        ),
    ),
));
$post = $args->posts;
$term = get_terms(array(
    'taxonomy' => 'danh_muc_du_an',
    'hide_empty' => false,
));

$now = getdate();
$term_location = get_terms(array(
    'taxonomy' => 'danh_muc_vi_tri',
    'hide_empty' => false,
));

$current_year = $now['year'];



$j = 1;

?>
<style>
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
</style>
<main>
    <div class="divgif">
        <img class="iconloadgif" src="<?= get_template_directory_uri() ?>/dist/images/loading2.gif" alt="">
    </div>
    <section class="page-banner-nl">
        <div class="img ratio">
            <img class="w-100 d-block" src="<?= get_template_directory_uri() ?>/dist/images/da.png" alt="">
        </div>
    </section>
    <section class="page-linhvuc page-duan">
        <div class="container">
            <div class="tab-lv">
                <ul>
                    <li><a class="" href="<?= $url ?>"><?php pll_e('Tất cả'); ?></a></li>
                    <?php foreach ($term as $value): ?>
                        <li><a class="<?= ($value->slug == $terms->slug) ? 'active' : '' ?>" href="<?= get_term_link($value->term_id) ?>"><?= $value->name ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="filter-project">
                <div class="form" action="">
                    <div class="form-group">
                        <input class="form-control keyWord" value="" name="keyWord" placeholder="<?php pll_e('Nhập tên dự án'); ?>" type="text">
                    </div>
                    <div class="form-group">
                        <select class="form-control icon-ff location" name="location" id="location">
                            <option value=""><?php pll_e('Vi tri'); ?></option>
                            <?php foreach ($term_location as $item): ?>
                                <option value="<?= $item->slug ?>"><?= $item->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control icon-ff year" name="year" id="year">
                            <option value=""><?php pll_e('Thời gian'); ?></option>
                            <?php for ($i = $current_year; $i > 1995; $i--): ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control icon-ff progress" name="progress" id="progress">
                            <option value=""><?php pll_e('Tiến độ'); ?></option>
                            <option value="Đã hoàn thành"><?php pll_e('Đã hoàn thành'); ?></option>
                            <option value="Chưa hoàn thành"><?php pll_e('Chưa hoàn thành'); ?></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn-custom box-submit"><?php pll_e('Tìm kiếm'); ?></button>
                    </div>
                </div>
            </div>
            <div class="project-higlight">
                <div class="row row-custom">
                    <?php foreach ($post as $key => $value): ?>
                    <?php if($key == 0): ?>
                    <div class="col-lg-8 col-custom">
                        <div class="items-project">
                            <a class="img ratio" href="<?= get_permalink($value->ID) ?>">
                                <img src="<?= get_the_post_thumbnail($value->ID) ?>">
                            </a>
                            <div class="content">
                                <h3><a href="<?= get_permalink($value->ID) ?>"><?= $value->post_title ?></a></h3>
                                <p><?= $value->post_excrept ?></p>
                                <div class="icon">
                                    <div class="icon_text1">
                                        <img src="<?= $url ?>/dist/images/icon-da1.png" alt="">
                                        <div class="text">
                                            <p><?php pll_e('Quy mô'); ?></p>
                                            <span><?= get_field('scale',$value->ID ) ?>m2</span>
                                        </div>
                                    </div>
                                    <div class="icon_text1">
                                        <img src="<?= $url ?>/dist/images/icon-da2.png" alt="">
                                        <div class="text">
                                            <p><?php pll_e('Tiến độ'); ?></p>
                                            <span><?= get_field('complete',$value->ID ) ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif;?>
                    <?php endforeach;?>
                    <div class="col-lg-4 col-custom">
                        <div class="hightlight-sidebar">
                            <?php foreach ($post as $key => $value): ?>
                            <?php if($key == 1 || $key == 2): ?>
                            <div class="col-md-h">
                                <div class="items-project">
                                    <a class="img ratio" href="<?= get_permalink($value->ID) ?>">
                                        <img src="<?= get_the_post_thumbnail($value->ID) ?>">
                                    </a>
                                    <div class="content">
                                        <h3><a href="<?= get_permalink($value->ID) ?>"><?= $value->post_title ?></a></h3>
                                        <p><?= $value->post_excrept ?></p>
                                        <div class="icon">
                                            <div class="icon_text1">
                                                <img src="<?= $url ?>/dist/images/icon-da1.png" alt="">
                                                <div class="text">
                                                    <p><?php pll_e('Quy mô'); ?></p>
                                                    <span><?= get_field('scale',$value->ID ) ?>m2</span>
                                                </div>
                                            </div>
                                            <div class="icon_text1">
                                                <img src="<?= $url ?>/dist/images/icon-da2.png" alt="">
                                                <div class="text">
                                                    <p><?php pll_e('Tiến độ'); ?></p>
                                                    <span><?= get_field('complete',$value->ID )  ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif;?>
                    <?php endforeach;?>
                        </div>
                    </div>
                    <?php foreach ($post as $key => $value): ?>
                    <?php if($key != 0 && $key != 1 && $key != 2): ?>
                    <div class="col-lg-4 col-6 col-custom">
                        <div class="items-project">
                            <a class="img ratio" href="<?= get_permalink($value->ID) ?>">
                                <img src="<?= get_the_post_thumbnail($value->ID) ?>">
                            </a>
                            <div class="content">
                                <h3><a href="<?= get_permalink($value->ID) ?>"><?= $value->post_title ?></a></h3>
                                <p><?= $value->post_excrept ?> </p>
                                <div class="icon">
                                    <div class="icon_text1">
                                        <img src="<?= $url ?>/dist/images/icon-da1.png" alt="">
                                        <div class="text">
                                            <p><?php pll_e('Quy mô'); ?></p>
                                            <span><?= get_field('scale',$value->ID ) ?>m2</span>
                                        </div>
                                    </div>
                                    <div class="icon_text1">
                                        <img src="<?= $url ?>/dist/images/icon-da2.png" alt="">
                                        <div class="text">
                                            <p><?php pll_e('Tiến độ'); ?></p>
                                            <span><?= get_field('complete',$value->ID ) ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif;?>
                    <?php endforeach;?>
                </div>
            </div>
            <div class="load_news">
                <a class="load-post" data-key="0"
                   data-value="<?php echo posts_per_page_duan ?>"><?php pll_e('Xem thêm'); ?></a>
            </div>
        </div>
    </section>
</main>
<input type="hidden" id="slug-taxonomy" value="<?= $terms->slug ?>">
<script type='text/javascript' src='<?= get_template_directory_uri() ?>/dist/js/jquery/jquery.js'></script>
<?php
get_footer();
?>
<script>
    $(document).ready(function () {
        $('.load-post').on('click', function () { // click nút xem thêm
            var numberPage = $(this).data('value'); // biến lấy giá tr ( posts_per_page )
            var dataKey = $("input[id='slug-taxonomy']").val();
            var location = $('.location').val();
            var keyWord = $('.keyWord').val();
            var year = $('.year').val();
            var progress = $('.progress').val();
            // $('.loader').show();
            // console.log(numberPage);
            searchData(keyWord, year, progress, dataKey, location, numberPage)
        });
        // click từng danh mục
        // $('.term-taxonomy').on('click', function () {
        //     var dataKey = $(this).data('key');
        //     var location = $('.location').val();
        //     var keyWord = $('.sear_2').val();
        //     var year = $('.year').val();
        //     var progress = $('.progress').val();
        //     console.log(dataKey);
        //     searchData(keyWord, year, progress, dataKey, location);
        // });

        //click nút tìm kiếm
        $('.box-submit').on('click', function () {
            var numberPage = $(this).data('value'); // biến lấy gi trị ( posts_per_page )
            var dataKey = $("input[id='slug-taxonomy']").val();
            var location = $('.location').val();
            var keyWord = $('.keyWord').val();
            var year = $('.year').val();
            var progress = $('.progress').val();
            console.log(dataKey);
            console.log(location);
            console.log(year);
            console.log(progress);
            searchData(keyWord, year, progress, dataKey, location, numberPage);
        })
        //Search Data
        function searchData(keyWord, year, progress, dataKey, location, numberPage) {
            var link = "<?= admin_url('admin-ajax.php'); ?>";
            var action = "query_post_terms";
            $.ajax({
                url: link,
                type: 'POST',
                data: {
                    "action": action,
                    "slug": dataKey,
                    "keyWord": keyWord,
                    "year": year,
                    "progress": progress,
                    "location": location,
                    "number": numberPage,
                },
                dataType: 'json', //d liệu trả về dang json
                beforeSend: function () {
                    $('.divgif').css("display", "block");
                },
                success: function (data) {
                    $('.divgif').css("display", "none");
                    $('.row-custom').html(data.html);
                    $('.load-post').data('value', data.number);
                    if (data.check == 'hide') { // kiểm tra giá trị check nếu là hide ẩn class 'load-post'
                        $('.load_news').hide();
                    }
                }
            });
        }

    });

</script>