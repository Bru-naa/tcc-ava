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
        <form wire:submit.prevent="insertAlunos">
            <div class="space-y-6">
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
                    wire:model.blur="alun_nome"
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
                    wire:model.blur="alun_email"
                    required
                />
                @error('alun_email')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror

                <!-- Data de nascimento -->
                <flux:input 
                    label="Data de nascimento" 
                    type="date"
                    wire:model.blur="alun_data_nascimento"
                    max="{{ now()->subYears(12)->format('Y-m-d') }}"
                    required
                />
                @error('alun_data_nascimento')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror

                <!-- CPF -->
                <flux:input 
                    label="CPF"
                    placeholder="000.000.000-00"
                    wire:model.blur="alun_cpf"
                    maxlength="14"
                    required
                />
                @error('alun_cpf')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror

                <!-- Telefone -->
                <flux:input 
                    label="Telefone"
                    placeholder="(00) 00000-0000"
                    wire:model.blur="alun_telefone"
                    maxlength="15"
                    required
                />
                @error('alun_telefone')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror

                <!-- Endereço -->
                <flux:input 
                    label="Endereço"
                    placeholder="Digite o endereço completo"
                    wire:model.blur="alun_endereco"
                    required
                />
                @error('alun_endereco')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror

                <!-- Sexo -->
                <flux:select label="Sexo" wire:model.blur="alun_sexo" required>
                    <option value="">Selecione...</option>
                    <option value="masculino">Masculino</option>
                    <option value="feminino">Feminino</option>
                    <option value="outro">Outro</option>
                </flux:select>
                @error('alun_sexo')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror

                <!-- Botão -->
                <div class="flex justify-center">
                    <flux:button 
                        type="submit" 
                        variant="primary"
                        wire:loading.attr="disabled"
                    >
                        <span wire:loading.remove>Cadastrar Aluno</span>
                        <span wire:loading>Cadastrando...</span>
                    </flux:button>
                </div>

                <!-- Mensagem de sucesso/erro -->
                @if($mensagem)
                    <div class="p-3 rounded-lg {{ $tipoMensagem === 'success' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $mensagem }}
                    </div>
                @endif
            </div>
        </form>
    </flux:modal>
</div>