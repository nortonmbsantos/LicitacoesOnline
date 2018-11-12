<?php
namespace Controlador;

use \Modelo\Agency;
use \Modelo\Bidding;

class AgencyControlador extends Controlador
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

    public function index()
    {
        $this->visao('agency/index.php', ['user' => $user = $this->getUser(),  'agency' => $agency = $this->getAgency()]);
    }

    public function new()
    {
        $this->visao('agency/new.php', ['user' => $user = $this->getUser(),  'agency' => $agency = $this->getAgency()]);
    }

    public function create()
    {
        $agency = new Agency($_POST['email'], $_POST['pwd'], $_POST['agencyname']);

        if ($agency->isValido()) {
            $agency->save();
            $this->redirecionar(URL_RAIZ . 'agency');
        } else {
            $this->setErros($agency->getValidacaoErros());
            $this->visao('agency/new.php', ['user' => $user = $this->getUser(),  'agency' => $agency = $this->getAgency()]);
        }
    }

    public function biddings()
    {
        $pagination = $this->calculatePagination();     
        $biddings = Bidding::findByAgency($this->getAgency()->getId());
        $this->visao('agency/biddings/index.php', ['user' => $this->getUser(),  'agency' => $this->getAgency(),
        'biddings' => $pagination['biddings'], 'page' => $pagination['page'], 
        'lastPage' => $pagination['lastPage']  
        ]);
    }

}
