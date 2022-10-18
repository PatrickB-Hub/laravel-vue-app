<template>
    <div class="container mx-auto">
        <div
            v-show="isOpen"
            class="fixed inset-0 flex items-center justify-center bg-gray-700 bg-opacity-70"
        >
            <div class="max-w-2xl p-6 bg-white rounded-md shadow-xl">
                <div class="flex items-center justify-between">
                    <h3 class="text-2xl">Create Employee</h3>
                    <svg
                        @click="isOpen = false"
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-8 h-8 text-gray-600 cursor-pointer"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
                        />
                    </svg>
                </div>
                <div class="mt-6">
                    <form
                        class="max-w-md mx-auto px-10"
                        @submit.prevent="$emit('create-employee', employee)"
                    >
                        <div class="space-y-6">
                            <div class="mb-6">
                                <label
                                    for="first_name"
                                    class="block mb-2 text-sm font-medium text-gray-900"
                                    >First Name</label
                                >
                                <input
                                    type="text"
                                    id="first_name"
                                    v-model="employee.first_name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                />
                                <div v-if="errors.first_name">
                                    <span class="text-sm text-red-400">{{
                                        errors.first_name[0]
                                    }}</span>
                                </div>
                            </div>
                            <div class="mb-6">
                                <label
                                    for="last_name"
                                    class="block mb-2 text-sm font-medium text-gray-900"
                                    >Last Name</label
                                >
                                <input
                                    type="text"
                                    id="last_name"
                                    v-model="employee.last_name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                />
                                <div v-if="errors.last_name">
                                    <span class="text-sm text-red-400">{{
                                        errors.last_name[0]
                                    }}</span>
                                </div>
                            </div>
                            <div class="mb-6">
                                <label
                                    for="email"
                                    class="block mb-2 text-sm font-medium text-gray-900"
                                    >Email</label
                                >
                                <input
                                    type="text"
                                    id="email"
                                    v-model="employee.email"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                />
                                <div v-if="errors.email">
                                    <span class="text-sm text-red-400">{{
                                        errors.email[0]
                                    }}</span>
                                </div>
                            </div>
                            <div class="mt-4">
                                <button
                                    type="submit"
                                    class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded"
                                >
                                    Store
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "EmployeeCreateModal",
    props: {
        isOpen: Boolean,
        errors: {},
    },
    data() {
        return {
            employee: {},
        };
    },
    created() {
        this.employee = {
            first_name: "",
            last_name: "",
            email: "",
        };
    },
};
</script>
