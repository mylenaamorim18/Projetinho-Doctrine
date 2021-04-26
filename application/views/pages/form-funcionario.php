<?php include("capsulas/capsula-inicio.php")?>

<h2 class="text-center">Cadastro de funcionários</h2>
<div class="box">

    <form class="container" id="formulario" action="<?php echo site_url(isset($funcionario) ? 'funcionario/atualizar?id='. $funcionario->getId() . '&end=' . $endereco->getId() . '&tipo=funcionario' : 'funcionario/salvar?tipo=funcionario');?>" method="POST">

    <?php if(isset($funcionario)): ?>
    <input type="hidden" name="_method" value="PUT">
    <?php endif; ?>

    <div class="form-group">
        <label for="rua">Rua: </label>
        <input type="text" class="form-control" id="rua" name="rua" value="<?= isset($rua) ? $rua : (isset($endereco) ? $endereco->getRua() : '')?>" placeholder="Rua">
    </div>
    <div class="form-group">
        <label for="bairro">Bairro: </label>
        <input type="text" class="form-control" id="bairro" name="bairro" value="<?= isset($bairro) ? $bairro : (isset($endereco) ? $endereco->getBairro() : '')?>" placeholder="Bairro">
    </div>
    <div class="form-group">
        <label for="numero">Nº: </label>
        <input type="text" class="form-control" id="numero" name="numero" value="<?= isset($numero) ? $numero : (isset($endereco) ? $endereco->getNumero() : '')?>" placeholder="O número da residência">
    </div>
    <div class="form-group">
        <label for="cidade">Cidade: </label>
        <input type="text" class="form-control" id="cidade" name="cidade" value="<?= isset($cidade) ? $cidade : (isset($endereco) ? $endereco->getCidade() : '')?>" placeholder="Cidade">
    </div>
    <div class="form-group">
        <label for="estado">Estado: </label>
    <select class="form-select form-select-sm" name="estado" style="margin-top:5px; width:200px">
        <option value="<?= isset($estado_selecionado) ? $estado_selecionado->getId() : (isset($endereco) ? $estado->getId() : '')?>"><?= isset($estado_selecionado) ? $estado_selecionado->getNome() : (isset($endereco) ? $estado->getNome() : 'Selecione o estado')?></option>
        <?php
        foreach ($estados as $row) {
        ?>
            <option value="<?= $row->getId() ?>"><?= $row->getNome() ?></option>
        <?php
        }
        ?>
    </select>
    </div>

    <div class="form-group">
        <label for="nome">Nome: </label>
        <input type="text" class="form-control" id="nome" name="nome_funcionario" value="<?= isset($nome) ? $nome : (isset($funcionario) ? $funcionario->getNome() : '')?>" placeholder="Nome Sobrenome">
    </div>
    <div class="form-group">
        <label for="cpf">CPF: </label>
        <input type="text" class="form-control" id="cpf" name="cpf" value="<?= isset($cpf) ? $cpf : (isset($funcionario) ? $funcionario->getCpf() : '')?>" placeholder="Ex: 000.000.000-00">
    </div>

    <div class="form-group" id="dependente_tabela">
        <label for="departamento">Departamento: </label>
        <input type="text" class="form-control" id="departamento" name="departamento" value="<?= isset($departamento) ? $departamento : (isset($funcionario) ? $funcionario->getDepartamento() : '')?>" placeholder="Departamento do funcionário">
        
        <?php if(isset($funcionario)): ?>
            <table class="table table-info">
            <thead>
                <tr>
                <th scope="col">Dependente</th>
                <th scope="col">Excluir</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($dependentes as $row) {
            ?>
                <tr data-id="<?= $row->getId() ?>">
                <td><?= $row->getNome()?></td>
                <td class="coluna" data-depen="<?= $row->getId() ?>" data-fun="<?= $funcionario->getId() ?>"><button type="button"><img class="icon" src="data:image/svg+xml;base64,PHN2ZyBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAyNTYgMjU2IiBoZWlnaHQ9IjUxMiIgdmlld0JveD0iMCAwIDI1NiAyNTYiIHdpZHRoPSI1MTIiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0ibTE4Ny44MjQgOTUuNzRjMCAyOS42NC0xNC4xOSA1NS45Ny0zNi4xNSA3Mi41NS0xNS4yMiAxMS41LTM0LjE4IDE4LjMyLTU0LjczIDE4LjMyLTIxLjAxIDAtNDAuMzQtNy4xMi01NS43My0xOS4wOS0yMS4zOC0xNi42Mi0zNS4xNC00Mi41OS0zNS4xNC03MS43OCAwLTUwLjE5IDQwLjY4LTkwLjg4IDkwLjg3LTkwLjg4czkwLjg4IDQwLjY5IDkwLjg4IDkwLjg4eiIgZmlsbD0iIzVmY2RmZiIvPjxwYXRoIGQ9Im01Ni4yMTQgMTY3LjUyYzEzLjU0IDEwLjUzIDMwLjEyIDE3LjMgNDguMjIgMTguNzgtMi40Ny4yMS00Ljk3LjMxLTcuNDkuMzEtMjEuMDEgMC00MC4zNC03LjEyLTU1LjczLTE5LjA5LTIxLjM4LTE2LjYyLTM1LjE0LTQyLjU5LTM1LjE0LTcxLjc4IDAtNTAuMTkgNDAuNjgtOTAuODggOTAuODctOTAuODggMi41MyAwIDUuMDMuMSA3LjUuMzEtNDYuNjggMy44MS04My4zNyA0Mi45MS04My4zNyA5MC41NyAwIDI5LjE5IDEzLjc2IDU1LjE2IDM1LjE0IDcxLjc4eiIgZmlsbD0iIzczZDdmOSIvPjxwYXRoIGQ9Im0xODcuODI0IDk1Ljc0YzAgMjkuNjQtMTQuMTkgNTUuOTctMzYuMTUgNzIuNTUtMTUuMjIgMTEuNS0zNC4xOCAxOC4zMi01NC43MyAxOC4zMi0yLjUzIDAtNS4wNC0uMS03LjUxLS4zMSAxNy42Ni0xLjQzIDMzLjg5LTcuOTIgNDcuMjQtMTguMDEgMjEuOTYtMTYuNTggMzYuMTUtNDIuOTEgMzYuMTUtNzIuNTUgMC00Ny42Ni0zNi43LTg2Ljc2LTgzLjM4LTkwLjU3IDIuNDctLjIxIDQuOTctLjMxIDcuNS0uMzEgNTAuMTkgMCA5MC44OCA0MC42OSA5MC44OCA5MC44OHoiIGZpbGw9IiMzMGI2ZmYiLz48cGF0aCBkPSJtMTQ5Ljc0MiAxNjUuMjJ2NC44NWMtMTQuODEgMTAuNDktMzIuOTEgMTYuNjUtNTIuNDQgMTYuNjUtMTMuMzYgMC0yNi4wNC0yLjg4LTM3LjQ3LTguMDYtNS4yOS0yLjM5LTEwLjMxLTUuMjktMTUtOC42MXYtNC44M2MwLTI3LjE1IDIwLjYyLTQ5LjQ4IDQ3LjA2LTUyLjE4LTE2LjIxLTIuNjEtMjguNjEtMTYuOC0yOC42MS0zMy45MiAwLTE4Ljk4IDE1LjIzLTM0LjM2IDM0LTM0LjM2IDEuMTggMCAyLjM0LjA2IDMuNDguMTguMjguMDMuNTcuMDYuODUuMS4yOC4wMy41Ny4wNy44NS4xMi43OC4xMiAxLjU2LjI3IDIuMzIuNDQgMTUuMTcgMy40NSAyNi41IDE3LjE0IDI2LjUgMzMuNTIgMCAxNi4zNy0xMS4zMyAzMC4wNi0yNi40OSAzMy41LS4yOC4wNy0uNTYuMTMtLjg1LjE5LS40Mi4wOS0uODQuMTYtMS4yNi4yMy43MS4wNyAxLjQxLjE2IDIuMTEuMjYgMjUuNDEgMy42NCA0NC45NSAyNS41IDQ0Ljk1IDUxLjkyeiIgZmlsbD0iI2ZmZTJlMiIvPjxwYXRoIGQ9Im0xMDIuNjgyIDExMy4wNGMuNzEuMDcgMS40MS4xNiAyLjExLjI2LTI1LjQyIDMuNjMtNDQuOTYgMjUuNDktNDQuOTYgNTEuOTJ2MTMuNDRjLTUuMjktMi4zOS0xMC4zMS01LjI5LTE1LTguNjF2LTQuODNjMC0yNy4xNSAyMC42Mi00OS40OCA0Ny4wNi01Mi4xOC0xNi4yMS0yLjYxLTI4LjYxLTE2LjgtMjguNjEtMzMuOTIgMC0xOC45OCAxNS4yMy0zNC4zNiAzNC0zNC4zNiAxLjE4IDAgMi4zNC4wNiAzLjQ4LjE4LjI4LjAzLjU3LjA2Ljg1LjEuMjguMDMuNTcuMDcuODUuMTIuNzguMTIgMS41Ni4yNyAyLjMyLjQ0LTE1LjE3IDMuNDUtMjYuNSAxNy4xNS0yNi41IDMzLjUyczExLjM0IDMwLjA2IDI2LjUxIDMzLjVjLS4yOC4wNy0uNTYuMTMtLjg1LjE5LS40Mi4wOS0uODQuMTYtMS4yNi4yM3oiIGZpbGw9IiNmZmVmZWUiLz48Y2lyY2xlIGN4PSIxODcuNzYyIiBjeT0iMTg4Ljk3NCIgZmlsbD0iI2ZmNGE3MyIgcj0iNjIuMTY0Ii8+PHBhdGggZD0ibTIzMS43MjQgMjMyLjkzYy0xNC4wNSAxNC4wNS0zMy4xNiAxOS45Ny01MS40NiAxNy43NiAxMy4zMy0xLjYxIDI2LjIzLTcuNTMgMzYuNDYtMTcuNzYgMjQuMjctMjQuMjggMjQuMjctNjMuNjQgMC04Ny45MS0xMC4yMy0xMC4yMy0yMy4xMy0xNi4xNS0zNi40Ni0xNy43NiAxOC4zLTIuMjEgMzcuNDEgMy43MSA1MS40NiAxNy43NiAyNC4yNyAyNC4yNyAyNC4yNyA2My42MyAwIDg3LjkxeiIgZmlsbD0iI2VhMmE2YSIvPjxwYXRoIGQ9Im0xNTguODA0IDIzMi45M2MxMC4yMyAxMC4yMyAyMy4xMyAxNi4xNSAzNi40NiAxNy43Ni0xOC4zIDIuMjEtMzcuNDEtMy43MS01MS40Ni0xNy43Ni0yNC4yOC0yNC4yOC0yNC4yOC02My42NCAwLTg3LjkxIDE0LjA1LTE0LjA1IDMzLjE2LTE5Ljk3IDUxLjQ2LTE3Ljc2LTEzLjMzIDEuNjEtMjYuMjMgNy41My0zNi40NiAxNy43Ni0yNC4yOCAyNC4yNy0yNC4yOCA2My42MyAwIDg3LjkxeiIgZmlsbD0iI2Y5NzNhMyIvPjxwYXRoIGQ9Im0yMTYuMTIyIDIxNy4zMjZjLTQuNjg4IDQuNjg4LTEyLjI5IDQuNjgxLTE2Ljk3MSAwbC0xMS4zODQtMTEuMzg0LTExLjM4NCAxMS4zODRjLTQuNjg4IDQuNjg4LTEyLjI4MiA0LjY4OC0xNi45NzEgMC00LjY4OC00LjY4OC00LjY4OC0xMi4yODIgMC0xNi45NzFsMTEuMzg0LTExLjM4NC0xMS4zODQtMTEuMzg0Yy00LjY4OC00LjY4OC00LjY4OC0xMi4yODIgMC0xNi45NzEgNC42ODEtNC42ODEgMTIuMjgyLTQuNjg4IDE2Ljk3MSAwbDExLjM4NCAxMS4zODQgMTEuMzc3LTExLjM3N2M0LjY4OC00LjY4OCAxMi4yODItNC42ODggMTYuOTcxIDAgNC42ODggNC42ODggNC42ODggMTIuMjgyIDAgMTYuOTcxbC0xMS4zNzcgMTEuMzc3IDExLjM4NCAxMS4zODRjNC42ODEgNC42ODIgNC42ODEgMTIuMjkgMCAxNi45NzF6IiBmaWxsPSIjZmZlMmUyIi8+PHBhdGggZD0ibTIxNi4xMTUgMTYwLjYyMy01Ni43MDMgNTYuNzAzYy00LjY4OC00LjY4OC00LjY4OC0xMi4yODIgMC0xNi45NzFsMTEuMzg0LTExLjM4NC0xMS4zODQtMTEuMzg0Yy00LjY4OC00LjY4OC00LjY4OC0xMi4yODIgMC0xNi45NzEgNC42ODEtNC42ODEgMTIuMjgyLTQuNjg4IDE2Ljk3MSAwbDExLjM4NCAxMS4zODQgMTEuMzc3LTExLjM3N2M0LjY4OS00LjY4OCAxMi4yODMtNC42ODggMTYuOTcxIDB6IiBmaWxsPSIjZmZlZmVlIi8+PGcgZmlsbD0iIzVmMjY2ZCI+PHBhdGggZD0ibTIzNC41NDggMTQyLjE5MWMtMTIuNDctMTIuNDY5LTI5LjIyMi0xOS4zMzUtNDYuNjc2LTE5LjM2IDE4LjE4Ni02MS4wMDItMjcuODQ0LTEyMS45NzEtOTAuOTIyLTEyMS45NzEtNTIuMzE3IDAtOTQuODggNDIuNTYzLTk0Ljg4IDk0Ljg4IDAgMzAuMDM0IDE0LjMyNyA1OC4zNzIgMzguNDIgNzYuMjR2LjAzOWMyNi4zMDkgMTguNjE5IDU0LjkwNSAyMi4zNzcgODEuMTQ5IDE1LjMyNi0uNDU4IDE4LjA5NiA2LjQwNSAzNS40NzcgMTkuMzQyIDQ4LjQxMyAxMi40OTQgMTIuNDk5IDI5LjEwNyAxOS4zODIgNDYuNzggMTkuMzgyczM0LjI4OS02Ljg4MyA0Ni43ODgtMTkuMzgyYzEyLjQ5OC0xMi40OTggMTkuMzgxLTI5LjExMyAxOS4zODEtNDYuNzg2IDAtMTcuNjc0LTYuODgzLTM0LjI4Ny0xOS4zODItNDYuNzgxem0tMjI0LjQ3OC00Ni40NTFjMC00Ny45MDUgMzguOTc1LTg2Ljg4IDg2Ljg4LTg2Ljg4IDU4Ljk4OSAwIDEwMS4zMDYgNTguMDk5IDgyLjM3IDExNC40OTEtMTIuMTEgMS41NTgtMjMuNjMgNi40OTUtMzMuMTIzIDE0LjE1OC02LjU5Ni0xMS43NjgtMTcuNDIzLTIxLjEzLTMwLjY2LTI1LjczMSAxMS41NzMtNi41MjEgMTkuNDEtMTguOTIxIDE5LjQxLTMzLjEyNCAwLTIwLjk1My0xNy4wNDctMzgtMzgtMzhzLTM4IDE3LjA0Ny0zOCAzOGMwIDE0LjIxOCA3Ljg1NCAyNi42MyAxOS40NDcgMzMuMTQ1LTIxLjA2MyA3LjM1My0zNi40NzUgMjYuODQzLTM3LjgwMyA1MC4wNTQtMTkuMjQtMTYuNDI5LTMwLjUyMS00MC42MDYtMzAuNTIxLTY2LjExM3ptODYuOTM4IDEyLjkxMmMtMTYuNTYuMDMzLTMwLjA2LTEzLjQyNy0zMC4wNi0yOS45OTkgMC0xNi41NDIgMTMuNDU4LTMwIDMwLTMwczMwIDEzLjQ1OCAzMCAzMGMwIDE2LjUyMi0xMy40MjYgMjkuOTY2LTI5Ljk0IDI5Ljk5OXptLTQ4LjUxOCA1OS4xODFjMC01Ni43ODcgNjkuNDI1LTY4LjE5NyA5MS42Mi0yNC43NTQtOS4yMDEgOS41NDYtMTUuNjA4IDIxLjg0OS0xNy43MzkgMzUuNzU1LTI0LjA0OSA3LjM0LTUxLjM2OSA0LjE2Ni03My44ODEtMTEuMDAxem0xODAuNDAyIDYyLjI2OWMtMTAuOTg3IDEwLjk4Ny0yNS41OTQgMTcuMDM4LTQxLjEzIDE3LjAzOHMtMzAuMTQtNi4wNTEtNDEuMTIzLTE3LjAzOGMtMTIuNjA5LTEyLjYwOS0xOC42ODMtMzAuMDIxLTE2LjY2NS00Ny43NzFsLjAwMS0uMDA2YzMuMjAyLTI4LjAwNiAyNS44MTctNDguOTMyIDUyLjY1Ny01MS4yOSAxNy4xOTgtMS41MTkgMzQuMDU4IDQuNjExIDQ2LjI2MSAxNi44MTQgMTAuOTg3IDEwLjk4MiAxNy4wMzggMjUuNTg3IDE3LjAzOCA0MS4xMjMtLjAwMSAxNS41MzUtNi4wNTIgMzAuMTQyLTE3LjAzOSA0MS4xM3oiLz48cGF0aCBkPSJtMjEwLjM5MSAxODguOTc1IDguNTU0LTguNTU1YzYuMjM4LTYuMjM4IDYuMjM4LTE2LjM4OSAwLTIyLjYyNy02LjIzOS02LjIzOC0xNi4zOS02LjIzOC0yMi42MjcgMGwtOC41NTQgOC41NTQtOC41NTQtOC41NTRjLTMuMDIxLTMuMDIyLTcuMDQtNC42ODctMTEuMzEzLTQuNjg3cy04LjI5MiAxLjY2NC0xMS4zMTQgNC42ODdjLTYuMjM4IDYuMjM4LTYuMjM4IDE2LjM4OSAwIDIyLjYyN2w4LjU1NSA4LjU1NS04LjU1NSA4LjU1NGMtNi4yMzggNi4yMzgtNi4yMzggMTYuMzg5IDAgMjIuNjI3IDMuMTE5IDMuMTE5IDcuMjE3IDQuNjc5IDExLjMxNCA0LjY3OXM4LjE5NC0xLjU2IDExLjMxMy00LjY3OWw4LjU1NC04LjU1NCA4LjU1NCA4LjU1NGM2LjIzOCA2LjIzOCAxNi4zODkgNi4yMzggMjIuNjI3IDAgMy4wMjItMy4wMjEgNC42ODYtNy4wNCA0LjY4Ni0xMS4zMTMgMC00LjI3NC0xLjY2NS04LjI5Mi00LjY4Ni0xMS4zMTN6bTIuODk3IDI1LjUyNGMtMy4xMiAzLjExOS04LjE5NSAzLjExNy0xMS4zMTMgMGwtMTEuMzgyLTExLjM4M2MtMS41NjMtMS41NjItNC4wOTUtMS41NjItNS42NTcgMGwtMTEuMzgyIDExLjM4M2MtMy4xMiAzLjExOS04LjE5NSAzLjExOS0xMS4zMTMgMC0zLjExOS0zLjExOS0zLjExOS04LjE5NCAwLTExLjMxNGwxMS4zODMtMTEuMzgyYzEuNTYxLTEuNTYgMS41NjMtNC4wOTQgMC01LjY1NmwtMTEuMzgzLTExLjM4M2MtNS4wMzctNS4wMzktMS40MjMtMTMuNjU3IDUuNjU3LTEzLjY1NyAyLjEzNyAwIDQuMTQ2LjgzMiA1LjY1NiAyLjM0M2wxMS4zODMgMTEuMzgzYzEuNTYzIDEuNTYyIDQuMDk1IDEuNTYyIDUuNjU3IDBsMTEuMzgyLTExLjM4M2MzLjExOS0zLjExOCA4LjE5NC0zLjEyIDExLjMxMyAwczMuMTE5IDguMTk1IDAgMTEuMzE0bC0xMS4zODIgMTEuMzgzYy0xLjU2MiAxLjU2Mi0xLjU2MiA0LjA5NSAwIDUuNjU2bDExLjM4MiAxMS4zODJjMS41MTEgMS41MTEgMi4zNDMgMy41MiAyLjM0MyA1LjY1Ny0uMDAyIDIuMTM3LS44MzQgNC4xNDUtMi4zNDQgNS42NTd6Ii8+PHBhdGggZD0ibTMzLjIzOCA2MS4xNDhjLTEuOTk3LS45NDctNC4zODItLjA5NS01LjMyOSAxLjktMy42MzIgNy42NTctNS45NDMgMTUuODItNi44NzEgMjQuMjYyLS4yNDEgMi4xOTUgMS4zNDMgNC4xNzIgMy41NCA0LjQxMyAyLjI0NC4yMzYgNC4xNzUtMS4zODEgNC40MTMtMy41NC44My03LjU1MyAyLjg5Ny0xNC44NTYgNi4xNDctMjEuNzA3Ljk0Ni0xLjk5Ni4wOTUtNC4zOC0xLjktNS4zMjh6Ii8+PHBhdGggZD0ibTM5Ljc1NyA0NS4xMjVjLTEuMjYyIDEuNDI1LTIuNDg1IDIuOTE0LTMuNjM0IDQuNDI2LTEuMzM3IDEuNzU4LS45OTYgNC4yNjguNzYzIDUuNjA0LjcyNC41NTEgMS41NzQuODE2IDIuNDE4LjgxNiAxLjIwNyAwIDIuNC0uNTQ0IDMuMTg3LTEuNTc5IDEuMDI5LTEuMzU0IDIuMTI1LTIuNjg4IDMuMjU1LTMuOTY1IDEuNDY1LTEuNjU0IDEuMzExLTQuMTgyLS4zNDMtNS42NDYtMS42NTMtMS40NjQtNC4xODItMS4zMDktNS42NDYuMzQ0eiIvPjwvZz48L3N2Zz4=" width="30px"></td> <!-- mostrar que foi delatado com sucesso -->
                </tr>
            <?php
            }
            ?>
              </tbody>
            </table>  

        <?php else : ?>
        <label for="">Selecione os dependentes: </label>
        <select class="form-select form-select-sm" name="dependentes[]" multiple aria-label=".form-select-sm" style="width:200px">
            <?php if(isset($dependentes_selecionado)): ?>
                <?php
                foreach($dependentes_selecionado as $row) {
                ?>
                    <option value="<?= $row->getId() ?>" selected><?= $row->getNome() ?></option>       
                <?php
                }
                ?>     
                 
            <?php else : 
            foreach($dependentes as $row) {
            ?>

                <option value="<?=$row->getId()?>" ><?=$row->getNome()?></option>       

            <?php
            }
            ?>
            <?php endif; ?>  
        </select>
        <?php endif; ?>
    </div>

    <?php if(isset($mensagem)): ?>
    <?= $mensagem ?>
    <?php endif; ?>

    <button type="submit" class="btn btt-cadastro btn-success"><?= isset($funcionario) ? 'Alterar Funcionário' : 'Cadastrar funcionário'?></button>
    </form>
</div>


<script>

$(document).on('click', '.coluna', function(event) {
    event.preventDefault();
    var dependente = $(this).data("depen");
    var funcionario = $(this).data("fun");
    var tipo = "dependente-de-funcionario";

    $.post("<?= site_url('deletarvinculado?') ?>", 
    { dependente: dependente, funcionario: funcionario, tipo: tipo }, 
    function( data ) {
        $('[data-id="' + data + '"]').hide();
        notyDelete();
    }, "json");
});

</script>


<?php include("capsulas/capsula-fim.php")?>