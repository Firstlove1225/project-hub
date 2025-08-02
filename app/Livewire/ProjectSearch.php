<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Component;

class ProjectSearch extends Component
{
    public $searchTerm = '';

    public function render()
    {
        $projects = Project::where('name', 'like', '%'.$this->searchTerm.'%')
            ->whereIn('status', ['completed', 'in_progress'])
            ->get();

        return view('livewire.project-search', [
            'projects' => $projects,
        ]);
    }
}
