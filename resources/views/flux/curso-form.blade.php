<div class="mb-4">
    <flux:modal.trigger name="curso-profile">
        <flux:button 
            variant="primary" 
            color="emerald"
            icon="plus-circle"
        >
            Adicionar Novo Curso
        </flux:button>
    </flux:modal.trigger>

    <flux:modal name="curso-profile" class="md:w-96">
        <form action="{{ route('secretaria.cursos.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <div>
                <flux:heading size="lg">Cadastrar Curso</flux:heading>
                <flux:text class="mt-2">
                    Insira as informações do curso.
                </flux:text>
            </div>

            <!-- Nome do Curso -->
            <flux:input 
                label="Nome do Curso"
                placeholder="Digite o nome do curso"
                name="nome_curso"
                value="{{ old('nome_curso') }}"
                maxlength="100"
                required
            />
            @error('nome_curso')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror

            <!-- Sigla -->
            <flux:input 
                label="Sigla do Curso"
                placeholder="Ex: EF1, MED, INF"
                name="sigla"
                value="{{ old('sigla') }}"
                maxlength="4"
                required
                oninput="this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '').slice(0, 4)"
            />
            @error('sigla')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror

            <!-- Descrição -->
            <flux:textarea 
                label="Descrição do Curso"
                placeholder="Descreva o curso..."
                name="descricao_curso"
                value="{{ old('descricao_curso') }}"
                rows="3"
            />
            @error('descricao_curso')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror

            <!-- Duração -->
            <flux:input 
                label="Duração (meses)"
                type="number"
                placeholder="Ex: 12, 24, 36"
                name="duracao_curso"
                value="{{ old('duracao_curso') }}"
                min="1"
                max="120"
                required
            />
            @error('duracao_curso')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror

            <!-- Nível do Curso -->
            <flux:select label="Nível do Curso" name="nivel_curso" required>
                <option value="">Selecione o nível...</option>
                <option value="Fundamental" {{ old('nivel_curso') == 'Fundamental' ? 'selected' : '' }}>Ensino Fundamental</option>
                <option value="Médio" {{ old('nivel_curso') == 'Médio' ? 'selected' : '' }}>Ensino Médio</option>
                <option value="Técnico" {{ old('nivel_curso') == 'Técnico' ? 'selected' : '' }}>Técnico</option>
                <option value="Superior" {{ old('nivel_curso') == 'Superior' ? 'selected' : '' }}>Superior</option>
                <option value="Pós-graduação" {{ old('nivel_curso') == 'Pós-graduação' ? 'selected' : '' }}>Pós-graduação</option>
            </flux:select>
            @error('nivel_curso')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror

            <!-- Área do Curso -->
            <flux:input 
                label="Área do Curso"
                placeholder="Ex: Exatas, Humanas, Biológicas"
                name="area_curso"
                value="{{ old('area_curso') }}"
                maxlength="50"
                required
            />
            @error('area_curso')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror

            <!-- Escola -->
            <flux:select label="Escola" name="escola_id" required>
                <option value="">Selecione a escola...</option>
                @foreach($escolas as $escola)
                    <option value="{{ $escola->id }}" {{ old('escola_id') == $escola->id ? 'selected' : '' }}>
                        {{ $escola->esc_nome }}
                    </option>
                @endforeach
            </flux:select>
            @error('escola_id')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror

            <!-- Status -->
            <flux:checkbox 
                label="Curso ativo"
                name="ativo"
                value="1"
                checked="{{ old('ativo', true) }}"
            />
            @error('ativo')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror

            <!-- Botão -->
            <div class="flex justify-center">
                <flux:button type="submit" variant="primary">
                    Cadastrar Curso
                </flux:button>
            </div>
        </form>
    </flux:modal>
</div>