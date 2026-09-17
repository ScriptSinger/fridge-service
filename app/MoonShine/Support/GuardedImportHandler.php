<?php

declare(strict_types=1);

namespace App\MoonShine\Support;

use MoonShine\Contracts\UI\ActionButtonContract;
use MoonShine\Contracts\UI\FormBuilderContract;
use MoonShine\ImportExport\ImportHandler;
use MoonShine\Support\Enums\ToastType;
use MoonShine\UI\Components\ActionButton;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\UI\Components\Heading;
use MoonShine\UI\Exceptions\ActionButtonException;
use MoonShine\UI\Fields\Checkbox;
use MoonShine\UI\Fields\File;
use Symfony\Component\HttpFoundation\Response;

/**
 * Import is destructive by ID (upsert) and has no undo. In production this
 * requires an explicit "yes, I mean it" checkbox, checked both client-side
 * (required attribute) and server-side (handle()) so it can't be bypassed
 * by submitting the form without JS.
 */
class GuardedImportHandler extends ImportHandler
{
    private const CONFIRM_FIELD = 'confirm_production_import';

    public function handle(): Response
    {
        if (app()->isProduction() && ! request()->boolean(self::CONFIRM_FIELD)) {
            toast(
                'Импорт в PRODUCTION не выполнен: не подтверждено флажком «Это действие затронет боевые данные».',
                ToastType::ERROR
            );

            return back();
        }

        return parent::handle();
    }

    /**
     * @throws ActionButtonException
     */
    public function getButton(): ActionButtonContract
    {
        if (! $this->hasResource()) {
            throw ActionButtonException::resourceRequired();
        }

        $isProduction = app()->isProduction();

        return $this->prepareButton(
            ActionButton::make($this->getLabel())
                ->when($isProduction, fn (ActionButton $btn) => $btn->error())
                ->when(! $isProduction, fn (ActionButton $btn) => $btn->success())
                ->icon(
                    $isProduction ? 'exclamation-triangle' : $this->getIconValue(),
                    $isProduction ? false : $this->isCustomIcon(),
                    $isProduction ? null : $this->getIconPath()
                )
                ->inOffCanvas(
                    fn (): string => $isProduction
                        ? '⚠️ ' . $this->getLabel() . ' — PRODUCTION'
                        : $this->getLabel(),
                    fn (): FormBuilderContract => FormBuilder::make($this->getUrl())->fields(array_filter([
                        $isProduction
                            ? Heading::make(
                                'Это боевая база данных. Импорт создаст/перезапишет записи по ID — действие необратимо.'
                            )
                            : null,
                        File::make(column: $this->getInputName())->required(),
                        $isProduction
                            ? Checkbox::make(
                                'Понимаю, что это PRODUCTION, и подтверждаю импорт',
                                self::CONFIRM_FIELD
                            )->required()
                            : null,
                    ]))
                        ->class('js-change-query')
                        ->customAttributes([
                            'data-original-url' => $this->getUrl(),
                        ])
                        ->submit(__('moonshine::ui.confirm')),
                    name: 'import-off-canvas'
                )
        );
    }
}
