<?php

namespace App\Http\Livewire;

use App\Models\Section as SectionModel;
use Livewire\Component;

class Section extends Component
{
    public $addmore = [1];
    public $count = 0;
    public $section_name, $section_status;
    public function addmore()
    {
        $countable = $this->count++;
        if ($countable < 5) {
            $this->addmore[] = count($this->addmore) + 1;
        }
    }
    public function remove($index)
    {
        $this->count--;
        unset($this->addmore[$index]);
    }
    public function store()
    {
        foreach ($this->section_name as $key => $name) {
            SectionModel::create([
                'section_name' => $this->section_name['$key'],
                'status' => $this->section_status['$key'] ?? 0
            ]);
        }
        $this->formreset();
    }
    public function formreset()
    {
        $this->section_name = '';
        $this->section_status = '';
        $this->addmore = [1];
        $this->dispatchBrowserEvent('closemodel');
    }
    public function render()
    {
        return view('livewire.section', ['sections' => SectionModel::all()]);
    }
}
