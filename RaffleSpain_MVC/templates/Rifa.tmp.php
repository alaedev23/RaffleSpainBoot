<section id="search">
    <form method="get" role="search">
        <input type="search" class="inpSearch" placeholder="Buscar">
        <button class="btn" type="submit">Buscar</button>
    </form>
</section>
<section id="producto">
    <div id="fotosProducto">
        <div id="imagenesSecundarias">
            <img src="<?= 'public/img/vambas/' . $rifa->product->img ?>" alt="Zapatilla 2">
            <img src="<?= 'public/img/vambas/' . $rifa->product->img ?>" alt="Zapatilla 2">
            <img src="<?= 'public/img/vambas/' . $rifa->product->img ?>" alt="Zapatilla 2">
            <img src="<?= 'public/img/vambas/' . $rifa->product->img ?>" alt="Zapatilla 2">
        </div>
        <div id="imagenPrincipal">
            <img src="<?= 'public/img/vambas/' . $rifa->product->img ?>" alt="Zapatilla 1">
        </div>
    </div>
    <div id="infoProducto">
        <h1><?= str_replace('-', ' ', $rifa->product->brand) . ' ' . str_replace('-', ' ', $rifa->product->name) ?></h1>
        <h1><?= $rifa->product->price . ' €' ?></h1>
        <h3><?="Participa hasta el " . $rifa->date_end?></h3>
        <?php
        // $mRaffle = new RaffleModel();

        // $obj = new stdClass();
        // $obj->id = $rifa->id;
        // $obj->client_id = $_SESSION['usuari']->id;

        // $isIn = false;
        // if ($mRaffle->userIsInRaffle($obj)) {
        //     // Si el usuario ya está en la rifa, eliminarlo
        //     $isIn = true;
        // }

        if (isset($_SESSION['usuari']) && $isInRaffle) {
            echo "<a href='?Raffle/toggleUser/{$rifa->id}/{$_SESSION['usuari']->id}/' class='btn'>Dejar de participar</a>";
        } else if (isset($_SESSION['usuari'])) {
            echo "<a href='?Raffle/toggleUser/{$rifa->id}/{$_SESSION['usuari']->id}/' class='btn'>Participar en la rifa</a>";
        } else {
            echo '<p>Para participar en la rifa debes iniciar sesión</p>';
        }
        ?>
    </div>
</section>
