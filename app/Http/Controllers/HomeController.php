<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\SystemSettings;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $contentsLatest = Content::where(function ($query) {
            $query->whereNull('scheduled_for')
                  ->orWhere('scheduled_for', '<=', now());
        })->with('genre')->latest()->get();
        
        $contentsMovies = Content::where('content_type', 'movie')->where(function ($query) {
            $query->whereNull('scheduled_for')
                  ->orWhere('scheduled_for', '<=', now());
        })->with('genre')->latest()->get();

        $contentsSeries = Content::where('content_type', 'series')->where(function ($query) {
            $query->whereNull('scheduled_for')
                  ->orWhere('scheduled_for', '<=', now());
        })->with('genre')->latest()->get();

        $contentsPodcasts = Content::where('content_type', 'podcast')->where(function ($query){
            $query->whereNull('scheduled_for')
            ->orWhere('scheduled_for', '<=', now());
        })->with('genre')->latest()->get();

        return view('home', compact('contentsLatest', 'contentsMovies', 'contentsSeries', 'contentsPodcasts'));
    }

    public function tos(){
        $settings = SystemSettings::first('site_tos');
        return view('terms', compact('settings'));    
    }

    public function show(Content $content)
    {
        return view('content.show', compact('content'));
    }
}
