<div id="search">
    <div id="searchProduct">
        <form action="?producte/searchProducts/" method="POST">
            <input id="searchInput" type="search" name="searchInput">
            <button type="submit" id="btnSearchSudmit" class="btn" name="serachProducts">Buscar</button>
        </form>
    </div>
    <div id="filterProducts" class="containerProductos">
        <?= isset($templateProduct) ? $templateProduct : '' ?>
    </div>
</div>
