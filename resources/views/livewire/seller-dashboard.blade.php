<div class="container mx-auto px-6 py-8">
    <h3 class="text-3xl font-bold text-slate-800 mb-8">Dashboard Overview</h3>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-4 mb-8">
        {{-- Card 1 --}}
        <div class="flex items-center rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
            <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-indigo-50 text-indigo-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
            </div>
            <div class="ml-4">
                <span class="block text-2xl font-bold text-slate-900">Rp 12.5 Jt</span>
                <span class="block text-sm text-slate-500">Omzet Bulan Ini</span>
            </div>
        </div>

        {{-- Card 2 --}}
        <div class="flex items-center rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
            <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-orange-50 text-orange-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" /></svg>
            </div>
            <div class="ml-4">
                <span class="block text-2xl font-bold text-slate-900">54</span>
                <span class="block text-sm text-slate-500">Pesanan Baru</span>
            </div>
        </div>
    </div>

    {{-- Orders Section --}}
    <div class="rounded-2xl bg-white shadow-sm border border-slate-100 overflow-hidden">
        <div class="border-b border-slate-100 px-6 py-4 flex justify-between items-center">
            <h2 class="text-lg font-bold text-slate-800">Pesanan Terbaru</h2>
            <div class="flex gap-2">
                 <button class="px-3 py-1 text-sm font-medium text-indigo-600 bg-indigo-50 rounded-full">Baru (12)</button>
                 <button class="px-3 py-1 text-sm font-medium text-slate-500 hover:bg-slate-50 rounded-full">Diproses (5)</button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-500">
                <thead class="bg-slate-50 text-xs uppercase text-slate-700">
                    <tr>
                        <th class="px-6 py-3">ID Pesanan</th>
                        <th class="px-6 py-3">Pelanggan</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Total</th>
                        <th class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <tr class="hover:bg-slate-50/50">
                        <td class="px-6 py-4 font-medium text-slate-900">#ORD-001</td>
                        <td class="px-6 py-4">Budi Santoso</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center rounded-md bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-800 ring-1 ring-inset ring-yellow-600/20">Menunggu</span>
                        </td>
                        <td class="px-6 py-4 font-bold">Rp 45.000</td>
                        <td class="px-6 py-4">
                            <button class="text-indigo-600 hover:text-indigo-900 font-medium">Proses</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
