<?php

namespace App\Livewire;

use App\Models\Reclamacao;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class ReclamacaoTable extends PowerGridComponent
{
    public string $tableName = 'reclamacaoTable';

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Reclamacao::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('assunto')
            ->add('descricao')
            ->add('status')
            ->add('data_reclamacao')
            ->add('data_resolucao')
            ->add('prioridade')
            ->add('user_id')
            ->add('matricula_id')
            ->add('escola_id')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Assunto', 'assunto')
                ->sortable()
                ->searchable(),

            Column::make('Descricao', 'descricao')
                ->sortable()
                ->searchable(),

            Column::make('Status', 'status')
                ->sortable()
                ->searchable(),

            Column::make('Data reclamacao', 'data_reclamacao_formatted', 'data_reclamacao')
                ->sortable(),

            Column::make('Data reclamacao', 'data_reclamacao')
                ->sortable()
                ->searchable(),

            Column::make('Data resolucao', 'data_resolucao_formatted', 'data_resolucao')
                ->sortable(),

            Column::make('Data resolucao', 'data_resolucao')
                ->sortable()
                ->searchable(),

            Column::make('Prioridade', 'prioridade')
                ->sortable()
                ->searchable(),

            Column::make('User id', 'user_id'),
            Column::make('Matricula id', 'matricula_id'),
            Column::make('Escola id', 'escola_id'),
            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable(),

            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    public function actions(Reclamacao $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit: '.$row->id)
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('edit', ['rowId' => $row->id])
        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
