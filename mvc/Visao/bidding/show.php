<?php if($bidding) { ?>
<h1><?= $bidding->getTitle() ?></h1>
<h1><?= $bidding->getDescription() ?></h1>
<h1><?= $bidding->getInstitutionName() ?></h1>

<?php if($agency && $agency->getId() == $bidding->getInstitutionId()) { ?>
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
<?php } ?>
<?php if($user) { ?>        
    <div class="center-block site">
        <div class="col-sm-offset-3">
            <h1 class="text-center">Entre</h1>
            <form action="<?= URL_RAIZ . 'user/bid' ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="value">Sua proposta *</label>
                    <?php $this->incluirVisao('shared/formErro.php', ['campo' => 'value']) ?>
                    <input type="text" id="value" name="value" class="form-control" autofocus value="<?= $this->getPost('value') ?>">
                </div>
                <div class="form-group">
                    <input type="hidden" id="userId" name="userId" class="form-control" autofocus value="<?= $this->getUser()->getId() ?>">
                </div>
                <div class="form-group">
                    <input type="hidden" id="biddingId" name="biddingId" class="form-control" autofocus value="<?= $bidding->getId() ?>">
                </div>
                    <button type="submit" class="btn btn-success center-block">Dar Lance</button>
            </form>
        </div>
    </div>
<?php } ?>
<?php } else { ?>
    <h1>Não conseguimos encontrar esta licitação em nossa base de dados! <i class="fas fa-frown"></i> </h1>
<?php } ?>