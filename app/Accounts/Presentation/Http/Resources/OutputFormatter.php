<?php

namespace App\Accounts\Presentation\Http\Resources;

use Illuminate\Http\JsonResponse;

interface OutputFormatter
{
    public function format(Output $output): JsonResponse;
}

