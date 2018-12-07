<div class="dropdown-divider"></div>
<form action="<?= URL_RAIZ . 'bidding/close/' . $bidding->getId() ?>" method="post" class="inline">
    <input type="hidden" name="_metodo" value="PATCH">
    <button type="submit" class="btn btn-danger">Fechar licitação</button>
</form>