<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Leads extends Component
{
    /**
     * Create a new component instance.
     */
    public $model;
    public $payload;

    public function __construct($model = null, array $payload = [])
    {
        $this->model = $model;

        // если модель есть, формируем leadable_type и leadable_id
        $this->payload = array_merge($payload, [
            'leadable_type' => $model ? get_class($model) : null,
            'leadable_id' => $model ? $model->id : null,
        ]);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view(
            'components.ui.forms.leads',
            [
                'payload' => $this->payload,
            ]

        );
    }
}
