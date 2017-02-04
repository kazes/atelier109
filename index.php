<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

    <div class="wrap page-index">
        <?php

        $button_text = array(
            "mode-flamenco-femme" => "créations sur mesure",
            "doudous" => "découvrir",
            "tenue-de-ceremonie" => "créations sur mesure",
            "mode-flamenco-enfant" => "découvrir"
        );

        //for each category, show 5 posts
        $cat_args = array(
            'orderby' => 'name',
            'order' => 'ASC'
        );
        $categories = get_categories($cat_args);

        foreach ($categories as $category) {
            $post_args = array(
                'showposts' => 1,
                'category__in' => array($category->term_id),
                'caller_get_posts' => 1
            );
            $posts = get_posts($post_args);
            if ($posts) {
                foreach ($posts as $post) {
                    setup_postdata($post); ?>

                    <div class="cover">
                        <div class="image">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/<?php echo $category->slug; ?>-cover-home.jpg" alt="">
                        </div>
                        <div class="pattern"></div>
                        <div class="layout">
                            <div class="title h2">
                                <?php echo $category->name; ?>
                            </div>
                            <a href="<?php the_permalink() ?>" class="button bg-2 button-bigger">
                                <?php echo $button_text[$category->slug]; ?>
                            </a>
                        </div>
                    </div>
                    <?php
                } // foreach($posts
            } // if ($posts
        } // foreach($categories
        ?>

    </div><!-- .wrap -->

<?php get_footer();
