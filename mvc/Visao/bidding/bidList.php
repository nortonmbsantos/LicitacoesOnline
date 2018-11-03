<div class="dropdown-divider"></div>

<div class="row">
    <?php foreach($bids as $b) { ?>
        <div class="card col-2 mt-3" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"><?= $b->getUser()->getUserName() ?></h5>
                <h6 class="card-subtitle mb-2 text-muted">Valor da proposta <?= $b->getValue() ?> </h6>
            </div>
        </div>
    <?php } ?>
</div>