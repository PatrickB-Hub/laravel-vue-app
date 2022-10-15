<template>
    <div class="container mx-auto pt-2 pb-6 px-6">
        <div
            class="shadow-md overflow-x-auto overflow-y-auto"
            style="max-height: 610px"
        >
            <table
                class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative"
            >
                <thead>
                    <tr
                        class="bg-slate-200 sticky top-0 text-left text-gray-800 font-bold tracking-wide uppercase text-sm"
                    >
                        <th class="py-3 pl-10">First Name</th>
                        <th class="py-3 pl-10">Last Name</th>
                        <th class="py-3 pl-10">Email</th>
                    </tr>
                </thead>
                <tbody>
                    <template v-for="employee in employees" :key="employee.id">
                        <tr
                            class="bg-gray-100 border-dashed border-b last:border-0 border-gray-300 text-gray-800"
                        >
                            <td>
                                <span class="pl-10 py-3">{{
                                    employee.first_name
                                }}</span>
                            </td>
                            <td>
                                <span class="pl-10 py-3">{{
                                    employee.last_name
                                }}</span>
                            </td>
                            <td>
                                <span class="pl-10 py-3">{{
                                    employee.email
                                }}</span>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import { BASE_URL } from "../constants";

export default {
    name: "EmployeeTable",
    props: {
        companyId: Number,
    },
    data() {
        return {
            employees: [],
        };
    },
    methods: {
        async fetchCompany(id) {
            const res = await fetch(`${BASE_URL}companies/${id}`);

            const data = await res.json();

            return data;
        },
    },
    async created() {
        this.employees = await this.fetchCompany(this.companyId);
    },
};
</script>
