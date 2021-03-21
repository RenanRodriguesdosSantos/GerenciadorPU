var output = document.getElementById("output");
var buttons = document.getElementsByClassName("tool-btn");
for(let btn of buttons){
    btn.addEventListener('click',() =>{
        let cmd =  btn.dataset["command"];
        if(cmd === 'createLink'){
            let url = prompt("Digite o link", "http:\/\/"); 
            document.execCommand(cmd,false, url);
        }
        else{
            document.execCommand(cmd,false, null);
        }
    });
}

function formatDoc(sCmd, sValue) {
    document.execCommand(sCmd, false, sValue); output.focus();
}

function salvar() {
    this.texto.value = output.innerHTML;
    return true;
}
