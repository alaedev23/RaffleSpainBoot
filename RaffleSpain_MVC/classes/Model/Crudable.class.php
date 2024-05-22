<?php

/**
 * Interface Crudable
 *
 * Define los métodos CRUD básicos que deben implementar las clases que la implementen.
 */
interface Crudable {
    
    /**
     * Crea un nuevo objeto en la base de datos.
     *
     * @param mixed $obj El objeto a crear.
     * @return mixed El resultado de la operación de creación.
     */
    public function create($obj);
    
    /**
     * Lee los objetos de la base de datos.
     *
     * @return mixed Los objetos leídos de la base de datos.
     */
    public function read();
    
    /**
     * Actualiza un objeto en la base de datos.
     *
     * @param mixed $obj El objeto a actualizar.
     * @return mixed El resultado de la operación de actualización.
     */
    public function update($obj);
    
    /**
     * Elimina un objeto de la base de datos.
     *
     * @param mixed $obj El objeto a eliminar.
     * @return mixed El resultado de la operación de eliminación.
     */
    public function delete($obj);
}