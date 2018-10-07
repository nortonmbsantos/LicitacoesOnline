<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Licitações Online</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?= URL_RAIZ ?>">Página Inicial<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= URL_RAIZ . 'empresa' ?>">Minha Empresa</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= URL_RAIZ . 'empresa/licitacao' ?>">Minhas Licitações</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="text" placeholder="Username">
      <input class="form-control mr-sm-2" type="password" placeholder="Password">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Login</button>
    </form>
    <a class="btn btn-outline-secondary my-2 my-sm-0 ml-2" href="<?= URL_RAIZ . 'empresa/new' ?>">Criar conta</a>    
  </div>
</nav>