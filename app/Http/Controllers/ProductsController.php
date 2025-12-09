<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->ram) {
            $query->where('ram', $request->ram);
        }

        if ($request->manhinh) {
            $query->where('manhinh', $request->manhinh);
        }

        if ($request->ocung == '512GB') {
            $query->where('ocung', 'LIKE', '%512%');
        }
        if ($request->ocung == '1TB') {
            $query->where('ocung', 'LIKE', '%1TB%');
        }

        if ($request->price_from) {
            $query->where('giasp', '>=', $request->price_from);
        }

        if ($request->price_to) {
            $query->where('giasp', '<=', $request->price_to);
        }

        $products = $query->paginate(12);

        $brands = Product::whereNotNull('hang')->pluck('hang')->unique()->values();

        $ramOptions = Product::whereNotNull('ram')
            ->pluck('ram')->unique()
            ->filter(fn($i) => in_array($i, ['16GB', '8GB']))
            ->values();

        $manhinhOptions = Product::whereNotNull('manhinh')
            ->pluck('manhinh')->unique()
            ->filter(fn($i) => in_array($i, [
                '14 inches','15.6 inches','16 inches'
            ]))
            ->values();

        $ocungOptions = ['512GB','1TB'];

        return view('pages.products.products', compact(
            'products','brands','ramOptions','manhinhOptions','ocungOptions'
        ));
    }
}

