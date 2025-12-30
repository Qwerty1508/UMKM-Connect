<div class="min-h-screen bg-slate-50 py-12">
    <div class="container mx-auto max-w-3xl px-4">
        <div class="text-center mb-12">
            <h1 class="text-3xl font-bold text-slate-900">Pusat Bantuan</h1>
            <p class="text-slate-600 mt-2">Temukan jawaban atas pertanyaan Anda atau hubungi kami.</p>
        </div>

        <div class="space-y-4">
            @foreach($faqs as $index => $faq)
                <div x-data="{ open: false }" class="rounded-xl bg-white shadow-sm border border-slate-100 overflow-hidden">
                    <button @click="open = !open" class="flex w-full items-center justify-between px-6 py-4 text-left font-bold text-slate-800 hover:bg-slate-50 transition-colors">
                        <span>{{ $faq['question'] }}</span>
                        <svg x-bind:class="open ? 'rotate-180' : ''" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5 transition-transform text-slate-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="border-t border-slate-50 bg-slate-50 px-6 py-4 text-slate-600 text-sm leading-relaxed">
                        {{ $faq['answer'] }}
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Contact Support --}}
        <div class="mt-12 rounded-2xl bg-indigo-600 p-8 text-center text-white shadow-xl">
            <h2 class="text-2xl font-bold mb-2">Masih butuh bantuan?</h2>
            <p class="mb-6 opacity-90">Tim support kami siap membantu Anda 24/7 melalui WhatsApp.</p>
            <a href="https://wa.me/6281234567890" target="_blank" class="inline-flex items-center gap-2 rounded-full bg-white px-6 py-3 font-bold text-indigo-600 hover:bg-slate-100 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" /></svg>
                Chat WhatsApp
            </a>
        </div>
    </div>
</div>
