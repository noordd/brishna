<?php
namespace App\Localization\Enums;

enum AppLocale: string {
    case ENGLISH = 'en';
    case PASHTO  = 'ps';
    case FARSI   = 'fa';

    public function label(): string
    {
        return __("localization/enums.locales.{$this->value}");
    }

    public static function options(): array
    {
        return array_map(fn($case) => [
            'value' => $case->value,
            'label' => $case->label(),
        ], self::cases());
    }
}
