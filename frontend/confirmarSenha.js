function confirmarSenhaForm() {
    var senha = document.querySelector("#novaSenha").value;
    if(!senha){
        var alertSenha = document.querySelector("#alertSenha");
        alertSenha.innerText = "Preencha todos os campos!";
        alertSenha.classList.remove("d-none");
        return false;
    }
    else{
        var senhaConfirmar = document.querySelector("#confirmarSenha").value;
        if(senha == senhaConfirmar){
            return true;
        }
        else{
            var alertSenha = document.querySelector("#alertSenha");
            alertSenha.innerText = "Senhas Diferentes!";
            alertSenha.classList.remove("d-none");
            return false;
        }
    }
}