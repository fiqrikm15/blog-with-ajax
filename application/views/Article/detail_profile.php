<div class="container article-pub" style="width: 60%;">
    <h4 align="center" style="color: #4286ff;"><?php echo $user_data[0]['username']; ?>-Profile</h4>
    <hr>

    <div style="margin: 0 auto; padding: 20px;">
        <?php if($user_data[0]['foto_profile'] != ''): ?>
            <img class="circle-profile" src="<?php echo base_url(); ?>uploads/profiles/<?php echo $user_data[0]['foto_profile']; ?>">
        <?php else: ?>
            <img class="circle-profile" src="<?php echo base_url(); ?>/assets/img/profile.png"></img><br>
        <?php endif; ?>
    </div>
    <table class="table table-hover">
        <tbody>
        <tr>
            <td>Name:</td>
            <td><?php echo $user_data[0]['nama'];?></td>
        </tr>

        <tr>
            <td>Email:</td>
            <td><?php echo $user_data[0]['email'];?></td>
        </tr>

        <tr>
            <td>Jenis Kelamin:</td>
            <td><?php echo $user_data[0]['j_kelamin'];?></td>
        </tr>

        <tr>
            <td>Alamat:</td>
            <td><?php echo $user_data[0]['alamat'];?></td>
        </tr>

        <tr>
            <td>Kode Pos:</td>
            <td><?php echo $user_data[0]['kode_pos'];?></td>
        </tr>

        <tr>
            <td>Agama:</td>
            <td><?php echo $user_data[0]['agama'];?></td>
        </tr>
        </tbody>
    </table>
    <?php echo anchor(site_url('article'), 'Back To Article List', array('class' => 'btn btn-outline-primary btn-block')); ?>
</div>