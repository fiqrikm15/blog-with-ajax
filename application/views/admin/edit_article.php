<div class="container article-list">

    <div class="form-create">

        <?php echo form_open_multipart(site_url('admin/edit_action/'.$article[0]['id_article'].'/'.$article[0]['id_user'])); ?>

        <h3 align="center">Edit Article</h3><br>

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id='title' class='form-control' value="<?php echo $article[0]['title'];?>">
        </div>

        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" name="slug" id='slug' class='form-control'value="<?php echo $article[0]['slug'];?>">
        </div>

        <div class="form-group">
            <label for="">Status</label>
            <select name="status" class="form-control col-sm-2">
                <?php if($article[0]['status'] == 'Publish'): ?>
                    <option value="Publish" selected>Publish</option>
                    <option value="Draft">Draft</option>
                    <option value="Unpublish">Unpublish</option>
                <?php elseif($article[0]['status'] == 'Draft'): ?>
                    <option value="Publish">Publish</option>
                    <option value="Draft" selected>Draft</option>
                    <option value="Unpublish">Unpublish</option>
                <?php elseif($article[0]['status'] == 'Unpublish'): ?>
                    <option value="Publish">Publish</option>
                    <option value="Draft">Draft</option>
                    <option value="Unpublish" selected>Unpublish</option>
                <?php endif; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="slug">Header Image (Max size: 1MB)</label><br>
            <input type="file" id="file2" name="header-pic">
        </div>

        <div class="form-group">
            <label for="">Content</label>
            <div class="form-group">
                <textarea name="content" id="content" class="form-control" rows="10"><?php echo $article[0]['content'];?></textarea>
            </div>
        </div>

        <div class="form-group">
            <input type="submit" name="btn_create" id='btn_create' value="Edit Article" class="btn btn-success">
            <?php echo anchor(site_url('admin'), 'Cancel', "class='btn btn-danger'"); ?>
        </div>

        <?php echo form_close(); ?>

    </div>

</div>