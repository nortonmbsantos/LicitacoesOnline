<div class="dropdown-divider"></div>
<div class="d-flex justify-content-center">

<div class="center-block site">
    <div class="col-sm-offset-3">
        <form class="form-inline" action="<?= URL_RAIZ . 'user/bid/update' ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group <?= $this->getErroCss('value') ?>">
                <label for="value" class="col-6">Atualize seu lance:</label>
                <input type="text" id="value" name="value" class="form-control col-6" autofocus value="<?= $userBid->getValue() ?>">
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

    <form action="<?= URL_RAIZ . 'user/bid/delete/' . $userBid->getId() ?>" method="post" onsubmit="return confirm('Tem certeza que deseja excluir seu lance? Deixará de participar desta licitação.');">
        <input type="hidden" name="_metodo" value="DELETE">
        <input type="hidden" name="biddingId" value="<?= $bidding->getId() ?>">
        <button type="submit" class="btn btn-danger float-right">Desistir do lance</button>
    </form>

</div>
