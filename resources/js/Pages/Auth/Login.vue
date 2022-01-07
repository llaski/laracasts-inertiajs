<template>
    <Head title="Login Page" />

    <main class="grid place-items-center min-h-screen">
        <section class="bg-white p-8 rounded-xl max-w-3xl mx-auto border border-gray-500">
            <h1 class="text-3xl">Login</h1>

            <form
                method="POST"
                action="/"
                class="max-w-md max-auto mt-8"
                @submit.prevent="onSubmit"
            >
                <div class="mb-6">
                    <label
                        for="email"
                        class="
                            block
                            mb-2
                            uppercase
                            font-bold
                            text-xs text-gray-700
                        "
                    >
                        Email</label
                    >

                    <input
                        v-model="form.email"
                        type="email"
                        class="border border-gray-500 rounded p-2 w-full"
                        name="email"
                        id="email"
                    />

                    <div
                        v-if="form.errors.email"
                        v-text="form.errors.email"
                        class="text-red-500 text-sx mt-1"
                    ></div>
                </div>

                <div class="mb-6">
                    <label
                        for="password"
                        class="
                            block
                            mb-2
                            uppercase
                            font-bold
                            text-xs text-gray-700
                        "
                    >
                        Password</label
                    >

                    <input
                        v-model="form.password"
                        type="password"
                        class="border border-gray-500 rounded p-2 w-full"
                        name="password"
                        id="password"
                    />

                    <div
                        v-if="form.errors.password"
                        v-text="form.errors.password"
                        class="text-red-500 text-sx mt-1"
                    ></div>
                </div>

                <div class="mb-6">
                    <button
                        type="submit"
                        class="
                            bg-blue-400
                            text-white
                            rounded
                            py-2
                            px-4
                            hover:bg-blue-500
                            disabled:opacity-75
                        "
                        :disabled="form.processing"
                    >
                        Log In
                    </button>
                </div>
            </form>
        </section>
    </main>
</template>

<script>
export default {
    layout: null,

    data() {
        return {
            form: this.$inertia.form({
                email: "",
                password: "",
            }),
        };
    },

    methods: {
        onSubmit() {
            this.form.post("/login");
        },
    },
};
</script>
