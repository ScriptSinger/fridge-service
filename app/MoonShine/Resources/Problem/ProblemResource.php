<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Problem;

use Illuminate\Database\Eloquent\Model;
use App\Models\Problem;
use App\MoonShine\Resources\Problem\Pages\ProblemIndexPage;
use App\MoonShine\Resources\Problem\Pages\ProblemFormPage;
use App\MoonShine\Resources\Problem\Pages\ProblemDetailPage;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;

use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;


/**
 * @extends ModelResource<Problem, ProblemIndexPage, ProblemFormPage, ProblemDetailPage>
 */
class ProblemResource extends ModelResource
{
    protected string $model = Problem::class;

    protected string $title = 'Problems';

    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Slug', 'slug'),
            Text::make('Title', 'title'),
            Text::make('H1', 'h1'),
            Textarea::make('Content', 'content'),
        ];
    }

    protected function formFields(): iterable
    {
        return [
            Box::make([
                ID::make()->readonly(),

                Text::make('Slug', 'slug')
                    ->readonly()
                    ->hint('Генерируется автоматически'),

                Text::make('Title', 'title')
                    ->required(),

                Text::make('H1', 'h1')
                    ->required(),

                Textarea::make('Content', 'content')
            ]),
        ];
    }

    protected function detailFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Slug', 'slug'),
            Text::make('Title', 'title'),
            Text::make('H1', 'h1'),
            Textarea::make('Content', 'content'),
        ];
    }

    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            ProblemIndexPage::class,
            ProblemFormPage::class,
            ProblemDetailPage::class,
        ];
    }
}
