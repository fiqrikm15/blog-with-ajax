<?php foreach ($article as $articles): ?>
<div class="container article-pub" style="background: white; padding: 20px; width: 60%;">
    <h3><?php echo $articles->title; ?></h3>
    <p style="font-size: 10px"><?php echo anchor(site_url('article/detail_profile/'.$articles->id_user), $articles->nama).", Terakhir Di Perbaharui ". date('d-M-y',strtotime($articles->last_update));?></p>
    <hr>
    <p><?php echo substr($articles->content, 0, 100); echo " ".anchor(site_url('article/detail/'.$articles->id_article), 'Readmore...')?></p>
</div><br>
<?php endforeach; ?>
