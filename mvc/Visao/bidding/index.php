<div class="row">
    <?php foreach($biddings as $b) { ?>
        <div class="card col-4 mt-3 mr-5" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"><?= $b->getTitle() ?></h5>
                <h6 class="card-subtitle mb-2 text-muted">Licitação de <?= $b->getInstitutionName() ?></h6>
                <p class="card-text"><?= $b->getDescription() ?></p>
                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
            </div>
        </div>
    <?php } ?>
</div>
