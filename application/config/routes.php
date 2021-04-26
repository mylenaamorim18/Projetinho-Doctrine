<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['doctrine_tools'] = 'doctrine_tools';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['listar'] = 'pessoacontroller/listar'; 
$route['pesquisar'] = 'pessoacontroller/filtrar';
$route['deletar'] = 'pessoacontroller/deletar';
$route['deletarvinculado'] = 'pessoacontroller/deletar_dependente_funcionario';

$route['funcionario/criar'] = 'pessoacontroller/criar'; 
$route['funcionario/salvar'] = 'pessoacontroller/salvar_funcionario';
$route['funcionario/editar'] = 'pessoacontroller/editar_funcionario';
$route['funcionario/atualizar'] = 'pessoacontroller/atualizar_funcionario';

$route['dependente/criar'] = 'pessoacontroller/criar';
$route['dependente/salvar'] = 'pessoacontroller/salvar_dependente';
$route['dependente/editar'] = 'pessoacontroller/editar_dependente';
$route['dependente/atualizar'] = 'pessoacontroller/atualizar_dependente';





