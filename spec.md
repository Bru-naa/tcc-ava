# AVA+ Project Specification & Architecture Guidelines

## 1. Tech Stack & Environment
* **Language:** PHP 8.2+ (Strict typing enforced).
* **Framework:** Laravel 11.
* **Frontend:** Livewire 3, Volt, Tailwind CSS.
* **Database:** SQLite.

## 2. Architecture & Clean Code (SOLID)
* **Separation of Concerns:** Controllers e componentes Livewire não devem processar regras de negócio complexas. A lógica principal deve ser delegada para classes dedicadas (`Actions` ou `Services`).
* **Models Enxutos:** Os Models do Eloquent devem conter apenas `relationships`, `casts`, `mutators`/`accessors` e `query scopes`.
* **Tipagem Estrita (Type Hinting):** Todos os métodos, funções, parâmetros e retornos devem possuir tipagem estrita declarada. Evitar o uso de `mixed`. Utilize `Backed Enums` para estados e categorias em vez de *strings* soltas.

## 3. Database & Eloquent Mastery
* **Performance & N+1:** É estritamente obrigatório o uso de Eager Loading (`with()`, `load()`) em consultas a relacionamentos. O problema N+1 deve ser evitado a todo o custo.
* **Integridade:** Qualquer operação que envolva inserção/atualização em múltiplas tabelas simultaneamente deve ser obrigatoriamente encapsulada em transações atômicas (`DB::transaction`).
* **Consultas:** Lógicas de filtragem reutilizáveis devem ser encapsuladas em *Local Scopes* no Model, não espalhadas pelos Controllers.

## 4. Livewire 3 & Frontend Reactivity
* **Reatividade Nativa:** Proibida a manipulação direta do DOM via JavaScript puro ou gambiarras com temporizadores (`sleep()` no PHP ou `setTimeout` no JS). 
* **Otimização de Estado:** Utilize o atributo `#[Computed]` para propriedades que apenas exibem dados, evitando consultas desnecessárias ao banco de dados durante re-renderizações.
* **Comunicação:** Utilize o sistema de eventos do Livewire (`$this->dispatch`) para comunicação entre componentes distintos, mantendo o baixo acoplamento.