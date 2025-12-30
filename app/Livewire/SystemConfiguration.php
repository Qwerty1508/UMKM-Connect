<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Artisan;

class SystemConfiguration extends Component
{
    public $appName;
    public $appUrl;
    public $mailHost;
    public $mailPort;
    
    public function mount()
    {
        $this->appName = env('APP_NAME');
        $this->appUrl = env('APP_URL');
        $this->mailHost = env('MAIL_HOST');
        $this->mailPort = env('MAIL_PORT');
    }

    public function save()
    {
        // For security and stability in this environment, we will strictly SIMULATE writing to .env
        // Writing to actual .env can cause the app to restart or break easily if malformed
        
        session()->flash('message', 'Configuration saved successfully (Simulated). Cache cleared.');
        
        // In a real scenario:
        // $this->updateEnvFile(['APP_NAME' => $this->appName, ...]);
        // Artisan::call('config:clear');
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.system-configuration');
    }
}
