
<?php
class CistellaController extends Controller {
    
    public static function show() {
        $carretoProductos = self::cargarProductos();
        CistellaView::show($carretoProductos);    
    }
        
    
    public static function addProduct($id) {
            $prd = new Product($id[0]);
            $productModel = new ProductModel();
            $newProduct = $productModel->getById($prd);

            if (isset($_SESSION['usuari'])) {
                
                $cistellaList = new CistellaList();
                $cistellaModel = new CistellaListModel();

                $cistellaList->client_id = $_SESSION['usuari']->id;
                $cistellaList->addProduct($newProduct);

                $result  = $cistellaModel->create($cistellaList);

                var_dump($result);
                die();

            } else {
                $carrito = isset($_COOKIE['cistella']) ? json_decode($_COOKIE['cistella'], true) : [];

                if ($newProduct) {
                    $carrito[] = $newProduct->toArray();
                    setcookie('cistella', json_encode($carrito), time() + 806400, "/");
                }
            }

            $cistella = new ProducteController();
            $cistella->mostrarProducte($id);
        }

        public static function emptyCart() {
            setcookie('cistella', '', time() - 3600);
            header('Location: .');
        }

        public static function removeProductById($productId) {
            $carrito = isset($_COOKIE['cistella']) ? json_decode($_COOKIE['cistella'], true) : [];
        
            $newCarrito = array_filter($carrito, function($product) use ($productId) {
                return $product['id'] != $productId[0];
            });
        
            setcookie('cistella', "", time() - 3600, '/');
            setcookie('cistella', json_encode(array_values($newCarrito)), time() + 806400, '/');

            var_dump($newCarrito);
            
            header('Location: ?Cistella/show');
            exit();
        }
        
    
    public static function cargarProductos() {
        $cistella = isset($_COOKIE['cistella']) ? json_decode($_COOKIE['cistella'], true) : [];
        return $cistella;
    }
}
