<?php

use Illuminate\Http\Request;

function fotoAkun()
{
    return asset(auth()->user()->foto);
}

function nama()
{
    return auth()->user()->nama;
}

function menu()
{
    $menu = [
        'Kriteria', 'Alternatif', 'User'
    ];

    return $menu;
}

function RouteURL()
{
    $url = [
        0 => 'kriteria.index', 
        1 => 'alternatif.index', 
        2 => 'user.index', 
    ];

    return $url;
}

function totalData($model)
{
    $a = 'App\Models\\' . $model;
    return $a::count();
}

