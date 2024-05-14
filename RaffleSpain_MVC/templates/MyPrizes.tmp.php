<?= (count($raffles) === 0) ? '<section style="height: calc(100vh - 462px)" id="myRaffles">' : '<section id="myRaffles ">' ?>
	<div class="containerError">
    	<?= isset($errors) ? "<div class=\"errorMessage\"><p>$errors</hp></div>" : ''; ?>
    </div>
    <div id="filterProducts" class="containerProductos">
            <?= (strlen($templateMyPrizes) > 0)  
            ? "<h1>Mis Premios</h1>" . $templateMyPrizes : '<h1>No has ganado ningun premio.</h1>' ?>
    </div>
</section>