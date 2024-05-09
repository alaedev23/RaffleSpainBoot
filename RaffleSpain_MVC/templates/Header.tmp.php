<header>
    <div class="header-content">
        <a href="." id="logo"><img src="../public/img/logo.png" alt="Logo"></a>
        <nav>
            <ul id="aparecer">
                <li><a href="?productsex/show/H">HOMBRE</a></li>
                <li><a href="?productsex/show/M">MUJER</a></li>
                <li><a href="?productsex/show/N">NIÑO</a></li>
                <li><a href="?mpdf/show">PDF</a></li>
            </ul>
            <ul id="menu">
                <li><a href="?productSex/show/H">HOMBRE</a></li>
                <li><a href="?productSex/show/M">MUJER</a></li>
                <li><a href="?productSex/show/N">NIÑO</a></li>
                <li><a href="?mpdf/show">PDF</a></li>
            </ul>
        </nav>
    </div>
    <nav>
        <ul>
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
                echo '<li><a href="?client/formLogin"><svg xmlns="http://www.w3.org/2000/svg" id="iconoUser" class="icono" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                        </svg></a></li>';
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
//                 echo '<li><a href="?client/showUpdateDatesClient"><svg xmlns="http://www.w3.org/2000/svg" width="16" class="icono" height="16" fill="currentColor" class="bi bi-person-fill-gear" viewBox="0 0 16 16">
//                               <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4m9.886-3.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0"/>
//                             </svg></a></li>';
//                 echo '<li><a href="?client/logOut"><svg xmlns="http://www.w3.org/2000/svg" class="icono" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
//                               <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
//                             </svg></a></li>';
                //                     echo '<li><a href="?client/logOut"><svg xmlns="http://www.w3.org/2000/svg" class="icono" fill="currentColor" class="bi bi-person-check" viewBox="0 0 16 16">
                //                               <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
                //                               <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z"/>
                //                         </svg></a></li>';
            }
            ?>
            <svg xmlns="http://www.w3.org/2000/svg" class="menu icono" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
            </svg>

            <!-- <img src="../img/menu.png" alt="Icono menú" class= "menu"> 
            
                     var_dump($_SESSION['usuari']);
                     if ($_SESSION['usuari']->__get("type") === 1) {
                        
                     }-->
        </ul>
    </nav>
</header>