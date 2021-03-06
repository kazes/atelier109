<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

    <div class="wrap single-template">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">

                <?php
                $cat_name = get_the_category($post->ID)[0]->cat_name;
                $all_posts = query_posts('posts_per_page=-1&post_type=post&orderby=date&order=ASC&category_name=' . $cat_name);

                // find index number of the post in its category
                $post_index = 0;
                foreach ($all_posts as $p) {
                    $post_index++;
                    if ($p->ID === $post->ID) {
                        break;
                    }
                }

                // reset the global $post array before using it in the loop
                wp_reset_query();

                // pan to (add extra zeros)
                if (strlen(strval($post_index)) < 2) {
                    $post_index = "0" . strval($post_index);
                }

                function getAttachedImageFromPost($the_post, $format = 'thumbnail')
                {
                    $post_attachments = get_posts(array(
                        'post_type' => 'attachment',
                        'numberposts' => -1,
                        'post_status' => null,
                        'post_parent' => $the_post->ID
                    ));
                    $img_src = $post_attachments ? wp_get_attachment_image_src($post_attachments[0]->ID, $format) : 'no attachment image in this post';
                    //print_r($prev_post);

                    return '<img src="' . $img_src[0] . '" alt="' . $the_post->post_title . '">';
                }

                // get post image
                $attachments = get_posts(array(
                    'post_type' => 'attachment',
                    'numberposts' => -1,
                    'post_status' => null,
                    'post_parent' => $post->ID
                ));
                $post_image = $attachments ? wp_get_attachment_image($attachments[0]->ID, 'medium') : 'no attachment image in this post';
                $post_image_thumb = $attachments ? wp_get_attachment_image($attachments[0]->ID, 'thumbnail') : 'no attachment image in this post';

                /* Start the Loop */
                while (have_posts()) : the_post();

                    ?>
                    <div class="post-container">
                        <div class="nav-container prev-post-container">
                            <div class="nav-link prev-post-link">

                                <?php
                                $next_post = get_next_post(true);
                                if ($next_post) {
                                    $next_post_image = getAttachedImageFromPost($next_post);
                                    next_post_link('%link', '<span class="arrow icon-prev"></span>' . $next_post_image, true);
                                }
                                ?>
                            </div>
                        </div>

                        <div class="post-content">
                            <!-- IMAGE POST -->
                            <div class="image-container">
                                <?php include('inc/back-to-home.inc.php'); ?>
                                <div class="image-post JS_toggler" data-toggler-group="popin" data-toggler-id="popin-gallery">
                                    <div class="pattern"></div>
                                    <?php echo $post_image; ?>
                                </div>
                                <a href="#" class="button JS_toggler" data-toggler-group="popin" data-toggler-id="popin-gallery">
                                    <?php echo __('[:fr]En détails[:en]More details[:es]More details'); ?>
                                </a>
                            </div>

                            <!-- TEXT CONTENT -->
                            <div class="content-container">
                                <div class="post-number">
                                    &lt;<?php echo $post_index; ?>&gt;
                                </div>

                                <h1 class="post-title">
                                    <?php the_title(); ?>
                                </h1>

                                <div class="the-content">
                                    <?php the_content(); ?>
                                </div>

                                <a href="#" class="button button-big bg-2 JS_toggler" data-toggler-group="popin" data-toggler-id="popin-more">
                                    <?php echo __('[:fr]Commander[:en]Order[:es]Order'); ?>
                                </a>
                            </div>
                        </div>


                        <div class="nav-container next-post-container">
                            <div class="nav-link next-post-link">
                                <?php
                                $prev_post = get_previous_post(true);
                                if ($prev_post) {
                                    $prev_post_image = getAttachedImageFromPost($prev_post);
                                    previous_post_link('%link', '<span class="arrow icon-next"></span>' . $prev_post_image, true);
                                }
                                ?>
                            </div>
                        </div>
                    </div>


                    <?php

                endwhile; // End of the loop.
                ?>

            </main><!-- #main -->
        </div><!-- #primary -->
    </div><!-- .wrap -->


    <!-- POPIN GALLERY -->
    <!-- params ($popin_name='popin-gallery')-->
    <div class="popin popin-gallery JS_item_toggler" data-toggler-itemid="popin-gallery" data-toggler-group="popin">

        <!-- MASK -->
        <div class="mask JS_toggler" data-toggler-id="popin-gallery" data-toggler-group="popin" data-toggler-action="close"></div>

        <!-- POPIN CONTENT -->
        <div class="content-scroll">
            <div class="content-wrapper">
                <div class="popin-content">
                    <div class="popin-ground">
                        <!-- CLOSE -->
                        <span class="popin-close JS_toggler" data-toggler-id="popin-gallery" data-toggler-group="popin" data-toggler-action="close">
                            <i class="icon-close"></i>
                        </span>


                        <div class="owl-carousel images-list">
                            <?php
                            if ($attachments) {
                                foreach ($attachments as $attachment) {
                                    echo '<div class="image-cover" style="background-image: url('.wp_get_attachment_image_src($attachment->ID, "large")[0].')"></div>';
                                }
                            }
                            ?>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- POPIN CONTACT -->
    <div class="popin JS_item_toggler" data-toggler-itemid="popin-more" data-toggler-group="popin">

        <!-- MASK -->
        <div class="mask JS_toggler" data-toggler-id="popin-more" data-toggler-group="popin" data-toggler-action="close"></div>

        <!-- POPIN CONTENT -->
        <div class="content-scroll">
            <div class="content-wrapper">
                <div class="popin-content">
                    <div class="popin-ground">
                        <!-- CLOSE -->
                        <span class="popin-close JS_toggler" data-toggler-id="popin-more" data-toggler-group="popin" data-toggler-action="close">
                            <i class="icon-close"></i>
                        </span>

                        <!-- TITLE -->
                        <h1 class="title">
                            Votre création atelier 109 est réalisée sur-mesure
                        </h1>

                        <div class="contact-container">
                            <div class="thumbnail">
                                <?php echo $post_image_thumb; ?>
                            </div>

                            <div class="message">
                                <p class="intro">
                                    Parlez moi de vos envies de couleurs et de tissus. Je vous enverrai une proposition
                                    personnalisée.
                                </p>
                                <!-- FORM -->
                                <?php echo do_shortcode('[contact-form-7 id="49" title="Contact form 1"]'); ?>
                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
<?php get_footer();

