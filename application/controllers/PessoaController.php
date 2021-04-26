<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once(APPPATH.'controllers/ReutilizarCode.php');

use Doctrine\ORM\Query\Expr\Join;
use models\entidades\Pessoa;
use models\entidades\Funcionario;
use models\entidades\Dependente;
use models\entidades\Endereco;
use models\entidades\Estado;

class PessoaController extends ReutilizarCode {

	public $em;

    function __construct() {
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('url');

        $this->em = $this->doctrine->em;
    }

	public function index() {

	}

    public function criar() {
        $estados = $this->em->getRepository('models\entidades\Estado')->findAll();
        $funcionarios = $this->em->getRepository('models\entidades\Funcionario')->findAll();
        $dependentes = $this->em->getRepository('models\entidades\Dependente')->findAll();
        $id = $this->input->get('id');

        if($id == 'funcionario') {
            $this->load->view('pages/form-funcionario', array('estados' => $estados, 'funcionarios' => $funcionarios, 'dependentes' => $dependentes)); 
        } 
        else if($id == 'dependente') {
            $this->load->view('pages/form-dependente', array('estados' => $estados, 'funcionarios' => $funcionarios, 'dependentes' => $dependentes)); 
        } 
        else {
            echo "Error";
        }
	}


    public function salvar_funcionario() {
        if($_POST['nome_funcionario'] != '' && $_POST['cpf'] != '' && $_POST['departamento'] != '') {
            $funcionario = new Funcionario;
            $funcionario->setNome($this->input->post('nome_funcionario'));
            $funcionario->setEndereco($this->cadastro_endereco());
            $funcionario->setCpf($this->input->post('cpf'));
            $funcionario->setDepartamento($this->input->post('departamento'));

            if(isset($_POST['dependentes'])) {
                foreach($_POST['dependentes'] as $dependente) {
                    $obj_dependente = $this->em->find('models\entidades\Dependente', $dependente);
                    $obj_dependente->getFuncionarios()->add($funcionario);
                    $funcionario->getDependentes()->add($obj_dependente);
                    $this->em->persist($obj_dependente);
                    $this->em->persist($funcionario);
                }
            }
            $this->em->flush();
            $_SESSION['mensagem'] = "Cadastro realizado com sucesso!";
            return redirect('listar?id=funcionario');
        }
        else {
            $this->preencher_form();
        }    
    }
    
    public function listar() {
        $funcionarios = $this->em->getRepository('models\entidades\Funcionario')->findAll();
        $enderecos = $this->em->getRepository('models\entidades\Endereco')->findAll();
        $dependentes = $this->em->getRepository('models\entidades\Dependente')->findAll();
        $id = $this->input->get('id');
        
        if($id == 'funcionario') {
            $this->load->view('pages/lista-funcionarios', array('funcionarios' => $funcionarios, 'enderecos' => $enderecos, 'dependentes' => $dependentes));
        } 
        else if($id == 'dependente') {
            $this->load->view('pages/lista-dependentes', array('funcionarios' => $funcionarios, 'enderecos' => $enderecos, 'dependentes' => $dependentes));
        } 
        else {
            print_r("Erro");
        }
    }
    
    public function deletar() {
        $id = $this->input->post('chave');
        $tipo = $this->input->post('tipo');
        if($tipo == 'funcionario' && $id != null){
            $funcionario = $this->em->find('models\entidades\Funcionario', $id);
            $this->em->remove($funcionario);
            $this->em->flush();
            print_r($id);
        }   
        else if($tipo == 'dependente' && $id != null){
            $dependente = $this->em->find('models\entidades\Dependente', $id);
            $this->em->remove($dependente);
            $this->em->flush();
            print_r($id);
        }    
    }

    public function editar_funcionario() {
        if(isset($_GET['id'])) {
            $fun_id = $this->input->get('id');
            $end_id = $this->input->get('end');
            $funcionario = $this->em->find('models\entidades\Funcionario', $fun_id);
            $endereco = $this->em->find('models\entidades\Endereco', $end_id);
            $uf = $endereco->getEstado();
            $estado = $this->em->find('models\entidades\Estado', $uf);
            $estados = $this->em->getRepository('models\entidades\Estado')->findAll();

            $depen_qtd = count($funcionario->getDependentes());
            $id_dependentes = array();

            for($row = 0; $row<$depen_qtd; $row++) {
                $dependente = $funcionario->getDependentes()[$row]->getId();
                array_push($id_dependentes, $dependente);
            }

            $dependentes = $this->em->getRepository('models\entidades\Dependente')->findBy(array('id' => $id_dependentes));

            $this->load->view('pages/form-funcionario', array('funcionario' => $funcionario, 'endereco' => $endereco, 'estado' => $estado, 'estados' => $estados, 'dependentes' => $dependentes)); 
        }
    }

    public function atualizar_funcionario() {        
        $this->atualizar_endereco();

        if($_POST['nome_funcionario'] != '' && $_POST['cpf'] != '' && $_POST['departamento'] != '') {
            $id_fun = $this->input->get('id');
            $funcionario = $this->em->find('models\entidades\Funcionario', $id_fun);

            $funcionario->setNome($this->input->post('nome_funcionario'));
            $funcionario->setCpf($this->input->post('cpf'));
            $funcionario->setDepartamento($this->input->post('departamento'));
            $this->em->flush();
            $_SESSION['mensagem_up'] = "Cadastro atualizado com sucesso!"; 
            return redirect('listar?id=funcionario');
        }
        else {
            $this->preencher_form();
        }
    }


    public function salvar_dependente() {
        if($_POST['nome_dependente'] != '' && $_POST['cpf'] != '' && $_POST['idade'] != '') {
            $dependente = new Dependente;
            $dependente->setNome($this->input->post('nome_dependente'));
            $dependente->setEndereco($this->cadastro_endereco());
            $dependente->setCpf($this->input->post('cpf'));
            $dependente->setIdade($this->input->post('idade'));

            if(isset($_POST['dependentes'])) {
                foreach($_POST['funcionarios'] as $funcionario) {
                    $obj_funcionario = $this->em->find('models\entidades\Funcionario', $funcionario);
                    $obj_funcionario->getDependentes()->add($dependente);
                    $dependente->getFuncionarios()->add($obj_funcionario);
                    $this->em->persist($obj_funcionario);
                    $this->em->persist($dependente);
                }
            }
            $this->em->flush();
            $_SESSION['mensagem'] = "Cadastro realizado com sucesso!";
            return redirect('listar?id=dependente');
        }
        else {
            $this->preencher_form();
        }    
    }

    public function editar_dependente() {
        if(isset($_GET['id'])) {
            $dependente_id = $this->input->get('id');
            $end_id = $this->input->get('end');
            $dependente = $this->em->find('models\entidades\Dependente', $dependente_id);
            $endereco = $this->em->find('models\entidades\Endereco', $end_id);
            $uf = $endereco->getEstado();
            $estado = $this->em->find('models\entidades\Estado', $uf);
            $lista_estados = $this->em->getRepository('models\entidades\Estado')->findAll();

            $funcionarios_qtd = count($dependente->getFuncionarios());
            $id_funcionarios = array();

            for($row = 0; $row<$funcionarios_qtd; $row++) {
                $f = $dependente->getFuncionarios()[$row]->getId();
                array_push($id_funcionarios, $f);
            }

            $funcionarios = $this->em->getRepository('models\entidades\Funcionario')->findBy(array('id' => $id_funcionarios));

            $this->load->view('pages/form-dependente', array('dependente' => $dependente, 'endereco' => $endereco, 'estado' => $estado, 'estados' => $lista_estados, 'funcionarios' => $funcionarios)); 
        }
    }

    public function atualizar_dependente() {
        $this->atualizar_endereco();

        if($_POST['nome_dependente'] != '' && $_POST['cpf'] != '' && $_POST['idade'] != '') {
            $id_depen = $this->input->get('id');
            $dependente = $this->em->find('models\entidades\Dependente', $id_depen);

            $dependente->setNome($this->input->post('nome_dependente'));
            $dependente->setCpf($this->input->post('cpf'));
            $dependente->setIdade($this->input->post('idade'));
            $this->em->flush();
            $_SESSION['mensagem_up'] = "Cadastro atualizado com sucesso!";
            return redirect('listar?id=dependente');
        }
        else {
            $this->preencher_form();
        }
    }
    
    public function deletar_dependente() {
        if(isset($_GET['id'])) {
            $obj_depen = $this->input->get('id');
            $dependente = $this->em->find('models\entidades\Dependente', $obj_depen);
            $this->em->remove($dependente);
            $this->em->flush();
        }
        return redirect('listar?id=dependente');
    }

    public function filtrar() {
        if(isset($_GET['procura_funcionarios'])) {
            $qb = $this->em->getRepository('models\entidades\Funcionario')->createQueryBuilder('f');

            $funcionarios = $qb->select(['f', 'e'])
            ->innerJoin('models\entidades\Endereco', 'e', 'WITH', 'f.endereco = e.id') 
            ->where($qb->expr()->orX(
                $qb->expr()->like('f.nome', $qb->expr()->literal('%'. $_GET['procura_funcionarios'] .'%'))
            ))
            ->getQuery()
            ->getScalarResult();

            if(empty($_GET['procura_funcionarios'])) {
                print_r("Error");
            }
            else {
                $this->load->view('pages/pesquisa-funcionarios', (array('funcionarios' => $funcionarios)));
            }
        }
    }

    public function deletar_dependente_funcionario() {   
        $tipo = $this->input->post('tipo');
        $id_depen = $this->input->post('dependente');
        $id_fun =  $this->input->post('funcionario');
        $dependente = $this->em->getReference('models\entidades\Dependente', $id_depen);
        $funcionario = $this->em->find('models\entidades\Funcionario', $id_fun);
        
        if($tipo == 'dependente-de-funcionario') {
            $funcionario->removeDependente($dependente);
            $this->em->flush();
            print_r($id_depen);
        }
        else if($tipo == 'funcionario-de-dependente') {
            $dependente->removeFuncionario($funcionario);
            $this->em->flush();
            print_r($id_fun);
        }
    }

}