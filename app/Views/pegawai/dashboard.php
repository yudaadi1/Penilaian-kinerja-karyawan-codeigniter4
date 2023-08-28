<?= $this->extend('template/default') ?>

<?= $this->section('menu') ?>
<?= $this->include('template/menu1') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
  
    <div class="section-header">
            <h1><?=$title;?></h1>
    </div>
          <div class="section-body">
    </div>
   
</section>
<?= $this->endSection() ?>
