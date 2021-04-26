<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Doctrine\ORM\Query\Expr\Join;

use models\entidades\Pessoa;
use models\entidades\Funcionario;
use models\entidades\Dependente;
use models\entidades\Endereco;
use models\entidades\Estado;


class ReutilizarCode extends CI_Controller {

	public $em;

    function __construct() {
        parent::__construct();

        $this->load->helper('url');

        $this->em = $this->doctrine->em;
    }

    public function cadastro_endereco() {
        $endereco = new Endereco;
        $endereco->setRua($this->input->post('rua'));
        $endereco->setCidade($this->input->post('cidade'));
        $endereco->setBairro($this->input->post('bairro'));
        $endereco->setEstado($this->input->post('estado'));
        $endereco->setNumero($this->input->post('numero'));
        $this->em->persist($endereco);
        $this->em->flush();

        $ultimo_registro = end($endereco);
        $endereco_obj = $this->em->find('models\entidades\Endereco', $ultimo_registro);

        return $endereco_obj;
    }

    public function atualizar_endereco() {
        $id_end = $this->input->get('end');
        $endereco = $this->em->find('models\entidades\Endereco', $id_end);
        
        $endereco->setRua($this->input->post('rua'));
        $endereco->setCidade($this->input->post('cidade'));
        $endereco->setBairro($this->input->post('bairro'));
        $endereco->setEstado($this->input->post('estado'));
        $endereco->setNumero($this->input->post('numero'));
    }

    public function preencher_form() {
        $tipo = $this->input->get('tipo');

        $estados = $this->em->getRepository('models\entidades\Estado')->findAll();
        $uf_id= $this->input->post('estado');
        $estado_selecionado = $this->em->find('models\entidades\Estado', $uf_id);
        $rua = $this->input->post('rua');
        $cidade = $this->input->post('cidade');
        $bairro = $this->input->post('bairro');
        $numero = $this->input->post('numero');
        $nome = $this->input->post('nome_funcionario');
        $cpf = $this->input->post('cpf');

        if($tipo == 'funcionario') {
            $dependentes = $this->em->getRepository('models\entidades\Dependente')->findAll();
            
            $departamento = $this->input->post('departamento');
            $dependentes_selecionado = null;

            if(isset($_POST['dependentes'])) {
                $id_dependentes = array();
                foreach($_POST['dependentes'] as $dependente) {
                    $obj_dependente = $this->em->find('models\entidades\Dependente', $dependente);
                    array_push($id_dependentes, $obj_dependente);
                }
                $dependentes_selecionado = $this->em->getRepository('models\entidades\Dependente')->findBy(array('id' => $id_dependentes));
            }

            $mensagem = "<p style='color:red;'>Preencha todos os campos!</p>";

            $this->load->view('pages/form-funcionario', array('mensagem' => $mensagem, 'nome' => $nome, 'cpf' => $cpf, 'departamento' => $departamento, 'rua' => $rua, 'cidade' => $cidade, 
            'bairro' => $bairro, 'estado_selecionado' => $estado_selecionado, 'numero' => $numero, 'estados' => $estados, 'dependentes' => $dependentes, 'dependentes_selecionado' => $dependentes_selecionado));
        }
        else if($tipo == 'dependente') {
            $funcionarios = $this->em->getRepository('models\entidades\Funcionario')->findAll();
            
            $idade = $this->input->post('idade');
            $funcionarios_selecionado = null;

            if(isset($_POST['funcionarios'])) {
                $id_funcionarios = array();
                foreach($_POST['funcionarios'] as $funcionario) {
                    $obj_funcionario = $this->em->find('models\entidades\Funcionario', $funcionario);
                    array_push($id_funcionarios, $obj_funcionario);
                }
                $funcionarios_selecionado = $this->em->getRepository('models\entidades\Funcionario')->findBy(array('id' => $id_funcionarios));
            }

            $mensagem = "<p style='color:red;'>Preencha todos os campos!</p>";

            $this->load->view('pages/form-dependente', array('mensagem' => $mensagem, 'nome' => $nome, 'cpf' => $cpf, 'idade' => $idade, 
            'rua' => $rua, 'cidade' => $cidade,'bairro' => $bairro, 'estado_selecionado' => $estado_selecionado, 'numero' => $numero, 'estados' => $estados, 
            'funcionarios' => $funcionarios, 'funcionarios_selecionado' => $funcionarios_selecionado));
        }
        else {
            print_r("Passe o tipo na url");
        }
    }
    
}
