<?php

include_once(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/ame_public/AME_vs1/com/model/Empresa.php');
include_once(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/ame_public/AME_vs1/com/dao/BaseDAO.php');

class EmpresaDAO extends BaseDAO {

    private $limpaObjetos = false;

	public function __construct($limpaObjetos = false) {
		$this->limpaObjetos = $limpaObjetos;
	}
    
    public function insertEmpresa(Empresa $empresa) {

        $sql = 'INSERT INTO empresa (
                    idEmpresa, 
                    idFederacao, 
                    idBairro,
                    nmEmpresa,
                    nrNumero,
                    nrCnpj,
                    nrCep,
                    dsEmail,
                    dsEndereco,
                    dsComplemento) VALUES (:id_empresa, 
                                      :id_federacao, 
                                      :id_bairro, 
                                      :nm_empresa, 
                                      :nr_numero, 
                                      :nr_cnpj, 
                                      :nr_cep, 
                                      :ds_emal, 
                                      :ds_endereco, 
                                      :ds_complemenmto)';

        $parameters = array(
            ':id_empresa' => $empresa->getIdEmpresa(),
            ':id_federacao' => $empresa->getIdFederacao(),
            ':id_bairro' => $empresa->getIdBairro(),
            ':nm_empresa' => $empresa->getNmEmpresa(),
            ':nr_numero' => $empresa->getNrNumero(),
            ':nr_cnpj' => $empresa->getNrCnpj(),
            ':nr_cep' => $empresa->getNrCep(),
            ':ds_emal' => $empresa->getDsEmail(),
            ':ds_endereco' => $empresa->getDsEndereco(),
            ':ds_complemenmto' => $empresa->getDsComplemento()
        );

        parent::insert($sql, $parameters);

    }

    public function getEmpresa($idEmpresa)
	{
		return parent::getListCastParam("SELECT * FROM empresa WHERE id_empresa = :id_empresa", array(':id_empresa' => $idEmpresa));
	}

    public function getEmpresas()
	{
		return parent::getListCast("SELECT * FROM empresa");
	}

    protected function processRow($result) {

		$empresa = new Empresa($result,$this->limpaObjetos);
		
        return $empresa;
	
    }

}

?>