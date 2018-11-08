<?php if($bidding) { ?>
<img src="<?= URL_IMG . $bidding->getImage() ?>" alt="">
<h1><?= $bidding->getTitle() ?></h1>
<h1><?= $bidding->getDescription() ?></h1>
<h1><?= $bidding->getInstitutionName() ?></h1>

<?php if($agency && $agency->getId() == $bidding->getInstitutionId()) { ?>
    <?php require_once('bidList.php') ?>        
<?php } ?>
<?php if($user) { ?>        
    <?php if($userBid) { ?>        
        <?php require_once('updateBid.php') ?>        
    <?php } else { ?>
        <?php require_once('newBid.php') ?>            
    <?php } ?>
<?php } ?>
<?php } else { ?>
    <h1>Não conseguimos encontrar esta licitação em nossa base de dados! <i class="fas fa-frown"></i> </h1>
<?php } ?>
