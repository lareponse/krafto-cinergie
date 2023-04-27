<div class="row">
<?php
foreach($people as $person)
{
    echo '<div class="col-lg-6 col-xl-4 col-xxl-3">';
    $this->insert('Secret::Team/_partials/tab-people-card', ['person' => $person]);
    echo '</div>';
}
?>
</div>
