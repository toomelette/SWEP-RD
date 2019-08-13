<?php

namespace App\Core\Interfaces;
 


interface UserMenuInterface {

	public function store($user, $menu);

	public function getAll();

	public function getByCategory($cat);

	public function isExist();
		
}