<div id="searchRaffle">
    <div class="searchContainer">
        <form action="?raffle/searchRaffles/" method="POST">
            <input id="searchInput" type="search" name="searchInput" value="<?= ($searchText !== null) ? $searchText : '' ?>">
            <button type="submit" style="margin-right: 20px" id="btnSearchSudmit" class="btn" name="serachRaffle">Buscar</button>
            <a href="?raffle/showAll" class="btn" name="reset">Ver Todas</a>
            <?= isset($errors) ? "<div class=\"errorMessage\"><p>$errors</hp></div>" : ''; ?>
        </form>
    </div>
    <div id="filterProducts" class="containerProductos">
        <?= isset($templateRaffle) ? $templateRaffle : '' ?>
    </div>
</div>
