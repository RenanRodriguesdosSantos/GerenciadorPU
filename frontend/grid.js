class Grid{
    constructor(){
        this.canvas = document.getElementById("idCanvas");
        this.fase = [];
        this.tamanho = 0;
        this.url = "";
    }

    desenharGrid(){
        this.calcTamanho();
        this.canvas.width = (this.tamanho * 80) + 1;
        this.precherGrid();
        var context = this.canvas.getContext("2d");
        context.beginPath();
        this.canvas.addEventListener("mousemove", e => this.onMouse(e,this.fase, this.canvas),false);
        this.canvas.addEventListener("click", e => this.onClick(e,this.url),false);
        
        context.translate(0.5,0.5);
        context.moveTo(0, 0);
        context.lineTo(this.canvas.width, 0);
        for(var y = 100; y < 570; y += 50){
            context.moveTo(0, y);
            context.lineTo(this.canvas.width, y);
        }
        context.fillStyle = "#000";
        context.font = "bold 18px sans-serif"
        context.fillText("Disciplinas", 30, 35);
        context.fillText("X", 70, 60);
        context.fillText("Fases", 50, 80);
        context.font = "bold 16px sans-serif"
        context.fillText("Modelo de Negócios", 2, 130);
        context.font = "bold 18px sans-serif"
        context.fillText("      Requisitos", 15, 180);
        context.fillText("Análise e Design",9, 230);
        context.fillText("Implementação",15, 280);
        context.fillText("         Teste", 15, 330);
        context.fillText("   Implantação", 15, 380);
        context.font = "bold 16px sans-serif"
        context.fillText("      Gerência de ", 5, 420);
        context.fillText(" Config. e Mudança", 5, 440);
        context.fillText("  Gerenciamento", 5, 470);
        context.fillText("      de Projeto", 5, 490);
        context.font = "bold 18px sans-serif"
        context.fillText("   Ambiente", 15, 530);
        context.moveTo(0, 0);
        context.lineTo(0, 550);

        context.moveTo(160, 0);
        context.lineTo(160, 550);

        context.moveTo(160,50);
        context.lineTo(this.canvas.width, 50);
        for(var i = 0; i < this.fase.length; i++){
            var multp = 0;
            for(var j = 0; j <= i; j++){
                let tam = this.fase[j].iteracao.length;
                multp += tam;
                multp += this.fase[j].iteracao.length == 1?1:0;
            }
            context.moveTo(160  + (multp * 80), 0);
            context.lineTo(160  + (multp * 80), 550);

            if(this.fase[i].iteracao.length == 1){
                context.fillText(this.fase[i].titulo,(multp * 80) - ((this.fase[i].iteracao.length * 80)/2) + 80, 32)
                context.fillText(this.fase[i].iteracao[0].nome, (multp * 80) - ((this.fase[i].iteracao.length * 80)/2) + 110, 80);
            }
            else if(this.fase[i].iteracao.length > 1){
                context.fillText(this.fase[i].titulo,(multp * 80) - ((this.fase[i].iteracao.length * 80)/2) + 120, 32);
                multp -= this.fase[i].iteracao.length;
                for(var j = 0; j < this.fase[i].iteracao.length; j++){
                    context.fillText(this.fase[i].iteracao[j].nome, 110 + ((j+1) * 80 + (multp * 80)), 80);
                    context.moveTo(160 + ((j+1) * 80 + (multp * 80)),50);
                    context.lineTo(160 + ((j+1) * 80 + (multp * 80)), 550);
                }
            }
        }

        context.strokeStyle = "#000";
        context.stroke();
        context.closePath();
    }

    calcTamanho(){
        this.fase.forEach(element => {
            if(element.iteracao.length <= 1){
                this.tamanho += 2;
            }
            else{
                this.tamanho += element.iteracao.length;
            }
        });
        this.tamanho += 2;
    }

    addFase(fase){
        this.fase.push(fase);
    }

    onMouse(ev, fase, canvas){
        var x, y;
        if (ev.layerX || ev.layerX == 0) { 
            x = ev.layerX;
            y = ev.layerY;
        }
        for(var i = 0; i < fase.length; i++){
            var multp = 0;
            for(var j = 0; j <= i; j++){
                let tam = fase[j].iteracao.length;
                multp += tam;
                multp += fase[j].iteracao.length == 1?1:0;
            }
            if(fase[i].iteracao.length <= 1){
                for(var j = 1; j <= 9; j++){
                    if(x >= (multp * 80) && x < (160  + (multp * 80)) && y >= (j*50) + 50 && y <((j * 50) + 100)){
                        if(j >= 1 && j <= 9){
                            canvas.style.cursor = "pointer";
                            this.url = "viewDisciplina.php?id=" + fase[i].iteracao[0].disciplinas[(j - 1)].id + "&projeto=" + idProjeto;
                        }
                    }
                }
            }
            else{
                multp -= this.fase[i].iteracao.length;
                for(var j = 0; j < fase[i].iteracao.length; j++){
                    for(var k = 1; k <= 9; k++){
                        if(x >= (80 + ((j+1) * 80 + (multp * 80))) && x < (160 + ((j+1) * 80 + (multp * 80))) && y >= ((k*50) + 50) && y <((k * 50) + 100)){
                            if(k >= 1 && k <= 9){
                                canvas.style.cursor = "pointer";
                                this.url = "viewDisciplina.php?id=" + fase[i].iteracao[j].disciplinas[(k -1)].id + "&projeto=" + idProjeto;
                            }
                        }
                    }
                }
            }
            if(x < 160 || y < 100){
                canvas.style.cursor = "";
                this.url = "";
            }
        }
    }
    onClick(ev, url){
        if(this.url){
            window.location.href =  this.url;
        }
    }

    precherGrid(){
        var context = this.canvas.getContext("2d");
        var cores = ["#FF0000","#FFA500","#FFD700","#FFFF00","#008000","#00BFFF","#0011FF","#191970","#8B008B"];
        for(var i = 0; i < 9; i++){
            var y =  ((i+1)*50) + 100;
            var x = 160;
            y =  ((i+1)*50) + 100;
            context.beginPath();
            context.fillStyle = cores[i];   
            context.moveTo(x, y);
            for(var j = 0; j < this.fase.length; j++){
                for(var k = 0; k < this.fase[j].iteracao.length; k++){
                    y = ((i + 1) * 50) + 100 - (this.fase[j].iteracao[k].disciplinas[i].tempo * 2);
                    x += 80 + (this.fase[j].iteracao.length == 1?80:0);
                    context.lineTo(x - (this.fase[j].iteracao.length == 1?80:40), y);
                }
            }
            context.lineTo(x,((i+1)*50) + 100);
            context.fill();
        }
    }

    addFases(fases){
        fases.forEach(element => {
            this.addFase(element);
        });
    }
}
