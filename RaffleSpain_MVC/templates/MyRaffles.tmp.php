<?= (count($raffles) === 0) ? '<section style="height: calc(100vh - 462px)" id="myRaffles ">' : '<section id="myRaffles ">' ?>
	<div class="containerError">
    	<?= isset($errors) ? "<div class=\"errorMessage\"><p>$errors</hp></div>" : ''; ?>
    </div>
    <div id="filterProducts" class="containerProductos">
            <?= (strlen($templateMyRaffle) > 0)  
            ? "<h1>Mis Rifas</h1>" . $templateMyRaffle : '<h1>No has participado en ninguna rifa</h1>' ?>
    </div>
</section>