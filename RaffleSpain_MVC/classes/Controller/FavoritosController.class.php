<?php

class FavoritosController extends Controller {
    
        /**
     * Muestra los productos favoritos del usuario.
     *
     * @throws Exception Cuando no hay ningún cliente logueado.
     */
    public static function show()
    {
        if (isset($_SESSION['usuari'])) {
            $carretoProductos = self::cargarProductos();
            FavoritosView::show($carretoProductos);
        } else {
            $loginController = new ClientController();
            $loginController->formLogin();
        }

    }

        /**
     * Carga los productos favoritos del usuario.
     *
     * @return array|null Lista de productos favoritos del usuario.
     */

    public static function cargarProductos() {

        if (isset($_SESSION['usuari'])) {
            $cistellaList = new FavoritosProduct();
            $cistellaModel = new FavoritosProductModel();

            $cistellaList->client_id = $_SESSION['usuari']->id;
            $cistella = $cistellaModel->read($cistellaList);

            return $cistella;

        }
    }

       /**
     * Agrega un producto a la lista de favoritos del usuario.
     *
     * @param array $id  ID del producto a agregar.
     *
     * @throws Exception Cuando no hay ningún cliente logueado.
     */

    public static function addProduct($id)
    {
        $prd = new Product($id[0]);
        $productModel = new ProductModel();
        $newProduct = $productModel->getById($prd);

        if (isset($_SESSION['usuari'])) {

            $cistellaList = new FavoritosProduct();
            $cistellaModel = new FavoritosProductModel();

            $cistellaList->client_id = $_SESSION['usuari']->id;
            $cistellaList->product = $newProduct;

            $dbProductCarreto = $cistellaModel->readByClientAndProduct($cistellaList);

            if ($dbProductCarreto === null) {
                $cistellaListdbProduct = new FavoritosProduct();
                $cistellaListdbProduct->client_id = $_SESSION['usuari']->id;
                $cistellaListdbProduct->product = $cistellaList->product;
                $cistellaModel->create($cistellaListdbProduct);
            } else {
                $cistellaModel->deleteById($cistellaList->product);
            }

        } else {
            $loginController = new ClientController();
            $loginController->formLogin();
        }

        header('Location: ?Producte/mostrarProducte/' . $id[0]);
        exit();

    }

        /**
     * Vacía el carrito de favoritos del usuario.
     */
    public static function emptyCart() {

        if (isset($_SESSION['usuari'])) {
            $cistellaModel = new FavoritosProductModel();
            $client = new Client($_SESSION['usuari']->id);
            $cistellaModel->deleteByClientId($client);
        }

        header('Location: .');
        exit();
    }
    

        /**
     * Elimina un producto de la lista de favoritos por su ID.
     *
     * @param array $productId  ID del producto a eliminar.
     */
    public static function removeProductById($productId) {

        if (isset($_SESSION['usuari'])) {

            $cistellaListModel = new FavoritosProductModel();
            $product = new Product($productId[0]);

            $cistellaListModel->deleteById($product);

        }

        header('Location: ?Favoritos/show');
        exit();
    }
    
}