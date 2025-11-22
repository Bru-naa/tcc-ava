<div class="flex flex-col mb-4">


  <p class="text-center 2xl lg:4xl mt-2 mb-4 font-medium">Alunos matriculados</p>
  <div class="-m-1.5 overflow-x-auto">
    <div class="p-1.5 min-w-full inline-block align-middle">
      <div class="border border-gray-200 rounded-lg divide-y divide-gray-200 dark:border-neutral-700 dark:divide-neutral-700">

        <div class="py-3 px-4">
          <div class="relative max-w-xs">
            <label class="sr-only text-black dark:text-white">Search</label>
            <input type="text"
              name="hs-table-with-pagination-search"
              id="hs-table-with-pagination-search"
              class="py-1.5 sm:py-2 px-3 ps-9 block w-full border-gray-200 shadow-2xs rounded-lg sm:text-sm
                     focus:z-10 focus:border-blue-500 focus:ring-blue-500
                     disabled:opacity-50 disabled:pointer-events-none
                     dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-300
                     dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
              placeholder="Search for items">

            <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3">
              <svg class="size-4 text-gray-400 dark:text-neutral-500"
                   xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                   viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                   stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"></circle>
                <path d="m21 21-4.3-4.3"></path>
              </svg>
            </div>
          </div>
        </div>

        <div class="overflow-hidden">
          <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
            <thead class="bg-gray-50 dark:bg-white/10 backdrop-blur-sm">
              <tr>
                <th scope="col" class="py-3 px-4 pe-0">
                  <div class="flex items-center h-5">
                    <input id="hs-table-pagination-checkbox-all"
                           type="checkbox"
                           class="border-gray-200 rounded-sm text-blue-600 focus:ring-blue-500
                                  dark:bg-neutral-700 dark:border-neutral-600
                                  dark:checked:bg-blue-500 dark:checked:border-blue-500
                                  dark:focus:ring-offset-gray-800">
                    <label for="hs-table-pagination-checkbox-all" class="sr-only">Checkbox</label>
                  </div>
                </th>
                <th class="px-6 py-3 text-start text-xs font-medium text-gray-600 uppercase dark:text-neutral-300">Nome</th>
                <th class="px-6 py-3 text-start text-xs font-medium text-gray-600 uppercase dark:text-neutral-300">Email</th>
                <th class="px-6 py-3 text-start text-xs font-medium text-gray-600 uppercase dark:text-neutral-300">Contato</th>
                <th class="px-6 py-3 text-end text-xs font-medium text-gray-600 uppercase dark:text-neutral-300">Status</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
              <tr>
                <td class="py-3 ps-4">
                  <div class="flex items-center h-5">
                    <input type="checkbox"
                      class="border-gray-200 rounded-sm text-blue-600 focus:ring-blue-500
                             dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500">
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">John Brown</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">john@email.com</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">(11) 90000-0000</td>
                <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                  <span class="px-2 py-1 text-xs font-semibold rounded-full
                               bg-green-100 text-green-700
                               dark:bg-green-900/40 dark:text-green-300">
                    Ativo
                  </span>
                </td>
              </tr>
              <tr>
                <td class="py-3 ps-4">
                  <div class="flex items-center h-5">
                    <input type="checkbox"
                      class="border-gray-200 rounded-sm text-blue-600 dark:bg-neutral-800 dark:border-neutral-700">
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">Jim Green</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">jim@email.com</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">(21) 95555-6666</td>
                <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                  <span class="px-2 py-1 text-xs font-semibold rounded-full
                               bg-red-100 text-red-700
                               dark:bg-red-900/40 dark:text-red-300">
                    Pendente
                  </span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="py-1 px-4">
          <nav class="flex items-center space-x-1" aria-label="Pagination">
            <button type="button"
              class="p-2.5 min-w-10 inline-flex justify-center items-center gap-x-2 text-sm rounded-full 
                     text-gray-800 hover:bg-gray-100 dark:text-white dark:hover:bg-neutral-700">
              «
            </button>
            <button type="button"
              class="min-w-10 flex justify-center items-center text-gray-800 hover:bg-gray-100 
                     py-2.5 text-sm rounded-full dark:text-white dark:hover:bg-neutral-700"
              aria-current="page">
              1
            </button>
            <button type="button"
              class="min-w-10 flex justify-center items-center text-gray-800 hover:bg-gray-100 
                     py-2.5 text-sm rounded-full dark:text-white dark:hover:bg-neutral-700">
              2
            </button>
            <button type="button"
              class="p-2.5 min-w-10 inline-flex justify-center items-center gap-x-2 text-sm rounded-full">
              »
            </button>
          </nav>
        </div>

      </div>
    </div>
  </div>
</div>
