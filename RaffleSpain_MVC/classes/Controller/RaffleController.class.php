<?php

class RaffleController extends Controller
{

    private Raffle $raffle;
    private RaffleModel $mRaffle;
    private SearchView $vSearchRaffle;

    /**
     * Constructor de la clase RaffleController.
     */
    public function __construct()
    {
        $this->raffle = new Raffle(null, null, null, null);
        $this->mRaffle = new RaffleModel();
        $this->vSearchRaffle = new SearchView();
    }

    /**
     * Muestra todas las rifas disponibles.
     *
     * @throws Exception Si hay un error al obtener las rifas.
     * @return void
     */
    public function showAll()
    {
        if (isset($_COOKIE["lang"])) {
            $lang = $_COOKIE["lang"];
        } else {
            $lang = "es";
        }

        if (isset($_SESSION['usuari'])) {
            $rifas = $this->mRaffle->read();
            $vSearch = new SearchView();
            $vSearch->showRaffle($lang, $rifas);
        } else {
            header("Location: ?client/formLogin");
        }
    }

    /**
     * Muestra los detalles de una rifa específica.
     *
     * @param array $id El ID de la rifa.
     * @throws Exception Si hay un error al obtener los detalles de la rifa.
     * @return void
     */
    public function showRaffleWithId($id)
    {

        if (isset($_COOKIE["lang"])) {
            $lang = $_COOKIE["lang"];
        } else {
            $lang = "ca";
        }

        $this->raffle->id = $id[0];

        $isIn = false;
        if (isset($_SESSION['usuari'])) {
            $obj = new stdClass();
            $obj->id = $this->raffle->id;
            $obj->client_id = $_SESSION['usuari']->id;

            if ($this->mRaffle->userIsInRaffle($obj)) {
                $isIn = true;
            }

            $this->raffle = $this->mRaffle->getById($this->raffle);

            if ($this->raffle->__get("type") == 1) {
                if ($_SESSION['usuari']->type == 2 || $_SESSION['usuari']->type == 3) {
                    $validate = $this->validateDateRaffle();
                    RaffleView::show($this->raffle, $isIn, $validate);
                } else {
                    $this->vSearchRaffle->showRaffle($lang, $this->mRaffle->read(), false, null, "No tienes permisos para entrar a esta pagina.");
                }
            } else {
                if ($_SESSION['usuari']->type == 1 || $_SESSION['usuari']->type == 2 || $_SESSION['usuari']->type == 3) {
                    $validate = $this->validateDateRaffle();
                    RaffleView::show($this->raffle, $isIn, $validate);
                } else {
                    $this->vSearchRaffle->showRaffle($lang, $this->mRaffle->read(), false, null, "No tienes permisos para entrar a esta pagina.");
                }
            }

        } else {
            header("Location: ?client/formLogin");
        }

    }

    /**
     * Valida si la fecha de la rifa ha pasado.
     *
     * @throws Exception Si hay un error al validar la fecha de la rifa.
     * @return bool true si la fecha ha pasado y se ha seleccionado un ganador, false de lo contrario.
     */

    public function validateDateRaffle()
    {
        $actualDate = new DateTime();
        $raffleDate = new DateTime($this->raffle->__get("date_end"));

        if ($actualDate > $raffleDate) {
            $this->mRaffle->searchWinner($this->raffle);
            return true;
        } else {
            return false;
        }
    }

    /**
     * Obtiene las rifas de un cliente específico.
     *
     * @throws Exception Si hay un error al obtener las rifas del cliente.
     * @return void
     */
    public function getRaffleClient()
    {
        if (isset($_COOKIE["lang"])) {
            $lang = $_COOKIE["lang"];
        } else {
            $lang = "ca";
        }

        $raffles = $this->mRaffle->getRaffleForClient($_SESSION['usuari']->id);
        $vSearch = new ClientDatesView();
        $vSearch->showMyRaffle($lang, $raffles);
    }

    /**
     * Realiza una búsqueda de rifas.
     *
     * @throws Exception Si hay un error al procesar la búsqueda de rifas.
     * @return void
     */
    public function searchRaffles()
    {
        if (isset($_COOKIE["lang"])) {
            $lang = $_COOKIE["lang"];
        } else {
            $lang = "ca";
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && (isset($_POST["serachRaffle"]))) {
            $search = $this->sanitize($_POST['searchInput']);

            if (strlen($search) === 0) {
                $errors = "Escribe algo para buscar entre nuestros productos.";
            }

            if (!isset($errors)) {
                $products = $this->mRaffle->searchRaffle($search);

                if (!empty($products)) {
                    $this->vSearchRaffle->showRaffle($lang, $products, true, $search, $errors);
                } else {
                    $this->vSearchRaffle->showRaffle($lang, null, false, $search, "No se ha encontrado ningun resultado en su busqueda.");
                }
            } else {
                $this->vSearchRaffle->showRaffle($lang, null, false, $search, $errors);
            }

        }
    }

    /**
     * Alterna la participación de un usuario en una rifa.
     *
     * @param array $ids Los IDs de la rifa y del cliente.
     * @return void
     */
    public function toggleUser($ids)
    {
        $obj = new stdClass();
        $obj->id = $ids[0];
        $obj->client_id = $ids[1];

        if ($this->mRaffle->userIsInRaffle($obj)) {
            $this->mRaffle->removeUser($obj);
        } else {
            $this->mRaffle->addUser($obj);
        }

        $this->showRaffleWithId($obj->id);

        $url = $_SERVER['REQUEST_URI'];
        $url = strtok($url, '?');
        $url .= ('?Raffle/showRaffleWithId/' . $obj->id);
        echo "<script>history.pushState(null, null, '$url');</script>";
    }
}
