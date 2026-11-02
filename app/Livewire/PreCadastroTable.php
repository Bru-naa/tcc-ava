<?php

namespace App\Livewire;

use App\Models\PreCadastro;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\Facades\Rule;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridFields;

final class PreCadastroTable extends PowerGridComponent
{
    public string $tableName = 'preCadastroTable';

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
        $escolaId = Auth::user()?->escola_id;

        return PreCadastro::query()
            ->with(['escola', 'role'])
            ->when($escolaId, fn (Builder $query, int $id) => $query->daEscola($id));
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('nome')
            ->add('telefone')
            ->add('data_nascimento_formatted', fn (PreCadastro $model) => $model->data_nascimento
                ? Carbon::parse($model->data_nascimento)->format('d/m/Y')
                : '-')
            ->add('cpf_masked', fn (PreCadastro $model) => '***.***.***-' . substr((string) $model->cpf, -4))
            ->add('email_pessoal')
            ->add('email_institucional')
            ->add('escola_id', fn (PreCadastro $model) => $model->escola?->nome ?? $model->escola_id)
            ->add('role_id', fn (PreCadastro $model) => $model->role?->nome ?? $model->role_id)
            ->add('criado_por')
            ->add('status')
            ->add('created_at_formatted', fn (PreCadastro $model) => $model->created_at
                ? Carbon::parse($model->created_at)->format('d/m/Y H:i')
                : '-')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Nome', 'nome')
                ->sortable()
                ->searchable(),

            Column::make('Telefone', 'telefone')
                ->sortable()
                ->searchable(),

            Column::make('Data nascimento', 'data_nascimento_formatted', 'data_nascimento')
                ->sortable(),

            Column::make('CPF(últimos dígitos)', 'cpf_masked')
                ->sortable()
                ->searchable(),

            Column::make('Email pessoal', 'email_pessoal')
                ->sortable()
                ->searchable(),

            Column::make('Email institucional', 'email_institucional')
                ->sortable()
                ->searchable(),

            Column::make('Escola', 'escola_id'),
            Column::make('Perfil', 'role_id'),
            Column::make('Criado por', 'criado_por')
                ->sortable()
                ->searchable(),

            Column::make('Status', 'status')
                ->sortable()
                ->searchable(),

            Column::make('Criado em', 'created_at_formatted', 'created_at')
                ->sortable(),

            Column::action('Action'),
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datepicker('data_nascimento'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert(' . (int) $rowId . ')');
    }

    public function actions(PreCadastro $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit: ' . $row->id)
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('edit', ['rowId' => $row->id]),
        ];
    }

    public function actionRules($row): array
    {
        return [
            Rule::button('edit')
                ->when(fn ($row) => $row->id === 1)
                ->hide(),
        ];
    }
}