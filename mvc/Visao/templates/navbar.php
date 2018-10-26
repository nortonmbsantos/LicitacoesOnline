<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
  <a class="navbar-brand ml-auto" href="<?= URL_RAIZ ?>">Licitações Online</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?= URL_RAIZ ?>">Página Inicial<span class="sr-only">(current)</span></a>
      </li>
      <?php if($user) { ?>
      <li class="nav-item">
        <a class="nav-link" href="<?= URL_RAIZ . 'user/bidding' ?>">Minhas Licitações</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
      <?php } ?>
    </ul>

    <?php if(!$user && !$agency) { ?>    
      <form class="form-inline my-2 my-lg-0" action="<?= URL_RAIZ . 'user/login/new' ?>" method="post" enctype="multipart/form-data" >
        <input type="email" id="email" name="email" class="form-control" placeholder="email">
        <input id="pwd" name="pwd" class="form-control" type="password"  placeholder="Senha">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Login</button>
      </form>
      <a class="btn btn-outline-secondary my-2 my-sm-0 ml-2" href="<?= URL_RAIZ . 'user/new' ?>">Criar conta</a>    
    <?php } else { ?>

      <?php if($user) { ?>        
        <div class="nav-item dropdown mr-10">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo $this->getUser()->getUsername(); ?>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="<?= URL_RAIZ . 'user' ?>">Perfil</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?= URL_RAIZ . 'user/logout' ?>">Logout</a>
          </div>
        </div>
      <?php } ?>
      
      <?php if($agency) { ?>
        <div class="nav-item dropdown mr-10">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo $this->getAgency()->getAgencyName(); ?>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="<?= URL_RAIZ . 'user' ?>">Perfil</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?= URL_RAIZ . 'agency/logout' ?>">Logout</a>
          </div>
        </div>          
      <?php } ?>
    <?php } ?>
  </div>
</nav>