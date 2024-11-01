<div></div>
<?php
/* Template Name:  Ngun lực */


get_header();
?>

<?php
$url = get_template_directory_uri();
$banner = get_field('banner', get_the_ID());
$title = get_field('title', get_the_ID());
$human_resource = get_field('human_resource', get_the_ID());
$power_finance = get_field('power_finance', get_the_ID());
$system = get_field('system', get_the_ID());
$province = callProvince();
$idpost = $_GET['idpost'];
$provinces = $_GET['provinces'];
$ditricts = $_GET['ditricts'];
if (!empty($idpost)) {
    $args = new WP_Query(array(
        'post_type' => 'du_an',
        'posts_per_page' => -1,
        'post__in' => array($idpost),
    ));
} else {
    $args = new WP_Query(array(
        'post_type' => 'du_an',
        'posts_per_page' => -1,
    ));
}

$arr_project = $args->posts;
//print_r($arr_project);die;
$terms = get_terms(array(
    'taxonomy' => 'danh_muc_vi_tri',
    'hide_empty' => false,
));

$arr_taxonomy = [];
foreach ($terms as $ter => $item) {
    $arr_taxonomy[$ter]->id = $item->ID;

}

$arr_post = [];
foreach ($arr_project as $key => $value) {
    $arr_post[$key]->id = $value->ID;
    $arr_post[$key]->post_title = $value->post_title;
    $arr_post[$key]->image = get_the_post_thumbnail($value->ID);
    $arr_post[$key]->link = get_permalink($value->ID);

    $investor = get_field('investor', $value->ID);
    $address = get_field('address', $value->ID);
    $range = get_field('range', $value->ID);
    $highlights = get_field('highlights', $value->ID);
    $project_progress = get_field('project_progress', $value->ID);
    $ditricts = get_field('ditricts', $value->ID);
    $longitude = get_field('longitude', $value->ID);
    $latitude = get_field('latitude', $value->ID);

    $arr_post[$key]->investor = $investor;
    $arr_post[$key]->address = $address;
    $arr_post[$key]->range = $range;
    $arr_post[$key]->highlights = $highlights;
    $arr_post[$key]->project_progress = $project_progress;
    $arr_post[$key]->ditricts = $ditricts;
    $arr_post[$key]->longitude = $longitude;
    $arr_post[$key]->latitude = $latitude;

}


?>
<style>
    #map {
        height: 100%;
    }

    .tiptip-content h3 {
        font-size: 16px;
    }

    .tiptip-content .img-icon {
        border-radius: 10px;
        height: 50px !important;
    }

    .page-tc .content .filter-project .list .items h3 {
        color: #220916;
    }
</style>

<main>
    <div class="divgif">
        <img class="iconloadgif" src="<?= $url ?>/dist/images/loading2.gif" alt="">
    </div>
    <section class="page-banner-nl">
        <div class="img ratio">
            <img class="w-100 d-block" src="<?= $banner['img'] ?>" alt="">
        </div>
        <div class="content">
            <div class="container">
                <div class="title-main">
                    <h2 class="heading"><?= $banner['title'] ?></h2>
                </div>
            </div>
        </div>
    </section>
    <!--        <button hidden id="clickButton" data-autoscroll>CLICK</button>-->
    <!--        <button id="test-but"> CLICK</button>-->
    <section class="page-nnl">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="images wow fadeInLeft" data-wow-delay="0.3s">
                        <div class="img ratio">
                            <img src="<?= $human_resource['img'] ?>" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="content">
                        <div class="title-main wow fadeInRight" data-wow-delay="0.7s">
                            <h2 class="heading"><?= $human_resource['title'] ?></h2>
                            <p><?= $human_resource['dis'] ?></p>
                        </div>
                        <div class="text wow fadeInRight" data-wow-delay="0.7s">
                            <h3>
                                <span><?= $human_resource['total']['title'] ?></span> <?= $human_resource['total']['number'] ?>
                                <img src="<?= $url ?>/dist/images/user.png" alt=""></h3>
                            <ul>
                                <?php foreach ($human_resource['total']['office_block'] as $office): ?>
                                    <li><span><?= $office['name'] ?></span>
                                        <div><?= $office['number'] ?> <i class="fa-solid fa-user"></i></div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="page-tc" style="background-image: url(<?= $power_finance[0]['img'] ?>);">
        <div id="scroll-test" class="content wow fadeInLeft" data-wow-delay="0.3s">
            <h2><?= $power_finance[0]['title'] ?></h2>
            <div class="v">
                <img src="<?= $power_finance[0]['icon'] ?>" alt="">
                <div class="v-text">
                    <span><?= $power_finance[0]['capital'] ?></span>
                    <h3><?= $power_finance[0]['amount_capital'] ?> <?php pll_e('dự án'); ?></h3>
                </div>
            </div>
            <h5><?php pll_e('Tìm kiếm dự án'); ?></h5>
            <div class="filter-project">
                <form id="form" class="form" action="" method="get">
                    <div class="form-group">
                        <select class="form-control  location" name="calc_provinces" required="" id="calc_provinces">
                            <option value=""><?php pll_e('Tỉnh / Thành phố'); ?></option>
                            <?php foreach ($province as $key => $value): ?>
                                <option name="provinces" class="provinces" data-key="<?= $value['codename'] ?>"
                                        data-id="<?= $value['id_province'] ?>" value=""><?= $value['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control  calc_district" name="calc_district" required="" id="calc_district">
                            <option value=""><?php pll_e('Quận / Huyện'); ?></option>
                        </select>
                    </div>
                </form>
                <div class="list wow fadeInDown query-recruit" data-wow-delay="0.5s">
                    
                </div>
            </div>
        </div>
        <div class="home__map">
            <div class="map" id="map">

            </div>
        </div>
    </section>
    <section class="page-sytem">
        <div class="container">
            <div class="title-main wow fadeInUp" data-wow-delay="0.3s">
                <h2 class="heading"><?= $system['title'] ?></h2>
                <p><?= $system['content'] ?></p>
            </div>
            <div class="slick-sytem slick-nav-custom">
                <?php foreach ($system['image'] as $content): ?>
                    <div class="items wow fadeInUp" data-wow-delay="0.7s">
                        <div class="images">
                            <a class="img ratio d-block" data-fancybox href="<?= $content['img'] ?>">
                                <img src="<?= $content['img'] ?>" alt="">
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>
<?php
get_footer();
?>
<script>
    $(document).ready(function () {
        $('select#calc_provinces').change(function () {
            var keycode = $(this).children("option:selected").data('id');
            var link = "<?= admin_url('admin-ajax.php'); ?>";
            var action = "get_ditricts";
            $.ajax({
                url: link,
                type: 'POST',
                data: {
                    "action": action,
                    "keycode": keycode,
                },
                dataType: 'json', //dữ liệu trả v dang json
                success: function (data) {
                    $('.calc_district').html(data.html);
                }
            });

        });
    });
</script>

<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js"></script>

<script>
    var markersOnMap = [];
    var InforObj = [];
    var markers = [];
    var inforwindows = [];
    var map;
    $(document).ready(function () {
        $('select.calc_district').change(function () {
            // $('#form').submit();
            var province = $('select#calc_provinces').children("option:selected").data('key');
            var district = $(this).children("option:selected").data('key');
            var id = $('.title-map').data('key');
            console.log(province);
            console.log(district);
            searchData(id, province, district);
        });
        $('body').on('click','.title-map', function () {
            // $('#form').submit();
            var id = $(this).data('key');
            var province = $('select#calc_provinces').children("option:selected").data('key');
            var district = $('select.calc_district').children("option:selected").data('key');
            console.log(id);
            searchData(id, province, district);
        });
        searchData();
        // var return_first = (function () {
    });
    function searchData(id,province, district) {
        var link = "<?= admin_url('admin-ajax.php'); ?>";
        var action = "province_ditricts";
        $.ajax({
            url: link,
            type: 'POST',
            data: {
                "action": action,
                "province": province,
                "district": district,
                "id": id,
            },
            dataType: 'json', //dữ liệu trả v dang json
            beforeSend: function () {
                $('.divgif').css("display", "block");
            },
            success: function (data) {
                markers = [];
                markersOnMap = [];

                $('.divgif').css("display", "none");
                $('.query-recruit').html(data.html);
                var key = 0;
                var maps_1 = JSON.parse(data.post);
                if (maps_1.length > 0) {
                    var centerCords = {
                        lat: Number(maps_1[0].latitude),
                        lng: Number(maps_1[0].longitude)
                    };
                } else {
                    var centerCords = {
                        lat: Number(20.9925),
                        lng: Number(105.847)
                    };
                }
                var id = 0;
                maps_1.forEach(function (val) {
                    var clonedobj = {
                        LatLng: [{
                            lat: Number(val.latitude),
                            lng: Number(val.longitude)
                        }],
                        id: '#map' + id,
                        title: val.post_title,
                        address: val.address,
                        image: val.image,
                        investor: val.investor,
                        highlights: val.highlights,
                        range: val.range,
                        project_progress: val.project_progress,
                        link: val.link,
                    };
                    markersOnMap.push(clonedobj);
                    id = id + 1;
                });

                map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 6,
                    center: {
                        lat: Number(13.7830),
                        lng: Number(105.2197)
                    },
                    datalessRegionColor: 'transparent',
                });
                addMarkerInfo();

            }
        });
    }

    var return_first;

    function callback(response) {
        return_first = response;
        return return_first;
    }

    var image = '<?= $url; ?>/dist/images/location.png';
    var loca = '<?= $url; ?>/dist/images/i-da2.png';
    var iconves = '<?= $url; ?>/dist/images/i-da1.png';
    var iconra = '<?= $url; ?>/dist/images/i-da4.png';
    var iconpro = '<?= $url; ?>/dist/images/i-da3.png';
    var name_inves = '<?php pll_e('Chủ đầu tư'); ?>'
    var name_address = '<?php pll_e('Địa chỉ'); ?>'
    var name_lo = '<?php pll_e('Tiến độ'); ?>'
    var name_pro = '<?php pll_e('Phạm vi công việc'); ?>'

    function addMarkerInfo() {
        for (var i = 0; i < markersOnMap.length; i++) {
            var contentString =
                '<div class="tiptip-content ws-tiptip">' +
                '<div class="top">' +
                '<div class="text">' +
                '<a href="' + markersOnMap[i].link + '">' +
                '<h3>' + markersOnMap[i].title + '</h3>' +
                '<div class="desc">' +
                '<p>' + markersOnMap[i].highlights + '</p>' +
                '</div>' +
                '<div class="action">' +
                '<a href="' + markersOnMap[i].link + '"><?php pll_e('Tìm hiểu thêm'); ?></a>' +
                '</div>' +
                '</div>' + '<div>' +
                '<img src="' + markersOnMap[i].image +
                '</div>' +
                '</div><div class="bot">' +
                '<div class="child"><div class="image"><img src="' + iconves + '"></div><div class="text"><h4>'+ name_inves +'</h4><p>' + markersOnMap[i].investor + '</div></div>' +
                '<div class="child"><div class="image-icon"><img src="' + loca + '"></div><div class="text"><h4>'+ name_address +'</h4><p>' + markersOnMap[i].address + '</div></div>' +
                '<div class="child"><div class="image"><img src="' + iconpro + '"></div><div class="text"><h4>'+ name_lo +'</h4><p>' + markersOnMap[i].project_progress + '</div></div>' +
                '<div class="child"><div class="image"><img src="' + iconves + '"></div><div class="text"><h4>'+ name_pro +'</h4><p>' + markersOnMap[i].range + '</div></div>' +
                '</div>';
            var a = Number(markersOnMap[i].LatLng[0].lat);
            var b = Number(markersOnMap[i].LatLng[0].lng);
            const marker = new google.maps.Marker({
                position: markersOnMap[i].LatLng[0],
                map: map,
                icon: image,
            }, {location: new google.maps.LatLng(a, b), weight: 3});
            const infowindow = new google.maps.InfoWindow({  // khai báo hằng chứa nội dung
                content: contentString,
                maxWidth: 300,
            });
            if (markersOnMap.length == 1) {
                closeOtherInfo();
                infowindow.open(marker.get('map'), marker);
                InforObj[0] = infowindow;
                map.setZoom(15);
                map.setCenter(marker.getPosition());
                $('.map').addClass("active");
            } else {
                google.maps.event.addListener(marker, 'click', function () {
                    closeOtherInfo();
                    infowindow.open(marker.get('map'), marker);
                    InforObj[0] = infowindow;
                    map.setZoom(15);
                    map.setCenter(marker.getPosition());
                    $('.map').addClass("active");
                });
            }

            markers.push(marker);
            inforwindows.push(infowindow);
        }
        const markerCluster = new markerClusterer.MarkerClusterer({map, markers});
    }

    function closeOtherInfo() {
        if (InforObj.length > 0) {
            /* detach the info-window from the marker ... undocumented in the API docs */
            InforObj[0].set("marker", null);
            /* and close it */
            InforObj[0].close();
            /* blank the array */
            InforObj.length = 0;
        }
    }

  

</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDWWgSW8tvSWDFEo_xwAQjQBu6YYkPfVNo&callback=initMap"
        type="text/javascript"></script>

