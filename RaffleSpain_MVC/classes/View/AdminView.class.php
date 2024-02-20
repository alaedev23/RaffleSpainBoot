<?php

class AdminView extends View {
    
    public static function show($lang, $prodcuts, $raffles, $objSelec = null, $modificarDatos = false, $errors = "") {
        
        if ($errors !== "") {
            $result = self::generateSectionAdmin($prodcuts, $raffles, $modificarDatos, $objSelec);
        } else {
            $result = self::generateSectionAdmin($prodcuts, $raffles, $modificarDatos, $objSelec, $errors);
        }
        
        echo "<!DOCTYPE html><html lang=\"es\">";
        include "templates/Head.tmp.php";
        echo "<body id=\"adminPage\">";
        include "templates/Header.tmp.php";
        include "templates/Admin.tmp.php";
        include "templates/Footer.tmp.php";
        echo "</body></html>";
        
    }
    
    public static function generateSectionAdmin($products, $raffles, $modificarDatos = false, $objSelec= null, $errors = "") {
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
            $html .= '<td><input type="text" name="id" value="' . $objSelec->id . '" readonly></td>';
            $html .= '<td><input type="text" name="name" value="' . $objSelec->name . '"></td>';
            $html .= '<td><input type="text" name="brand" value="' . $objSelec->brand . '"></td>';
            $html .= '<td><input type="text" name="modelcode" value="' . $objSelec->modelCode . '" readonly></td>';
            $html .= '<td><input type="text" name="price" value="' . $objSelec->price . '"></td>';
            $html .= '<td><input type="text" name="size" value="' . $objSelec->size . '"></td>';
            $html .= '<td><input type="text" name="color" value="' . $objSelec->color . '"></td>';
            $html .= '<td><input type="text" name="description" value="' . $objSelec->description . '"></td>';
            $html .= '<td><input type="text" name="sex" value="' . $objSelec->sex . '"></td>';
            $html .= '<td><input type="file" name="imatge"></td>';
            $html .= '<td><input type="text" name="quantity" value="' . $objSelec->quantity . '"></td>';
            $html .= '<td><input type="text" name="discount" value="' . $objSelec->discount . '"></td>';
        } else {
            $html .= "<tr>";
            $html .= '<td><input type="text" name="id" readonly></td>';
            $html .= '<td><input type="text" name="name"></td>';
            $html .= '<td><input type="text" name="brand"></td>';
            $html .= '<td><input type="text" name="modelcode" readonly></td>';
            $html .= '<td><input type="text" name="price"></td>';
            $html .= '<td><input type="text" name="size"></td>';
            $html .= '<td><input type="text" name="color"></td>';
            $html .= '<td><input type="text" name="description"></td>';
            $html .= '<td><input type="text" name="sex"></td>';
            $html .= '<td><input type="file" name="imatge"></td>';
            $html .= '<td><input type="text" name="quantity"></td>';
            $html .= '<td><input type="text" name="discount"></td>';
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
        
//         foreach ($products as $product) {
//             $html .= "<tr>";
//             $html .= "<td><input type=\"text\" name=\"id\" value=\"" . $product->id . "\"></td>";
//             $html .= "<td><input type=\"text\" name=\"name\" value=\"" . $product->name . "\"></td>";
//             $html .= "<td><input type=\"text\" name=\"brand\" value=\"" . $product->brand . "\"></td>";
//             $html .= "<td><input type=\"text\" name=\"modelCode\" value=\"" . $product->modelCode . "\"></td>";
//             $html .= "<td><input type=\"text\" name=\"price\" value=\"" . $product->price . "\"></td>";
//             $html .= "<td><input type=\"text\" name=\"size\" value=\"" . $product->size . "\"></td>";
//             $html .= "<td><input type=\"text\" name=\"color\" value=\"" . $product->color . "\"></td>";
//             $html .= "<td><input type=\"text\" name=\"description\" value=\"" . $product->description . "\"></td>";
//             $html .= "<td><input type=\"text\" name=\"sex\" value=\"" . $product->sex . "\"></td>";
//             $html .= "<td><input type=\"text\" name=\"img\" value=\"" . $product->img . "\"></td>";
//             $html .= "<td><input type=\"text\" name=\"quantity\" value=\"" . $product->quantity . "\"></td>";
//             $html .= "<td><input type=\"text\" name=\"discount\" value=\"" . $product->discount . "\"></td>";
//             $html .= "</tr>";
//         }
        
        $html .= "</tbody></table>";
        $html .= "</form>";
        
        return $html;
    }
    
}

?>