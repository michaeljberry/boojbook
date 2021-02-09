<?php

namespace App\Repositories;

use App\Models\Book;

class BookRepositoryEloquent extends AbstractRepository implements BookRepository
{
	protected $query;

	function __construct(Book $query)
	{
		$this->query = $query;
	}

  public function datatablesIndex()
  {
    return $this->query->whereRaw("1=?", [1]);
  }
}