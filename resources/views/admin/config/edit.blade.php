@extends('layouts.admin')

@section('title', 'Pengaturan CMS')

@section('content')
    <div class="mb-8">
        <h1 class="font-display text-2xl font-bold text-primary">Pengaturan CMS</h1>
        <p class="text-gray-500">Kustomisasi tampilan dan konten website Anda</p>
    </div>
    
    <form action="{{ route('admin.config.update') }}" method="POST" x-data="cmsEditor()" class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        @csrf
        @method('PUT')
        
        <!-- Editor Panel -->
        <div class="space-y-6">
            <!-- Business Info -->
            <div class="luxury-card p-6">
                <h2 class="font-display text-lg font-semibold text-primary mb-4">Informasi Bisnis</h2>
                
                <div class="space-y-4">
                    <div>
                        <label class="form-label">Nama Bisnis <span class="text-red-500">*</span></label>
                        <input type="text" name="business_name" x-model="businessName" 
                               value="{{ old('business_name', $config['business_name']) }}"
                               maxlength="50" class="form-input" required>
                        <p class="text-xs text-gray-400 mt-1">Maksimal 50 karakter</p>
                        @error('business_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="form-label">Tagline</label>
                        <input type="text" name="tagline" x-model="tagline"
                               value="{{ old('tagline', $config['tagline']) }}"
                               maxlength="50" class="form-input">
                        <p class="text-xs text-gray-400 mt-1">Maksimal 50 karakter</p>
                        @error('tagline')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="form-label">Tentang Bisnis</label>
                        <textarea name="about_text" rows="4" maxlength="1000" class="form-input">{{ old('about_text', $config['about_text']) }}</textarea>
                        @error('about_text')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            
            <!-- Colors -->
            <div class="luxury-card p-6">
                <h2 class="font-display text-lg font-semibold text-primary mb-4">Warna Tema</h2>
                
                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label class="form-label">Primary</label>
                        <div class="flex items-center gap-2">
                            <input type="color" name="primary_color" x-model="primaryColor"
                                   value="{{ old('primary_color', $config['primary_color']) }}"
                                   class="w-12 h-12 rounded-lg cursor-pointer border-0">
                            <input type="text" x-model="primaryColor" class="form-input text-sm" readonly>
                        </div>
                    </div>
                    
                    <div>
                        <label class="form-label">Secondary</label>
                        <div class="flex items-center gap-2">
                            <input type="color" name="secondary_color" x-model="secondaryColor"
                                   value="{{ old('secondary_color', $config['secondary_color']) }}"
                                   class="w-12 h-12 rounded-lg cursor-pointer border-0">
                            <input type="text" x-model="secondaryColor" class="form-input text-sm" readonly>
                        </div>
                    </div>
                    
                    <div>
                        <label class="form-label">Accent</label>
                        <div class="flex items-center gap-2">
                            <input type="color" name="accent_color" x-model="accentColor"
                                   value="{{ old('accent_color', $config['accent_color']) }}"
                                   class="w-12 h-12 rounded-lg cursor-pointer border-0">
                            <input type="text" x-model="accentColor" class="form-input text-sm" readonly>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Images -->
            <div class="luxury-card p-6">
                <h2 class="font-display text-lg font-semibold text-primary mb-4">Gambar</h2>
                
                <div class="space-y-4">
                    <div>
                        <label class="form-label">URL Logo</label>
                        <input type="url" name="logo_url" x-model="logoUrl"
                               value="{{ old('logo_url', $config['logo_url']) }}"
                               placeholder="https://..." class="form-input">
                        @error('logo_url')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="form-label">URL Hero Image</label>
                        <input type="url" name="hero_image_url" x-model="heroImageUrl"
                               value="{{ old('hero_image_url', $config['hero_image_url']) }}"
                               placeholder="https://..." class="form-input">
                        <p class="text-xs text-gray-400 mt-1">Gambar yang ditampilkan di halaman utama</p>
                        @error('hero_image_url')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            
            <!-- Contact Info -->
            <div class="luxury-card p-6">
                <h2 class="font-display text-lg font-semibold text-primary mb-4">Informasi Kontak</h2>
                
                <div class="space-y-4">
                    <div>
                        <label class="form-label">Nomor Telepon</label>
                        <input type="text" name="contact_phone" 
                               value="{{ old('contact_phone', $config['contact_phone']) }}"
                               class="form-input">
                    </div>
                    
                    <div>
                        <label class="form-label">Email</label>
                        <input type="email" name="contact_email" 
                               value="{{ old('contact_email', $config['contact_email']) }}"
                               class="form-input">
                    </div>
                    
                    <div>
                        <label class="form-label">Alamat</label>
                        <input type="text" name="contact_address" 
                               value="{{ old('contact_address', $config['contact_address']) }}"
                               class="form-input">
                    </div>
                    
                    <div>
                        <label class="form-label">WhatsApp</label>
                        <input type="text" name="whatsapp_number" 
                               value="{{ old('whatsapp_number', $config['whatsapp_number']) }}"
                               placeholder="628xxxxxxxxxx" class="form-input">
                    </div>
                    
                    <div>
                        <label class="form-label">URL Instagram</label>
                        <input type="url" name="instagram_url" 
                               value="{{ old('instagram_url', $config['instagram_url']) }}"
                               class="form-input">
                    </div>
                    
                    <div>
                        <label class="form-label">URL Facebook</label>
                        <input type="url" name="facebook_url" 
                               value="{{ old('facebook_url', $config['facebook_url']) }}"
                               class="form-input">
                    </div>
                </div>
            </div>
            
            <!-- Submit Button -->
            <button type="submit" class="w-full btn-secondary text-lg py-4">
                Simpan Perubahan
            </button>
        </div>
        
        <!-- Live Preview Panel -->
        <div class="hidden lg:block">
            <div class="sticky top-24">
                <h2 class="font-display text-lg font-semibold text-primary mb-4">Live Preview</h2>
                
                <div class="luxury-card overflow-hidden" :style="{ '--primary-color': primaryColor, '--secondary-color': secondaryColor, '--accent-color': accentColor }">
                    <!-- Preview Hero -->
                    <div class="relative h-64 bg-cover bg-center" :style="heroImageUrl ? 'background-image: url(' + heroImageUrl + ')' : 'background: linear-gradient(135deg, ' + primaryColor + ', ' + primaryColor + '99)'">
                        <div class="absolute inset-0 bg-gradient-to-b from-black/50 to-black/70"></div>
                        <div class="relative z-10 flex flex-col items-center justify-center h-full text-white text-center p-6">
                            <h3 class="font-display text-2xl font-bold mb-2" x-text="businessName || 'Nama Bisnis'"></h3>
                            <p class="text-sm opacity-80" x-text="tagline || 'Tagline Anda'"></p>
                        </div>
                    </div>
                    
                    <!-- Preview Content -->
                    <div class="p-6" :style="{ backgroundColor: accentColor }">
                        <div class="flex gap-4 mb-4">
                            <div class="w-20 h-20 rounded-lg" :style="{ backgroundColor: primaryColor }"></div>
                            <div class="flex-1">
                                <div class="h-4 rounded w-3/4 mb-2" :style="{ backgroundColor: primaryColor }"></div>
                                <div class="h-4 rounded w-1/2" :style="{ backgroundColor: secondaryColor }"></div>
                            </div>
                        </div>
                        
                        <button class="w-full py-2 rounded-lg text-white text-sm font-medium" :style="{ backgroundColor: secondaryColor }">
                            Contoh Tombol
                        </button>
                    </div>
                </div>
                
                <p class="text-xs text-gray-400 text-center mt-4">Preview akan diperbarui secara realtime</p>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
<script>
    function cmsEditor() {
        return {
            businessName: '{{ old('business_name', $config['business_name']) }}',
            tagline: '{{ old('tagline', $config['tagline']) }}',
            primaryColor: '{{ old('primary_color', $config['primary_color']) }}',
            secondaryColor: '{{ old('secondary_color', $config['secondary_color']) }}',
            accentColor: '{{ old('accent_color', $config['accent_color']) }}',
            logoUrl: '{{ old('logo_url', $config['logo_url']) }}',
            heroImageUrl: '{{ old('hero_image_url', $config['hero_image_url']) }}',
        }
    }
</script>
@endpush
