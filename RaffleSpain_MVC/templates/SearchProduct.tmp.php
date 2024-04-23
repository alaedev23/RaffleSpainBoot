<div id="searchProduct">
    <div id="searchProduct">
        <form action="?producte/searchProducts/" method="POST">
            <input id="searchInput" type="search" name="searchInput" value="<?= ($searchText !== null) ? $searchText : '' ?>">
            <button type="submit" style="margin-right: 20px" id="btnSearchSudmit" class="btn" name="serachProducts">Buscar</button>
            <a href="?producte/showSearchProducts" class="btn" name="reset">Ver Todos</a>
            <?= isset($errors) ? "<div class=\"errorMessage\"><p>$errors</hp></div>" : ''; ?>
        </form>
    </div>
    <div id="filterProducts" class="containerProductos">
        <?= isset($templateProduct) ? $templateProduct : '' ?>
    </div>
</div>
