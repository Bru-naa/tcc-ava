<div class="mb-4">
    <flux:modal.trigger name="aluno-profile">
        <flux:button 
            variant="primary" 
            color="sky"
            icon="plus-circle"
        >
            Inserir novo aluno
        </flux:button>
    </flux:modal.trigger>

    <flux:modal name="aluno-profile" class="md:w-96">
        <form action="{{ route('secretaria.alunos.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <div>
                <flux:heading size="lg">Cadastrar Aluno</flux:heading>
                <flux:text class="mt-2">
                    Insira as informações do aluno.
                </flux:text>
            </div>

            <!-- Nome -->
            <flux:input 
                label="Nome Completo"
                placeholder="Digite o nome"
                name="alun_nome"
                value="{{ old('alun_nome') }}"
                maxlength="50"
                required
            />
            @error('alun_nome')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror

            <!-- Email -->
            <flux:input 
                label="Email" 
                type="email"
                placeholder="email@exemplo.com"
                name="alun_email"
                value="{{ old('alun_email') }}"
                required
            />
            @error('alun_email')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror

            <!-- Data de nascimento -->
            <flux:input 
                label="Data de nascimento" 
                type="date"
                name="alun_data_nascimento"
                value="{{ old('alun_data_nascimento') }}"
                max="{{ now()->subYears(12)->format('Y-m-d') }}"
                required
            />
            @error('alun_data_nascimento')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror

            <!-- CPF com oninput -->
            <flux:input 
                label="CPF"
                placeholder="000.000.000-00"
                name="alun_cpf"
                value="{{ old('alun_cpf') }}"
                maxlength="14"
                required
                oninput="this.value = this.value
                    .replace(/\D/g,'')            
                    .slice(0,11)                    
                    .replace(/(\d{3})(\d)/, '$1.$2')
                    .replace(/(\d{3})(\d)/, '$1.$2')
                    .replace(/(\d{3})(\d{1,2})$/, '$1-$2');"
            />
            @error('alun_cpf')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror

            <!-- Telefone com oninput -->
            <flux:input 
                label="Telefone"
                placeholder="(00) 00000-0000"
                name="alun_telefone"
                value="{{ old('alun_telefone') }}"
                maxlength="15"
                required
                oninput="this.value = this.value
                    .replace(/\D/g,'')              
                    .slice(0,11)                    
                    .replace(/(\d{2})(\d)/, '($1) $2')
                    .replace(/(\d{5})(\d{4})/, '$1-$2');"
            />
            @error('alun_telefone')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror

            <!-- Endereço -->
            <flux:input 
                label="Endereço"
                placeholder="Digite o endereço completo"
                name="alun_endereco"
                value="{{ old('alun_endereco') }}"
                required
            />
            @error('alun_endereco')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror

            <!-- Sexo -->
            <flux:select label="Sexo" name="alun_sexo" required>
                <option value="">Selecione...</option>
                <option value="masculino" {{ old('alun_sexo') == 'masculino' ? 'selected' : '' }}>Masculino</option>
                <option value="feminino" {{ old('alun_sexo') == 'feminino' ? 'selected' : '' }}>Feminino</option>
                <option value="outro" {{ old('alun_sexo') == 'outro' ? 'selected' : '' }}>Outro</option>
            </flux:select>
            @error('alun_sexo')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror

            <flux:select label="Curso" name="curso_id" required>
    <option value="">Selecione o curso...</option>
    @foreach($cursos as $curso)
        <option value="{{ $curso->id }}" {{ old('curso_id') == $curso->id ? 'selected' : '' }}>
            {{ $curso->nome_curso }} ({{ $curso->sigla }})
        </option>
    @endforeach
</flux:select>
@error('curso_id')
    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
@enderror
            <!-- Botão -->
            <div class="flex justify-center">
                <flux:button type="submit" variant="primary">
                    Cadastrar Aluno
                </flux:button>
            </div>
        </form>
    </flux:modal>
</div>