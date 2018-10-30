<?php if($bidding) { ?>
<h1><?= $bidding->getTitle() ?></h1>
<h1><?= $bidding->getDescription() ?></h1>
<h1><?= $bidding->getInstitutionName() ?></h1>
<?php } else { ?>
    <h1>Essa licitação não existe! </h1>
<?php } ?>