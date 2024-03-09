<?php


namespace gs\d_t_src;

class TableBuilder{


    private $query;

    private $get;

    private $columns= [];
    
    private $sortList;

    private $key;


    private $categories = [];
    /**
     * @var gs\d_t_src\Table
     */
    private $table;

    public function __construct(QueryBuilder $query, array $get, array $columns, ?array $categories,string $key, string ...$sortList)
    {
        $this->query = $query;
        $this->get = $get;
        $this->columns = $columns;
        $this->sortList = $sortList;
        $this->key = $key;
        $this->categories = $categories;
        $this->table = new Table ($query, $get);
    }

    public function execute(mixed $root)
    {
        //var_dump($this->sortList);
        //var_dump(implode(', ', $this->sortList));
        //$table = new Table ($this->query, $this->get);
        
        $this->table->columns($this->columns);

        $this->table->categories($this->categories);
        
        $this->table->sortList($this->sortList);

        $this->table->format($this->key, 'wholesale_price');

        $this->table->run($root);
    }
}