<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\Province;
use Livewire\Component;

class SendMoney extends Component
{
    public $amount;

    public $fees;

    public $total;

    public $cities = [];

    public $province = [];

    public $selectedCity;

    public $selectedProvince;

    protected $messages = ['selectedProvince.required' => 'Ilçe secmeniz gerekmektedir.'];

    public function mount()
    {
        $this->cities = City::all();
    }

     public function changeCity()
     {
         // sleep(1);
         if ($this->selectedCity !== '-1') {
             $this->province = Province::where('city_id', $this->selectedCity)->get();
         }
     }

     public function send()
     {
         $this->validate([
             'selectedProvince' => 'required',
         ]);
         if ($this->amount <= 1) {
             session()->flash('error', 'Lütfen 1 TL den büyük bir tutar giriniz.');
         } else {
             session()->flash('message', ' işlem başarılı');
         }
     }

     public function render()
     {
         if ($this->amount == '') {
             $this->amount = '';
             $this->total = '';
         } elseif ($this->amount < 2000) {
             $this->fees = $this->amount * 0.05;
             $this->total = number_format($this->amount + $this->fees, 2);
         } elseif ($this->amount >= 2000 && $this->amount < 5000) {
             $this->fees = $this->amount * 0.08;
             $this->total = number_format($this->amount + $this->fees, 2);
         } elseif ($this->amount >= 5000) {
             $this->fees = $this->amount * 0.1;
             $this->total = number_format($this->amount + $this->fees, 2);
         } else {
             $this->total = '';
         }
         $this->send = '';

         return view('livewire.send-money', ['total' => $this->total]);
     }
}
