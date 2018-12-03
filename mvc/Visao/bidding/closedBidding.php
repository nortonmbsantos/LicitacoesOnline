
<?php if($bidding->getValue()!=null){ ?>
<div class="dropdown-divider"></div>
<div class="text-center">
    <p> Empresa vencedora: <?php echo $bidding->getWinner()->getUsername() ?></p>
    <p> Valor: R$<?php echo $bidding->getValue() ?></p>
</div>
<?php } else { ?>
    <p>Esta licitação foi fechada sem vencedores! </p>
<?php } ?>

