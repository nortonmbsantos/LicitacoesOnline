<?php $this->incluirVisao('shared/flashMessage.php') ?>

<?php if($bidding) { ?>

    <div class="d-flex justify-content-center">
        <img src="<?= URL_IMG . $bidding->getImage() ?>" alt="image-profile-bidding" class="image-bidding">
    </div>
    <div class="d-flex justify-content-center">
        <h1><?= $bidding->getTitle() ?></h1>
    </div>
    <div class="d-flex justify-content-center">
        <h2><?= $bidding->getDescription() ?></h2>
    </div>

    <div class="d-flex justify-content-center">
        <h4><?= $bidding->getInstitutionName() ?></h4>
    </div>

    <?php if(!$bidding->isClosed()) { ?>
        <?php if($agency && $agency->getId() == $bidding->getInstitutionId()) { ?>
            <?= $this->incluirVisao('bidding/closeForm.php') ?>
        <?php } else { ?>
            <?php if($user && $bidding->getValue()==0) { ?>        
                <?php if($userBid) { ?>        
                    <?php require_once('updateBid.php') ?>        
                <?php } else { ?>
                    <?php require_once('newBid.php') ?>            
                <?php } ?> 
            <?php } else { ?>
                <?php $this->incluirVisao('bidding/closed.php') ?>
            <?php } ?>
        <?php } ?>
    <?php } else { ?>
        <?php $this->incluirVisao('bidding/closedBidding.php') ?>
    <?php } ?>

<?php } else { ?>
    <h1>Não conseguimos encontrar esta licitação em nossa base de dados! <i class="fas fa-frown"></i> </h1>
<?php } ?>
