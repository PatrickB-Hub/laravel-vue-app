<template>
    <main class="py-12 max-w-7xl mx-auto min-h-screen bg-slate-200">
        <div class="text-left" bis_skin_checked="1">
            <template v-for="company in companies" :key="company.id">
                <div class="mx-20 mb-4 shadow rounded bg-white">
                    <div class="flex justify-between">
                        <h3 class="pl-6 py-5 text- text-xl font-bold">
                            {{ company.name }}
                        </h3>
                        <button
                            @click="setSelectedCompany(company.id)"
                            class="my-3 mx-6 px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded"
                        >
                            {{
                                selectedCompany !== null &&
                                selectedCompany === company.id
                                    ? "Hide Employees"
                                    : "Show Employees"
                            }}
                        </button>
                    </div>
                    <EmployeeTable
                        v-if="selectedCompany === company.id"
                        :companyId="company.id"
                    />
                </div>
            </template>
        </div>
    </main>
</template>

<script>
import { BASE_URL } from "./constants";
import EmployeeTable from "./components/EmployeeTable.vue";

export default {
    name: "Home",
    components: {
        EmployeeTable,
    },
    data() {
        return {
            companies: [],
            selectedCompany: null,
            btnText: "Show Employees",
            btnColor: "cornflowerBlue",
        };
    },
    methods: {
        async fetchCompanies() {
            const res = await fetch(`${BASE_URL}companies`);

            const { data } = await res.json();

            return data;
        },

        setSelectedCompany(id) {
            if (this.selectedCompany === id) {
                this.selectedCompany = null;

                this.btnText = "Show Employees";
                this.btnColor = "cornflowerBlue";
            } else {
                this.selectedCompany = id;

                this.btnText = "Hide Employees";
                this.btnColor = "lightSlateGrey";
            }
        },
    },
    async created() {
        this.companies = await this.fetchCompanies();
    },
};
</script>
