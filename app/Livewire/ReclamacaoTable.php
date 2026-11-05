<?php

namespace App\Livewire;

use App\Models\Reclamacao;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridFields;

final class ReclamacaoTable extends PowerGridComponent
{
    public string $tableName = 'reclamacaoTable';

    /**
     * Escopo de listagem: 'meus_cursos' (padrão para Coordenador) ou 'geral' (toda a escola).
     */
    public string $escopo = 'geral';

    #[On('alterar-escopo-reclamacoes')]
    public function alterarEscopo(string $escopo): void
    {
        if (in_array($escopo, ['meus_cursos', 'geral'], true)) {
            $this->escopo = $escopo;
            $this->resetPage();
        }
    }

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
        $user = Auth::user();
        $escolaId = $user?->escola_id;

        return Reclamacao::query()
            ->with(['matricula.curso', 'user'])
            ->when(
                $escolaId !== null,
                fn (Builder $query): Builder => $query->where('reclamacoes.escola_id', (int) $escolaId)
            )
            ->when(
                $this->escopo === 'meus_cursos' && $user?->possuiPerfil('coordenador'),
                function (Builder $query) use ($user): Builder {
                    $cursoIds = $user->cursosCoordenados()->pluck('cursos.id')->all();

                    return $query->whereHas(
                        'matricula',
                        fn (Builder $q): Builder => $q->whereIn('curso_id', $cursoIds)
                    );
                }
            );
    }

    public function relationSearch(): array
    {
        return [
            'matricula.curso' => [
                'nome_curso',
                'sigla',
            ],
        ];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('curso_nome', fn (Reclamacao $model) => $model->matricula?->curso
                ? $model->matricula->curso->sigla . ' - ' . $model->matricula->curso->nome_curso
                : 'N/A')
            ->add('assunto')
            ->add('descricao')
            ->add('prioridade_badge', function (Reclamacao $model) {
                $colors = [
                    'alta' => 'bg-red-100 text-red-800 dark:bg-red-900/40 dark:text-red-300',
                    'media' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/40 dark:text-yellow-300',
                    'baixa' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-300',
                ];
                $cls = $colors[$model->prioridade] ?? $colors['media'];

                return '<span class="px-2.5 py-0.5 rounded-full text-xs font-medium ' . $cls . '">' . ucfirst((string) $model->prioridade) . '</span>';
            })
            ->add('status_badge', function (Reclamacao $model) {
                $isResolvida = $model->status === 'resolvida';
                $cls = $isResolvida
                    ? 'bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-300'
                    : 'bg-amber-100 text-amber-800 dark:bg-amber-900/40 dark:text-amber-300';

                return '<span class="px-2.5 py-0.5 rounded-full text-xs font-medium ' . $cls . '">' . ucfirst((string) $model->status) . '</span>';
            })
            ->add('data_reclamacao_formatted', fn (Reclamacao $model) => $model->data_reclamacao
                ? Carbon::parse($model->data_reclamacao)->format('d/m/Y H:i')
                : '-');
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable(),

            Column::make('Curso', 'curso_nome')
                ->searchable(),

            Column::make('Assunto', 'assunto')
                ->sortable()
                ->searchable(),

            Column::make('Descrição', 'descricao')
                ->searchable(),

            Column::make('Prioridade', 'prioridade_badge', 'prioridade')
                ->sortable(),

            Column::make('Status', 'status_badge', 'status')
                ->sortable(),

            Column::make('Data Reclamação', 'data_reclamacao_formatted', 'data_reclamacao')
                ->sortable(),
        ];
    }

    public function filters(): array
    {
        return [];
    }
}
