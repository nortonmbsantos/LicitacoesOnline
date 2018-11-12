<div class="row">
  <h1 class="text-center mt-5 col-12">Últimos cadastrados</h1>
  <?php $this->incluirVisao('bidding/biddingList.php') ?>
</div>
<div class="pb-5 mt-5">
  <?php if ($page > 1) : ?>
  <div class="float-left">
      <a href="<?= URL_RAIZ . 'biddings?p=' . ($page-1) ?>" class="btn btn-danger ">Página anterior</a>
  </div>
  <?php endif ?>
  <?php if ($page < $lastPage) : ?>
    <div class="float-right">
      <a href="<?= URL_RAIZ . 'biddings?p=' . ($page+1) ?>" class="btn btn-success">Próxima página</a>
    </div>
  <?php endif ?>
</div>
