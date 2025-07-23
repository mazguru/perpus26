<?= $this->extend('layouts/master_admin') ?>

<?= $this->section('content') ?>

<?= $this->include('admin/settings/index') ?>


<script>
    const config = {
        controller: 'settings/reading',
        dirUpload: 'upload/image/'
    }

    
</script>


<?= $this->endSection() ?>