<?php

include_once(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/ame_public/AME_vs1/com/model/Cidade.php');
include_once(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/ame_public/AME_vs1/com/dao/BaseDAO.php');

class CidadeDAO extends BaseDAO {

    private $limpaObjetos = false;

	public function __construct($limpaObjetos = false) {
		$this->limpaObjetos = $limpaObjetos;
	}
    
    public function insertCidade(Cidade $cidade) {

        $sql = 'INSERT INTO cidade (
                    id_cidade, 
                    nm_cidade) VALUES (:id_cidade, 
                                      :nm_cidade)';

        $parameters = array(
            ':id_cidade' => $cidade->getIdCidade(),
            ':nm_cidade' => $cidade->getNmCidade()
        );

        parent::insert($sql, $parameters);

    }

    public function getCidade($idCidade)
	{
		return parent::getListCastParam("SELECT * FROM cidade WHERE id_cidade = :id_cidade", array(':id_cidade' => $idCidade));
	}

    protected function processRow($result) {

		$cidade = new Cidade($result,$this->limpaObjetos);
		
        return $cidade;
	
    }

}

?>