<?php
/**
 * Clase Product
 *
 * Esta clase representa un producto y contiene información detallada sobre él.
 */
class Product
{
    /**
     * @var int $id ID del producto.
     */
    private $id;
    
    /**
     * @var string|null $name Nombre del producto.
     */
    private $name;
    
    /**
     * @var string|null $brand Marca del producto.
     */
    private $brand;
    
    /**
     * @var string|null $modelCode Código de modelo del producto.
     */
    private $modelCode;
    
    /**
     * @var float|null $price Precio del producto.
     */
    private $price;
    
    /**
     * @var string|null $size Tamaño del producto.
     */
    private $size;
    
    /**
     * @var string|null $color Color del producto.
     */
    private $color;
    
    /**
     * @var string|null $description Descripción del producto.
     */
    private $description;
    
    /**
     * @var string|null $sex Género al que está dirigido el producto.
     */
    private $sex;
    
    /**
     * @var string|null $img URL de la imagen del producto.
     */
    private $img;
    
    /**
     * @var int|null $quantity Cantidad disponible del producto.
     */
    private $quantity;
    
    /**
     * @var float|null $discount Descuento aplicado al producto.
     */
    private $discount;
    
    /**
     * Constructor de la clase Product.
     *
     * @param int $id ID del producto.
     * @param string|null $name Nombre del producto.
     * @param string|null $brand Marca del producto.
     * @param string|null $modelCode Código de modelo del producto.
     * @param float|null $price Precio del producto.
     * @param string|null $size Tamaño del producto.
     * @param string|null $color Color del producto.
     * @param string|null $description Descripción del producto.
     * @param string|null $sex Género al que está dirigido el producto.
     * @param string|null $img URL de la imagen del producto.
     * @param int|null $quantity Cantidad disponible del producto.
     * @param float|null $discount Descuento aplicado al producto.
     */
    public function __construct($id, $name=null, $brand=null, $modelCode=null, $price=null, $size=null, $color=null, $description=null, $sex=null, $img=null, $quantity=null, $discount=null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->brand = $brand;
        $this->modelCode = $modelCode;
        $this->price = $price;
        $this->size = $size;
        $this->color = $color;
        $this->description = $description;
        $this->sex = $sex;
        $this->img = $img;
        $this->quantity = $quantity;
        $this->discount = $discount;
    }
    
    /**
     * Convierte el objeto Product en un array asociativo.
     *
     * @return array Un array asociativo con los atributos del producto.
     */
    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'brand' => $this->brand,
            'modelCode' => $this->modelCode,
            'price' => $this->price,
            'size' => $this->size,
            'color' => $this->color,
            'sex' => $this->sex,
            'img' => $this->img,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'discount' => $this->discount
        ];
    }

    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        } else {
            throw new Exception("No existeix la propietat $property a Product");
        }
    }
    
    /**
     * Método mágico para obtener valores de propiedades inaccesibles.
     *
     * @param string $property El nombre de la propiedad.
     * @return mixed El valor de la propiedad.
     * @throws Exception Si la propiedad no existe en la clase Product.
     */
    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        } else {
            throw new Exception("No existeix la propietat $property a Product");
        }
    }
    
    /**
     * Método mágico para obtener información de depuración.
     *
     * @return array Un array asociativo con la información de depuración.
     */
    public function __debugInfo()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'brand' => $this->brand,
            'modelCode' => $this->modelCode,
            'price' => $this->price,
            'size' => $this->size,
            'color' => $this->color,
            'sex' => $this->sex,
            'img' => $this->img,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'discount' => $this->discount
        ];
    }
}
?>
