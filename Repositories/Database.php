<?php
namespace AFS\Repositories;

interface Database {
	public function connect();
	public function insert(array $data);
	// public function update();
	// public function delete();
	// public function fetch();
	public function fetchAll();
}
