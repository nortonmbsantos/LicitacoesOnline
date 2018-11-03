<div class="dropdown-divider"></div>

<div class="center-block site">
    <div class="col-sm-offset-3">
        <form class="form-inline" action="<?= URL_RAIZ . 'user/bid/new' ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="value" class="col-4">Dê seu lance:</label>
                <?php $this->incluirVisao('shared/formErro.php', ['campo' => 'value']) ?>
                <input type="text" id="value" name="value" class="form-control col" autofocus value="<?= $this->getPost('value') ?>">
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