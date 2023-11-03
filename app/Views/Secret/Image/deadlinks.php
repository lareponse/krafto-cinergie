<?php $this->layout('Secret::dashboard', ['title' => 'Dead image links']) ?>
<h1><?= $countErrors?> images perdues dans <?= count($errorsByArticle)?> articles</h1>
<?php
foreach ($errorsByArticle as $id => $errors) 
{
    $article = $articleWithErrors[$id];
    echo '<h4><a href="'.$controller->router()->hyp('dash_record_edit', ['nid'=> 'Article', 'id' => $id]).'">'.$article.'</a> ('.$article->get('publication').')</h4>';
    foreach($errors as $url => $errors)
    {
        echo '<p>'.$url.': '.implode('<br>', $errors).'</p>';
    }
}
?>
