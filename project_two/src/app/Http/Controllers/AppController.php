<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class AppController extends Controller
{
    public function listCars () {
        $cars = [
            ["name" => "Audi A8"],
            ["name" => "Audi S8"],
            ["name" => "Audi RS7"],
            ["name" => "Audi Q7"],
            ["name" => "BMW 7 Series"],
            ["name" => "BMW X7"],
            ["name" => "BMW M760i"],
            ["name" => "BMW i8"],
            ["name" => "Mercedes-Benz S-Class"],
            ["name" => "Mercedes-Benz E-Class"],
            ["name" => "Mercedes-Benz GLE"],
            ["name" => "Mercedes-Benz AMG GT"],
            ["name" => "Lexus LS"],
            ["name" => "Lexus LC"],
            ["name" => "Lexus LX"],
            ["name" => "Lexus RX"],
            ["name" => "Jaguar XJ"],
            ["name" => "Jaguar XF"],
            ["name" => "Jaguar F-Type"],
            ["name" => "Jaguar I-PACE (electric luxury SUV)"],
            ["name" => "Range Rover"],
            ["name" => "Range Rover Sport"],
            ["name" => "Range Rover Velar"],
            ["name" => "Porsche Panamera"],
            ["name" => "Porsche Cayenne"],
            ["name" => "Porsche 911"],
            ["name" => "Tesla Model S"],
            ["name" => "Tesla Model X"],
            ["name" => "Tesla Model 3"],
            ["name" => "Rolls-Royce Ghost"],
            ["name" => "Rolls-Royce Phantom"],
            ["name" => "Rolls-Royce Cullinan"],
            ["name" => "Bentley Continental GT"],
            ["name" => "Bentley Flying Spur"],
            ["name" => "Bentley Bentayga"],
            ["name" => "Maserati Quattroporte"],
            ["name" => "Maserati Ghibli"],
            ["name" => "Maserati Levante"],
            ["name" => "Aston Martin DB11"],
            ["name" => "Aston Martin Vantage"],
            ["name" => "Aston Martin DBS Superleggera"],
            ["name" => "Lamborghini Urus (luxury SUV)"],
            ["name" => "Lamborghini Huracan"],
            ["name" => "Lamborghini Aventador"],
            ["name" => "Ferrari Portofino"],
            ["name" => "Ferrari 812 Superfast"],
            ["name" => "Ferrari SF90 Stradale"],
            ["name" => "Bugatti Chiron"],
            ["name" => "Bugatti Divo"]
        ];
        return response()->json($cars);
    }
    public function getListOfMotosFromLaravelProjectOne () {
        $response = Http::withHeaders([
            "Accept" => "application/json"
        ])->get(config("services.project_one.request_host") . "/api/list-motos");
        return  $response->json();
    }
}
