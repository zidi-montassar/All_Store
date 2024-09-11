<?php

namespace gs\d_t_src;

use gs\Models\{Product, Category};
use gs\Table\Tablecategory;

class Table {

    private $query;

    private $get;

    private $columns = [];

    private $sortedItem = [];

    private $formatKey = [];

    private $categories = [];

    private const PER_PAGE= 20;

    public function __construct(QueryBuilder $query, array $get)
    {
        $this->query = $query;
        $this->get = $get;
    }

    public function columns(array $columns)
    {
        $this->columns= $columns;
    }

    public function categories(array $categories)
    {
        $this->categories = $categories;
    }

    public function sortList(array $sortedItem)
    {
        $this->sortedItem = $sortedItem;
    }

    public function format(string ...$formatKey)
    {
        $this->formatKey = $formatKey;
    }

    public function sort (string $a, string $b): string

            {
                $sort = $this->get['sort'] ?? null;
                $direction = $this->get['dir'] ?? 'asc';
                $icon ="";
                if ($sort === $a){
                    $icon = $direction === 'asc' ? "^" : "v";
                }
                $url = LinkHelper::Build_1($this->get, [
                    'sort' => $a,
                'dir' => $direction === 'asc' && $sort === $a ? 'desc' : 'asc'
                ]);
                return <<<HTML
                    <a href="?$url">$b $icon </a>

HTML;
            }


    public function echo(Product $item, string $propriety)
    {
        $function = 'get' . ucfirst($propriety);
        if(in_array($propriety, $this->formatKey)){
            return NumberHelper::price($item->$function());
        }
        return $item->$function();
    }

    public function run(mixed $root)
    {
        if(!empty($this->get['sort']) && in_array($this->get['sort'],$this->sortedItem)){
    
            $this->query->orderBy($this->get['sort'], $this->get['dir'] ?? 'ASC');
            
        }

        $count= (clone($this->query))->count();

        //$page = (int)($this->get['p'] ?? 1);
        //$this->query->limit(PER_PAGE)->page($page);
        
        /**
         * @var Product[];
         */
        $items = $this->query->fetchAll(Product::class);
      

        //$pages = ceil($count/PER_PAGE);
        ?>




        <div class="container">
                <table class="table table-striped" style="width: 100%; height: 100%;">
                    <thead>
                        
                        <tr>   
                            <?php foreach ($this->columns as $key => $column) : ?>
                                        <?php if(in_array($key, $this->sortedItem)) :?> 
                                            <th style="color:#381061; font-size: 20px;"><?= $this->sort($key, $column)?></th> 
                                        <?php else : ?> 
                                            <th style="color:dark; font-size: 20px;"><strong><?= $column?></strong></th>
                                        <?php endif;?>
                            <?php endforeach; ?>
                        </tr>    
                        
                    </thead>
                    <tbody>
                        
                        <?php foreach ($items as $item){?>             
                                <tr>
                                        <?php $style = 'color:white';
                                            if($item->getQuantity() <= $item->getA_quantity()){
                                                $style = 'color:red';
                                            } 
                                        ?>
                                        <?php foreach ($this->columns as $key => $column){?> 
                                            <?php if ($key === 'name'): ?>
                                                <td><a href="<?=$root->url('Show_Product', ['id' => $item->getId(), 'slug' => $item->getSlug()])?>" style="<?=$style?>"><?= $this->echo($item, $key)?></a></td>
                                            <?php else: ?>    
                                                <td style="<?=$style?>"><?= $this->echo($item, $key)?></td>
                                            <?php endif ?>    
                                        <?php }?>
                                   
                                </tr>
                        <?php }?>       
                        
                    </tbody>
                </table>   
        </div>
    <?php                                        

    }

}