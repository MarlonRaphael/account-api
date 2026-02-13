<?php

namespace App\Presentation\Account\Http\Resources;

use Illuminate\Http\JsonResponse;

interface OutputFormatter
{
    public function format(Output $output): JsonResponse;
}

