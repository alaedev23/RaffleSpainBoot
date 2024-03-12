<section id="datesClient">
    <div id="asideDatesClient">
        <h2>Configuración</h2>
        <div id="asideContent">
            <ul>
                <li id="detallesCuenta"><span><svg class="iconoDatesClient" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                </svg></span> Detalles de Cuenta</li>
                <li id="metodosPago"><span><svg class="iconoDatesClient" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-credit-card" viewBox="0 0 16 16">
                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z" />
                    <path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z" />
                </svg></span> Métodos de Pago</li>
            </ul>
        </div>
    </div>
    <div id="contentDatesClient">
        <div id="contentDetallesCuenta" class="active">
            <h3>Detalles de Cuenta</h3>
            <?= $htmlDetallesCuentas ?>
        </div>
        <div id="contentMetodosPago">
            <h3>Métodos de Pago</h3>
            <p>Contenido de Métodos de pago</p>
        </div>
    </div>
</section>
