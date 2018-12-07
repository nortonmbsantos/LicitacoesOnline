<?php
namespace Controlador;

use \Modelo\Bidding;
use \Modelo\Agency;
use \Modelo\UserBid;
use \Framework\DW3Sessao;


class BiddingsControlador extends Controlador
{

    private function calculatePagination()
    {
        $page = array_key_exists('p', $_GET) ? intval($_GET['p']) : 1;
        $limit = 8;
        $offset = ($page - 1) * $limit;
        $biddings = Bidding::findAndPaginate($limit, $offset);
        $lastPage = ceil(Bidding::countAll() / $limit);
        return compact('page', 'biddings', 'lastPage');
    }

    private function filterPagination($filter)
    {
        $page = array_key_exists('p', $_GET) ? intval($_GET['p']) : 1;
        $limit = 8;
        $offset = ($page - 1) * $limit;
        $biddings = Bidding::filterBidding($filter, $limit, $offset);
        if ($filter == 'open') {
            $lastPage = ceil(Bidding::countAllOpen() / $limit);
        } elseif ($filter == 'closed') {
            $lastPage = ceil(Bidding::countAllClosed() / $limit);            
        } elseif ($filter == 'all') {
            $lastPage = ceil(Bidding::countAll() / $limit);                        
        }
        var_dump(Bidding::countAllClosed());
        return compact('page', 'biddings', 'lastPage');
    }

    public function index()
    {
        $this->verifyLogedIn();
        $pagination = $this->calculatePagination();
        $this->visao('bidding/index.php', ['user' => $this->getUser(),  'agency' => $this->getAgency(),
         'biddings' => $pagination['biddings'], 'page' => $pagination['page'], 
         'lastPage' => $pagination['lastPage'], 'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')
         ]);
    }

    public function show($id)
    {
        $this->verifyLogedIn();
        $bidding = Bidding::findById($id);
        $bids = UserBid::findByBidding($id);
        
        if($this->getUser()){
            $userBid = UserBid::findByUserAndBidding($this->getUser()->getId(), $id);
        } else {
            $userBid = null;
        }

        $this->visao('bidding/show.php', 
        ['user' => $this->getUser(),  'agency' => $this->getAgency(), 
        'bidding' => $bidding, 'bids' => $bids, 
        'userBid' => $userBid, 'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')]);
    }

    public function new()
    {
        $this->verifyAgencyLogedIn();
        $this->visao('bidding/new.php', ['user' => $this->getUser(), 'agency' => $this->getAgency()]);
    }

    public function create()
    {
        $photo = array_key_exists('photo', $_FILES) ? $_FILES['photo'] : null;
        $bidding = new Bidding($_POST['title'], $_POST['description'], $_POST['institutionId'], $photo);

        if ($bidding->isValido()) {
            $bidding->save();
            DW3Sessao::setFlash('mensagemFlash', 'Licitação cadastrada.');
            $this->redirecionar(URL_RAIZ . 'agency/biddings');
        } else {
            $this->setErros($bidding->getValidacaoErros());
            $this->visao('bidding/new.php', 
            ['user' => $this->getUser(),  'agency' => $this->getAgency(),
            'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')
            ]);
        }
    }

    public function close($ID)
    {
        $this->verifyAgencyLogedIn();
        $userBid = UserBid::findBiddingToClose($ID);   
        Bidding::closeBidding($userBid->getValue(), $userBid->getUserId(), $ID);
        DW3Sessao::setFlash('mensagemFlash', 'Licitação fechada com sucesso.');
        $this->redirecionar(URL_RAIZ . 'bidding/' . $ID);
    }

    public function filter(){
        $this->verifyLogedIn();
        $filter = $_GET['biddingFilter'];
        $pagination = $this->filterPagination($filter);
        $this->visao('bidding/index.php', ['user' => $this->getUser(),  'agency' => $this->getAgency(),
         'biddings' => $pagination['biddings'], 'page' => $pagination['page'], 
         'lastPage' => $pagination['lastPage'], 'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')
         ]); 
    }
}
