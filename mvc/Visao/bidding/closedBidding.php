<div class="dropdown-divider"></div>

<?php if($bidding->getValue()!=null){ ?>
<div class="text-center">
    <p> Empresa vencedora: <?php echo $bidding->getWinner()->getUsername() ?></p>
    <p> Valor: R$<?php echo $bidding->getValue() ?></p>

    <?php require_once('bidList.php') ?>
</div>
<?php } else { ?>
    <p>Esta licitação foi fechada sem um vencedor! </p>
<?php } ?>

