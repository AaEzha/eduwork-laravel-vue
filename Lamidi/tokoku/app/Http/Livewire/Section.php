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
        foreach ($this->section_name as $key => $section) {
            SectionModel::create([
                'section_name' => $this->section_name[$key],
                'status' => $this->section_status[$key] ?? 0
            ]);
        }
        $this->formreset();
        $this->SwalMessageDialog('Section Inserted Successfully');
    }
    public function editsection($section_id)
    {
        $section = SectionModel::findOrFail($section_id);
        $this->section_name = $section->section_name;
        $this->section_status = $section->status ?? 0;
    }
    public function formreset()
    {
        $this->section_name = '';
        $this->section_status = '';
        $this->addmore = [1];
        $this->dispatchBrowserEvent('closemodel');
    }
    public function SwalMessageDialog($message)
    {
        $this->dispatchBrowserEvent('msgsuccessfull', ['title' => $message,]);
    }
    public function render()
    {
        return view('livewire.section', ['sections' => SectionModel::all()]);
    }
}
