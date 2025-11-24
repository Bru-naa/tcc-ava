<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - AvaliaEdu</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxAppearance
    @livewireStyles
</head>
       <body class="min-h-screen bg-white dark:bg-zinc-800 antialiased">
     
    <flux:header container class="bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" />
            <flux:brand href="#" logo="{{ asset('images/logo-ava.png') }}" name="AvaliaEdu" class="max-lg:hidden dark:hidden" />
            <flux:brand href="#" logo="{{ asset('images/logo-ava.png') }}" name="AvaliaEdu" class="hidden max-lg:hidden dark:flex" />

            <flux:navbar class="-mb-px max-lg:hidden">
                <flux:navbar.item icon="home" href="#home" current>Home</flux:navbar.item>
                
                <!-- <flux:navbar.item icon="information-circle" badge="12" href="#">Sobre nós</flux:navbar.item> -->
                 <flux:navbar.item icon="building-library" href="#instituicoes">Instituições</flux:navbar.item>
                 <flux:navbar.item icon="information-circle" href="#sobreNos">Sobre nós</flux:navbar.item>
                <flux:navbar.item icon="at-symbol" href="#contato">Contato</flux:navbar.item>
                
                <flux:separator vertical variant="subtle" class="my-2"/>
            </flux:navbar>

            <flux:spacer />

            <flux:navbar class="me-4">
                <flux:navbar.item icon="magnifying-glass" href="#" label="Search" disabled class="max-lg:hidden opacity-50 cursor-not-allowed" />
                @auth
        <!-- Usuário autenticado: link ativo -->
        <flux:navbar.item 
            class="max-lg:hidden" 
            icon="cog-6-tooth" 
            href="{{ route('settings') }}" 
            label="Settings" 
        />
    @else
        <!-- Usuário não autenticado: item desabilitado -->
        <flux:navbar.item 
            class="max-lg:hidden opacity-50 cursor-not-allowed" 
            icon="cog-6-tooth" 
            href="#" 
            label="Settings" 
        />
    @endauth
               
            </flux:navbar>

            <flux:dropdown position="top" align="start">
                <flux:profile :initials="auth()->user()?->initials()??'CV'" />
                <flux:menu>
                    <flux:menu.radio.group>
                        <flux:menu.radio checked>{{ auth()->user()?->name ?? 'Convidado' }}</flux:menu.radio>
                        <flux:radio.group x-data variant="segmented" x-model="$flux.appearance">
            <flux:radio value="light" icon="sun" checked></flux:radio>
            <flux:radio value="dark" icon="moon"></flux:radio>
            <flux:radio value="system" icon="computer-desktop"></flux:radio>
        </flux:radio.group>
                    </flux:menu.radio.group>
                    <flux:menu.separator />

                    @auth
                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full" data-test="logout-button">
                                {{ __('Log Out') }}
                            </flux:menu.item>
                        </form>
                           <flux:menu.separator />

                        <flux:menu.item href="{{ route('profile.edit') }}" icon="briefcase" class="w-full" data-test="profile-button">
                            {{ __('Perfil') }}
                        </flux:menu.item>
                    @else
                        <flux:menu.item href="{{ route('login') }}" icon="arrow-right-end-on-rectangle" class="w-full" data-test="login-button">
                            {{ __('Log In') }}
                        </flux:menu.item>

                    @endauth
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        <flux:sidebar sticky collapsible="mobile" class="lg:hidden bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
            <flux:sidebar.header>
                <flux:sidebar.brand
                    href="#"
                    logo="{{ asset('images/logo-ava.png') }}"
                    logo:dark="{{ asset('images/logo-ava.png') }}"
                    name="AvaliaEdu"
                />
                <flux:sidebar.collapse class="in-data-flux-sidebar-on-desktop:not-in-data-flux-sidebar-collapsed-desktop:-mr-2" />
            </flux:sidebar.header>

            <flux:sidebar.nav>
                <flux:sidebar.item icon="home" href="#home" current>Home</flux:sidebar.item>
                 <flux:sidebar.item icon="building-library" href="#instituicoes">Instituições</flux:sidebar.item>
                 <flux:sidebar.item icon="information-circle" href="#sobreNos">Sobre nós</flux:sidebar.item>
                <flux:sidebar.item icon="at-symbol" href="#contato">Contato</flux:sidebar.item>
               
                
            </flux:sidebar.nav>

            <flux:sidebar.spacer />

            <flux:sidebar.nav>
                <flux:sidebar.item icon="cog-6-tooth" href="#">Settings</flux:sidebar.item>
                <flux:sidebar.item icon="information-circle" href="#">Help</flux:sidebar.item>
            </flux:sidebar.nav>
        </flux:sidebar>

        <flux:main container>
            {{$slot}}
          <!--   <div class="flex max-md:flex-col items-start">
                <div class="w-full md:w-[220px] pb-4 me-10">
                    <flux:navlist>
                        <flux:navlist.item href="#" current>Dashboard</flux:navlist.item>
                        <flux:navlist.item href="#" badge="32">Orders</flux:navlist.item>
                        <flux:navlist.item href="#">Catalog</flux:navlist.item>
                        <flux:navlist.item href="#">Payments</flux:navlist.item>
                        <flux:navlist.item href="#">Customers</flux:navlist.item>
                        <flux:navlist.item href="#">Billing</flux:navlist.item>
                        <flux:navlist.item href="#">Quotes</flux:navlist.item>
                        <flux:navlist.item href="#">Configuration</flux:navlist.item>
                    </flux:navlist>
                </div> -->
<!-- 
                <flux:separator class="md:hidden" />

               
            </div> -->
        </flux:main>
 
      <!-- VLibras -->
    <div vw class="enabled">
      <div vw-access-button class="active"></div>
      <div vw-plugin-wrapper>
        <div class="vw-plugin-top-wrapper"></div>
      </div>
    </div>
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
      new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>

    @fluxScripts
    @livewireScripts
    
</body>
</html>
