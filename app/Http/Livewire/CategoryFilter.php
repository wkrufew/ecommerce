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

    public function updatedPrecio()
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

        /* if ($this->precio === 'desc') { */
            /* agregar el filtro para discount*/
            /* $productsQuery->orderBy('discount', 'desc'); */
            if ($this->precio) {
                $productsQuery->orderByRaw('CASE WHEN discount > 0 THEN 0 ELSE 1 END, discount ' . $this->precio)
                              ->orderBy('id',  $this->precio);
            }
        /* } elseif ($this->precio === 'asc') {
            $productsQuery->orderByRaw('CASE WHEN discount > 0 THEN 0 ELSE 1 END, discount ' . $this->precio)
                              ->orderBy('id',  $this->precio); */
            /* $productsQuery->orderBy('discount', 'asc'); */
        /* } */

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
}
