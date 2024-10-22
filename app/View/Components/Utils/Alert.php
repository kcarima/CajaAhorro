<?php

namespace App\View\Components\Utils;

use Illuminate\View\Component;

final class Alert extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public readonly ?string $message = null, public readonly ?string $type = null)
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.utils.alert');
    }

    public function backgroundCSS()
    {
        return match ($this->type) {
            'error' => 'bg-alert-error',
            'success' => 'bg-alert-success',
            'warning' => 'bg-alert-warning',
            default => 'bg-alert-unknown'
        };
    }
}
