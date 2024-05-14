<?php

class AdminView extends View {
    
    public static function show($lang, $products, $raffles, $objSelec = null, $modificarDatos = false, $errors = "") {
        
        if ($objSelec instanceof Product) {
            $tempProducts = self::generateSectionProducts($products, $modificarDatos, $objSelec, $errors);
            $tempRraffles = self::generateSectionRaffles($raffles, false, null, $errors);
        } else if ($objSelec instanceof Raffle) {
            $tempRraffles = self::generateSectionRaffles($raffles, $modificarDatos, $objSelec, $errors);
            $tempProducts = self::generateSectionProducts($products, false, null, $errors);
        } else {
            $tempProducts = self::generateSectionProducts($products, $modificarDatos, $objSelec, $errors);
            $tempRraffles = self::generateSectionRaffles($raffles, $modificarDatos, $objSelec, $errors);
        }
        
        echo "<!DOCTYPE html><html lang=\"es\">";
        include "templates/Head.tmp.php";
        echo "<body id=\"adminPage\">";
        include "templates/Header.tmp.php";
        include "templates/Admin.tmp.php";
        include "templates/Footer.tmp.php";
        echo "</body></html>";
        
    }
    
    public static function generateSectionProducts($products, $modificarDatos = false, $objSelec= null, $errors = "") {
        $html = "<h1>Productos</h1>";
        
        if ($modificarDatos) {
            $html .= "<form action=\"?admin/updateProductSelected\" method=\"post\" enctype=\"multipart/form-data\">";
        } else {
            $html .= "<form action=\"?admin/createProduct\" method=\"post\" enctype=\"multipart/form-data\">";
        }
        
        $html .= "<table><thead><tr>
            <th>Id</th>
            <th>Name</th>
            <th>Brand</th>
            <th>ModelCode</th>
            <th>Price</th>
            <th>Size</th>
            <th>Color</th>
            <th>Description</th>
            <th>Sex</th>
            <th>Img</th>
            <th>Quantity</th>
            <th>Discount</th>
        </tr></thead>";
        
        if ($objSelec !== null) {
            $html .= "<tr>";
            $html .= "<td></td>";
            $html .= '<td><input class="inputTable" type="text" name="name" value="' . $objSelec->name . '"></td>';
            $html .= '<td><input class="inputTable" type="text" name="brand" value="' . $objSelec->brand . '"></td>';
            $html .= "<td></td>";
            $html .= '<td><input class="inputTable" type="text" name="price" value="' . $objSelec->price . '"></td>';
            $html .= '<td><input type="text" name="size" value="' . $objSelec->size . '"></td>';
            $html .= '<td><input type="text" name="color" value="' . $objSelec->color . '"></td>';
            $html .= '<td><input class="inputTable" type="text" name="description" value="' . $objSelec->description . '"></td>';
            $html .= '<td><input class="inputTable" type="text" name="sex" value="' . $objSelec->sex . '"></td>';
            $html .= '<td><input class="inputTable" type="file" name="imatge"></td>';
            $html .= '<td><input class="inputTable" type="text" name="quantity" value="' . $objSelec->quantity . '"></td>';
            $html .= '<td><input class="inputTable" type="text" name="discount" value="' . $objSelec->discount . '"></td>';
        } else {
            $html .= "<tr>";
            $html .= "<td></td>";
            $html .= '<td><input class="inputTable" type="text" name="name"></td>';
            $html .= '<td><input class="inputTable" type="text" name="brand"></td>';
            $html .= "<td></td>";
            $html .= '<td><input class="inputTable" type="text" name="price"></td>';
            $html .= '<td><input class="inputTable" type="text" name="size"></td>';
            $html .= '<td><input class="inputTable" type="text" name="color"></td>';
            $html .= '<td><input class="inputTable" type="text" name="description"></td>';
            $html .= '<td><input class="inputTable" type="text" name="sex"></td>';
            $html .= '<td><input class="inputTable" type="file" name="imatge"></td>';
            $html .= '<td><input class="inputTable" type="text" name="quantity"></td>';
            $html .= '<td><input class="inputTable" type="text" name="discount"></td>';
        }
        
        if ($modificarDatos) {
            $html .= "<th colspan=\"2\"><input class=\"btn\" value=\"Update\" type=\"submit\" name=\"sendDataUpdate\"></th></tr></thead><tbody>";
        } else {
            $html .= "<th colspan=\"2\"><input class=\"btn\" value=\"Crear\" type=\"submit\" name=\"sendDataCreate\"></th></tr></thead><tbody>";
        }
        
        foreach ($products as $product) {
            $html .= "<tr>";
            $html .= "<td>$product->id</td>";
            $html .= "<td>$product->name</td>";
            $html .= "<td>$product->brand</td>";
            $html .= "<td>$product->modelCode</td>";
            $html .= "<td>$product->price</td>";
            $html .= "<td>$product->size</td>";
            $html .= "<td>$product->color</td>";
            $html .= "<td>$product->description</td>";
            $html .= "<td>$product->sex</td>";
            $html .= "<td><img class=\"adminImages\" src=\"public/img/vambas/$product->img\"></td>";
            $html .= "<td>$product->quantity</td>";
            $html .= "<td>$product->discount</td>";
            $html .= '<th class="alinear"><a class="btn" href="?admin/updateProduct/' . $product->id . '">Modificar</a></th>';
            $html .= '<th class="alinear"><a class="btn" href="?admin/deleteProduct/' . $product->id . '">Eliminar</a></th></tr>';
            $html .= "</tr>";
        }
        
        $html .= "</tbody></table>";
        $html .= "</form>";
        
        return $html;
    }
    
    public static function generateSectionRaffles($raffles, $modificarDatos = false, $objSelec= null, $errors = "") {
        $html = "<h1>Raffles</h1>";
        $html .= "<p>El format de les dates son el seguent: 2023-12-01 09:00.</p>";
        
        if ($modificarDatos) {
            $html .= "<form action=\"?admin/updateRaffleSelected\" method=\"post\" enctype=\"multipart/form-data\">";
        } else {
            $html .= "<form action=\"?admin/createRaffle\" method=\"post\" enctype=\"multipart/form-data\">";
        }
        
        $html .= "<table><thead><tr>
            <th>Id</th>
            <th>Producto Id</th>
            <th>Fecha Inicio </th>
            <th>Fecha Fin</th>
            <th>Imatge Producte</th>
            <th>Ganador</th>
            <th>Type</th>
        </tr></thead>";
        
        if ($objSelec !== null) {
            $html .= "<tr>";
            $html .= '<td><input class="inputTable" type="hidden" name="id" value="' . $objSelec->id . '"></td>';
            $html .= '<td><input class="inputTable" type="text" name="product_id" value="' . $objSelec->product_id . '"></td>';
            $html .= '<td><input class="inputTable" type="text" name="date_start" value="' . $objSelec->date_start . '"></td>';
            $html .= '<td><input class="inputTable" type="text" name="date_end" value="' . $objSelec->date_end . '"></td>';
            $html .= "<td><img class=\"adminImages\" src=\"public/img/vambas/" . $objSelec->product->img . "\"></td>";
            $html .= '<td><input class="inputTable" type="text" name="winner" value="' . $objSelec->winner . '"></td>';
            $html .= '<td><input class="inputTable" type="text" name="type" value="' . $objSelec->type . '"></td>';
        } else {
            $html .= "<tr>";
            $html .= '<td><input class="inputTable" type="hidden" name="id" value=""></td>';
            $html .= '<td><input class="inputTable" type="text" name="product_id"></td>';
            $html .= '<td><input class="inputTable" type="text" name="date_start"></td>';
            $html .= '<td><input class="inputTable" type="text" name="date_end"></td>';
            $html .= '<td></td>';
            $html .= '<td><input class="inputTable" type="text" name="winner"></td>';
            $html .= '<td><input class="inputTable" type="text" name="type"></td>';
        }
        
        if ($modificarDatos) {
            $html .= "<th colspan=\"2\"><input class=\"btn\" value=\"Update\" type=\"submit\" name=\"sendDataUpdate\"></th></tr></thead><tbody>";
        } else {
            $html .= "<th colspan=\"2\"><input class=\"btn\" value=\"Crear\" type=\"submit\" name=\"sendDataCreate\"></th></tr></thead><tbody>";
        }
        
        foreach ($raffles as $raffle) {
            $html .= "<tr>";
            $html .= "<td>$raffle->id</td>";
            $html .= "<td>$raffle->product_id</td>";
            $html .= "<td>$raffle->date_start</td>";
            $html .= "<td>$raffle->date_end</td>";
            $html .= "<td><img class=\"adminImages\" src=\"public/img/vambas/" . $raffle->product->img . "\"></td>";
            $html .= "<td>$raffle->winner</td>";
            $html .= "<td>$raffle->type</td>";
            $html .= '<th class="alinear"><a class="btn" href="?admin/updateRaffle/' . $raffle->id . '">Modificar</a></th>';
            $html .= '<th class="alinear"><a class="btn" href="?admin/deleteRaffle/' . $raffle->id . '">Eliminar</a></th></tr>';
            $html .= "</tr>";
        }
        
        $html .= "</tbody></table>";
        $html .= "</form>";
        
        return $html;
    }
    
}

?>