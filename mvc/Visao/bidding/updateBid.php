<div class="dropdown-divider"></div>
<div class="center-block site">
    <div class="col-sm-offset-3">
        <form class="form-inline" action="<?= URL_RAIZ . 'user/bid/update' ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group <?= $this->getErroCss('value') ?>">
                <label for="value" class="col-4">Atualize seu lance:</label>
                <input type="text" id="value" name="value" class="form-control col" autofocus value="<?= $userBid->getValue() ?>">
            </div>
            <div class="form-group">
                <input type="hidden" id="userId" name="userId" value="<?= $this->getUser()->getId() ?>">
            </div>
            <div class="form-group">
                <input type="hidden" id="biddingId" name="biddingId" value="<?= $bidding->getId() ?>">
            </div>
                <button type="submit" class="btn btn-success center-block">Atualizar Lance</button>

                <div class="form-group <?= $this->getErroCss('value') ?>">
                <?php $this->incluirVisao('shared/formErro.php', ['campo' => 'value']) ?>
                </div>
        </form>
    </div>
</div>