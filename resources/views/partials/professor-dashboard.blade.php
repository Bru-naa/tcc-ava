

<div class="h-auto w-auto mx-auto"><flux:select wire:model="industry" placeholder="Escolha o semestre...">
    <flux:select.option>2024/1</flux:select.option>
    <flux:select.option>2024/2</flux:select.option>
    <flux:select.option>2025/1</flux:select.option>
    <flux:select.option>2025/2</flux:select.option>
  
</flux:select></div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">

    <!-- PERGUNTA 1 - Participação nas Atividades -->
    <div class="bg-white p-6 rounded-xl shadow-lg border">
        <h3 class="text-lg font-semibold mb-4 text-gray-800">
            Como aluno, você realiza todas as atividades práticas incentivadas durante a aula?
        </h3>
        <div class="chart-container" style="height: 300px;">
            <canvas id="participacaoChart"></canvas>
        </div>
    </div>

    <!-- PERGUNTA 2 - Dificuldades no Ensino -->
    <div class="bg-white p-6 rounded-xl shadow-lg border">
        <h3 class="text-lg font-semibold mb-4 text-gray-800">
            Quais dificuldades você sente em relação ao ensino do professor(a)?
        </h3>
        <div class="chart-container" style="height: 300px;">
            <canvas id="dificuldadesChart"></canvas>
        </div>
    </div>

    <!-- PERGUNTA 3 - Conforto com Dúvidas -->
    <div class="bg-white p-6 rounded-xl shadow-lg border">
        <h3 class="text-lg font-semibold mb-4 text-gray-800">
            Quando sente dificuldade, você se sente à vontade para tirar dúvidas com o professor(a)?
        </h3>
        <div class="chart-container" style="height: 300px;">
            <canvas id="duvidasChart"></canvas>
        </div>
    </div>

    <!-- PERGUNTA 4 - Coerência das Avaliações -->
    <div class="bg-white p-6 rounded-xl shadow-lg border">
        <h3 class="text-lg font-semibold mb-4 text-gray-800">
            A forma de avaliação é justa e coerente com o que foi ensinado?
        </h3>
        <div class="chart-container" style="height: 300px;">
            <canvas id="avaliacoesChart"></canvas>
        </div>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-lg border">
    <h3 class="text-lg font-semibold mb-4 text-gray-800 text-center">
        Perfil Comportamental - Dificuldades no Ensino
    </h3>
    <div class="chart-container" style="height: 400px;">
        <canvas id="radarChart"></canvas>
    </div>
</div>

</div>

