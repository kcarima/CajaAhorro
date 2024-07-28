<?php

namespace App\Actions\Console;

use App\Models\SCA\ConversionMonetaria;
use App\Repositories\SCA\TasaDolarRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;

final readonly class ActualizarDolarAction {

    public function __construct(
        public TasaDolarRepository $repo
    ) { }

    public function handle()
    {
        $this->actualizarTasa($this->getTasa());
    }

    private function getTasa() : string {

        $html = file_get_contents($this->repo->getPaginaReferencia());
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($html);
        libxml_use_internal_errors(true);
        $xpath = new \DOMXPath($dom);
        $strong = $xpath->query($this->repo->getXPATHReferencia());

        return trim($strong->item(0)->textContent);
    }

    private function actualizarTasa(string $tasa) {

        $monedaPrincipal = $this->repo->getMonedaPrincipalId();
        $monedaSecundaria = $this->repo->getMonedaSecundariaId();

        $conversion = ConversionMonetaria::where(function ($query) use ($monedaPrincipal, $monedaSecundaria) {
            $query
                ->where('moneda_principal_id', '=', $monedaPrincipal)
                ->where('moneda_secundaria_id', '=', $monedaSecundaria);
        })->first();

        $conversion->fill([
            'cantidad_moneda_secundaria' => str_replace(',', '.', $tasa),
            'fecha_actualizacion' => Carbon::now()->format('Y-m-d'),
        ]);

        $conversion->save();
    }

}
