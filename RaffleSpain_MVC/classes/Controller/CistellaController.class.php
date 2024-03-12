<?php
class CistellaController extends Controller
{

    public static function show()
    {
        $carretoProductos = self::cargarProductos();
        CistellaView::show($carretoProductos);
    }


    public static function addProduct($id)
    {
        $prd = new Product($id[0]);
        $productModel = new ProductModel();
        $newProduct = $productModel->getById($prd);

        if (isset($_SESSION['usuari'])) {

            $cistellaList = new CistellaList();
            $cistellaModel = new CistellaListModel();

            $cistellaList->client_id = $_SESSION['usuari']->id;
            $cistellaList->addProduct($newProduct);

            $result = $cistellaModel->create($cistellaList);

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

        if (isset($_COOKIE['cistella'])) {
            setcookie('cistella', '', time() - 3600);
        }

        if (isset($_SESSION['client']) && $_SESSION['client']->id) {
            $cistellaModel = new CistellaListModel();
            $client = new Client($_SESSION['client']->id);
            $cistellaModel->deleteByClientId($client);
        }

        header('Location: .');
        exit();
    }
    

    public static function removeProductById($productId) {

        if (isset($_SESSION['usuari'])) {

            $cistellaListModel = new CistellaListModel();
            $product = new Product($productId[0]);

            $cistellaListModel->deleteById($product);

        } else {
            $carrito = isset($_COOKIE['cistella']) ? json_decode($_COOKIE['cistella'], true) : [];

            $newCarrito = array_filter($carrito, function ($product) use ($productId) {
                return $product['id'] != $productId[0];
            });

            setcookie('cistella', "", time() - 3600, '/');
            setcookie('cistella', json_encode(array_values($newCarrito)), time() + 806400, '/');
        }



        header('Location: ?Cistella/show');
        exit();
    }


    public static function cargarProductos()
    {

        if (isset($_SESSION['usuari'])) {
            $cistellaList = new CistellaList();
            $cistellaModel = new CistellaListModel();

            $cistellaList->client_id = $_SESSION['usuari']->id;
            $cistella = $cistellaModel->read($cistellaList);

            foreach ($cistella->carreto as $cistellaProduct) {
                $cistellaArray[] = $cistellaProduct->toArray();
            }

            return $cistellaArray;

        } else {
            return isset($_COOKIE['cistella']) ? json_decode($_COOKIE['cistella'], true) : [];
        }
    }
}
