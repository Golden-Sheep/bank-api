<?php

namespace App\Services\API\ManagerTransaction;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;

/**
 * Class ManagerTransactionService
 *
 * @author Joao Victor <dev.jvictor@gmail.com>
 */
class ManagerTransactionService implements ManagerTransactionServiceInterface
{
    private string $url;

    public function __construct(
    ) {
        $this->url = env('ENDPOINT_MANAGER_TRANSACTION');
    }

    public function getTransactionAuthorization(): bool
    {
        $url = sprintf(
            '%s/v3/5794d450-d2e2-4412-8131-73d0293ac1cc',
            $this->url
        );
        $response = Http::get($url);

        return $response->status() == 200 ? true : false;
    }

    public function sendTransactionSuccessNotification(): bool
    {
        $url = sprintf(
            '%s/v3/54dc2cf1-3add-45b5-b5a9-6bf7e7f1f4a6',
            $this->url
        );
        $response = Http::get($url);

        if ($response->status() != 200) {
            try {

                Queue::connection('sqs')->pushRaw((string) json_encode([]), 'SQS_QUEUE_NAME');
            } catch (\Exception $e) {
                Log::warning("Failed to enqueue message after unsuccessful HTTP request. URL: {$url}, HTTP Status: {$response->status()}, Exception: {$e->getMessage()}");
            }
        }

        return true;
    }
}
