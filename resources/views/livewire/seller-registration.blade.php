<div class="min-h-screen bg-slate-50 py-12">
    <div class="container mx-auto max-w-2xl px-4">
        
        {{-- Progress Bar --}}
        <div class="mb-10">
            <div class="flex items-center justify-between px-2">
                @foreach([1, 2, 3] as $s)
                    <div class="flex flex-col items-center relative z-10">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full border-2 transition-all duration-300
                            {{ $step >= $s ? 'border-indigo-600 bg-indigo-600 text-white' : 'border-slate-300 bg-white text-slate-400' }}">
                            @if($step > $s)
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-6 w-6"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                            @else
                                <span class="font-bold">{{ $s }}</span>
                            @endif
                        </div>
                        <span class="mt-2 text-xs font-medium {{ $step >= $s ? 'text-indigo-600' : 'text-slate-400' }}">
                            {{ $s === 1 ? 'Info Usaha' : ($s === 2 ? 'Lokasi' : 'Verifikasi') }}
                        </span>
                    </div>
                @endforeach
                {{-- Connector Line --}}
                <div class="absolute left-0 top-5 -z-0 h-0.5 w-full bg-slate-200">
                    <div class="h-full bg-indigo-600 transition-all duration-300" style="width: {{ ($step - 1) * 50 }}%"></div>
                </div>
            </div>
        </div>

        <div class="rounded-2xl bg-white p-8 shadow-lg">
            <h1 class="mb-6 text-2xl font-bold text-slate-900">
                {{ $step === 1 ? 'Informasi Dasar' : ($step === 2 ? 'Lokasi Toko' : 'Upload Dokumen') }}
            </h1>

            <form wire:submit.prevent="registerStore">
                
                {{-- Step 1 --}}
                @if($step === 1)
                    <div class="space-y-6">
                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700">Nama Usaha</label>
                            <input wire:model.live="name" type="text" class="w-full rounded-lg border-slate-200 px-4 py-3 focus:border-indigo-500 focus:ring-indigo-500" placeholder="Contoh: Warung Mantap">
                            @error('name') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700">Slug URL</label>
                            <div class="flex items-center rounded-lg border border-slate-200 bg-slate-50 px-4 py-3 text-slate-500">
                                <span class="text-xs">umkm.connect/</span>
                                <input wire:model="slug" type="text" class="w-full border-none bg-transparent p-0 text-sm focus:ring-0" readonly>
                            </div>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700">Deskripsi Singkat</label>
                            <textarea wire:model="description" rows="3" class="w-full rounded-lg border-slate-200 px-4 py-3 focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                            @error('description') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                        </div>
                    </div>
                @endif

                {{-- Step 2 --}}
                @if($step === 2)
                    <div class="space-y-6">
                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700">Alamat Lengkap</label>
                            <textarea wire:model="location" rows="3" class="w-full rounded-lg border-slate-200 px-4 py-3 focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                            @error('location') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                        </div>
                        <div class="h-48 w-full rounded-xl bg-slate-100 flex items-center justify-center text-slate-400 border-2 border-dashed border-slate-200">
                            Peta Lokasi (Placeholder for Map Picker)
                        </div>
                    </div>
                @endif

                {{-- Step 3 --}}
                @if($step === 3)
                    <div class="space-y-6">
                        <div class="rounded-xl border border-blue-100 bg-blue-50 p-4">
                            <p class="text-sm text-blue-800">Silakan upload KTP untuk verifikasi identitas pemilik usaha.</p>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700">Foto KTP</label>
                            <input wire:model="idCard" type="file" class="block w-full text-sm text-slate-500 file:mr-4 file:rounded-full file:border-0 file:bg-indigo-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-indigo-700 hover:file:bg-indigo-100">
                            @error('idCard') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                        </div>
                    </div>
                @endif

                <div class="mt-8 flex justify-between">
                    @if($step > 1)
                        <button type="button" wire:click="prevStep" class="rounded-lg px-6 py-2 text-sm font-bold text-slate-600 hover:bg-slate-100">
                            Kembali
                        </button>
                    @else
                        <div></div>
                    @endif

                    @if($step < 3)
                        <button type="button" wire:click="nextStep" class="rounded-lg bg-indigo-600 px-6 py-2 text-sm font-bold text-white shadow-lg hover:bg-indigo-700 transition-all">
                            Lanjut
                        </button>
                    @else
                        <button type="submit" class="rounded-lg bg-green-600 px-6 py-2 text-sm font-bold text-white shadow-lg hover:bg-green-700 transition-all">
                            Daftar Sekarang
                        </button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
