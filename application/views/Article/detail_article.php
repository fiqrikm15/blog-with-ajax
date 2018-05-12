<div class="container article-pub" style="width: 60%;">

    <h2><?php echo $article[0]['title']; ?></h2>
    <p style="font-size: 10px"><?php echo anchor(site_url(''), $article[0]['nama']).", Terakhir Di Perbaharui ". date('d-M-y',strtotime($article[0]['last_update']));?></p>
    <hr>

    <br>
    <?php if($article[0]['image'] != null): ?>
        <img style="width: 100%;" src="<?php echo base_url(); ?>uploads/header-img/<?php echo $article[0]['image']; ?>"></img><br><br>
    <?php endif; ?>
    <p class="lead"><?php echo $article[0]['content'];?></p>

</div>