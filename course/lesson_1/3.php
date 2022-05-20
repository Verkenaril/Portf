<?php

abstract class SomeClass
{
    abstract public function new();
    abstract public function save();
    public function getName()
    {
        return "Какая-то строка";   
    }
}
class MyClass extends SomeClass
{
    public function new() { echo "Что-то создано <br>"; }
    public function save() { echo "Что-то сохранено <br>";}
    public function getName() { echo parent::getName() . " - Здорово";}
}
$obj = new MyClass();
$obj -> new();
$obj -> save();
$obj -> getName();
?>