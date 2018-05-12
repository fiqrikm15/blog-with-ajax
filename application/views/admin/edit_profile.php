<div class="container article-list">

    <div class="form-create">

        <?php echo form_open_multipart(site_url('admin/edit_profile_act/'.$user_data[0]['id_user'])); ?>

        <h3 align="center">Edit User Information</h3><br>
        <hr><br>

        <div class="form-group">
            <label for="title">Nama</label>
            <input type="text" name="nama" id='title' class='form-control' value="<?php echo $user_data[0]['nama'];?>">
            <p class="error"><?php echo form_error('nama'); ?></p>
        </div>

        <div class="form-group">
            <label for="title">Username</label>
            <input type="text" name="username" id='title' class='form-control' value="<?php echo $user_data[0]['username'];?>">
            <p class="error"><?php echo form_error('username'); ?></p>
        </div>

        <div class="form-group">
            <label for="slug">Email</label>
            <input type="text" name="email" id='slug' class='form-control' value="<?php echo $user_data[0]['email'];?>">
            <p class="error"><?php echo form_error('email'); ?></p>
        </div>

        <div class="form-group">
            <label for="slug">Password</label>
            <input type="password" name="password" id='slug' class='form-control'>
            <p class="error"><?php echo form_error('password'); ?></p>
        </div>

        <div class="form-group">
            <label for="slug">Jenis Kelamin</label><br>
            <select class="custom-select" name="jKelamin">
                <?php if($user_data[0]['j_kelamin'] == 'Pria'): ?>
                    <option value="Pria" selected>Pria</option>
                    <option value="Wanita">Wanita</option>
                <?php elseif($user_data[0]['j_kelamin'] == 'Wanita'): ?>
                    <option value="Pria">Pria</option>
                    <option value="Wanita" selected>Wanita</option>
                <?php endif; ?>
                <p class="error"><?php echo form_error('jKelamin'); ?></p>
            </select>
        </div>

        <div class="form-group">
            <label for="slug">Alamat</label>
            <textarea class="form-control" name="alamat" ><?php echo $user_data[0]['alamat'];?></textarea>
        </div>

        <div class="form-group">
            <label for="slug">Kode Pos</label>
            <input type="text" name="kode_pos" id='slug' class='form-control' value="<?php echo $user_data[0]['kode_pos'];?>">
        </div>

        <div class="form-group">
            <label for="slug">Agama</label><br>
            <select class="custom-select" name="agama">
                <?php if($user_data[0]['agama'] == 'Islam'): ?>
                    <option value="Islam" selected>Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Budha">Budha</option>
                <?php elseif($user_data[0]['agama'] == 'Kristen'): ?>
                    <option value="Islam">Islam</option>
                    <option value="Kristen" selected>Kristen</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Budha">Budha</option>
                <?php elseif($user_data[0]['agama'] == 'Hindu'): ?>
                    <option value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Hindu" selected>Hindu</option>
                    <option value="Budha">Budha</option>
                <?php elseif($user_data[0]['agama'] == 'Budha'): ?>
                    <option value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Budha" selected>Budha</option>
                <?php endif; ?>
            </select>
            <p class="error"><?php echo form_error('agama'); ?></p>
        </div>

        <div class="form-group">
            <label for="slug">Foto Profile (Max size: 1MB)</label><br>
            <input type="file" id="file2" name="profile-pic">
        </div>

        <div class="form-group">
            <input type="submit" name="btn_register" id='btn_create' value="Update Profile" class="btn btn-success">
            <?php echo anchor(site_url('/'), 'Cancel', "class='btn btn-danger'"); ?>
        </div>

        <?php echo form_close(); ?>

    </div>

</div>