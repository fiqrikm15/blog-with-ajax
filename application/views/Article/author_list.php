<div class="container article-pub" style="width: 60%;">

    <h3 align="center">Author List</h3>

    <table class="table">
        <thead class="thead-dark" align="center">
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jenis Kelamin</th>
            <th>Agama</th>
        </tr>
        </thead>
        <tbody class="thead-light" align="center">
        <?php
        $i = 0;
        foreach($user_data as $users):
            $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo anchor(site_url('article/detail_profile/'.$users->id_user), $users->nama) ?></td>
                <td><?php echo $users->email; ?></td>
                <td><?php echo $users->j_kelamin; ?></td>
                <td><?php echo $users->agama; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</div>