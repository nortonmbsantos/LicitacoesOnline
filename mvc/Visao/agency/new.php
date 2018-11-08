<div class="center-block site">
    <div class="col-sm-offset-3">
        <h1 class="text-center">Cadastre o Orgão Público!</h1>


        <form action="<?= URL_RAIZ . 'agency' ?>" method="post" enctype="multipart/form-data">
            <div class="form-group <?= $this->getErroCss('email') ?>">
                <label class="exampleInputEmail1" for="email">E-mail *</label>
                <?php $this->incluirVisao('shared/formErro.php', ['campo' => 'email']) ?>
                <input type="email" id="email" name="email" class="form-control" autofocus value="<?= $this->getPost('email') ?>">
            </div>
            <div class="form-group <?= $this->getErroCss('agencyname') ?>">
                <label class="text" for="text">Nome do Orgão Público *</label>
                <?php $this->incluirVisao('shared/formErro.php', ['campo' => 'agencyname']) ?>
                <input type="text" id="agencyname" name="agencyname" class="form-control" autofocus value="<?= $this->getPost('agencyname') ?>">
            </div>
            <div class="form-group <?= $this->getErroCss('pwd') ?>">
                <label class="control-label" for="pwd">Senha *</label>
                <?php $this->incluirVisao('shared/formErro.php', ['campo' => 'pwd']) ?>
                <input id="pwd" name="pwd" class="form-control" type="password">
            </div>
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="submit" class="btn btn-success center-block">Cadastrar</button>
                <a href="<?= URL_RAIZ ?>" class="btn btn-danger">Voltar</a>
            </div>
        </form>
    </div>
</div>