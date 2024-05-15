<?php

class ClientAdminView {
    
    public static function showClients($lang, $clients, $objSelec = null, $modificarDatos = false, $errors = "") {
        
        $clientTemplate = self::generateClientSection($clients, $modificarDatos, $objSelec, $errors);
        
        echo "<!DOCTYPE html><html class=\"light\" lang=\"$lang\">";
        include "templates/Head.tmp.php";
        echo "<body id=\"adminPage\">";
        include "templates/Header.tmp.php";
        include "templates/ClientAdmin.tmp.php";
        include "templates/Footer.tmp.php";
        echo "</body></html>";
    }
    
    public static function generateClientSection($clients, $modificarDatos = false, $objSelec= null, $errors = "") {
        $html = "<div class=\"client-section\">";
        $html .= "<h1>Clients</h1>";
        
        if ($modificarDatos) {
            $html .= "<form action=\"?ClientAdmin/updateClientSelected\" method=\"post\" enctype=\"multipart/form-data\">";
        } else {
            $html .= "<form action=\"?ClientAdmin/createClient\" method=\"post\" enctype=\"multipart/form-data\">";
        }
        
        $html .= "<table><thead><tr>
            <th>Id</th>
            <th>Name</th>
            <th>Password</th>
            <th>Surnames</th>
            <th>Born</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Sex</th>
            <th>Poblation</th>
            <th>Address</th>
            <th>Type</th>
            <th>Floor</th>
            <th>Door</th>
            <th>Postal Code</th>
        </tr></thead><tbody>";

        if ($objSelec !== null) {
            $html .= "<tr>";
            $html .= '<td><input class="inputTable" type="hidden" name="id" value="' . $objSelec->id . '"></td>';
            $html .= '<td><input class="inputTable" type="text" name="name" value="' . $objSelec->name . '"></td>';
            $html .= '<td><input class="inputTable" type="text" name="password" value="' . $objSelec->password . '"></td>';
            $html .= '<td><input class="inputTable" type="text" name="surnames" value="' . $objSelec->surnames . '"></td>';
            $html .= '<td><input class="inputTable" type="text" name="born" value="' . $objSelec->born . '"></td>';
            $html .= '<td><input class="inputTable" type="text" name="email" value="' . $objSelec->email . '"></td>';
            $html .= '<td><input class="inputTable" type="text" name="phone" value="' . $objSelec->phone . '"></td>';
            $html .= '<td><input class="inputTable" type="text" name="sex" value="' . $objSelec->sex . '"></td>';
            $html .= '<td><input class="inputTable" type="text" name="poblation" value="' . $objSelec->poblation . '"></td>';
            $html .= '<td><input class="inputTable" type="text" name="address" value="' . $objSelec->address . '"></td>';
            $html .= '<td><input class="inputTable" type="text" name="type" value="' . $objSelec->type . '"></td>';
            $html .= '<td><input class="inputTable" type="text" name="floor" value="' . $objSelec->floor . '"></td>';
            $html .= '<td><input class="inputTable" type="text" name="door" value="' . $objSelec->door . '"></td>';
            $html .= '<td><input class="inputTable" type="text" name="postal_code" value="' . $objSelec->postal_code . '"></td>';
        } else {
            $html .= "<tr>";
            $html .= "<td></td>";
            $html .= '<td><input class="inputTable" type="text" name="name"></td>';
            $html .= '<td><input class="inputTable" type="text" name="password"></td>';
            $html .= '<td><input class="inputTable" type="text" name="surnames"></td>';
            $html .= '<td><input class="inputTable" type="text" name="born"></td>';
            $html .= '<td><input class="inputTable" type="text" name="email"></td>';
            $html .= '<td><input class="inputTable" type="text" name="phone"></td>';
            $html .= '<td><input class="inputTable" type="text" name="sex"></td>';
            $html .= '<td><input class="inputTable" type="text" name="poblation"></td>';
            $html .= '<td><input class="inputTable" type="text" name="address"></td>';
            $html .= '<td><input class="inputTable" type="text" name="type"></td>';
            $html .= '<td><input class="inputTable" type="text" name="floor"></td>';
            $html .= '<td><input class="inputTable" type="text" name="door"></td>';
            $html .= '<td><input class="inputTable" type="text" name="postal_code"></td>';
        }

        if ($modificarDatos) {
            $html .= "<td class=\"input-admin\" colspan=\"2\"><input class=\"btn\" value=\"Update\" type=\"submit\" name=\"sendDataUpdate\"></td></tr></thead><tbody>";
        } else {
            $html .= "<td class=\"input-admin\" colspan=\"2\"><input class=\"btn\" value=\"Create\" type=\"submit\" name=\"sendDataCreate\"></td></tr></thead><tbody>";
        }
        
        foreach ($clients as $client) {
            $html .= "<tr>";
            $html .= "<td>$client->id</td>";
            $html .= "<td>$client->name</td>";
            $html .= "<td>$client->password</td>";
            $html .= "<td>$client->surnames</td>";
            $html .= "<td>$client->born</td>";
            $html .= "<td>$client->email</td>";
            $html .= "<td>$client->phone</td>";
            $html .= "<td>$client->sex</td>";
            $html .= "<td>$client->poblation</td>";
            $html .= "<td>$client->address</td>";
            $html .= "<td>$client->type</td>";
            $html .= "<td>$client->floor</td>";
            $html .= "<td>$client->door</td>";
            $html .= "<td>$client->postal_code</td>";
            $html .= '<td class="alinear"><a class="btn" href="?ClientAdmin/updateClient/' . $client->id . '">Modificar</a></td>';
            $html .= '<td class="alinear"><a class="btn" href="?ClientAdmin/deleteClient/' . $client->id . '">Eliminar</a></td></tr>';
            $html .= "</tr>";
        }
        
        $html .= "</tbody></table>";
        $html .= "</div>";
        
        return $html;
    }
}
