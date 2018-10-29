<div class="center-block site">
    <div class="col-sm-offset-3">
        <h1 class="text-center">Cadastre a sua Licitação!</h1>

        <form action="<?= URL_RAIZ . 'bidding/new' ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label class="exampleInputEmail1" for="email">Título *</label>
                <?php $this->incluirVisao('shared/formErro.php', ['campo' => 'title']) ?>
                <input type="text" id="title" name="title" class="form-control" autofocus value="<?= $this->getPost('title') ?>">
            </div>
            <div class="form-group">
                <label class="text" for="text">Descrição *</label>
                <?php $this->incluirVisao('shared/formErro.php', ['campo' => 'description']) ?>
                <input type="textarea" id="description" name="description" class="form-control" autofocus value="<?= $this->getPost('description') ?>">
            </div>
            <div class="form-group">
                <input type="hidden" id="institutionId" name="institutionId" class="form-control" autofocus value="<?= $this->getAgency()->getId() ?>">
            </div>
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="submit" class="btn btn-success center-block">Cadastrar</button>
                <a href="<?= URL_RAIZ ?>" class="btn btn-danger">Voltar</a>
            </div>
        </form>
    </div>
</div>