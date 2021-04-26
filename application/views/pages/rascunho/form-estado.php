<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>Form 1</title>
</head>
<body>

<form action="<?php echo site_url(isset($estado) ? 'estados/'. $estado->getId() .'/atualizar' : 'estados/salvar');?>" method="POST">

<?php if(isset($estado)):?>
  <input type="hidden" name="_method" value="PUT">
<?php endif;?>

  <div class="form-group">
    <label for="uf">Uf: </label>
    <input type="text" class="form-control" id="uf" name="uf" value="<?= isset($estado) ? $estado->getUf() : ''?>" placeholder="Digite a UF do seu estado">
  </div>
  <div class="form-group">
    <label for="nome">Nome: </label>
    <input type="text" class="form-control" id="nome" name="nome_estado" value="<?= isset($estado) ? $estado->getNome() : ''?>" placeholder="Digite o nome do seu estado">
  </div>

  <button type="submit" class="btn btn-primary"><?= isset($estado) ? 'Editar' : 'Adicionar'?> o Estado</button>
</form>
</body>
</html>