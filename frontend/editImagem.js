var inputImagens = document.getElementById("imagens");
var inputImagensCustumInterna = document.getElementById("imagensCustumInterna");

inputImagens.addEventListener("change",function(){
    showArquivos(this.files);
});

function defaultInputActive(){
    inputImagens.click();
}

function doDrop(event) {
    event.preventDefault();
    event.stopPropagation();
    inputImagens.files = event.dataTransfer.files;
    showArquivos(inputImagens.files);
}

function showArquivos(files) {
    inputImagensCustumInterna.innerHTML = "";
    for (var i = 0; i < files.length; i++) {
        const element = files[i];
        let tipo = element.type.split("/")[0];
        if(tipo == "image"){
            let nome = element.name;
            if(nome.length > 10){
                nome = nome.substring(0, 5) + ".." + nome.substring(nome.length - 4, nome.length);
            }
            inputImagensCustumInterna.innerHTML += "<div class='col-md-2'><img src='images/imageImage.png'><br>" + nome + "</div>";
            var alertImage = document.getElementById("alertaImagem");
            alertImage.classList.add("d-none");
        }
        else{
            var alertImage = document.getElementById("alertaImagem");
            alertImage.classList.remove("d-none");
            inputImagens.files = new DataTransfer().files;
            break;
        }
        
    }
}