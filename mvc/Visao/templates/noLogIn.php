</ul>
      <form class="form-inline my-2 my-lg-0" action="<?= URL_RAIZ . 'user/login/new' ?>" method="post" enctype="multipart/form-data" >
        <input type="email" id="email" name="email" class="form-control" placeholder="email">
        <input id="pwd" name="pwd" class="form-control" type="password"  placeholder="Senha">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Login</button>
      </form>
      <a class="btn btn-outline-secondary my-2 my-sm-0 ml-2" href="<?= URL_RAIZ . 'user/new' ?>">Criar conta</a>  