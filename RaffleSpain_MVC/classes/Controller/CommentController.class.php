<?php

class CommentController extends Controller {
    
    private $vComment;
    
    public function __construct() {
        $this->vComment = new ProducteView();
    }
    
        /**
     * Agrega un comentario.
     *
     * @param int[] $id El ID del producto.
     */
    public function addComment($id) {
        
        if ($_SERVER["REQUEST_METHOD"] == "POST" && (isset($_POST["addNewComent"]))) {
            
            $title = $this->sanitize($_POST['titleComment']);
            $message = $this->sanitize($_POST['mensajeComment']);
            $stars = $this->sanitize($_POST['estrellas']);
            
            if (strlen($title) === 0) {
                $errors = "El titulo es obligatorio.";
            }
            
            if (strlen($message) === 0) {
                $errors = "El mensaje es obligatorio.";
            }
            
            if ($stars === "") {
                $errors = "Tienes que seleccionar las estrellas que creas.";
            }
            
            $mProduct = new ProductModel();
            $mFavorites = new FavoritosProductModel();
            
            $product = $mProduct->getById(new Product($id[0]));
            $tallas = $mProduct->getTallas($product);
            
            $objFav = new FavoritosProduct();
            $objFav->__set("client_id", $_SESSION['usuari']->id);
            $objFav->__set("product", $product);
            $enFavoritos = $mFavorites->readByClientAndProduct($objFav);
            
            if (!isset($errors)) {
                
                $objComment = new Comment(null, $_SESSION['usuari']->id, $product->id, $title, $message, $stars, date("Y-m-d"));
                
                $mComment = new CommentModel();
                $create = $mComment->create($objComment);
                
                if ($create === "La consulta se ha realizado con existo") {
                    header('Location: ?Producte/mostrarProducte/' . $id[0]);
                } else {
                    $this->vComment->show($product, $tallas, $enFavoritos, '', $create);
                }
            } else {
                $this->vComment->show($product, $tallas, $enFavoritos, '', $errors);
            }
            
        }
    }
    
}