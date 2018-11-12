<div class="row">
<div class="col-3"></div>
<div class="col-6">

<div class="center-block site">
    <div class="col-sm-offset-3">
        <h1 class="text-center">Login Orgão Público!</h1>

        <form action="<?= URL_RAIZ . 'agency/login/new' ?>" method="post" enctype="multipart/form-data">
            <div class="form-group <?= $this->getErroCss('login') ?>">
                <div class="text-center">
                    <?php $this->incluirVisao('shared/formErro.php', ['campo' => 'login']) ?><br>
                </div>
                <label class="exampleInputEmail1" for="email">E-mail *</label>
                <input type="email" id="email" name="email" class="form-control" autofocus value="<?= $this->getPost('email') ?>">
            </div>
            <div class="form-group <?= $this->getErroCss('login') ?>">
                <label class="control-label" for="pwd">Senha *</label>
                <input id="pwd" name="pwd" class="form-control" type="password">
            </div>
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="submit" class="btn btn-success center-block">Entrar</button>
                <a href="<?= URL_RAIZ ?>" class="btn btn-danger">Voltar</a>
            </div>
        </form>
    </div>
</div>