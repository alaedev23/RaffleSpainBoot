<div id="searchRaffle">
    <div id="searcherRaffle">
        <form action="?raffle/searchRaffles/" method="POST">
            <input class="searchInput" type="search" name="searchInput" value="<?= ($searchText !== null) ? $searchText : '' ?>">
            <div>
                <button type="submit" style="margin-right: 20px" id="btnSearchSudmit" class="btn" name="serachRaffle">Buscar</button>
                <a href="?raffle/showAll" class="btn" name="reset">Ver Todas</a>
            </div>
        </form>
    </div>
    <div class="containerError">
    	<?= isset($errors) ? "<div class=\"errorMessage\"><p>$errors</hp></div>" : ''; ?>
    </div>
    <div id="filterProducts" class="containerProductos">
    	<h1>Rifas Miembros</h1>
        <?= isset($templateRaffleMember) ? $templateRaffleMember : '' ?>
    </div>
    <div id="filterProducts" class="containerProductos">
        <h1>Rifas</h1>
        <?= isset($templateRaffle) ? $templateRaffle : '' ?>
    </div>
</div>
