<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.js" integrity="sha512-lOrm9FgT1LKOJRUXF3tp6QaMorJftUjowOWiDcG5GFZ/q7ukof19V0HKx/GWzXCdt9zYju3/KhBNdCLzK8b90Q==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.css" integrity="sha512-NXUhxhkDgZYOMjaIgd89zF2w51Mub53Ru3zCNp5LTlEzMbNNAjTjDbpURYGS5Mop2cU4b7re1nOIucsVlrx9fA==" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="<?= base_url('/assets/jquery/main.js')?>"></script>
    <title>Doctrine</title>
    <style>
      h2{
        margin-top: 1.2%;
      }
      nav{
        background-color: #086A87;
      }
      .btt-cadastro{
        margin-top:20px; background-color: #086A87; color: #ffffff;
      }
      table .table{
        margin-top:10px; width:500px;
      }
      .table-list{
        margin-top:40px;
      }
    </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand text-white" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-1 mb-lg-2">
          <li class="nav-item">
            <a class="nav-link active text-white" aria-current="page" href="<?=site_url('home')?>">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active text-white" aria-current="page" href="<?=site_url('/funcionario/criar?id=funcionario')?>">Cadastrar Funcionário</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active text-white" aria-current="page" href="<?=site_url('/dependente/criar?id=dependente')?>">Cadastrar Dependente</a>
          </li>
        </ul>
        <form class="d-flex" action="<?php echo site_url('/pesquisar')?>" method="GET">
          <input type="text" class="form-control me-2" name="procura_funcionarios" placeholder="Pesquisar Funcionário">
          <button type="submit" class="btn btn-outline-light">Pesquisar</button>
        </form>
      </div>
    </div>
  </nav>