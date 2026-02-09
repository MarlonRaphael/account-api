<?php

namespace App\Infraestructure\Http\Formatters;

use App\Infraestructure\DTO\Output;
use Illuminate\Http\JsonResponse;

interface OutputFormatter
{
    public function format(Output $output): JsonResponse;
}
