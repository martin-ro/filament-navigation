<?php

namespace RyanChandler\FilamentNavigation\Filament\Resources\NavigationResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use RyanChandler\FilamentNavigation\Filament\Resources\NavigationResource\Pages\Concerns\HandlesNavigationBuilder;
use RyanChandler\FilamentNavigation\FilamentNavigation;

class CreateNavigation extends CreateRecord
{
    use CreateRecord\Concerns\Translatable, HandlesNavigationBuilder;

    public static function getResource(): string
    {
        return FilamentNavigation::get()->getResource();
    }

    //    protected function getHeaderActions(): array
    //    {
    //        return [
    //            // Actions\LocaleSwitcher::make(),
    //            // ...
    //        ];
    //    }
}
