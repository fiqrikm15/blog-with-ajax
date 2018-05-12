<nav class="navbar navbar-expand-lg navbar navbar-dark bg-primary sticky-top">
    <a class="navbar-brand" href="#">
        <img src="<?php echo base_url();?>/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="">
        IDts.Web.Id
    </a>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
        <?php echo anchor(site_url('admin'), 'Article List', 'class="nav-link active"'); ?>
        <?php echo anchor(site_url('admin/create_article'), 'Create Article', 'class="nav-link active"'); ?>
            <?php echo anchor(site_url('user'), 'Login', array('class'=>"nav-item nav-link"));?>
            <?php echo anchor(site_url('user/register'), 'Register', array('class'=>"nav-item nav-link"));?>
        </div>
    </div>
</nav><br>
