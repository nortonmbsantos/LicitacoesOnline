  <li class="nav-item">
    <a class="nav-link" href="<?= URL_RAIZ . 'agency/biddings' ?>">Minhas Licitações</a>
  </li>
</ul>

<div class="nav-item dropdown mr-10">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?php echo $this->getAgency()->getAgencyName(); ?><i class="fas fa-archway ml-1"></i>
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
    <a class="dropdown-item" href="<?= URL_RAIZ . 'agency/biddings' ?>">Minhas Licitações</a>
    <div class="dropdown-divider"></div>
    <form action="<?= URL_RAIZ . 'agency/logout' ?>" method="post">
        <input type="hidden" name="_metodo" value="DELETE">
        <button type="submit" class="dropdown-item">Sair</button>
    </form>
    </div>
</div>