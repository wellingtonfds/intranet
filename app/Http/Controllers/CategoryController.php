<?php

namespace App\Http\Controllers;

use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {

        return view('category.index', [
            'categories' => Category::paginate(5)
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'name' => 'required',
        ], [
            'name.required' => 'O nome é requerido.'
        ]);

        $category->fill($request->all());
        $category->save();
        return $category;
    }

    public function store(Request $request, Category $category)
    {
        $this->validate($request, [
            'name' => 'required',
        ], [
            'name.required' => 'O nome é requerido.'
        ]);

        $category->fill($request->all());
        $category->save();
        return $category;
    }

    public function edit(Category $category)
    {
        return $category;
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return $category;
    }
    public function show(Category $category)
    {
        return view('procedure.list', [
            'categories' => $category,
            'procedures' => $category->procedures()
                ->where('date_publish_finish','>=',Carbon::now()->format('Y-m-d'))
                ->orWhere('date_publish_finish','=', null)
                ->where('publish','=',true)
                ->paginate(15)
        ]);
    }



}
