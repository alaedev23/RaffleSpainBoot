<?php

class ProducteController extends Controller {

    private $product;
    private $mProduct;
    private $vSearchProduct;
    
        /**
     * Constructor de la clase ProducteController.
     */
    public function __construct() {
        parent::__construct();
        $this->mProduct = new ProductModel();
        $this->vSearchProduct = new SearchView();
    }
    
        /**
     * Muestra productos aleatorios en la página de búsqueda.
     *
     * @throws Exception Si hay un error al obtener los productos aleatorios.
     * @return void
     */
    public function showSearchProducts() {
        if (isset($_COOKIE["lang"])) {
            $lang = $_COOKIE["lang"];
        } else {
            $lang = "es";
        }
        
        $products = $this->mProduct->getRandomProducts(6);
        $this->vSearchProduct->showProducts($lang, $products);
    }

        /**
     * Muestra los detalles de un producto específico.
     *
     * @param array $id El ID del producto.
     * @param string $errors Los errores a mostrar, si los hay.
     * @throws Exception Si hay un error al obtener los detalles del producto.
     * @return void
     */
    public function mostrarProducte($id, $errors = '') {
        $mProducts = new ProductModel();
        $productId = new Product($id[0]);
        
        $this->product = $mProducts->getById($productId);
        $tallas = $mProducts->getTallas($this->product);
        
        if ($errors == '') {
            $enFavoritos = null;
            
            if (isset($_SESSION['usuari'])) {
                $favoritosModel = new FavoritosProductModel();
                $favoritosProduct = new FavoritosProduct();
                $favoritosProduct->client_id = $_SESSION['usuari']->id;
                $favoritosProduct->product = $this->product;
                $enFavoritos = $favoritosModel->readByClientAndProduct($favoritosProduct);
            }

            $vProducte = new ProducteView();
            $vProducte->show($this->product, $tallas, $enFavoritos);
        } else {
            $vProducte = new ProducteView();
            $vProducte->show($this->product, $tallas, false);
        }

    }

        /**
     * Realiza una búsqueda de productos.
     *
     * @throws Exception Si hay un error al procesar la búsqueda.
     * @return void
     */

    public function searchProducts() {
        if (isset($_COOKIE["lang"])) {
            $lang = $_COOKIE["lang"];
        } else {
            $lang = "ca";
        }
        
        if ($_SERVER["REQUEST_METHOD"] == "POST" && (isset($_POST["serachProducts"]))) {
            $search = $this->sanitize($_POST['searchInput']);
            
            if (strlen($search) === 0) {
                $errors = "Escribe algo para buscar entre nuestros productos.";
            }
            
            if (!isset($errors)) {
                $products = $this->mProduct->searchProduct($search);
                
                if (!empty($products)) {
                    $this->vSearchProduct->showProducts($lang, $products, true, $search, $errors);
                } else {
                    $this->vSearchProduct->showProducts($lang, null, false, $search, "No se ha encontrado ningun resultado en su busqueda.");
                }
            } else {
                $this->vSearchProduct->showProducts($lang, null, false, $search, $errors);
            }
            
        }
    }
    

}
