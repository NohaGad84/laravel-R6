<?php
use Illuminate\Support\Facades\Route;

Route::get('/teachers', function () {
    return 'List of teachers';
});

Route::get('/teachers/{id}', function ($id) {
    return "Teacher with ID: $id";
});