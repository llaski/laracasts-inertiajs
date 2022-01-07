<template>
    <Head>
        <title>My App</title>
        <meta
            type="description"
            content="Info about app"
            head-key="description"
        />
    </Head>

    <section class="p-6 bg-gray-300">
        <header class="flex justify-between">
            <div class="flex items-center">
                <h1 class="font-bold text-lg">My App</h1>
                <p class="text-sm ml-4">Welcome Back, {{ username }}</p>
            </div>

            <Nav />
        </header>
    </section>

    <section class="p-6">
        <div class="max-w-3xl mx-auto">
            <slot />
        </div>
    </section>
</template>

<script>
import { Head } from "@inertiajs/inertia-vue3";
import Nav from "../Shared/Nav";

export default {
    components: { Head, Nav },
    computed: {
        username() {
            return this.$page.props.auth.user.username;
        },
    },
};
</script>
