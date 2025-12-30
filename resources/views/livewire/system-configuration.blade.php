<div class="container mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-3xl font-bold text-slate-800">System Configuration</h3>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8">
        <form wire:submit.prevent="save">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                {{-- App Settings --}}
                <div class="col-span-full">
                    <h4 class="text-lg font-bold text-slate-800 border-b border-slate-100 pb-2 mb-4">Application Settings</h4>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">App Name</label>
                    <input wire:model="appName" type="text" class="w-full rounded-lg border-slate-200 px-4 py-3 focus:ring-indigo-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">App URL</label>
                    <input wire:model="appUrl" type="text" class="w-full rounded-lg border-slate-200 px-4 py-3 focus:ring-indigo-500">
                </div>

                {{-- Mail Settings --}}
                <div class="col-span-full mt-4">
                    <h4 class="text-lg font-bold text-slate-800 border-b border-slate-100 pb-2 mb-4">Mail Configuration</h4>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Mail Host</label>
                    <input wire:model="mailHost" type="text" class="w-full rounded-lg border-slate-200 px-4 py-3 focus:ring-indigo-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Mail Port</label>
                    <input wire:model="mailPort" type="text" class="w-full rounded-lg border-slate-200 px-4 py-3 focus:ring-indigo-500">
                </div>
            </div>

            <div class="flex justify-end pt-6 border-t border-slate-100">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg transition-transform hover:-translate-y-1">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
