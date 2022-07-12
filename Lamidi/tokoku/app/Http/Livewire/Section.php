<?php

namespace App\Http\Livewire;

use App\Models\Section as SectionModel;
use Livewire\Component;

class Section extends Component
{
    public $addmore = [1];
    public $count = 0;
    public $section_name, $section_status, $edit_id;
    public $checked = [], $selectall = false;

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
    protected $lestiners = ['RecordDeleted' => 'DeletedSection'];
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
        dd($section_id);
        $this->edit_id = $section_id;
        $section = SectionModel::findOrFail($section_id);
        $this->section_name = $section->section_name;
        $this->section_status = $section->status;
    }
    public function update($section_id)
    {
        SectionModel::updateOrCreate(['id' => $section_id], [
            'section_name' => $this->section_name,
            'status' => $this->section_status ?? 1
        ]);
        $this->formreset();
        $this->SwalMessageDialog('Section Upddated Successfully');
    }
    public function ischecked($section_id)
    {
        return $this->checked && $this->selectall ?
            in_array($section_id, $this->checked) :
            in_array($section_id, $this->checked);
    }
    public function updatedselectall($value_in_array)
    {
        $value_in_array ? $this->checked = SectionModel::pluck('id') : $this->checked = [];
    }
    public function confirmbulkdelete($section_id)
    {
        $this->dispatchBrowserEvent('Swal:DeletedRecord', ['title' => "Are you sure want to dele All?", 'id' => $this->checked]);
    }
    public function recorddeleted($section_id)
    {
        if ($this->checked) {
            SectionModel::whereIn('id', $this->checked)->delete();
            $this->checked = [];
            $this->selectall = false;
        } else {
            $section = SectionModel::find($section_id);
            $section->delete();
        }
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
