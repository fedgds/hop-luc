<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package theme
 */
$url = get_template_directory_uri();
// Footer
$logo = get_field('logo_footer', 'option');
$qrcode = get_field('qrcode', 'option');
$link_page = get_field('link_page', 'option');
$follow = get_field('follow', 'option');
$networks = get_field('networks', 'option');
$copyright = get_field('copyright', 'option');
$brach1 = get_field('brach1', 'option');
$contact = get_field('contact', 'option');

// Header
$logo_header = get_field('logo_header', 'option');
$company = get_field('company', 'option');
$facebook = get_field('facebook', 'option');
$youtube = get_field('youtube', 'option');
$inline = get_field('inline', 'option');
?>

<?php if ( is_front_page() ) :  ?>

<?php else: ?>
    <footer class="footer footer-none" style="background-image: url(<?= $url ?>/dist/images/bg-footer.png);">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-custom">
                <div class="footer_content footer_logo">
                    <div class="logo">
                        <a href="<?= home_url() ?>"><img src="<?= $logo ?>" alt=""></a>
                        <div class="qr">
                            <img src="<?= $qrcode ?>" alt="">
                        </div>
                    </div>
                    <div>
                        <div class="flow">
                            <span><?= $follow ?></span>
                            <div class="mxh">
                                <a href="<?= $networks['linkfa'] ?>"><i class="fa-brands fa-facebook-f"></i></a>
                                <a href="<?= $networks['linkyu'] ?>"><i class="fa-brands fa-youtube"></i></a>
                            </div>
                        </div>
                        <div class="coppy"><?= $copyright ?></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-custom">
                <div class="footer_content">
                    <?php foreach ($brach1 as $value): ?>
                    <div class="items-address">
                        <h4 class="heading-ft"><?= $value['name_brach'] ?></h4>
                        <p><?= $value['address'] ?></p>
                    </div>
                    <?php endforeach;?>
                </div>
            </div>
            <div class="col-md-4 col-custom">
                <div class="footer_content">
                    <h4 class="heading-ft"><?php pll_e('Liên hệ'); ?></h4>
                    <ul>
                        <li><img src="<?= $url ?>/dist/images/icon dia chi-01.png" alt=""><span><?= $contact['address_footer'] ?></span></li>
                        <li><img src="<?= $url ?>/dist/images/icon dia chi-02.png" alt=""><span><?= $contact['hotline'] ?></span></li>
                        <li><img src="<?= $url ?>/dist/images/icon dia chi-03.png" alt=""><span><?= $contact['email'] ?></span></li>
                        <li><a class="btn-custom" href="<?= $link_page ?>"><?php pll_e('TUYỂN DỤNG'); ?></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php endif ?>
<section class="menu-main">
    <div class="content">
        <div class="icon">
            <div class="js-search">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <div class="js-close">
                <i class="fa-solid fa-xmark"></i>
            </div>
        </div>
        <div class="w-100">
            <div class="menu">

                <ul>
                    <?php
                    wp_nav_menu(array(
                        'theme_location'  => 'menu-1',
                        'container'       => '__return_false',
                        'fallback_cb'     => '__return_false',
                        'items_wrap'      => '%3$s',
                        'depth'           => 2,

                    ));
                    ?>
                </ul>
            </div>
            <div class="mxh">
                <a href="<?= $facebook ?>"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="<?= $youtube ?>"><i class="fa-brands fa-youtube"></i></a>
                <a href="<?= $inline ?>"><i class="fa-brands fa-linkedin"></i></a>
            </div>
            <div class="member">
                <p><?= $company ?></p>
                <div class="logo-member">
                    <?php foreach ($logo_header as $log):  ?>
                    <a href="<?= $log['link'] ?>">
                        <img src="<?= $log['logo'] ?>">
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="search-form">
    <div class="js-close-s">
        <i class="fa-solid fa-xmark"></i>
    </div>
    <div class="content">
        <form action="<?= home_url()?>">
            <input class="form-control" name="s" placeholder="Tìm kiếm" type="text">
            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
    </div>
</section>
<section class="pp-rec">
    <div class="content">
        <div class="title-main text-center">
            <h3 class="heading"><?php pll_e('Nộp đơn ứng tuyển'); ?></h3>
        </div>
        <div class="close-h"><i class="fa-solid fa-xmark"></i></div>
        <?php
        if(ICL_LANGUAGE_CODE == 'vi' || ICL_LANGUAGE_CODE == ''){
            echo do_shortcode('[contact-form-7 id="676" title="Tuyển dng"]');
        }elseif (ICL_LANGUAGE_CODE == 'en'){
            echo do_shortcode('[contact-form-7 id="797" title="Tuyển dng_en"]');
        }elseif (ICL_LANGUAGE_CODE == 'zh'){
            echo do_shortcode('[contact-form-7 id="3041" title="Tuyển dụng_cn"]');
        }?>
    </div>
</section>
<!-- Messenger Plugin chat Code -->
    <div id="fb-root"></div>

    <!-- Your Plugin chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "2592905857601950");
      chatbox.setAttribute("attribution", "biz_inbox");
    </script>

    <!-- Your SDK code -->
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v16.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>
<?php
wp_footer();
?>

<script src="<?= $url ?>/dist/fullpage/fullpage.min.js"></script>
<script src="<?= $url ?>/dist/wowjs/dist/wow.min.js"></script>
<script type="text/javascript" src="<?= $url ?>/dist/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?= $url ?>/dist/box/jquery.fancybox.min.js"></script>
<script type="text/javascript" src="<?= $url ?>/dist/menu-mobile/hc-offcanvas-nav.js"></script>
<script type="text/javascript" src="<?= $url ?>/dist/js/main.js"></script>
<script src="<?= $url ?>/Assets/js/main.js"></script>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-15MEMY9XJZ"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-15MEMY9XJZ');
</script>
</body>

</html>

