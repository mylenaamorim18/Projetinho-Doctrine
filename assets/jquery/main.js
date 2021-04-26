function notyDelete(){
    new Noty({
        text: 'Deleteado com sucesso!',
        timeout: 3000,
        type: 'error'
    }).show();
}

function notyCadastrado(){
    new Noty({
        text: 'Cadastrado realizado com sucesso!',
        timeout: 3000,
        type: 'success'
    }).show();
}

function notyAlterado(){
    new Noty({
        text: 'Cadastrado alterado com sucesso!',
        timeout: 3000,
        type: 'success'
    }).show();
}