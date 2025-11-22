<div class="mb-4">
    <flux:modal.trigger name="edit-profile">
        <flux:button 

    variant="primary"
    color="blue"
    icon="plus-circle"
>
    Pré-cadastro
</flux:button>

    </flux:modal.trigger>

    <flux:modal name="edit-profile" class="md:w-96">
        <form action="{{ route('secretaria.pre-cadastro.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <flux:heading size="lg">Pré-registro</flux:heading>
                <flux:text class="mt-2">
                    Insira as informações do funcionário para gerar o e-mail institucional.
                </flux:text>
            </div>

            <flux:input 
                label="Nome Completo"
                placeholder="Digite o nome"
                name="nome"
                value="{{ old('nome') }}"
                required
            />

            <flux:input 
                label="Email pessoal" 
                type="email"
                placeholder="email pessoal..."
                name="email_pessoal"
                value="{{ old('email_pessoal') }}"
                required
            />

            <flux:input 
                label="Data de nascimento" 
                type="date"
                name="data_nascimento"
                value="{{ old('data_nascimento') }}"
                required
            />

            <flux:input 
                label="CPF"
                placeholder="000.000.000-00"
                name="cpf"
                value="{{ old('cpf') }}"
                required
                oninput="this.value = this.value.replace(/\D/g,'').slice(0,11)
                          .replace(/(\d{3})(\d{3})(\d{3})(\d{0,2})/, '$1.$2.$3-$4');"
            />

            <flux:input 
                label="Telefone"
                placeholder="(00) 00000-0000"
                name="telefone"
                value="{{ old('telefone') }}"
                required
                oninput="this.value = this.value.replace(/\D/g,'').slice(0,11)
                          .replace(/(\d{2})(\d{5})(\d{0,4})/, '($1) $2-$3');"
            />

            <input type="hidden" name="escola_id" value="{{ auth()->user()->escola_id }}">

            

            <flux:select label="Função" name="role_id" required>
                <option value="">Selecione...</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </flux:select>

            <div class="flex">
                <flux:spacer />

                <flux:button 
                    type="submit" 
                    variant="primary"
                >
                    Salvar
                </flux:button>
            </div>
        </form>
    </flux:modal>
</div>
