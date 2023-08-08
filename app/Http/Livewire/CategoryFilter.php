<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Livewire\WithPagination;

class CategoryFilter extends Component
{
    use WithPagination;
    public $category, $orden = 'desc', $subcategoria, $marca , $precio;
    public $eliminandoFiltros = false;
    public $view = 'grid';
    protected $queryString=['subcategoria','marca','precio'];

    public function updatedSubcategoria()
    {
        $this->resetPage();
    }

    public function updatedMarca()
    {
        $this->resetPage();
    }

    public function updatedMPrecio()
    {
        $this->resetPage();
    }

    public function render(): View
    {
        $productsQuery = Product::query()
                                    ->with('images')    
                                    ->whereHas('subcategory.category', function (Builder $query) {
                                        $query->where('id', $this->category->id);
                                    });

        if ($this->subcategoria) {
            $productsQuery = $productsQuery->whereHas('subcategory', function (Builder $query) {
                $query->where('slug', $this->subcategoria);
            });
        }

        if ($this->marca) {
            $productsQuery = $productsQuery->whereHas('brand', function (Builder $query) {
                $query->where('name', $this->marca);
            });
        }

        if ($this->precio === 'mayor') {
            $productsQuery->orderBy('price', 'desc');
        } elseif ($this->precio === 'menor') {
            $productsQuery->orderBy('price', 'asc');
        }

        $products = $productsQuery->orderBy('id', $this->orden)->paginate(12);

        return view('livewire.category-filter', compact('products'));
    }

    public function limpiar()
    {
        $this->orden = 'desc';
        $this->reset(['subcategoria','marca','precio']);
        $this->resetPage();
        $this->eliminandoFiltros = true;
    }
     /* 
    
    protected $queryString = [
        'orden' => ['except' => 'desc'],
        'subcategoria',
        'marca',
    ];

    public function mount()
    {
        $this->subcategoria = [];
        $this->marca = [];
    }

    public function render(): View
    {
            $cacheKey = 'category-filter:' . md5(json_encode([
                'subcategoria' => $this->subcategoria,
                'marca' => $this->marca,
                'orden' => $this->orden,
                'page' => $this->page,
            ]));
    
            $products = Cache::remember($cacheKey, 3600, function () {
                        $productsQuery = Product::query()->with('images')->whereHas('subcategory.category', function (Builder $query) {
                                                                                $query->where('id', $this->category->id);
                                                                            });
                        if ($this->subcategoria) {
                            $this->eliminandoFiltros = true;
                            $productsQuery->where('subcategory_id', $this->subcategoria);
                        }
                        if ($this->marca) {
                            $this->eliminandoFiltros = true;
                            $productsQuery->where('brand_id', $this->marca);
                        }
                        if ($this->eliminandoFiltros) {
                            $this->resetPage();
                            $this->eliminandoFiltros = false;
                        }
                        return $productsQuery->orderBy('id', $this->orden)->paginate(12);
            });
    
            return view('livewire.category-filter', compact('products'));
        }
    
        public function limpiar()
        {
            $this->orden = 'desc';
            $this->reset(['subcategoria','marca']);
            $this->resetPage();
            $this->eliminandoFiltros = true;
        }
    */
}
