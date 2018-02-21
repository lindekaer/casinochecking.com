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
$sectionBg = get_field('section_bg');
$activateOverlay = get_field('activate_overlay');
?>
<section class="bg-img content-casino z-index-low" style="background-image: url('<?php echo $sectionBg['url']; ?>');">
  <div class="container single-page-padding z-index">
    <div class="row">
      <div class="small-12 medium-8 bg-gray columns slide-up z-index hidden-overflow small-order-1 medium-order-2" id="casino-outer-wrapper">
        <div class="container">
          <div class="row">
            <div class="small-6 columns casino-logo z-index">
              <?php 
              $size = 'thumbnail'; 
              if( $image ) {
                echo wp_get_attachment_image( $image, $imageSize );
              }
              ?>
            </div>
            <div class="small-6 columns casino-info-wrapper align-middle">
              <div class="row">
                <div class="small-12 columns">
                  <div class="heading-blog"><p><?php echo $category; ?></p></div>
                </div>
                <div class="small-12 columns">
                  <div class="category-blog"><h1 class="cursive-headline"><?php echo the_title(); ?></h1></div>                            
                </div>
                <div class="small-12 columns icon-blog">
                  <?php 
                  $size = 'thumbnail';
                  if( $image ) {
                    echo wp_get_attachment_image( $icon, $iconSize );
                  }
                  ?>                            
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="small-12 columns desc">
              <p><?php echo $description; ?></p>
            </div>
          </div>
        </div>
      </div>
      <div class="medium-4 bg-sidebar columns wrapper-casino-comparison slide-up small-order-2 medium-order-1">
        <?php echo get_sidebar(); ?>
      </div>
    </div>
  </div>
</section>
<script type="application/ld+json">
  {
    "@context": "http://schema.org",
    "@type": "NewsArticle",
    "mainEntityOfPage": {
      "@type": "WebPage",
      "@id": "https://casinochecking.com/blog"
    },
    "headline": "<?php echo the_title(); ?>",
    "image": ["<?php echo wp_get_attachment_image_url( $image, 'logo-casino-content');?>",
    "<?php echo wp_get_attachment_image_url( $image, 'logo-casino-archive');?>",
    "<?php echo wp_get_attachment_image_url( $image, 'logo-blog-archive');?>"
    ],
    "author": {
      "@type": "Person",
      "name": "Mads Lundholm"
    },
    "datePublished": "<?php echo get_the_date(); ?>",
    "dateModified": "<?php the_modified_date(); ?>",
    "publisher": {
      "@type": "Organization",
      "name": "Casinochecking",
      "logo": {
        "@type": "ImageObject",
        "url": "https://casinochecking.com/wp-content/uploads/2017/10/casino-logo-white.png"
      }
    },
    "description": "<?php echo substr($description,0,100); ?>"
  }
</script>