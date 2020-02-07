<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'ProductController@index');

Route::post('/category/{product_id}/fetch', 'ProductCategoryController@fetch')->name('product.category.fetch');
Route::post('/category/{product_id}/toggle', 'ProductCategoryController@toggle')->name('product.category.toggle');
