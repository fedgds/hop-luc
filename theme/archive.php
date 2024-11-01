<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package theme
 */

get_header();

$url = get_template_directory_uri();
$term = get_queried_object();
$category = get_terms(array(
    'taxonomy' => 'category',
    'hide_empty' => false,
));

$args1 = new WP_Query(array(
    'post_type' => 'post',
    'posts_per_page' => 1,
    'orderby' => 'date',
    'order' => 'DESC',
    'tax_query' => array(
        'relation' => 'AND',
        array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => $term->slug,
        ),
    ),
));
$post1 = $args1->posts;

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$arr = array(
    'post_type' => 'post',
    'posts_per_page' => get_option('posts_per_page'),
    'paged' => $paged,
    'orderby' => 'date',
    'order' => 'DESC',
    'tax_query' => array(
        'relation' => 'AND',
        array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => $term->slug,
        ),
    ),
);
$args = new WP_Query($arr);
$post = $args->posts;
//print_r($args);die;
?>

    <main>
        <section class="page-banner-nl">
            <div class="img ratio">
                <img class="w-100 d-block" src="<?= get_field('ban', $term) ?>" alt="">
            </div>
            <div class="content">
                <div class="container">
                    <div class="title-main">
                        <h2 class="heading"><?= $term->description ?></h2>
                    </div>
                </div>
            </div>
        </section>
        <section class="page-linhvuc page-duan">
            <div class="container">
                <div class="tab-lv">
                    <ul>
                        <?php foreach ($category as $cate): ?>
                            <?php
                            $link_id = '';
                            if (ICL_LANGUAGE_CODE == 'vi') {
                                $link_id = '4481';
                            } elseif (ICL_LANGUAGE_CODE == 'en') {
                                $link_id = '4486';
                            } else {
                                $link_id = '4485';
                            }
                            ?>
                            <?php if ($cate->slug == 'tin_tuc' || $cate->slug == 'new-en' || $cate->term_id == '34' ): ?>
                                <li><a class="<?= ($cate->slug == $term->slug) ? 'active' : '' ?>" href="<?= get_page_link($link_id) ?>"><?php pll_e('Tất cả'); ?></a></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <?php foreach ($category as $cate): ?>
                            <?php $link =  get_category_link($cate->term_id) ?>
                            <?php if ($cate->parent == 7 || $cate->parent == 38 || $cate->parent == 34): ?>
                                <li><a class="<?= ($cate->slug == $term->slug) ? 'active' : '' ?>" href="<?= $link ?>"><?= $cate->name ?></a></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="news-archive">
                    <div class="list-archive">
                        <div class="row">
                            <?php foreach ($post as $key => $value): ?>
                                    <div class="col-md-4">
                                        <div class="items-news">
                                            <a class="img ratio" href="<?= get_permalink($value->ID) ?>">
										<span class="overflow-news">
											<?= get_the_post_thumbnail($value->ID) ?>
										</span>
                                            </a>
                                            <h3><a href="<?= get_permalink($value->ID) ?>"><?= $value->post_title ?></a></h3>
                                            <a class="more" href="<?= get_permalink($value->ID) ?>"><?php pll_e('Tìm hiểu thêm'); ?></a>
                                        </div>
                                    </div>

                            <?php endforeach; ?>
                        </div>
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

            </div>
        </section>
    </main>
<?php
get_footer();
?>