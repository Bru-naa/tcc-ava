<?php

namespace App\Livewire;

use App\Models\Curso;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class CursoTable extends PowerGridComponent
{
    use WithExport;

    public string $tableName = 'cursoTable';

    public function setUp(): array
    {
        return [
            PowerGrid::header()->showSearchInput(),
            PowerGrid::footer()->showPerPage()->showRecordCount(),
            PowerGrid::responsive()->fixedColumns('id', 'nome_curso', 'sigla', 'actions'),
        ];
    }

    public function datasource(): Builder
    {
        $escolaId = Auth::user()?->escola_id;

        return Curso::query()
            ->with('escola')
            ->when($escolaId, fn (Builder $query, int $id) => $query->daEscola($id));
    }

    public function relationSearch(): array
    {
        return [
            'escola' => ['esc_nome'],
        ];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('nome_curso')
            ->add('sigla')
            ->add('ultimo_numero')
            ->add('descricao_curso')
            ->add('duracao_curso')
            ->add('duracao_formatada', fn (Curso $model) => $model->duracao_formatada)
            ->add('nivel_curso')
            ->add('area_curso')
            ->add('ativo')
            ->add('esc_nome', fn (Curso $model) => $model->escola->esc_nome ?? 'N/A')
            ->add('created_at_formatted', fn (Curso $model) => $model->created_at
                ? Carbon::parse($model->created_at)->format('d/m/Y')
                : '-'
            );
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id'),
            Column::make('Nome do Curso', 'nome_curso')->sortable()->searchable(),
            Column::make('Sigla', 'sigla')->sortable()->searchable(),
            Column::make('Última Matrícula', 'ultimo_numero')->sortable(),
            Column::make('Duração', 'duracao_formatada')->sortable(),
            Column::make('Nível', 'nivel_curso')->sortable()->searchable(),
            Column::make('Área', 'area_curso')->sortable()->searchable(),
            Column::make('Escola', 'esc_nome')->sortable()->searchable(),
            Column::make('Ativo', 'ativo')->toggleable(),
            Column::make('Criado em', 'created_at_formatted', 'created_at')->sortable(),
            Column::action('Ações'),
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('nome_curso')->operators(['contains']),
            Filter::inputText('sigla')->operators(['contains']),
            Filter::inputText('area_curso')->operators(['contains']),
            Filter::boolean('ativo'),
        ];
    }

    #[\Livewire\Attributes\On('delete')]
    public function delete($rowId): void
    {
        $escolaId = Auth::user()?->escola_id;

        $curso = Curso::when($escolaId, fn (Builder $q, int $id) => $q->daEscola($id))
            ->find($rowId);

        if ($curso) {
            $curso->delete();
            $this->dispatch('pg:eventRefresh-default');
        }
    }

    public function actions(Curso $row): array
    {
        return [
            Button::add('edit')
                ->slot('✏️')
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700 px-2 py-1 text-sm')
                ->dispatch('openEditModal', ['cursoId' => $row->id]),

            Button::add('delete')
                ->slot('🗑️')
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700 px-2 py-1 text-sm bg-red-600 hover:bg-red-700 text-white')
                ->dispatch('delete', ['rowId' => $row->id]),
        ];
    }
}