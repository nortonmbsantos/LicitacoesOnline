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

    <?php if(!$bidding->getClosed()) { ?>
        <?php if($agency && $agency->getId() == $bidding->getInstitutionId()) { ?>
            <?php require_once('bidList.php') ?>
            <a href="<?= URL_RAIZ . 'bidding/close/' . $bidding->getId()?>" class="btn btn-danger">Close</a>        
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
