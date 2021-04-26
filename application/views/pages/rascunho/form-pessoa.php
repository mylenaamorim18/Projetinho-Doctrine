<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <title>Form Pessoa</title>
</head>
<body>
<div class="box" style="margin-top: 2%;">

    <form class="container" action="<?php echo site_url(isset($pessoa) ? 'pessoa/'. $pessoa->getId() .'/atualizar' : 'pessoa/salvar');?>" method="POST">

    <?php if(isset($pessoa)): ?>
    <input type="hidden" name="_method" value="PUT">
    <?php endif; ?>

    <!-- endereço  -->
    <div class="form-group">
        <label for="rua">Rua: </label>
        <input type="text" class="form-control" id="rua" name="rua" value="<?= isset($endereco) ? $endereco->getRua() : ''?>" placeholder="Inseria a sua Rua">
    </div>
    <div class="form-group">
        <label for="bairro">Bairro: </label>
        <input type="text" class="form-control" id="bairro" name="bairro" value="<?= isset($endereco) ? $endereco->getBairro() : ''?>" placeholder="Insira o nome do seu bairro">
    </div>
    <div class="form-group">
        <label for="numero">Nº: </label>
        <input type="text" class="form-control" id="numero" name="numero" value="<?= isset($endereco) ? $endereco->getNumero() : ''?>" placeholder="Insira o número da sua residência">
    </div>
    <div class="form-group">
        <label for="cidade">Cidade: </label>
        <input type="text" class="form-control" id="cidade" name="cidade" value="<?= isset($endereco) ? $endereco->getCidade() : ''?>" placeholder="Insira o nome da sua cidade">
    </div>

    <select class="form-select form-select-sm" name="estado" style="width:200px">
        <option><?= isset($endereco) ? $endereco->getEstado() : ''?></option>
        <?php
        foreach ($estados as $row) {
        ?>
            <option value="<?= $row->getId() ?>"><?= $row->getNome() ?></option>
        <?php
        }
        ?>
    </select>

    <div class="form-group">
        <label for="nome">Nome: </label>
        <input type="text" class="form-control" id="nome" name="nome_pessoa" value="<?= isset($pessoa) ? $pessoa->getNome() : ''?>" placeholder="Nome da pessoa">
    </div>
    <div class="form-group">
        <label for="cpf">CPF: </label>
        <input type="number" class="form-control" id="cpf" name="cpf" value="<?= isset($pessoa) ? $pessoa->getCpf() : ''?>" placeholder="CPF da pessoa">
    </div>

        <div class="form-check" id="funcionario_id">
        <input class="form-check-input" type="radio" name="flexRadio" id="funcionario">
        <label class="form-check-label" for="funcionario">
            Funcionário
        </label>
        </div>
        <div class="form-check">
        <input class="form-check-input" type="radio" name="flexRadio" id="dependente">
        <label class="form-check-label" for="dependente">
            Dependente
        </label>
        </div>

    <div class="form-group" id="depar_fun">
        <label for="departamento">Departamento: </label>
        <input type="text" class="form-control" id="departamento" name="departamento" value="<?= isset($pessoa) ? $pessoa->getDepartamento() : ''?>" placeholder="Nome o departamento do funcionário">
        
        <select class="form-select form-select-sm" name="dependentes" aria-label=".form-select-sm" style="width:200px" multiple>
            <option>Selecione os dependentes do funcionário</option>
            <?php
            foreach ($dependentes as $row) {
            ?>
                <option value="<?= $row->getId() ?>"><?= $row->getNome() ?></option>       
            <?php
            }
            ?>
        </select>

    </div>

    <div class="form-group" id="idade_depen">
        <label for="idade">Idade: </label>
        <input type="text" class="form-control" id="idade" name="idade" value="<?= isset($pessoa) ? $pessoa->getIdade() : ''?>" placeholder="Idade da pessoa">
        
        <select class="form-select form-select-sm" name="funcionarios" aria-label=".form-select-sm" style="width:200px" multiple>
            <option>Selecione o funcionário</option>
            <?php
            foreach ($funcionarios as $row) {
            ?>
                <option value="<?= $row->getId() ?>"><?= $row->getNome() ?></option>       
            <?php
            }
            ?>
        </select>

    </div>

    <button type="submit" class="btn btn-primary"><?= isset($pessoa) ? 'Editar Pessoa' : 'Adicionar/Próximo'?></button>
    </form>
</div>
    <script>

        $('.box').ready(function(){
            $("div #idade_depen").hide();
            $("div #depar_fun").hide();
        });
        $("#funcionario").click(function(){
            $("div #depar_fun").show();
            $("div #idade_depen").hide();
        });
        $("#dependente").click(function(){
            $("div #idade_depen").show();
            $("div #depar_fun").hide();
        });
    
    </script>
</body>
</html>
