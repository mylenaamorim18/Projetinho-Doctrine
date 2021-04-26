<?php include("capsulas/capsula-inicio.php")?>

<style type="text/css">
body{
  background-image: url('https://images.pexels.com/photos/461077/pexels-photo-461077.jpeg?cs=srgb&dl=pexels-picjumbocom-461077.jpg&fm=jpg');
  background-size: cover;
  background-repeat: no-repeat;
}
.home{
  margin-top:10%;
} 
.home a{
  background-color: #086A87; color: #ffffff;
}
a-2{
  margin-top:3%;
}
</style>

<div class="container home list-group col-md-3">
  <a href="<?=site_url('listar?id=funcionario')?>" class="h5 list-group-item text-center list-group-item-action')?>">Listar Funcionários</a>
  <a id="a-2" href="<?=site_url('listar?id=dependente')?>" class="h5 list-group-item text-center list-group-item-action')?>">Listar Dependentes</a>
</div>

<?php include("capsulas/capsula-fim.php")?>