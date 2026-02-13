<?php

namespace App\Presentation\Account\Http\Controllers;

use App\Application\Accounts\Processors\EventProcessor;
use App\Domain\Accounts\Exceptions\NonExistingAccountException;
use App\Presentation\Account\Http\Resources\FormatterRegistry;
use App\Presentation\Account\Http\Requests\HandleEventRequest;
use Illuminate\Http\JsonResponse;
use Throwable;

class EventController extends Controller
{
    public function __construct(
        private readonly EventProcessor $processor,
        private readonly FormatterRegistry $formatterRegistry,
    ) {}

    public function handle(HandleEventRequest $request): JsonResponse
    {
        try {
            $output = $this->processor->process($request->validated());
            $formatter = $this->formatterRegistry->getFormatter($output);

            return $formatter->format($output);
        } catch (NonExistingAccountException $exception) {
            logger()->error($exception->getTraceAsString());
            return $this->respondNotFound();
        } catch (Throwable $exception) {
            logger()->error($exception->getTraceAsString());
            return $this->respondNotFound();
        }
    }
}

