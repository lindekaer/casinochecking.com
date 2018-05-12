<a href="<?php the_permalink(); ?>">
    <div class="blog-content">
        <?php
        $image = get_field('blog_image');
        $size = 'logo-blog-archive'; ?>

        <div class="blog-img-wrapper"
             style="background-image: url(<?php if ($image): echo wp_get_attachment_image_url($image, $size); endif; ?>);"></div>
        <div class="text-wrapper columns">
            <div class="category">
                <p><?php the_field('blog_category'); ?></p>
            </div>
            <h5 class="cursive-headline blog-headline"><?php the_title(); ?></h5>
            <div class="blog-icon">
                <?php
                $images = get_field('blog_icon');
                $sizes = 'thumbnail'; // (thumbnail, medium, large, full or custom size)
                if ($images) {
                    echo wp_get_attachment_image($images, $sizes);
                }
                ?>
            </div>
            <div class="blog-text">
                <?php $desc = strip_tags(get_the_content()); ?>
                <p><?php echo substr($desc, 0, 100) . ' [...]'; ?></p>
            </div>
</a>
</div>
</div>
