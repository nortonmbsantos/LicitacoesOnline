<?php
namespace Controlador;

use \Modelo\Bidding;
use \Modelo\Agency;
use \Modelo\UserBid;
use \Framework\DW3Sessao;


class UserBidControlador extends Controlador
{
    public function new()
    {
        $this->verifyUserLogedIn();
        $bidding = Bidding::findById($_POST['biddingId']);
        $bid = new UserBid($_POST['userId'], $_POST['biddingId'], $_POST['value']);

        if ($bid->isValido()) {
            $bid->save();
            DW3Sessao::setFlash('mensagemFlash', 'Lance cadastrado.');
            $this->redirecionar(URL_RAIZ . 'bidding/' . $_POST['biddingId']);            
        } else {
            $this->setErros($bid->getValidacaoErros());
            DW3Sessao::setFlash('mensagemFlash', 'Lance não pode ser cadastrado.');
            $this->visao('bidding/show.php', 
            ['user' => $this->getUser(), 'agency' => $this->getAgency(),
             'bidding' => $bidding, 'userBid' => false,
             'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')]);
        }
    }

    public function update(){
        $this->verifyUserLogedIn();
        $userBid = UserBid::findByUserAndBidding($this->getUser()->getId(), $_POST['biddingId']);
        $userBid->setValue($_POST['value']);
        $bidding = Bidding::findById($_POST['biddingId']);

        if ($userBid->isValido()) {
            $userBid->update();
            DW3Sessao::setFlash('mensagemFlash', 'Lance atualizado.');
            $this->redirecionar(URL_RAIZ . 'bidding/' . $_POST['biddingId']);
        } else {
            $this->setErros($userBid->getValidacaoErros());
            DW3Sessao::setFlash('mensagemFlash', 'Lance não pode ser atualizado.');
            $this->visao('bidding/show.php', 
            ['user' => $this->getUser(),  'agency' => $this->getAgency(),
             'bidding' => $bidding, 'userBid' => $userBid,
             'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')]);
        }
    }

    public function delete($id){
        $this->verifyUserLogedIn();
        UserBid::deleteByUserIdAndBiddingId($this->getUser()->getId(), $id);
        DW3Sessao::setFlash('mensagemFlash', 'Lance excluído.');
        $this->redirecionar(URL_RAIZ . 'bidding/' . $_POST['biddingId']);
    }

}