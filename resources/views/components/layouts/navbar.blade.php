<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - AvaliaEdu</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxAppearance
</head>
<body>
    <header>
       <body class="min-h-screen bg-white dark:bg-zinc-800 antialiased">
    <flux:header container class="bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" />
            <flux:brand href="#" logo="{{ asset('images/logo-ava.png') }}" name="AvaliaEdu" class="max-lg:hidden dark:hidden" />
            <flux:brand href="#" logo="{{ asset('images/logo-ava.png') }}" name="AvaliaEdu" class="hidden max-lg:hidden dark:flex" />

            <flux:navbar class="-mb-px max-lg:hidden">
                <flux:navbar.item icon="home" href="#" current>Home</flux:navbar.item>
                <flux:navbar.item icon="information-circle" href="#">Sobre nós</flux:navbar.item>
                <!-- <flux:navbar.item icon="information-circle" badge="12" href="#">Sobre nós</flux:navbar.item> -->
                <flux:navbar.item icon="at-symbol" href="#">Contato</flux:navbar.item>
                <flux:navbar.item icon="" href="#">Instituições</flux:navbar.item>
                <flux:separator vertical variant="subtle" class="my-2"/>
            </flux:navbar>

            <flux:spacer />

            <flux:navbar class="me-4">
                <flux:navbar.item icon="magnifying-glass" href="#" label="Search" />
                <flux:navbar.item class="max-lg:hidden" icon="cog-6-tooth" href="#" label="Settings" />
               
            </flux:navbar>

            <flux:dropdown position="top" align="start">
                <flux:profile :initials="auth()->user()?->initials()??'CV'" />
                <flux:menu>
                    <flux:menu.radio.group>
                        <flux:menu.radio checked>{{ auth()->user()?->name ?? 'Convidado' }}</flux:menu.radio>
                        <flux:menu.radio>Truly Delta</flux:menu.radio>
                        <flux:radio.group x-data variant="segmented" x-model="$flux.appearance">
            <flux:radio value="light" icon="sun"></flux:radio>
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
                    @else
                        <flux:menu.item href="{{ route('login') }}" icon="arrow-right-start-on-rectangle" class="w-full" data-test="login-button">
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
                    logo="https://fluxui.dev/img/demo/logo.png"
                    logo:dark="https://fluxui.dev/img/demo/dark-mode-logo.png"
                    name="Acme Inc."
                />
                <flux:sidebar.collapse class="in-data-flux-sidebar-on-desktop:not-in-data-flux-sidebar-collapsed-desktop:-mr-2" />
            </flux:sidebar.header>

            <flux:sidebar.nav>
                <flux:sidebar.item icon="home" href="#" current>Home</flux:sidebar.item>
                <flux:sidebar.item icon="inbox" badge="12" href="#">Inbox</flux:sidebar.item>
                <flux:sidebar.item icon="document-text" href="#">Documents</flux:sidebar.item>
                <flux:sidebar.item icon="calendar" href="#">Calendar</flux:sidebar.item>
                <flux:sidebar.group expandable heading="Favorites" class="grid">
                    <flux:sidebar.item href="#">Marketing site</flux:sidebar.item>
                    <flux:sidebar.item href="#">Android app</flux:sidebar.item>
                    <flux:sidebar.item href="#">Brand guidelines</flux:sidebar.item>
                </flux:sidebar.group>
            </flux:sidebar.nav>

            <flux:sidebar.spacer />

            <flux:sidebar.nav>
                <flux:sidebar.item icon="cog-6-tooth" href="#">Settings</flux:sidebar.item>
                <flux:sidebar.item icon="information-circle" href="#">Help</flux:sidebar.item>
            </flux:sidebar.nav>
        </flux:sidebar>

        <flux:main container>
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

                <flux:separator class="md:hidden" />

                <div class="flex-1 max-md:pt-6 self-stretch">
                    <flux:heading size="xl" level="1">Good afternoon, Olivia</flux:heading>
                    <flux:text class="mb-6 mt-2 text-base">Here's what's new today</flux:text>
                    <flux:separator variant="subtle" />
                </div>
            </div>
        </flux:main>
    </header>

    @fluxScripts
</body>
</html>
