<li class="nav-item">
        <a class="nav-link" href="<?= URL_RAIZ . 'user/bidding' ?>">Minhas Licitações</a>
      </li>
      </ul>

<div class="nav-item dropdown mr-10">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?= $this->getUser()->getUsername(); ?><i class="fas fa-user ml-1"></i>
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
    <a class="dropdown-item" href="<?= URL_RAIZ . 'user' ?>">Perfil</a>
    <a class="dropdown-item" href="#">Another action</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="<?= URL_RAIZ . 'user/logout' ?>">Logout</a>
    </div>
</div>