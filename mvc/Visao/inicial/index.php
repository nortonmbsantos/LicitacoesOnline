<?php $this->incluirVisao('shared/flashMessage.php') ?>
<?php include_once("carousel.php") ?>

<?php if(!$user && !$agency) { ?>    
<div class='row mt-5'>
  <div class="card col-sm-12 col-lg-4">
    <img class="card-img-top" src="<?= URL_IMG . 'empresa.png' ?>" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Sou uma empresa</h5>
      <p class="card-text">Empresas que desejam participar das licitaçẽs. Acesse aqui ou utilize o  login no navbar.</p>
      <a href="<?= URL_RAIZ . 'user/new' ?>" class="btn btn-primary">Cadastre-se</a>
      <a href="<?= URL_RAIZ . 'user/login/new' ?>" class="btn btn-primary float-right">Login</a>
    </div>
  </div>

  <div class="col-lg-4"></div>

  <div class="card col-sm-12 col-lg-4">
    <a href="<?= URL_RAIZ . 'agency/new' ?>"><img class="card-img-top" src="<?= URL_IMG . 'orgao_publicot.png' ?>" alt="Card image cap"></a>
    <div class="card-body">
      <h5 class="card-title">Sou um Orgão Público</h5>
      <p class="card-text">Orgãos Públicos que desejam criar licitaçẽs.</p>
      <a href="<?= URL_RAIZ . 'agency/new' ?>" class="btn btn-primary">Cadastre-se</a>
      <a href="<?= URL_RAIZ . 'agency/login/new' ?>" class="btn btn-primary float-right">Login</a>
    </div>
  </div>
</div>
<?php } else { ?>
      <?php include_once("biddings.php") ?>
<?php } ?>
