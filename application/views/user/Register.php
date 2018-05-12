<br>
<div class="container register-form">

    <div class="form-create">

        <?php echo form_open_multipart(site_url('user/register_action')); ?>

        <h3 align="center">New User Register</h3><br>
        <hr><br>

        <div class="form-group">
            <label for="title">Nama</label>
            <input type="text" name="nama" id='title' class='form-control'>
            <p class="error"><?php echo form_error('nama'); ?></p>
        </div>

        <div class="form-group">
            <label for="title">Username</label>
            <input type="text" name="username" id='title' class='form-control'>
            <p class="error"><?php echo form_error('username'); ?></p>
        </div>

        <div class="form-group">
            <label for="slug">Email</label>
            <input type="text" name="email" id='slug' class='form-control'>
            <p class="error"><?php echo form_error('email'); ?></p>
        </div>

        <div class="form-group">
            <label for="slug">Password</label>
            <input type="password" name="password" id='slug' class='form-control'>
            <p class="error"><?php echo form_error('password'); ?></p>
        </div>

        <div class="form-group">
            <label for="slug">Ulangi Password</label>
            <input type="password" name="c_password" id='slug' class='form-control'>
            <p class="error"><?php echo form_error('c_password'); ?></p>
        </div>

        <div class="form-group">
            <label for="slug">Jenis Kelamin</label><br>
            <select class="custom-select" name="jKelamin">
                <option value="Pria">Pria</option>
                <option value="Wanita">Wanita</option>
                <p class="error"><?php echo form_error('jKelamin'); ?></p>
            </select>
        </div>

        <div class="form-group">
            <label for="slug">Alamat</label>
            <textarea class="form-control" name="alamat">
            </textarea>
        </div>

        <div class="form-group">
            <label for="slug">Kode Pos</label>
            <input type="text" name="kode_pos" id='slug' class='form-control'>
        </div>

        <div class="form-group">
            <label for="slug">Agama</label><br>
            <select class="custom-select" name="agama">
                <option value="Islam">Islam</option>
                <option value="Kristen">Kristen</option>
                <option value="Hindu">Hindu</option>
                <option value="Budha">Budha</option>
            </select>
            <p class="error"><?php echo form_error('agama'); ?></p>
        </div>

        <div class="form-group">
            <label for="slug">Foto Profile (Max size: 1MB)</label><br>
            <input type="file" id="file2" name="profile-pic">
        </div>

        <div class="form-group">
            <input type="submit" name="btn_register" id='btn_create' value="Register" class="btn btn-success">
            <?php echo anchor(site_url('/'), 'Cancel', "class='btn btn-danger'"); ?>
        </div>

        <?php echo form_close(); ?>

    </div>

</div>