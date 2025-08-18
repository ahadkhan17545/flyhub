<?php

use App\Models\Tenant\Category;
use App\Repositories\Tenant\CategoryRepository;

uses(Tests\TestCase::class);

beforeEach(function () {
    $this->categoryRepo = new CategoryRepository();
});

test('create category', function () {
    $category = Category::factory()->make()->toArray();
    $createdCategory = $this->categoryRepo->create($category);
    $createdCategory = $createdCategory->toArray();
    $this->assertArrayHasKey('id', $createdCategory);
    $this->assertNotNull($createdCategory['id'], 'Created Category must have id specified');
    $this->assertNotNull(Category::find($createdCategory['id']), 'Category with given id must be in DB');
    $this->assertModelData($category, $createdCategory);
});

test('read category', function () {
    $category = Category::factory()->create();
    $dbCategory = $this->categoryRepo->find($category->id);
    $dbCategory = $dbCategory->toArray();
    $this->assertModelData($category->toArray(), $dbCategory);
});

test('update category', function () {
    $category = Category::factory()->create();
    $fakeCategory = Category::factory()->make()->toArray();
    $updatedCategory = $this->categoryRepo->update($fakeCategory, $category->id);
    $this->assertModelData($fakeCategory, $updatedCategory->toArray());
    $dbCategory = $this->categoryRepo->find($category->id);
    $this->assertModelData($fakeCategory, $dbCategory->toArray());
});

test('delete category', function () {
    $category = Category::factory()->create();
    $resp = $this->categoryRepo->delete($category->id);
    $this->assertTrue($resp);
    $this->assertNull(Category::find($category->id), 'Category should not exist in DB');
});
