<?php

interface Crudable {
    
    public function create($obj);
    public function read();
    public function update($obj);
    public function delete($obj);

}