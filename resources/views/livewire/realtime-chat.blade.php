<div class="flex h-[calc(100vh-65px)] bg-slate-100">
    {{-- Chat Area --}}
    <div class="flex-1 flex flex-col relative w-full max-w-4xl mx-auto bg-[#efe7dd]">
        {{-- Header --}}
        <div class="flex items-center justify-between bg-white px-4 py-3 shadow-sm border-b border-slate-200 z-10">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 overflow-hidden rounded-full bg-slate-300">
                    <img src="https://placehold.co/100" class="h-full w-full object-cover">
                </div>
                <div>
                    <h3 class="font-bold text-slate-800">Admin Toko</h3>
                    <p class="text-xs text-green-600 font-medium">Online</p>
                </div>
            </div>
            <button class="bg-indigo-50 text-indigo-600 px-3 py-1.5 rounded-full text-sm font-bold hover:bg-indigo-100 transition-colors">
                Lihat Pesanan
            </button>
        </div>

        {{-- Messages --}}
        <div class="flex-1 overflow-y-auto p-4 space-y-2 custom-scrollbar" id="chat-container">
            @foreach($messages as $msg)
                <div class="flex w-full {{ $msg->is_from_seller ? 'justify-start' : 'justify-end' }}">
                    <div class="relative max-w-[80%] rounded-lg px-3 py-2 text-sm shadow-sm 
                        {{ $msg->is_from_seller ? 'bg-white text-slate-800 rounded-tr-lg' : 'bg-[#e2ffc7] text-slate-900 rounded-tl-lg' }}">
                        {{ $msg->content }}
                        <span class="block text-[10px] text-slate-500 text-right mt-1">
                            {{ $msg->created_at->format('H:i') }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Input Area --}}
        <div class="bg-white px-4 py-3 border-t border-slate-200">
            <form wire:submit.prevent="sendMessage" class="flex items-end gap-2">
                <button type="button" class="p-2 text-slate-500 hover:text-slate-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m18.375 12.739-7.693 7.693a4.5 4.5 0 0 1-6.364-6.364l10.94-10.94A3 3 0 1 1 19.5 7.372L8.552 18.32m.009-.01-.01.01m5.699-9.941-7.81 7.81a1.5 1.5 0 0 0 2.112 2.13" />
                    </svg>
                </button>
                
                <input 
                    wire:model="message" 
                    type="text" 
                    placeholder="Ketik pesan..." 
                    class="block w-full rounded-full border-0 bg-slate-100 py-3 px-4 text-slate-900 placeholder:text-slate-500 focus:ring-0 sm:text-sm sm:leading-6"
                >
                
                <button type="submit" class="rounded-full bg-indigo-600 p-3 text-white shadow-md hover:bg-indigo-500 transition-all hover:scale-105 active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>

<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }
</style>
