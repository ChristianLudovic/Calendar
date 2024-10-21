<?php

namespace App\Livewire\Components;

use App\Models\Person;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Form extends Component
{

    public $isOpen = false;
    public $name = '';
    public $birthDate = '';
    public $avatarId = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'birthDate' => 'required|date_format:d-m-Y',
        'avatarId' => 'required|integer|min:1|max:31',
    ];

    public function updatedBirthDate($value)
    {
        if (!$this->isValidDate($value)) {
            $this->addError('birthDate', 'Le format de la date doit être jj-mm-aaaa');
            return;
        }
        
        $this->birthDate = $value;
    }

    public function addPerson()
    {
        $this->validate();

        try {
            $formattedDate = $this->formatDate($this->birthDate);
            
            Person::create([
                'name' => $this->name,
                'birthDate' => $formattedDate,
                'avatarId' => $this->avatarId,
                'user_id' => Auth::user()->id,
                
            ]);

            $this->reset(['name', 'birthDate', 'avatarId']);
            $this->isOpen = false;
            $this->dispatch('personAdded');
        } catch (\Exception $e) {
            $this->addError('birthDate', 'Erreur lors de la conversion de la date.');
        }
    }

    private function isValidDate($date)
    {
        $d = \DateTime::createFromFormat('d-m-Y', $date);
        return $d && $d->format('d-m-Y') === $date;
    }

    private function formatDate($date)
    {
        $d = \DateTime::createFromFormat('d-m-Y', $date);
        return $d ? $d->format('Y-m-d') : null;
    }

    

    public function render()
    {
        return view('livewire.components.form');
    }
}
