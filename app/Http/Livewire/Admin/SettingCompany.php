<?php

namespace App\Http\Livewire\Admin;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class SettingCompany extends Component
{
    public $ceo;
    public $phone1;
    public $phone2;
    public $email1;
    public $email2;
    public $address;
    public $facebook;
    public $instagram;
    public $whatsapp;
    public $banner;
    public $maps;
    public $banco;
    public $tipocuenta;
    public $cuenta;
    public $cedula;

    public function mount()
    {
        $setting = Setting::first();

        if ($setting) {
            $this->ceo = $setting->ceo;
            $this->phone1 = $setting->phone1;
            $this->phone2 = $setting->phone2;
            $this->email1 = $setting->email1;
            $this->email2 = $setting->email2;
            $this->address = $setting->address;
            $this->facebook = $setting->facebook;
            $this->instagram = $setting->instagram;
            $this->whatsapp = $setting->whatsapp;
            $this->banner = $setting->banner;
            $this->maps = $setting->maps;
            $this->banco = $setting->banco;
            $this->tipocuenta = $setting->tipocuenta;
            $this->cuenta = $setting->cuenta;
            $this->cedula = $setting->cedula;
        }
    }
    public function render()
    {
        return view('livewire.admin.setting-company')->layout('layouts.admin');
    }

    public function saveSettings()
    {
        $this->validate([
            'ceo' => 'nullable|string',
            'phone1' => 'nullable|string',
            'phone2' => 'nullable|string',
            'email1' => 'nullable|string|email',
            'email2' => 'nullable|string|email',
            'address' => 'nullable|string',
            'facebook' => 'nullable|string',
            'instagram' => 'nullable|string',
            'whatsapp' => 'nullable|string',
            'banner' => 'nullable|string',
            'maps' => 'nullable|string',
            'banco' => 'nullable|string',
            'tipocuenta' => 'nullable|string',
            'cuenta' => 'nullable|string',
            'cedula' => 'nullable|string'
        ]);

        $setting = Setting::firstOrCreate([]);

        $setting->ceo = $this->ceo;
        $setting->phone1 = $this->phone1;
        $setting->phone2 = $this->phone2;
        $setting->email1 = $this->email1;
        $setting->email2 = $this->email2;
        $setting->address = $this->address;
        $setting->facebook = $this->facebook;
        $setting->instagram = $this->instagram;
        $setting->whatsapp = $this->whatsapp;
        $setting->banner = $this->banner;
        $setting->maps = $this->maps;
        $setting->banco = $this->banco;
        $setting->tipocuenta = $this->tipocuenta;
        $setting->cuenta = $this->cuenta;
        $setting->cedula = $this->cedula;
        $setting->save();

        Cache::forget('settings');

        $this->emit('saved');
    }
}
