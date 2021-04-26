<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <!-- <link rel="stylesheet" type="text/css" href="css/style.css"> -->
    <title>Form Endereço</title>
</head>
<body>
<div class="box" style="margin-top: 2%;">

<form class="container" action="<?php echo site_url(isset($endereco) ? 'endereco/'. $endereco->getId() .'/atualizar' : 'endereco/salvar');?>" method="POST">

<?php if(isset($endereco)):?>
  <input type="hidden" name="_method" value="PUT">
<?php endif;?>

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
    <option>Selecione o estado</option>
      <?php
      foreach ($estado as $row) {
      ?>
        <option value="<?= $row->getId() ?>"><?= $row->getNome() ?></option>
      <?php
      }
      ?>
    </select>

  <button type="submit" class="btn btn-primary"><?= isset($endereco) ? 'Editar o Endereço' : 'Adicionar/Próximo'?></button>
</form>
</div>
</body>
</html>