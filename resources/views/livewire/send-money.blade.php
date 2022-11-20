
<div class="font-manrope flex h-screen w-full items-center justify-center">
<form wire:submit.prevent="send">
 @if (session()->has('message'))
        <div class="bg-emerald-500 text-white py-3 px-4 mb-4">
            {{ session('message') }}
        </div>
    @elseif(session()->has('error'))
        <div class="bg-red-500 text-white py-3 px-4 mb-4">
            {{ session('error') }}
        </div>

    @endif
  <div class="mx-auto box-border w-[365px] border bg-blue-100 p-4">
    <div class="flex items-center justify-between">
      <span class="font-bold">Para Gönder</span>
    </div>

    <div class="mt-6">
      <div class="font-semibold">Göndermek istediğiniz tutari girin</div>
      <div><input wire:model="amount" class="mt-1 w-full rounded-[4px] border border-[#A0ABBB] p-2" value="100.00" type="text" placeholder="100.00" /></div>
      <div class="flex justify-between">
        <span class="mt-[14px] text-gray-900 cursor-pointer truncate rounded-[4px] border border-[#E7EAEE] p-3">Ücret :</span>
        <div class="mt-[14px] cursor-pointer truncate rounded-[4px] border border-[#E7EAEE] p-3 text-red-600">TL {{$fees}}</div>
    </div>      
    <div class="mt-6">
      <div class="font-semibold">Şehir Seçin</div>
      <div class="mt-2">
        <div class="flex w-full items-center justify-between bg-neutral-100 p-3 rounded-[4px]">
       <select wire:model="selectedCity" wire:change="changeCity" class="flex-1">
        <option value="-1">Lütfen bir şehir seçin</option>
        @foreach($cities as $city)
            <option value="{{ $city->id }}">{{ $city->name }}</option>
        @endforeach
        </select>
    </div>
    </div>
    </div>
  <div class="mt-6">
    <div class="font-semibold">Ilçe Seç</div>
     @error('selectedProvince') <span class="text-red-500">{{ $message }}</span> @enderror
      <div class="mt-2">
        <div class="flex w-full items-center justify-between bg-neutral-100 p-3 rounded-[4px]">
        <select wire:model="selectedProvince" class="flex-1">
            @foreach($province as $ilce)
             <option value="{{$ilce->id}}">{{$ilce->name}}</option>
            @endforeach
        </select>
       </div>
        </div>
         <p wire:loading.block class=" mt-4 text-center font-bold text-red-700">Sonucudan seçtiğiniz şehir ilçeleri getiriyor...</p>
    </div>
    </div>
    <div class="mt-6">
    @if(!$total)
    <div class="flex justify-between">
        <span class="mt-[14px] text-gray-900 cursor-pointer truncate rounded-[4px] border border-[#E7EAEE] p-3">Toplam :</span>
        <div class="mt-[14px] cursor-pointer truncate rounded-[4px] border border-[#E7EAEE] p-3 text-[#191D23]">TL 0.00</div>
    </div>
    @else
    <div class="flex justify-between">
        <span class="mt-[14px] text-gray-900 cursor-pointer truncate rounded-[4px] border border-[#E7EAEE] p-3">Toplam :</span>
        <div class="mt-[14px] cursor-pointer truncate rounded-[4px] border border-[#E7EAEE] p-3 text-[#191D23]">TL {{$total}}</div>
    </div>
    @endif
    <button type="submit" class="mt-6 w-full bg-[#2F80ED] text-white py-3 rounded-[4px] font-bold">Gönder{{$total}}</button>
    </div>
  </div>
</form>
</div>