<?php

namespace App\Http\Controllers;

use App\Entities\Category;
use App\Http\Requests\CategoryRequest;
use App\Repositories\Contracts\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * @var CategoryRepository
     */
    public $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryRepository->all();

        return view('categories.index')->withCategories($categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', Category::class);

        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CategoryRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(CategoryRequest $request)
    {
        $this->authorize('create', Category::class);

        $category = $this->categoryRepository->create($request->all());

        return redirect()->route('categories.show', $category)->withMessage('Ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('categories.show')->withCategory($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Category $category
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Category $category)
    {
        $this->authorize('update', $category);

        return view('categories.edit')->withCategory($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CategoryRequest $request
     * @param  Category $category
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $this->authorize('update', $category);

        $updatedCategory = $this->categoryRepository->update($request->all(), $category->getKey());

        return redirect()->route('categories.show', $updatedCategory)->withMessage('Ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Category $category
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Category $category)
    {
        $this->authorize('delete', $category);
    }
}
