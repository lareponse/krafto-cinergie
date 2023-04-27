<?php $this->layout('Secret::dashboard', ['title' => 'Partenaires']) ?>


<div class="row">
<?php
    foreach($partners as $partner)
{
    echo '<div class="col-lg-6 col-xl-4 col-xxl-3">';
    $this->insert('Secret::Partner/_partials/tab-partner-card', ['partner' => $partner]);
    echo '</div>';
}
?>
</div>
