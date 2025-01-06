<?php
$category_url = isset($related['category_link']) ? $related['category_link'] : $related_default_links[$related['category']];
?>
<article class="card paysage mr-4 mb-4 slick-slide slick-active" style="width: 332px;" data-slick-index="1" aria-hidden="false" tabindex="0" role="tabpanel" id="slick-slide01">
  <div class="row g-0">
    <div class="col-md-4">
      <a href="<?php echo $related['title_link']; ?>" tabindex="0">
        <img src="<?php echo $related['img']; ?>" class="card-img-left img-fluid rounded-start" alt="...">
      </a>
    </div>

    <div class="col-md-8">
      <div class="card-body">
        <div class="d-flex  gap-2 align-items-center categories">
          <a href="/">Cinergie</a>
          &middot;
          <a href="<?= $category_url ?>"><?php echo ucfirst($related_labels[$related['category']]); ?></a>
        </div>
        <h5 class="card-title">
          <a href="<?php echo $related['title_link']; ?>" tabindex="0">
            <?php echo $related['title']; ?>
          </a>
        </h5>
        <div class="card-links">

          <?php
        foreach ($related['links'] as $title => $url) {
          echo '<a class="" href="' . $url . '" target="_blank"><i class="fas fa-caret-right"></i> <span>' . $title . '</span> </a>';
        }
        ?>
        </div>
      </div>

    </div>

  </div>
</article>