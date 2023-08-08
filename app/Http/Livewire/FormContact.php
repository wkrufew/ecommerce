<?php

namespace App\Http\Livewire;

use App\Mail\FormContact as MailFormContact;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;

class FormContact extends Component
{
    public $name;
    public $email;
    public $phone;
    public $message;
    public $isLoading = false;

    protected $rules = [
        'name' => 'required|min:6',
        'email' => 'required|email',
        'phone' => 'required|max:10',
        'message' => 'required|min:10',
    ];

    public function saveContact()
    {
        $data = $this->validate();

        Mail::to('destinatario@example.com')->queue(new MailFormContact($data));
        
        $this->resetForm();
        
        $this->emit('saved');
    }

    private function resetForm()
    {
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->message = '';
    }

    public function render()
    {
        return view('livewire.form-contact');
    }
}
