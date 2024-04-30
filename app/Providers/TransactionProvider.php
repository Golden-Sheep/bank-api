<?php

namespace App\Providers;

use App\Repositories\Adapters\Eloquent\Transaction\TransactionRepositoryAdapter;
use App\Repositories\Adapters\Eloquent\Transaction\TransactionRepositoryAdapterFactory;
use App\Repositories\Transaction\TransactionRepositoryFactory;
use App\Repositories\Transaction\TransactionRepositoryInterface;
use App\Services\API\ManagerTransaction\ManagerTransactionServiceFactory;
use App\Services\API\ManagerTransaction\ManagerTransactionServiceInterface;
use App\Services\Transaction\TransactionServiceFactory;
use App\Services\Transaction\TransactionServiceInterface;
use Illuminate\Support\ServiceProvider;

/**
 * Class TransactionProvider
 *
 * @author Joao Victor S <dev.jvictor@gmail.com>
 */
class TransactionProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            TransactionServiceInterface::class,
            function () {
                return (new TransactionServiceFactory())();
            }
        );

        $this->app->bind(TransactionRepositoryInterface::class, function () {
            return (new TransactionRepositoryFactory())();
        });

        $this->app->bind(TransactionRepositoryAdapter::class, function () {
            return (new TransactionRepositoryAdapterFactory())();
        });

        $this->app->bind(
            ManagerTransactionServiceInterface::class,
            function () {
                return (new ManagerTransactionServiceFactory())();
            }
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
