<div>
    @if($show && $curso)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-md max-h-[90vh] overflow-y-auto">
            <h2 class="text-xl font-bold mb-4">Editar Curso: {{ $curso->nome_curso }}</h2>
            
            <form wire:submit.prevent="update" class="space-y-4">
                <!-- Nome do Curso -->
                <div>
                    <label class="block text-sm font-medium mb-1">Nome do Curso *</label>
                    <input type="text" wire:model="curso.nome_curso" 
                           class="w-full border rounded px-3 py-2" required>
                    @error('curso.nome_curso') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Sigla -->
                <div>
                    <label class="block text-sm font-medium mb-1">Sigla *</label>
                    <input type="text" wire:model="curso.sigla" 
                           class="w-full border rounded px-3 py-2" maxlength="4" 
                           oninput="this.value = this.value.toUpperCase()" required>
                    @error('curso.sigla') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Descrição -->
                <div>
                    <label class="block text-sm font-medium mb-1">Descrição</label>
                    <textarea wire:model="curso.descricao_curso" 
                              class="w-full border rounded px-3 py-2" rows="3"></textarea>
                </div>

                <!-- Duração -->
                <div>
                    <label class="block text-sm font-medium mb-1">Duração (meses) *</label>
                    <input type="number" wire:model="curso.duracao_curso" 
                           class="w-full border rounded px-3 py-2" min="1" max="120" required>
                    @error('curso.duracao_curso') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Nível -->
                <div>
                    <label class="block text-sm font-medium mb-1">Nível *</label>
                    <select wire:model="curso.nivel_curso" class="w-full border rounded px-3 py-2" required>
                        <option value="">Selecione...</option>
                        <option value="Fundamental">Fundamental</option>
                        <option value="Médio">Médio</option>
                        <option value="Técnico">Técnico</option>
                        <option value="Superior">Superior</option>
                    </select>
                    @error('curso.nivel_curso') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Área -->
                <div>
                    <label class="block text-sm font-medium mb-1">Área *</label>
                    <input type="text" wire:model="curso.area_curso" 
                           class="w-full border rounded px-3 py-2" required>
                    @error('curso.area_curso') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Escola -->
                <div>
                    <label class="block text-sm font-medium mb-1">Escola</label>
                    <select wire:model="curso.escola_id" class="w-full border rounded px-3 py-2">
                        @foreach($escolas as $escola)
                            <option value="{{ $escola->id }}" {{ $curso->escola_id == $escola->id ? 'selected' : '' }}>
                                {{ $escola->esc_nome }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Ativo -->
                <div class="flex items-center">
                    <input type="checkbox" wire:model="curso.ativo" value="1" 
                           class="mr-2" id="ativo-edit" {{ $curso->ativo ? 'checked' : '' }}>
                    <label for="ativo-edit">Curso ativo</label>
                </div>

                <!-- Botões -->
                <div class="flex justify-between pt-4">
                    <button type="button" wire:click="close" 
                            class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                        Cancelar
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Salvar Alterações
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>