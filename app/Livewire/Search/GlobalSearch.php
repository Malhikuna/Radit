<?php

namespace App\Livewire\Search;

use Livewire\Component;
use App\Models\SearchHistory;
use App\Models\Community; 
use App\Models\Post;      
use Illuminate\Support\Facades\Auth;

class GlobalSearch extends Component
{
    public $search = '';
    public $recentSearches = [];
    public $trendingSearches = [];
    public $results = [];

    public function mount()
    {
        $this->refreshHistory();
        
        // Mockup Trending (Nanti bisa diganti logic real, misal: most viewed posts)
        $this->trendingSearches = [
            ['title' => 'Stranger Things Season 5', 'desc' => 'Based on your interests'],
            ['title' => 'GTA VI Leaks', 'desc' => 'Trending in Gaming'],
            ['title' => 'Laravel 20 Released', 'desc' => 'Technology'],
        ];
    }

    public function updatedSearch()
    {
        if (strlen($this->search) >= 2) {
            $this->results = [
                'communities' => Community::where('name', 'like', '%' . $this->search . '%')
                                    ->take(3)->get(),
                'posts' => Post::where('title', 'like', '%' . $this->search . '%')
                                ->take(5)->get(),
            ];
        } else {
            $this->results = [];
        }
    }

    public function deleteHistory($id)
    {
        SearchHistory::where('id', $id)->where('user_id', Auth::id())->delete();
        $this->refreshHistory();
    }

    public function saveHistory($keyword)
    {
        if (Auth::check() && !empty($keyword)) {
            SearchHistory::updateOrCreate(
                ['user_id' => Auth::id(), 'keyword' => $keyword],
                ['updated_at' => now()]
            );
        }
        $this->refreshHistory();
    }

    public function refreshHistory()
    {
        if (Auth::check()) {
            $this->recentSearches = SearchHistory::where('user_id', Auth::id())
                ->latest()
                ->take(5)
                ->get();
        }
    }

    public function render()
    {
        return view('livewire.search.global-search');
    }
}