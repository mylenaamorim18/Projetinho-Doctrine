<?php

use models\entidades\Pagina;

class Doctrine_tools extends CI_Controller
{

    public $em;

    //Doctrine EntityManager

    function __construct()
    {
        parent::__construct();

        //Instantiate a Doctrine Entity Manager
        $this->em = $this->doctrine->em;
    }

    public function index()
    {
        echo 'Doctrine: Atualizar estrutura do banco de dados.<br /><br />
		<form action="" method="POST">
		Inserir Dados<input type="checkbox" name="dados" value="1"><br /><br />
		<input type="submit" name="action" value="Atualizar Banco"><br /><br />
        </form>';

        if ($this->input->post('action')) {

            try {
                $tool = new \Doctrine\ORM\Tools\SchemaTool($this->em);

                $filter_exclude = [
                    'auth_login_attempts',
                    'auth_user_autologin',
                    'auth_user_profiles',
                    'ci_sessions',
                ];
                $exclude_reg = '/^(?!(?:' . implode('|', $filter_exclude) . ')$).*$/';
                $this->doctrine->em->getConfiguration()->setFilterSchemaAssetsExpression($exclude_reg);

                $classes = array(
                    $this->em->getClassMetadata('models\entidades\Entidade'),
                    $this->em->getClassMetadata('models\entidades\Dependente'),
                    $this->em->getClassMetadata('models\entidades\Estado'),
                    $this->em->getClassMetadata('models\entidades\Endereco'),
                    $this->em->getClassMetadata('models\entidades\Pessoa'),
                    $this->em->getClassMetadata('models\entidades\Funcionario'),
                );
                $tool->updateSchema($classes);
            } catch (Exception $ex) {
              
                die($ex->getMessage());
            }

        }
    }

//-----------------------------------------------------------------------------------------------------------------

    // public function insertPessoa($nome, $cpf) {
	// 	$pessoa = new Pessoa();
	// 	$this->pessoa->setNome($nome);
	// 	$this->pessoa->setCpf($cpf).save();


	// 	$em->flush();
	// }

	// function deletePessoa($id){
    //     try{
    //         $this->em->remove($id);
    //         $this->em->flush();
    //         return TRUE;
    //     }
    //     catch(Exception $err) {
    //         log_message("error", $err->getMessage(), false);
    //         return FALSE;
    //     }
    // }
}