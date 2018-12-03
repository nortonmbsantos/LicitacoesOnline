<?php $this->incluirVisao('shared/flashMessage.php') ?>

<div class="row">
<div class="col-12 text-center">
  <h1>Lista de licitações</h1>
</div>
<div class="col-12">
  <a href="<?= URL_RAIZ ?>" class="btn btn-danger">Voltar</a>
</div>

<div class="col-12">
<form action="<?= URL_RAIZ . 'bidding/filter' ?>" method="POST" class="margin-bottom">
	<div class="form-group">
        <label class="control-label pt-3" for="biddingFilter">Filtro</label>
        <select id="biddingFilter" name="biddingFilter" class="form-control" autofocus>
        	<option value="all">Todas as licitações</option>
        	<option value="open">Somente abertas</option>
        	<option value="closed">Somente fechadas</option>        
        </select>
    </div>
    <button type="submit" class="btn btn-primary center-block largura100">Filtrar</button>
</form>
</div>

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
