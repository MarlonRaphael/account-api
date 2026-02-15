<?php

namespace App\Accounts\Presentation\Http\Controllers;

use App\Accounts\Application\Processors\EventProcessor;
use App\Accounts\Domain\Exceptions\NonExistingAccountException;
use App\Accounts\Presentation\Http\Requests\HandleEventRequest;
use App\Accounts\Presentation\Http\Resources\FormatterRegistry;
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

