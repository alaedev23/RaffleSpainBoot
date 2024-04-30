<section id="datesClient">
    <div id="asideDatesClient">
        <h2>Configuración</h2>
        <div id="asideContent">
            <ul>
                <li id="DetallesCuenta"><span><svg class="iconoDatesClient" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                </svg></span> Detalles de Cuenta</li>
                <li id="MetodosPago"><span><svg class="iconoDatesClient" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-archive" viewBox="0 0 16 16">
  					<path d="M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 12.5V5a1 1 0 0 1-1-1zm2 3v7.5A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5V5zm13-3H1v2h14zM5 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"/>
                </svg></span> Direccion de Envio</li>
                <li id="CambiarContraseña"><span><svg xmlns="http://www.w3.org/2000/svg" class="iconoDatesClient" fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
                    <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8m4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5"/>
                    <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                </svg></span> Cambiar Contraseña</li>
            </ul>
        </div>
    </div>
    <div id="contentDatesClient">
        <div id="contentDetallesCuenta">
            <h3>Detalles de Cuenta</h3>
            <?= $htmlDetalleCuenta ?>
        </div>
        <div id="contentMetodosPago">
            <h3>Direccion de envio</h3>
            <?= $htmlChangeDirection ?>
        </div>
        <div id="contentCambiarContraseña">
            <h3>Cambiar Contraseña</h3>
            <?= $htmlChangePassword ?>
        </div>
    </div>
</section>
