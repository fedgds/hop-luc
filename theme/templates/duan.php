<?php

get_header();
$url = get_template_directory_uri();


//$id = get_the_ID();
//$banner = get_field('banner', get_the_ID());
//print_r($id);die;
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
        <img class="iconloadgif" src="<?= $url ?>/dist/images/loading2.gif" alt="">
    </div>
    <section class="page-banner-nl">
        <div class="img ratio">
            <img class="w-100 d-block" src="<?= get_field('banner', get_the_ID()) ?>" alt="">
        </div>
        <div class="content">
            <div class="container">
                <div class="title-main text-banner-left">
                    <h2 class="heading color-red"><?= get_field('title', get_the_ID()) ?></h2>
                </div>
            </div>
        </div>
    </section>
    <section class="page-linhvuc page-duan">
        <div class="container">
            <div class="tab-lv">
                <ul>
                    <li><a class="active" href="#"><?php pll_e('Tất cả'); ?></a></li>
                    <?php foreach ($term as $value): ?>
                        <li><a href="<?= get_term_link($value->term_id) ?>"><?= $value->name ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="filter-project">
                <div class="form" action="">
                    <div class="form-group">
                        <input class="form-control keyWord" value="<?php if (isset($key_word)) {
                            echo $key_word;
                        } ?>" type="text" name="keyWord" placeholder="<?php pll_e('Nhập tên dự án'); ?>" type="text">
                    </div>
                    <div class="form-group">
                        <select class="form-control icon-ff location" name="location" id="location">
                            <option value=""><?php pll_e('Vị trí'); ?></option>
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

                </div>
            </div>
            <div class="load_news">
                <a class="load-post" data-key="0" data-value="<?php echo get_option('posts_per_page') ?>"><?php pll_e('Xem thêm'); ?></a>
            </div>
        </div>
    </section>
</main>

<script type='text/javascript' src='<?= get_template_directory_uri() ?>/dist/js/jquery/jquery.js'></script>
<?php
get_footer();
?>
<script>
    $(document).ready(function () {
        $('.load-post').on('click', function () { // click nút xem thêm
            var numberPage = $(this).data('value'); // biến lấy giá trị ( posts_per_page )
            var dataKey = $(this).data('key');
            var location = $('.location').val();
            var keyWord = $('.keyWord').val();
            var year = $('.year').val();
            var progress = $('.progress').val();
            searchData(keyWord, year, progress, dataKey, location, numberPage)
        });
        // click từng danh mc
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
            var numberPage = $(this).data('value'); // biến ly giá trị ( posts_per_page )
            var dataKey = $(this).data('key');
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
        searchData(); // khong có biến chuyn vào gọi hàm searchData() n ra tất cả các bài viết

        //Search Data
        function searchData(keyWord, year, progress, dataKey, location, numberPage) {
            var link = "<?= admin_url('admin-ajax.php'); ?>";
            var action = "query_all_post";
            $.ajax({
                url: link,
                type: 'POST',
                data: {
                    "action": action,
                    "keyWord": keyWord,
                    "year": year,
                    "progress": progress,
                    "slug": dataKey,
                    "location": location,
                    "number": numberPage,
                },
                dataType: 'json', //dữ liệu trả về dang json
                beforeSend: function () {
                    $('.divgif').css("display", "block");
                },
                success: function (data) {
                    $('.divgif').css("display", "none");
                    $('.row-custom').html(data.html);
                    // $('.html-post').append(data.html1);
                    //in dữ liệu ra th div (class = content-post)
                    // var key = $('.taxonomy-key').val();
                    // console.log(key);
                    // if (key == 0) {
                    //     $('.html-post').html(data.html);
                    // } else if (key == 1 || data.key == 2) {
                    //     $('.one-post').html(data.html);
                    // } else {
                    //     $('.two-post').html(data.html);
                    // }
                    $('.load-post').data('value', data.number);
                    if (data.check == 'hide') { // kim tra giá trị check nếu l hide ẩn class 'load-post'
                        $('.load_news').hide();
                    }
                }
            });
        }
    });

</script>
<script>
      document.addEventListener("contextmenu", (event) => {
         event.preventDefault();
      });
   </script>
