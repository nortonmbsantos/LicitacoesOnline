<?php foreach($biddings as $b) { ?>
  <div class="card col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mt-3" style="width: 18rem;">
    <div class="card-body row">
      <div class="col-8">
      <h5 class="card-title"><?= $b->getTitle() ?></h5>
      <h6 class="card-subtitle mb-2 text-muted">Licitação de <?= $b->getInstitutionName() ?></h6>
      <p class="card-text"><?= $b->getDescription() ?></p>
      <a href="<?= URL_RAIZ . 'bidding/' . $b->getId() ?>" class="btn btn-info">Visualizar</a>
      </div>
      <div class="col-4">
        <img src="<?= URL_IMG . $b->getImage() ?>" class="img-50" alt="">
      </div>
    </div>
  </div>
<?php } ?>
