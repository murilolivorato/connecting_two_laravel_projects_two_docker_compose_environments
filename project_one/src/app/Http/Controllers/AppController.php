<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class AppController extends Controller
{
    public function listMotos () {
        $motos = [
            ["name" => "Ducati Panigale V4"],
            ["name" => "Ducati Diavel"],
            ["name" => "Ducati Multistrada V4"],
            ["name" => "BMW K 1600 GTL"],
            ["name" => "BMW S 1000 RR"],
            ["name" => "BMW R 1250 GS Adventure"],
            ["name" => "Harley-Davidson CVO Limited"],
            ["name" => "Harley-Davidson Street Glide CVO"],
            ["name" => "Harley-Davidson Road Glide CVO"],
            ["name" => "Indian Roadmaster Elite"],
            ["name" => "Indian Chieftain Limited"],
            ["name" => "Indian Challenger Limited"],
            ["name" => "Triumph Rocket 3 R"],
            ["name" => "Triumph Speed Triple 1200 RS"],
            ["name" => "Triumph Tiger 1200 Alpine Edition"],
            ["name" => "MV Agusta F4 Claudio"],
            ["name" => "MV Agusta Brutale 1000 Serie Oro"],
            ["name" => "Aprilia RSV4 1100 Factory"],
            ["name" => "Aprilia Tuono V4 1100 Factory"],
            ["name" => "KTM 1290 Super Duke R"],
            ["name" => "KTM 1290 Super Adventure R"],
            ["name" => "Moto Guzzi MGX-21"],
            ["name" => "Moto Guzzi California Touring 1400"],
            ["name" => "Arch Method 143"],
            ["name" => "Arch 1s"],
            ["name" => "Brough Superior SS100"],
            ["name" => "Norton V4 RR"]
        ];
        return response()->json($motos);
    }
    public function getListOfCarsFromLaravelProjectTwo () {
        $response = Http::withHeaders([
            "Accept" => "application/json"
        ])->get(config("services.project_two.request_host") . "/api/list-cars");
        return  $response->json();
    }
}
