var grid = new Grid();
fetch("selectGrid.php")
.then(response => response.json())
.then(response => {
    grid.addFases(response);
    grid.desenharGrid();
})

