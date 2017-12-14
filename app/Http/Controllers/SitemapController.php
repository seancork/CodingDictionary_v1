<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Word;

class SitemapController extends Controller
{
    public function index()
{
    $words = Word::all()->first();

  return response()->view('sitemap.index', [
      'words' => $words,
  ])->header('Content-Type', 'text/xml');
}

 public function words()
    {
        $words = Word::latest()->get();
       $usersUnique = $words->unique('word');
        return response()->view('sitemap.words', [
            'words' => $usersUnique,
        ])->header('Content-Type', 'text/xml');
    }
}
