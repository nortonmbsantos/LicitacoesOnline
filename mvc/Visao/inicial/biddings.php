<div class="row">
  <?php foreach($biddings as $b) { ?>
    <div class="card col-6 mt-3" style="width: 18rem;">
      <div class="card-body">
        <h5 class="card-title"><?= $b->getTitle() ?></h5>
        <h6 class="card-subtitle mb-2 text-muted">Licitação de <?= $b->getInstitutionName() ?></h6>
        <p class="card-text"><?= $b->getDescription() ?></p>
        <a href="#" class="btn btn-primary">Entrada Rápida</a>
        <a href="#" class="btn btn-secondary">Visualizar</a>
      </div>
    </div>
  <?php } ?>
</div>