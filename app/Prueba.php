<?php
   
   namespace App;

   class Prueba
   {
    private $foo; 
    
    
    public function __construct(Foo $foo)
    {
    $this->foo = $foo;
    }
   }