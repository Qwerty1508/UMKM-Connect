<div>
    <h1 class="text-3xl font-bold text-slate-900 mb-8">Platform Statistics</h1>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <p class="text-sm text-slate-500 mb-1">Total Users</p>
            <p class="text-3xl font-bold text-slate-900">{{ $totalUsers }}</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <p class="text-sm text-slate-500 mb-1">Total UMKM</p>
            <p class="text-3xl font-bold text-indigo-600">{{ $totalStores }}</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <p class="text-sm text-slate-500 mb-1">Total Orders</p>
            <p class="text-3xl font-bold text-green-600">{{ $totalOrders }}</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <p class="text-sm text-slate-500 mb-1">Pending Verification</p>
            <p class="text-3xl font-bold text-orange-600">{{ $pendingStores }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <h3 class="font-bold text-slate-800 mb-4">Recent Regitrations</h3>
            <div class="space-y-4">
                {{-- Dummy Data --}}
                @foreach(range(1, 4) as $i)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="h-10 w-10 rounded-full bg-slate-100 flex items-center justify-center font-bold text-slate-500">U</div>
                            <div>
                                <p class="font-medium text-slate-900">User {{ $i }}</p>
                                <p class="text-xs text-slate-500">user{{ $i }}@example.com</p>
                            </div>
                        </div>
                        <span class="text-xs text-slate-400">2 mins ago</span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <h3 class="font-bold text-slate-800 mb-4">Verification Queue</h3>
             <div class="space-y-4">
                {{-- Dummy Data --}}
                @foreach(range(1, 3) as $i)
                    <div class="flex items-center justify-between border-b border-slate-50 last:border-0 pb-3 last:pb-0">
                        <div>
                            <p class="font-medium text-slate-900">Warung {{ $i }}</p>
                            <p class="text-xs text-slate-500">Submitted ID Card</p>
                        </div>
                        <div class="flex gap-2">
                            <button class="px-3 py-1 text-xs font-bold text-green-600 bg-green-50 rounded-lg">Accept</button>
                            <button class="px-3 py-1 text-xs font-bold text-red-600 bg-red-50 rounded-lg">Reject</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
