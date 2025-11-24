<?php

namespace App\Livewire;

use App\Models\Aluno;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class AlunoTable extends PowerGridComponent
{
    public string $tableName = 'alunoTable';

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::header()
                ->showSearchInput(),
                
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),

            PowerGrid::responsive()
                ->fixedColumns('id', 'alun_nome', 'matricula', 'actions'),
        ];
    }

    public function datasource(): Builder
    {
        return Aluno::query()->with(['matriculas' => function($query) {
            $query->where('status', 'ativa');
        }]);
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('alun_nome')
            ->add('alun_email')
            ->add('alun_data_nascimento_formatted', fn (Aluno $model) => Carbon::parse($model->alun_data_nascimento)->format('d/m/Y'))
            ->add('alun_telefone')
            ->add('alun_cpf')
            ->add('alun_endereco')
            ->add('alun_sexo')
            ->add('status')
            ->add('matricula', fn (Aluno $model) => 
                $model->matriculas->first() ? $model->matriculas->first()->codigo_matricula : 'Sem matrícula'
            );
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            
            Column::make('Matrícula', 'matricula')
                ->sortable()
                ->searchable(),

            Column::make('Nome', 'alun_nome')
                ->sortable()
                ->searchable(),

            Column::make('Email', 'alun_email')
                ->sortable()
                ->searchable(),

            Column::make('Data de nascimento', 'alun_data_nascimento_formatted', 'alun_data_nascimento')
                ->sortable(),

            Column::make('Telefone', 'alun_telefone')
                ->sortable()
                ->searchable(),

            Column::make('CPF', 'alun_cpf')
                ->sortable()
                ->searchable(),

            Column::make('Endereço', 'alun_endereco')
                ->sortable()
                ->searchable(),

            Column::make('Sexo', 'alun_sexo')
                ->sortable()
                ->searchable(),

            Column::make('Status', 'status')
                ->sortable()
                ->searchable(),

            Column::make('Criado em', 'created_at')
                ->sortable(),

            Column::action('Ações')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datepicker('alun_data_nascimento'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    #[\Livewire\Attributes\On('delete')]
    public function delete($rowId): void
    {
        $aluno = Aluno::find($rowId);
        
        if ($aluno) {
            // Verifica se o aluno tem matrículas ativas antes de deletar
            if ($aluno->matriculas()->where('status', 'ativa')->exists()) {
                $this->js("alert('Não é possível excluir este aluno pois ele possui matrículas ativas!')");
                return;
            }
            
            $aluno->delete();
            $this->js("alert('Aluno deletado com sucesso!')");
            
            // Atualiza a tabela após a exclusão
            $this->fillData();
        }
    }

    public function actions(Aluno $row): array
    {
        return [
            Button::add('edit')
                ->slot('Editar')
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700 mr-2')
                ->dispatch('edit', ['rowId' => $row->id]),
                
            Button::add('delete')
                ->slot('Deletar')
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('delete', ['rowId' => $row->id])
        ];
    }
}