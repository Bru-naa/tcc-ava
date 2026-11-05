<div class="bg-zinc-50 dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-xl p-4 mb-6">
    <div class="flex flex-col md:flex-row items-center justify-between gap-4">
        <div>
            <h3 class="text-base font-semibold text-gray-800 dark:text-white">
                Desempenho Docente — Restrito aos Cursos da Coordenação
            </h3>
            <p class="text-xs text-gray-500 dark:text-neutral-400">
                Você visualiza apenas as avaliações de professores dos cursos sob sua coordenação.
            </p>
        </div>

        <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
            <div class="min-w-[240px]">
                <flux:select placeholder="Curso vinculado...">
                    @forelse($cursosVinculados as $curso)
                        <flux:select.option value="{{ $curso->id }}" :selected="$loop->first">
                            {{ $curso->sigla }} — {{ $curso->nome_curso }}
                        </flux:select.option>
                    @empty
                        <flux:select.option value="" disabled>Nenhum curso vinculado</flux:select.option>
                    @endforelse
                </flux:select>
            </div>

            <div class="min-w-[160px]">
                <flux:select placeholder="Escolha o semestre...">
                    <flux:select.option value="2025/2" selected>2025/2</flux:select.option>
                    <flux:select.option value="2025/1">2025/1</flux:select.option>
                    <flux:select.option value="2024/2">2024/2</flux:select.option>
                    <flux:select.option value="2024/1">2024/1</flux:select.option>
                </flux:select>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
    <div class="bg-white p-6 rounded-xl shadow-lg border">
        <h3 class="text-lg font-semibold mb-4 text-gray-800">
            Como aluno, você realiza todas as atividades práticas incentivadas durante a aula?
        </h3>
        <div class="chart-container" style="height: 300px;">
            <canvas id="participacaoChart"></canvas>
        </div>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-lg border">
        <h3 class="text-lg font-semibold mb-4 text-gray-800">
            Quais dificuldades você sente em relação ao ensino do professor(a)?
        </h3>
        <div class="chart-container" style="height: 300px;">
            <canvas id="dificuldadesChart"></canvas>
        </div>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-lg border">
        <h3 class="text-lg font-semibold mb-4 text-gray-800">
            Quando sente dificuldade, você se sente à vontade para tirar dúvidas com o professor(a)?
        </h3>
        <div class="chart-container" style="height: 300px;">
            <canvas id="duvidasChart"></canvas>
        </div>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-lg border">
        <h3 class="text-lg font-semibold mb-4 text-gray-800">
            A forma de avaliação é justa e coerente com o que foi ensinado?
        </h3>
        <div class="chart-container" style="height: 300px;">
            <canvas id="avaliacoesChart"></canvas>
        </div>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-lg border md:col-span-2">
        <h3 class="text-lg font-semibold mb-4 text-gray-800 text-center">
            Perfil Comportamental - Dificuldades no Ensino (Cursos Coordenados)
        </h3>
        <div class="chart-container" style="height: 400px;">
            <canvas id="radarChart"></canvas>
        </div>
    </div>
</div>

