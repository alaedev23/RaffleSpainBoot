<header>
    <div class="header-content">
        <a href="." id="logo"><img src="../public/img/logo.png" alt="Logo"></a>
        <nav id="gender-header">
            <ul>
                <li><a href="?productSex/show/H">HOMBRE</a></li>
                <li><a href="?productSex/show/M">MUJER</a></li>
                <li><a href="?productSex/show/N">NIÑO</a></li>
            </ul>
        </nav>
    </div>
    <nav>
        <ul id="menu">
            <li><a href="?favoritos/show"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-heart icono" viewBox="0 0 16 16">
                  <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                </svg></a></li>
            <li><a href="?cistella/show"><svg xmlns="http://www.w3.org/2000/svg" id="iconoBasket" fill="currentColor" class="icono" class="bi bi-cart" viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                    </svg></a></li>
            <li><a href="?producte/showSearchProducts"><svg xmlns="http://www.w3.org/2000/svg" id="iconoSearch" class="icono" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                    </svg></a></li>
            <li><a href="?raffle/showAll"><svg xmlns="http://www.w3.org/2000/svg" class="icono" fill="currentColor" class="bi bi-box2-heart" viewBox="0 0 16 16">
                    <path d="M8 7.982C9.664 6.309 13.825 9.236 8 13 2.175 9.236 6.336 6.31 8 7.982"/>
                    <path d="M3.75 0a1 1 0 0 0-.8.4L.1 4.2a.5.5 0 0 0-.1.3V15a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V4.5a.5.5 0 0 0-.1-.3L13.05.4a1 1 0 0 0-.8-.4zm0 1H7.5v3h-6zM8.5 4V1h3.75l2.25 3zM15 5v10H1V5z"/>
                </svg></a></li>
            <?php
            if (!isset($_SESSION['usuari'])) {
                echo '<li>
                            <div class="dropdown">
                                <svg xmlns="http://www.w3.org/2000/svg" onclick="dropdown(this)" fill="currentColor" class="icono drop-button" viewBox="0 0 16 16">
                                    <path class="pathDropdown" d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                                </svg>
                                <div id="dropdownLogin" class="login-dropdown dropdown-content">
                                    <a href="?client/formLogin">Iniciar Sesión</a>
                                    <a href="?client/formRegister">Registrarse</a>
                                </div>
                            </div>
                        </li>';
            } else {
                if ($_SESSION['userAdmin'] === true) {
                    echo '<li>
                            <div class="dropdown">
                                <svg xmlns="http://www.w3.org/2000/svg" onclick="dropdown(this)" fill="currentColor" class="icono drop-button" viewBox="0 0 16 16">
                                    <path class="pathDropdown" d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5v-1a2 2 0 0 1 .01-.2 4.49 4.49 0 0 1 1.534-3.693Q8.844 9.002 8 9c-5 0-6 3-6 4m7 0a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1"/>
                                </svg>    
                                <div id="dropdownAdmin" class="dropdown-content">
                                    <a href="?admin/showAdminPage">Productos y Rifas</a>
                                    <a href="?ClientAdmin/show">Clientes</a>
                                </div>
                            </div>
                        </li>';
                }
                echo '<li>
                        <div class="dropdown">
                            <svg xmlns="http://www.w3.org/2000/svg" onclick="dropdown(this)" fill="currentColor" class="icono drop-button" viewBox="0 0 16 16">
                                <path class="pathDropdown" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                            </svg>
                            <div id="dropdownUser" class="user-dropdown dropdown-content">
                                <a href="?client/showDatesClient">Configuración</a>
                                <a href="?raffle/getRaffleClient">Mis rifas</a>
                                <a href="?Deliver/showDelivers">Mis pedidos</a>
                                <a href="?Client/showMyPrizes">Mis premios</a>
                                <a id="cambiar-tema-container">Tema <svg xmlns="http://www.w3.org/2000/svg" id="cambiar-tema" fill="currentColor" class="bi bi-brilliance" viewBox="0 0 16 16">
                                <path d="M8 16A8 8 0 1 1 8 0a8 8 0 0 1 0 16M1 8a7 7 0 0 0 7 7 3.5 3.5 0 1 0 0-7 3.5 3.5 0 1 1 0-7 7 7 0 0 0-7 7"/>
                                </svg></a>
                                <a href="?client/logOut">Log Out</a>
                            </div>
                        </div>
                    </li>';
            }
            ?>
        </ul>
        <ul id="aparecer">
            <li><a href="?favoritos/show"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-heart icono" viewBox="0 0 16 16">
                  <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                </svg></a></li>
            <li><a href="?cistella/show"><svg xmlns="http://www.w3.org/2000/svg" id="iconoBasket" fill="currentColor" class="icono" class="bi bi-cart" viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                    </svg></a></li>
            <li><a href="?producte/showSearchProducts"><svg xmlns="http://www.w3.org/2000/svg" id="iconoSearch" class="icono" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                    </svg></a></li>
            <?php
            if (!isset($_SESSION['usuari'])) {
                echo '<li>
                            <div class="dropdown">
                                <svg xmlns="http://www.w3.org/2000/svg" onclick="dropdown(this)" fill="currentColor" class="icono drop-button" viewBox="0 0 16 16">
                                    <path class="pathDropdown" d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                                </svg>
                                <div id="dropdownLogin" class="login-dropdown dropdown-content">
                                    <a href="?client/formLogin">Iniciar Sesión</a>
                                    <a href="?client/formRegister">Registrarse</a>
                                </div>
                            </div>
                        </li>';
            } else {
                echo '<li>
                        <a href="?raffle/showAll"><svg xmlns="http://www.w3.org/2000/svg" class="icono" fill="currentColor" class="bi bi-box2-heart" viewBox="0 0 16 16">
                          <path d="M8 7.982C9.664 6.309 13.825 9.236 8 13 2.175 9.236 6.336 6.31 8 7.982"/>
                          <path d="M3.75 0a1 1 0 0 0-.8.4L.1 4.2a.5.5 0 0 0-.1.3V15a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V4.5a.5.5 0 0 0-.1-.3L13.05.4a1 1 0 0 0-.8-.4zm0 1H7.5v3h-6zM8.5 4V1h3.75l2.25 3zM15 5v10H1V5z"/>
                        </svg></a>
                    </li>';
                if ($_SESSION['userAdmin'] === true) {
                    echo '<li>
                            <div class="dropdown">
                                <svg xmlns="http://www.w3.org/2000/svg" onclick="dropdown(this)" fill="currentColor" class="icono drop-button" viewBox="0 0 16 16">
                                    <path class="pathDropdown" d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5v-1a2 2 0 0 1 .01-.2 4.49 4.49 0 0 1 1.534-3.693Q8.844 9.002 8 9c-5 0-6 3-6 4m7 0a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1"/>
                                </svg>    
                                <div id="dropdownAdmin" class="dropdown-content">
                                    <a href="?admin/showAdminPage">Productos y Rifas</a>
                                    <a href="#">Link 2</a>
                                    <a href="#">Link 3</a>
                                </div>
                            </div>
                        </li>';
                }
                echo '<li>
                        <div class="dropdown">
                            <svg xmlns="http://www.w3.org/2000/svg" onclick="dropdown(this)" fill="currentColor" class="icono drop-button" viewBox="0 0 16 16">
                                <path class="pathDropdown" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                            </svg>
                            <div id="dropdownUser" class="user-dropdown dropdown-content">
                                <a href="?client/showDatesClient">Configuración</a>
                                <a href="?raffle/getRaffleClient">Mis rifas</a>
                                <a href="?Deliver/showDelivers">Mis pedidos</a>
                                <a href="?Client/showMyPrizes">Mis premios</a>
                                <a href="?client/logOut">Log Out</a>
                            </div>
                        </div>
                    </li>';
            }
            ?>
        </ul>
        <svg xmlns="http://www.w3.org/2000/svg" class="menu icono" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
            </svg>
    </nav>
</header>