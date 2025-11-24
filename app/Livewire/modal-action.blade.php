<div>
    @if($curso)
    <flux:modal.trigger name="edit-curso-modal">
        <div style="display: none;">Abrir Modal</div>
    </flux:modal.trigger>

    <flux:modal name="edit-curso-modal" class="md:w-96">
        <form wire:submit="update" class="space-y-6">
            @csrf
            
            <div>
                <flux:heading size="lg">Editar Curso: {{ $curso->nome_curso }}</flux:heading>
            </div>

            <input type="hidden" wire:model="cursoId" value="{{ $curso->id }}">

            <!-- Nome do Curso -->
            <flux:input 
                label="Nome do Curso"
                placeholder="Digite o nome do curso"
                wire:model="nome_curso"
                value="{{ $curso->nome_curso }}"
                maxlength="100"
                required
            />

            <!-- Sigla -->
            <flux:input 
                label="Sigla do Curso"
                placeholder="Ex: EF1, MED, INF"
                wire:model="sigla"
                value="{{ $curso->sigla }}"
                maxlength="4"
                required
            />

            <!-- Descrição -->
            <flux:textarea 
                label="Descrição do Curso"
                placeholder="Descreva o curso..."
                wire:model="descricao_curso"
                value="{{ $curso->descricao_curso }}"
                rows="3"
            />

            <!-- Duração -->
            <flux:input 
                label="Duração (meses)"
                type="number"
                placeholder="Ex: 12, 24, 36"
                wire:model="duracao_curso"
                value="{{ $curso->duracao_curso }}"
                min="1"
                max="120"
                required
            />

            <!-- Nível do Curso -->
            <flux:select label="Nível do Curso" wire:model="nivel_curso" required>
                <option value="">Selecione o nível...</option>
                <option value="Fundamental" {{ $curso->nivel_curso == 'Fundamental' ? 'selected' : '' }}>Ensino Fundamental</option>
                <option value="Médio" {{ $curso->nivel_curso == 'Médio' ? 'selected' : '' }}>Ensino Médio</option>
                <option value="Técnico" {{ $curso->nivel_curso == 'Técnico' ? 'selected' : '' }}>Técnico</option>
                <option value="Superior" {{ $curso->nivel_curso == 'Superior' ? 'selected' : '' }}>Superior</option>
            </flux:select>

            <!-- Área do Curso -->
            <flux:input 
                label="Área do Curso"
                placeholder="Ex: Exatas, Humanas, Biológicas"
                wire:model="area_curso"
                value="{{ $curso->area_curso }}"
                maxlength="50"
                required
            />

            <!-- Status -->
            <flux:checkbox 
                label="Curso ativo"
                wire:model="ativo"
                value="1"
                checked="{{ $curso->ativo }}"
            />

            <!-- Botões -->
            <div class="flex justify-between">
                <flux:button type="button" variant="secondary" @click="closeModal()">
                    Cancelar
                </flux:button>
                <flux:button type="submit" variant="primary">
                    Salvar Alterações
                </flux:button>
            </div>
        </form>
    </flux:modal>
    @endif
</div>

<script>
    document.addEventListener('livewire:initialized', function () {
        Livewire.on('open-edit-modal', (event) => {
          
            document.querySelector('[data-modal-target="edit-curso-modal"]').click();
        });

        Livewire.on('curso-deleted', () => {
            
            window.location.reload();
        });
    });
</script>