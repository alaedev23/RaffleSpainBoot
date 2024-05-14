<div id="searchProduct">
    <div id="searcherProduct">
        <form action="?producte/searchProducts/" method="POST">
            <input class="searchInput" type="search" name="searchInput" value="<?= ($searchText !== null) ? $searchText : '' ?>">
            <div>
                <button type="submit" style="margin-right: 20px" id="btnSearchSudmit" class="btn" name="serachProducts">Buscar</button>
                <a href="?producte/showSearchProducts" class="btn" name="reset">Ver Todos</a>
            </div>
        </form>
    </div>
    <div class="containerError">
        <?= isset($errors) ? "<div class=\"errorMessage\"><p>$errors</hp></div>" : ''; ?>
    </div>
    <div id="filterProducts" class="containerProductos">
        <?= isset($templateProduct) ? $templateProduct : '' ?>
    </div>
</div>
