<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;
use App\Models\Company;

class ParseHtmlData extends Command
{
    protected $signature = 'parse:htmlfile {file}';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $file = $this->argument('file');
        $html = file_get_contents($file);

        $crawler = new Crawler($html);

        $companies = $crawler->filter('tr')->each(function (Crawler $companyNode) {
            $companyData = $companyNode->filter('td')->each(function (Crawler $dataNode) {
                return trim($dataNode->text());
            });

            $logoNode = $companyNode->filter('td img')->first();
            $logoUrl = null;

            if ($logoNode->count() > 0) {
                $logoUrl = $logoNode->attr('src');
            }

            if (count($companyData) !== 18) {
                return null;
            }

                // Create a new Company instance and fill it with the data
            $company = new Company([
                'company_id'=> $companyData[1],
                'logo' => $logoUrl,
                'name' => $companyData[3],
                'city' => $companyData[4],
                'country' => $companyData[5],
                'webmail' => $companyData[6],
                'email' => $companyData[7],
                'employees' => $companyData[8],
                'funding_state' => $companyData[9],
                'industry' => $companyData[10],
                'technology' => $companyData[11],
                'trl' => $companyData[12],
                'business_model' => $companyData[13],
                'revenue_model' => $companyData[14],
                'funding_sources' => $companyData[15],
                'total_funding' => $companyData[16],
                'executive_summary' => $companyData[17],
            ]);

            $company->save();

            return $company;
        });

        // Filter out any null entries
        $companies = array_filter($companies);

        $this->info(count($companies) . ' companies imported from ' . $file);
    }
}
