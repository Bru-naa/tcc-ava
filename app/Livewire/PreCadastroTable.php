<?php

namespace App\Livewire;

use App\Models\PreRegistro;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

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
        return PreRegistro::query();
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
            ->add('data_nascimento_formatted', fn (PreRegistro $model) => Carbon::parse($model->data_nascimento)->format('d/m/Y'))
            ->add('cpf_masked',fn (PreRegistro $model) => '***.***.***-' . substr($model->cpf, -4))

            ->add('email_pessoal')
            ->add('email_institucional')
            ->add('escola_id')
            ->add('role_id')
            ->add('criado_por')
            ->add('status')
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

            Column::make('CPF(últimos digitos)', 'cpf_masked')
                ->sortable()
                ->searchable(),

            Column::make('Email pessoal', 'email_pessoal')
                ->sortable()
                ->searchable(),

            Column::make('Email institucional', 'email_institucional')
                ->sortable()
                ->searchable(),

            Column::make('Escola id', 'escola_id'),
            Column::make('Role id', 'role_id'),
            Column::make('Criado por', 'criado_por')
                ->sortable()
                ->searchable(),

            Column::make('Status', 'status')
                ->sortable()
                ->searchable(),

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
            Filter::datepicker('data_nascimento'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    public function actions(PreRegistro $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit: '.$row->id)
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('edit', ['rowId' => $row->id])
        ];
    }

    
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
   
}
