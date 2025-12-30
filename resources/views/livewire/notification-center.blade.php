<div class="relative" x-data="{ open: false }">
    <button @click="open = !open" class="relative p-2 text-slate-500 hover:text-slate-700 transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" /></svg>
        
        @if(Auth::check() && Auth::user()->unreadNotifications->count() > 0)
            <span class="absolute top-1 right-1 h-2.5 w-2.5 rounded-full bg-red-500 border border-white"></span>
        @endif
    </button>

    <div x-show="open" @click.away="open = false" 
         class="absolute right-0 mt-2 w-80 origin-top-right rounded-xl bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none z-50 overflow-hidden"
         style="display: none;">
        
        <div class="px-4 py-3 border-b border-slate-100 flex justify-between items-center bg-slate-50">
            <h3 class="text-sm font-bold text-slate-900">Notifications</h3>
            <button wire:click="markAllAsRead" class="text-xs text-indigo-600 hover:text-indigo-800 font-medium">Mark all read</button>
        </div>

        <div class="divide-y divide-slate-100 max-h-96 overflow-y-auto">
            @forelse($this->notifications as $notification)
                <div class="px-4 py-3 hover:bg-slate-50 transition-colors {{ $notification->read_at ? 'opacity-60' : '' }}">
                    <a href="{{ $notification->data['url'] ?? '#' }}" wire:click="markAsRead('{{ $notification->id }}')" class="block">
                        <p class="text-sm text-slate-800 font-medium">{{ $notification->data['message'] ?? 'Notification' }}</p>
                        <p class="text-xs text-slate-500 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                    </a>
                </div>
            @empty
                <div class="px-4 py-8 text-center text-slate-500 text-sm">
                    No new notifications.
                </div>
            @endforelse
        </div>
        
        <div class="bg-slate-50 px-4 py-2 border-t border-slate-100 text-center">
            <a href="#" class="text-xs font-bold text-slate-600 hover:text-slate-800">View All</a>
        </div>
    </div>
</div>
