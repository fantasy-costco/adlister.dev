<?php
Class Model{
	private $attributes=[];
	public __set($key,$value){
		$this->attributes["$key"=>$value];
	}
	public __get($key,$value){
		if(isset($this->attibutes[$key])){
			return $this->attributes[$key];
		}
	}
}
$M=new Model();
$M->test='Working';
$m->test;