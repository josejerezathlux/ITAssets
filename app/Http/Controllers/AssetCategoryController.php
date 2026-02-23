<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAssetCategoryRequest;
use App\Http\Requests\UpdateAssetCategoryRequest;
use App\Models\AssetCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AssetCategoryController extends Controller
{
    public function index(): View
    {
        $this->authorize('viewAny', AssetCategory::class);
        $categories = AssetCategory::withCount('assets')->orderBy('name')->paginate(20);
        return view('categories.index', compact('categories'));
    }

    public function create(): View
    {
        $this->authorize('create', AssetCategory::class);
        return view('categories.create');
    }

    public function store(StoreAssetCategoryRequest $request): RedirectResponse
    {
        $data = $request->validated();
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }
        AssetCategory::create($data);
        return redirect()->route('categories.index')->with('success', 'Category added.');
    }

    public function show(AssetCategory $category): View
    {
        $this->authorize('view', $category);
        $category->loadCount('assets');
        $category->load(['assets', 'fields']);
        return view('categories.show', compact('category'));
    }

    public function edit(AssetCategory $category): View
    {
        $this->authorize('update', $category);
        return view('categories.edit', compact('category'));
    }

    public function update(UpdateAssetCategoryRequest $request, AssetCategory $category): RedirectResponse
    {
        $data = $request->validated();
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }
        $category->update($data);
        return redirect()->route('categories.index')->with('success', 'Category updated.');
    }

    public function destroy(AssetCategory $category): RedirectResponse
    {
        $this->authorize('delete', $category);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category removed.');
    }
}
