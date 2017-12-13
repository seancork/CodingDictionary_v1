<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index()
{
  $post = Post::active()->orderBy('updated_at', 'desc')->first();
  $podcast = Podcast::active()->orderBy('updated_at', 'desc')->first();

  return response()->view('sitemap.index', [
      'post' => $post,
      'podcast' => $podcast,
  ])->header('Content-Type', 'text/xml');
}
}
