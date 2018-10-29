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
      
    <?php if(!$user && !$agency) { ?>    
      <?php include_once('noLogIn.php'); ?>  
    <?php } else { ?>
      <?php if($user) { ?>        
        <?php include_once('userLogedInNavbar.php'); ?>
      <?php } else { ?>
        <?php include_once('agencyLogedInNavbar.php'); ?>
      <?php } ?>
    <?php } ?>
  </div>
</nav>