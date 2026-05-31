<?php

use App\Models\User;
use App\Models\Category;
use App\Models\Product;

test('category name is required', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->post('/categories', [
            'name' => '',
        ]);

    $response->assertSessionHasErrors('name');
});

test('category can be created with valid data', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->post('/categories', [
            'name' => 'Elektronik',
        ]);

    $response->assertSessionHasNoErrors();
    $response->assertRedirect('/categories');
    $this->assertDatabaseHas('categories', ['name' => 'Elektronik']);
});

test('product validation rules are enforced', function () {
    $user = User::factory()->create();
    $category = Category::create(['name' => 'Elektronik']);

    // Test required name
    $response = $this
        ->actingAs($user)
        ->post('/products', [
            'name' => '',
            'category_id' => $category->id,
            'price' => 1000,
            'stock' => 5,
        ]);
    $response->assertSessionHasErrors('name');

    // Test required category
    $response = $this
        ->actingAs($user)
        ->post('/products', [
            'name' => 'Laptop Asus',
            'category_id' => '',
            'price' => 1000,
            'stock' => 5,
        ]);
    $response->assertSessionHasErrors('category_id');

    // Test negative price
    $response = $this
        ->actingAs($user)
        ->post('/products', [
            'name' => 'Laptop Asus',
            'category_id' => $category->id,
            'price' => -100,
            'stock' => 5,
        ]);
    $response->assertSessionHasErrors('price');

    // Test negative stock
    $response = $this
        ->actingAs($user)
        ->post('/products', [
            'name' => 'Laptop Asus',
            'category_id' => $category->id,
            'price' => 1000,
            'stock' => -5,
        ]);
    $response->assertSessionHasErrors('stock');
});

test('product can be created with valid data', function () {
    $user = User::factory()->create();
    $category = Category::create(['name' => 'Elektronik']);

    $response = $this
        ->actingAs($user)
        ->post('/products', [
            'name' => 'Laptop Asus',
            'category_id' => $category->id,
            'price' => 15000000,
            'stock' => 10,
        ]);

    $response->assertSessionHasNoErrors();
    $response->assertRedirect('/products');
    $this->assertDatabaseHas('products', [
        'name' => 'Laptop Asus',
        'category_id' => $category->id,
        'price' => 15000000.00,
        'stock' => 10,
    ]);
});
