<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class WeatherPublic extends Component
{
    public string $city = '';
    public ?array $weather = null;
    public ?string $error = null;
    public bool $loading = false;
    public ?string $weatherText = null;
    public ?string $weatherIcon = null;
    public array $suggestions = [];
    public array $favorites = [];
    public ?string $lastUpdated = null;
    public ?array $forecast = null;
    public bool $isFetching = false;

    // AUTO REFRESH setiap 5 menit (opsional)
    protected $listeners = ['refreshWeather' => 'getWeather'];

    public function mount()
    {
        $this->favorites = session('favorites', []);
        $this->city = session('last_city', '');
        if($this->city) $this->getWeather();
    }

    // Live search
    public function updatedCity()
    {
        $this->error = null;

        if (strlen($this->city) < 3) {
            $this->suggestions = [];
            return;
        }

        $res = Http::withHeaders([
            'User-Agent' => 'LaravelWeatherApp/1.0'
        ])->get('https://nominatim.openstreetmap.org/search', [
            'q' => $this->city,
            'format' => 'json',
            'limit' => 5
        ]);

        if ($res->successful()) {
            $this->suggestions = collect($res->json())->pluck('display_name')->toArray();
        }
    }

    public function selectSuggestion(string $city)
    {
        $this->city = $city;
        $this->suggestions = [];
        $this->getWeather();
    }

    public function addFavorite()
    {
        if ($this->city && !in_array($this->city, $this->favorites)) {
            $this->favorites[] = $this->city;
            session(['favorites' => $this->favorites]);
        }
    }

    public function removeFavorite(string $city)
    {
        $this->favorites = array_filter($this->favorites, fn($c) => $c !== $city);
        session(['favorites' => $this->favorites]);
    }

    public function selectFavorite(string $city)
    {
        $this->city = $city;
        $this->getWeather();
    }

    public function getWeather()
    {
        $this->isFetching = true;
        
        if (trim($this->city) === '') {
            $this->error = 'Silakan masukkan nama daerah';
            return;
        }

        $this->loading = true;
        $this->error = null;
        $this->weather = null;
        $this->forecast = null;
        $this->suggestions = [];

        session(['last_city' => $this->city]);

        // 1️⃣ Geocoding OpenStreetMap
        $geo = Http::withHeaders([
            'User-Agent' => 'LaravelWeatherApp/1.0'
        ])->get('https://nominatim.openstreetmap.org/search', [
            'q' => $this->city,
            'format' => 'json',
            'limit' => 1
        ]);

        if (!$geo->successful() || empty($geo->json())) {
            $this->error = 'Daerah tidak ditemukan';
            $this->loading = false;
            return;
        }

        $lat = $geo->json()[0]['lat'];
        $lon = $geo->json()[0]['lon'];

        // 2️⃣ Ambil cuaca dari Open-Meteo
        $weather = Http::get('https://api.open-meteo.com/v1/forecast', [
            'latitude' => $lat,
            'longitude' => $lon,
            'current_weather' => true,
            'daily' => 'temperature_2m_max,temperature_2m_min',
            'timezone' => 'Asia/Jakarta'
        ]);

        if (!$weather->successful()) {
            $this->error = 'Gagal mengambil data cuaca';
            $this->loading = false;
            return;
        }

        $this->weather = $weather->json()['current_weather'];
        $this->forecast = $weather->json()['daily'] ?? null;
        $this->lastUpdated = Carbon::now()->format('H:i');

        [$this->weatherText, $this->weatherIcon] = $this->mapWeatherCode($this->weather['weathercode']);

        $this->loading = false;

        $this->isFetching = false;
    }


    private function mapWeatherCode(int $code): array
    {
        return match (true) {
            $code === 0 => ['Cerah', '☀️'],
            in_array($code, [1, 2]) => ['Cerah Berawan', '🌤'],
            $code === 3 => ['Berawan', '☁️'],
            in_array($code, [45, 48]) => ['Berkabut', '🌫'],
            in_array($code, [51, 53, 55]) => ['Gerimis', '🌦'],
            in_array($code, [61, 63, 65]) => ['Hujan', '🌧'],
            in_array($code, [71, 73, 75]) => ['Salju', '❄️'],
            in_array($code, [95, 96, 99]) => ['Badai', '⛈'],
            default => ['Tidak diketahui', '❓'],
        };
    }

    public function render()
    {
        return view('livewire.weather-public');
    }
}