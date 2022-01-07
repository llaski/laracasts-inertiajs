<template>
    <Head>
        <title>Users</title>
    </Head>

    <div class="flex justify-between mb-6">
        <div class="flex items-center">
            <h1 class="text-3xl">Users</h1>

            <Link class="text-blue-500 ml-4" href="/users/create" v-if="can.createUser"
                >New User</Link
            >
        </div>
        <input
            v-model="search"
            type="text"
            placeholder="Search..."
            class="border px-2 rounded-lg"
        />
    </div>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div
                class="
                    py-2
                    align-middle
                    inline-block
                    min-w-full
                    sm:px-6
                    lg:px-8
                "
            >
                <div
                    class="
                        shadow
                        overflow-hidden
                        border-b border-gray-200
                        sm:rounded-lg
                    "
                >
                    <table class="min-w-full divide-y divide-gray-200">
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="user in users.data" :key="user.id">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div>
                                            <div
                                                class="
                                                    text-sm
                                                    font-medium
                                                    text-gray-900
                                                "
                                            >
                                                {{ user.name }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td
                                    class="
                                        px-6
                                        py-4
                                        whitespace-nowrap
                                        text-right text-sm
                                        font-medium
                                    "
                                >
                                    <Link
                                        :href="`/users/${user.id}/edit`"
                                        class="
                                            text-indigo-600
                                            hover:text-indigo-900
                                        "
                                        v-if="user.can.edit"
                                        >Edit</Link
                                    >
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <Pagination :links="users.links" class="mt-6" />
</template>

<script>
import Pagination from "../../Shared/Pagination";
import throttle from "lodash/throttle";
// import debounce from "lodash/debounce"

export default {
    components: { Pagination },
    props: {
        filters: Object,
        users: Object,
        can: Object,
    },
    data() {
        return {
            search: this.filters.search,
        };
    },
    watch: {
        search: throttle(function (value) {
            this.$inertia.get(
                "/users",
                {
                    search: value,
                },
                {
                    preserveState: true,
                    replace: true,
                }
            );
        }, 500),

        // search: debounce(function(value) {
        //     this.$inertia.get('/users', {
        //         search: value
        //     }, {
        //         preserveState: true,
        //         replace: true
        //     })
        // }, 300)
    },
};
</script>
