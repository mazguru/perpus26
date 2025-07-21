<h2>Edit Artikel</h2>
<form method="post" action="/admin/artikel/update/<?= $artikel['id'] ?>">
    <input type="text" name="judul" value="<?= esc($artikel['judul']) ?>"><br>
    <textarea name="isi"><?= esc($artikel['isi']) ?></textarea><br>
    <button type="submit">Update</button>
</form>
