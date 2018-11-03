<?php if($bidding) { ?>
<h1><?= $bidding->getTitle() ?></h1>
<h1><?= $bidding->getDescription() ?></h1>
<h1><?= $bidding->getInstitutionName() ?></h1>

<?php if($agency && $agency->getId() == $bidding->getInstitutionId()) { ?>
    <?php require_once('bidList.php') ?>        
<?php } ?>
<?php if($user) { ?>        
    <?php require_once('newBid.php') ?>        
<?php } ?>
<?php } else { ?>
    <h1>Não conseguimos encontrar esta licitação em nossa base de dados! <i class="fas fa-frown"></i> </h1>
<?php } ?>