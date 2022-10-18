<template>
    <div class="container mx-auto pt-2 pb-6 px-6">
        <button
            @click="handleCreateClick"
            class="mb-3 px-4 py-2 rounded bg-green-500 hover:bg-green-600 text-white font-medium"
        >
            Create Employee
        </button>
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
                        <th class="py-3 pl-10">Action</th>
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
                            <td class="pl-10">
                                <button
                                    @click="handleEditClick(employee)"
                                    class="px-5 py-2 my-2 mr-4 rounded bg-blue-500 hover:bg-blue-600 text-white font-medium"
                                >
                                    Edit
                                </button>
                                <button
                                    @click="deleteEmployee(employee.id)"
                                    class="px-5 py-2 my-2 rounded bg-red-500 hover:bg-red-600 text-white font-medium"
                                >
                                    Delete
                                </button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>
    <EmployeeCreateModal
        :isOpen="createModalIsOpen"
        :errors="createModalErrors"
        @create-employee="createEmployee"
    />
    <EmployeeUpdateModal
        :isOpen="updateModalIsOpen"
        :employee="{ ...employee }"
        :errors="updateModalErrors"
        @update-employee="updateEmployee"
    />
</template>

<script>
import { BASE_URL } from "../constants";
import EmployeeCreateModal from "./EmployeeCreateModal.vue";
import EmployeeUpdateModal from "./EmployeeUpdateModal.vue";

export default {
    name: "EmployeeTable",
    components: {
        EmployeeCreateModal,
        EmployeeUpdateModal,
    },
    props: {
        companyId: Number,
    },
    data() {
        return {
            employee: {},
            employees: [],
            createModalIsOpen: false,
            updateModalIsOpen: false,
            createModalErrors: {},
            updateModalErrors: {},
        };
    },
    methods: {
        async fetchCompany(id) {
            const res = await fetch(`${BASE_URL}companies/${id}`);

            const data = await res.json();

            return data;
        },

        async createEmployee(employee) {
            const res = await fetch(`${BASE_URL}employees/`, {
                method: "POST",
                headers: {
                    Accept: "application/json",
                    "Content-type": "application/json",
                },
                body: JSON.stringify({
                    company_id: this.companyId,
                    ...employee,
                }),
            });

            if (res.status === 200) {
                this.createModalIsOpen = false;
                const data = await res.json();
                this.employees = [...this.employees, data];
                this.createModalErrors = {};
            }

            if (res.status === 422) {
                const json = await res.json();
                this.createModalErrors = json.errors;
            }
        },

        async updateEmployee(employee) {
            const data = {
                id: employee.id,
                first_name: employee.first_name,
                last_name: employee.last_name,
                email: employee.email,
                company_id: employee.company_id,
            };

            const res = await fetch(`${BASE_URL}employees/${employee.id}`, {
                method: "PUT",
                headers: {
                    Accept: "application/json",
                    "Content-type": "application/json",
                },
                body: JSON.stringify(data),
            });

            if (res.status === 200) {
                this.updateModalIsOpen = false;
                const updatedEmployees = this.employees.map((e) =>
                    e.id === employee.id ? { ...e, ...data } : e
                );
                this.employees = updatedEmployees;
                this.updateModalErrors = {};
            }

            if (res.status === 422) {
                const json = await res.json();
                this.updateModalErrors = json.errors;
            }
        },

        async deleteEmployee(id) {
            if (confirm("Are you sure?")) {
                const res = await fetch(`${BASE_URL}employees/${id}`, {
                    method: "DELETE",
                });

                res.status === 200
                    ? (this.employees = this.employees.filter(
                          (employee) => employee.id !== id
                      ))
                    : alert("Error deleting Employee");
            }
        },
        handleCreateClick() {
            this.createModalIsOpen = true;
        },
        handleEditClick(employee) {
            this.employee = employee;
            this.updateModalIsOpen = true;
        },
    },
    async created() {
        this.employees = await this.fetchCompany(this.companyId);
    },
};
</script>
