var grid = new Grid();
fetch("../backend/selectGrid.php?projeto="+idProjeto)
.then(response => response.json())
.then(response => {
    grid.addFases(response);
    grid.desenharGrid();
})

function confirmarDelecao(fase){
    return swal({
        title: "Excluir Iteração",
        icon: "error",
        closeOnClickOutside: false,
        closeOnEsc: false,
        text: "Deseja realmente excluir a última Iteracao da " + fase + "?",
        buttons: {
            cancel: {
                text: "    Não   ",
                value: false,
                visible: true,
                className: "btn btn-warning"
            },
            sim: {
                text: "  Sim Excluir   ",
                value: true,
                visible: true,
                className: "btn btn-danger"
            }
        }
    });
}

function deletarIteracao(fase,id,projeto) {
    confirmarDelecao(fase)
    .then(response =>{
        if(response){
            window.location.href = "../backend/deletarIteracao.php?id=" + id + "&projeto=" + projeto;
        }
    })
}
