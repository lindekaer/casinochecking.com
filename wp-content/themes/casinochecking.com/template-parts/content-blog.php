<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package checkmate
 */

$name = get_field('name');
$image = get_field('blog_image');
$description = get_the_content();
$category = get_field('blog_category');
$imageSize = 'logo-casino-content';
$iconSize = 'full';
$icon = get_field('blog_icon');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="container minus-margin">
        <div class="row">
            <div class="small-4 columns bg-sidebar wrapper-casino-comparison border-radius-left">
                <?php echo get_sidebar(); ?>
            </div>
            <div class="small-8 columns bg-gray border-radius-right" id="casino-outer-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="small-5 columns casino-logo">
                            <?php 
                            $size = 'thumbnail'; // (thumbnail, medium, large, full or custom size)
                            if( $image ) {
                                echo wp_get_attachment_image( $image, $imageSize );
                            }
                            ?>
                        </div>
                        <div class="small-7 columns casino-info-wrapper">
                            <div class="container">
                                <div class="row">
                                    <div class="small-12 columns">
                                        <div class="heading-blog"><p><?php echo $category; ?></p></div>
                                    </div>
                                    <div class="small-12 columns">
                                        <div class="category-blog"><h1 class="cursive-headline"><?php echo the_title(); ?></h1></div>                            
                                    </div>
                                    <div class="small-12 columns icon-blog">
                                        <?php 
                                         $size = 'thumbnail'; // (thumbnail, medium, large, full or custom size)
                                         if( $image ) {
                                          echo wp_get_attachment_image( $icon, $iconSize );
                                      }
                                      ?>                            
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                    <div class="small-12 columns desc">
                        <?php echo $description; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</article><!-- #post-<?php the_ID(); ?> -->
