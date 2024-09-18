<article class="qodef-e swiper-slide qodef-item--square  podcast-item type-podcast-item status-publish has-post-thumbnail hentry podcast-category-microphone podcast-tag-tag swiper-slide-prev" data-swiper-slide-index="0" style="width: 778.333px; margin-right: 80px;">
  <a itemprop="url" href="<?php echo $related['title_link']; ?>">
    <img width="650" height="650" src="<?php echo $related['img']; ?>" class="attachment-resonator_image_size_square size-resonator_image_size_square wp-post-image" alt="a" loading="lazy" srcset="<?php echo $related['img']; ?> 650w, <?php echo $related['img']; ?> 150w, <?php echo $related['img']; ?> 768w, <?php echo $related['img']; ?> 600w, <?php echo $related['img']; ?> 100w, <?php echo $related['img']; ?> 800w" sizes="(max-width: 650px) 100vw, 650px"> </a>
  <div class="qodef-info-top">
    <div class="qodef-e-episode-number">Cinergie </div>
    <div class="qodef-e-info-category">
      <a itemprop="url" class="qodef-e-category" href="<?php if (isset($related['category_link'])) echo $related['category_link'];
                                                        else echo $related_default_links[$related['category']]; ?>"><?php echo ucfirst($related_labels[$related['category']]); ?></a>
    </div>
  </div>
  <h4 itemprop="name" class="qodef-e-title entry-title">
    <a itemprop="url" class="qodef-e-title-link" href="<?php echo $related['title_link']; ?>"><?php echo $related['title']; ?></a>
  </h4>
  <div class="qodef-e-read-more">
    <?php
    foreach ($related['links'] as $title => $url) {
      echo '
          <a class="qodef-shortcode qodef-m  qodef-button qodef-layout--textual  qodef-html--link" href="' . $url . '" target="_blank">
            <i class="fas fa-caret-right"></i> <span class="qodef-m-text">' . $title . '</span> </a>
          ';
    }
    ?>
  </div>
</article>