var inputArtefatos = document.getElementById("artefatos");
var inputArtefatosCustumInterna = document.getElementById("artefatosCustumInterna");

inputArtefatos.addEventListener("change",function(){
    showArquivos(this.files);
});

function defaultInputActive(){
    inputArtefatos.click();
}

function doDrop(event) {
    event.preventDefault();
    event.stopPropagation();
    inputArtefatos.files = event.dataTransfer.files;
    showArquivos(inputArtefatos.files);
}

function showArquivos(files) {
    inputArtefatosCustumInterna.innerHTML = "";
    for (let i = 0; i < files.length; i++) {
        const element = files[i];
        let nome = element.name;
        if(nome.length > 10){
            nome = nome.substring(0, 5) + ".." + nome.substring(nome.length - 4, nome.length);
        }
        if(element.type == "application/pdf"){
            inputArtefatosCustumInterna.innerHTML += "<div class='col-md-2'><img src='images/imagePDF.png'><br>" + nome + "</div>";
        }
        else if(element.type.split("/")[0] == "image"){
            inputArtefatosCustumInterna.innerHTML += "<div class='col-md-2'><img src='images/imageImage.png'><br>" + nome + "</div>";
        }
        else{
            inputArtefatosCustumInterna.innerHTML += "<div class='col-md-2'><img src='images/imageText.png'><br>" + nome + "</div>";
        }
        
    }
}