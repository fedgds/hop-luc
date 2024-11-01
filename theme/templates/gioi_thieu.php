<?php
/* Template Name:  Giới thiệu */
get_header();
$url = get_template_directory_uri();
$id = get_the_ID();
$banner = get_field('banner', $id);
$title = get_field('title', $id);
$letters = get_field('letters', $id);
$history_title = get_field('history_title', $id);
$history_desc = get_field('history_desc', $id);
$history_develop = get_field('history_develop', $id);
$value = get_field('value', $id);
$visio = get_field('visio', $id);
$leadership = get_field('leadership', $id);
?>
<style>
    .page-tn .content p {
            color: #000000;
    }
</style>
<main>
    <section class="slides body-hide" id="fullpage">
        <div class="slide section" id="page12">
            <section class="page-banner">
                <div class="img ratio-mb">
                    <img class="w-100 d-block" src="<?= $banner ?>" alt="">
                    <span><?= $title ?></span>
                </div>
            </section>
        </div>
        <div class="slide section" id="page22">
            <section class="page-ld">
                <div class="container">
                    <div class="row align-items-center">
                        <?php foreach ($letters as $let ): ?>
                        <div class="col-md-6">
                            <div class="images wow fadeIn" data-wow-delay="0.3s">
                                <img src="<?= $let['img_letters'] ?>" alt="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="content">
                                <div class="title-main wow fadeInRight" data-wow-delay="0.5s">
                                    <span><?= $let['title_letters'] ?></span>
                                    <h2 class="heading"><?= $let['letters_copy'] ?></h2>
                                </div>
                                <div class="border-left-custom wow fadeInRight" data-wow-delay="0.7s">
                                    <p><?= $let['dis'] ?></p>
                                </div>
                                <p class="wow fadeInRight" data-wow-delay="0.9s"><?= $let['content_letters'] ?></p>
                            </div>
                        </div>
                        <?php endforeach;?>
                    </div>
                </div>
            </section>
        </div>
        <div class="slide section" id="page32">
            <div class="utilities-wrap">
                <div class="utilities-list">
                    <div class="utilities-circle">
                        <div class="utilities-spin">
                            <div class="utilities-list-item active" id="list-icon-utilitis">
                               <ul>
                                    <?php
                                        $i = 1;
                                        foreach ($history_develop as $key => $his):
                                            $pex = (25.7 + ($key * 18.37));
                                            $show_item = isset($his['select_display']) && $his['select_display'] == true;
                                    ?>
                                            <li class="js-leng" style="transform: rotate(<?= $pex ?>deg);">
                                                <span class="line-item-middle-before" style="transform: rotate(-9.185deg);"></span>
                                                <span class="line-item-middle-after" style="transform: rotate(9.185deg);"></span>
                                                <div class="icon-utilitis-wrap">
                                                    <a href="#" id="utiliti-<?= $key + 1 ?>" class="<?php if ($show_item) echo 'active' ?>">
                                                        <div class="icon-utilitis">
                                                            <div class="icon-inner" style="transform: rotate(-90deg);"><?= $his['year'] ?></div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </li>
                                            <?php $i++ ?>
                                    <?php endforeach; ?>
                                </ul>
                                <div class="utilities-section-info">
                                    <p class="utilities-section-title"><?= $history_title; ?></p>
                                    <p class="utilities-section-sub-title"><?= $history_desc; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ulilities-bg">
                </div>
                <div class="ulilities-content">
                    <?php
                        $i = 1;
                        foreach ($history_develop as $key => $his):
                            $show_item = isset($his['select_display']) && $his['select_display'] == true;
                    ?>
                            <div class="utiliti-content-wrap <?= ($show_item) ? 'utiliti-content-active' : '' ?>" id="utiliti-content-<?= $key+1 ?>">
                                <div class="decription-for-utilities-wrap">
                                    <div class="decription-for-utilities">
                                        <div class="utilitie-image-item">
                                            <div class="utilitie-image-item-ratio">
                                                <div class="utilitie-image-item-ratio-inner">
                                                    <img src="<?= $his['img_year'] ?>" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="decription-for-utilitie-p">
                                            <p><?= $his['outstanding'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php $i++ ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="history">
                <div class="container">
                    <div class="title-main">
                        <?php if(pll_current_language() == 'vi'): ?>
                            <h2 class="heading">Lịch Sử</h2>
                            <span>Hình Thành</span>
                        <?php elseif(pll_current_language() == 'en'): ?>
                            <h2 class="heading">Milestones</h2>
                        <?php else: ?>
                            <h2 class="heading">发展</h2>
                            <span>历程</span>
                        <?php endif; ?>
                    </div>
                    <div class="overflow-auto-mb">
                        <ul class="nav">
                            <?php $i=0; ?>
                            <?php foreach ($history_develop as $key => $his): ?>
                                <li class="nav-items">
                                    <a class="nav-link <?php if($i==0) echo 'active' ?>" data-toggle="tab" href="#dis<?php echo $i ?>"><?= $his['year'] ?></a>
                                </li>
                                <?php $i++ ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <?php $k=0 ?>
                        <?php foreach ($history_develop as $key => $his): ?>
                            <div class="tab-pane fade <?php if($k==0) echo 'active show' ?>" id="dis<?php echo $k ?>">
                                <div class="items">
                                    <img class="w-100 d-block" src="<?= $his['img_year'] ?>" alt="">
                                    <p><?= $his['outstanding'] ?></p>
                                </div>
                            </div>
                            <?php $k++ ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="slide section" id="page42">
            <section class="page-gt h-custom">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-7">
                            <div class="title-main">
                                <h2 class="heading wow fadeInDown" data-wow-delay="0.3s"><?= $value['title'] ?></h2>
                            </div>
                            <ul>
                                <?php foreach ($value['val'] as $val): ?>
                                <li class="wow fadeInUp" data-wow-delay="0.7s">
                                    <img src="<?= $val['icon'] ?>" alt="">
                                    <span><?= $val['dis'] ?></span>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="images wow fadeIn" data-wow-delay="1s">
                    <div class="img"><img src="<?= $value['image'] ?>" alt=""></div>
                </div>
            </section>
        </div>
        <div class="slide section" id="page52">
            <section class="page-tn">
                <div class="row m-0">
                    <?php foreach ($visio as $vis):?>
                    <div class="col-md-6 col-custom p-0">
                        <div class="images" style="background-image:url(<?= $vis['backround'] ?>)">
                            <div class="content">
                                <h2 class="wow fadeInLeft" data-wow-delay="0.5s"><?= $vis['title'] ?></h2>
                                <p class="wow fadeInLeft" data-wow-delay="0.5s"><?= $vis['content'] ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;?>
                </div>
            </section>
        </div>
        <div class="slide section" id="page62">
            <section class="page-team h-custom">
                <div class="container">
                    <div class="title-main">
                        <h2 class="heading wow fadeInDown" data-wow-delay="0.5s"><?= $leadership['title_leader'] ?></h2>
                        <p class="wow fadeInDown" data-wow-delay="0.3s"> <?= $leadership['content'] ?></p>
                    </div>
                    <div class="slick-team">
                        <?php foreach ($leadership['leaders'] as $leader): ?>
                        <div class="items wow fadeInUp" data-wow-delay="0.9s">
                            <div class="img">
                                <div class="bg">
                                    <img src="<?= $leader['img'] ?>" alt="">
                                    <div class="content">
                                        <span><?= $leader['position'] ?></span>
                                        <h3><?= $leader['name_leader'] ?></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach;?>
                    </div>
                </div>
            </section>
        </div>
    </section>
    <div id="navigation">
        <div id="nav_wrapper">
            <div class="nav_icon active" id="page1">
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
            <div id="nav_signifier"></div>
        </div>
    </div>
    <div class="navigation-mobile">
        <div id="nav_wrapper">
            <div class="nav_icon">
                <a class="active" href="#page12">01</a>
            </div>
            <div class="nav_icon" >
                <a href="#page22">02</a>
            </div>
            <div class="nav_icon" >
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
        </div>
    </div>
</main>
<?php
get_footer();
?>

<script>
    
</script>
