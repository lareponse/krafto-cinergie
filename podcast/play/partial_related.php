<section style="margin:10em auto;" class="elementor-section elementor-top-section elementor-element elementor-element-522d87b elementor-section-full_width elementor-section-height-default elementor-section-height-default qodef-elementor-content-no" data-id="522d87b" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
<div class="elementor-container elementor-column-gap-default">
  <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-eb5d2a8" data-id="eb5d2a8" data-element_type="column">
    <div class="elementor-widget-wrap elementor-element-populated">
      <div class="elementor-element elementor-element-3e8bc47 elementor-widget-mobile__width-initial elementor-widget elementor-widget-resonator_core_section_title" data-id="3e8bc47" data-element_type="widget"
        data-widget_type="resonator_core_section_title.default">
        <div class="elementor-widget-container">
          <div class="qodef-shortcode qodef-m  qodef-section-title qodef-alignment--center ">
            <h2 class="qodef-m-title">En savoir plus sur <?php echo $show_data['name'];?>: </h2>
            <p class="qodef-m-text">Découvrez nos contenus exclusifs sur cinergie.be</p>
          </div>
        </div>
      </div>
      <div class="elementor-element elementor-element-455697a elementor-widget elementor-widget-resonator_core_podcast_list" data-id="455697a" data-element_type="widget" data-widget_type="resonator_core_podcast_list.default">
        <div class="elementor-widget-container">
          <div
            class="qodef-shortcode qodef-m qodef-podcast-list qodef-indent-slider--yes qodef-item-layout--info-right qodef-grid qodef-swiper-container qodef-gutter--huge qodef-col-num--3 qodef--no-bottom-space qodef-pagination--off qodef-responsive--predefined swiper-container-initialized swiper-container-horizontal qodef-swiper--initialized"
            data-options="{&quot;slidesPerView&quot;:&quot;3&quot;,&quot;spaceBetween&quot;:80,&quot;centeredSlides&quot;:true,&quot;loop&quot;:true,&quot;autoplay&quot;:true,&quot;speed&quot;:&quot;&quot;,&quot;speedAnimation&quot;:&quot;&quot;,&quot;slideAnimation&quot;:&quot;&quot;}">
            <div class="swiper-wrapper" style="transition-duration: 0ms; transform: translate3d(-2575px, 0px, 0px);">

            <?php

            $related_items = $show_data['related'];

            foreach($related_items as $related){
              $related_links = [];
              if(isset($related['links']))
                $related_links = $related['links'];

              if ($related['category'] == 'personne')
              {
                $related['title'] = 'Réalisatrice';
                $related['title_link'] = $show_data['cinergie'];
                $related['links'] = array_merge([
                  'La fiche' => $related['title_link'],
                  'Les actualités' => 'https://www.cinergie.be/actualites?searchgo=go&actu_search%5Bsubject%5D=***&group=actualites&actu_search%5Bfreeterm%5D='.str_replace(' ', '+', strtolower($show_data['name']))
                ], $related_links);
              }

              require('partial_related_item.php');
            }

             ?>

            </div>
            <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets"><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 1"></span><span
                class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0" role="button" aria-label="Go to slide 2"></span><span class="swiper-pagination-bullet" tabindex="0" role="button"
                aria-label="Go to slide 3"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 4"></span></div>
            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
