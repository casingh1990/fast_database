<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
</script>

<template>
    <Head title="Welcome" />

    <div
        class="relative flex items-top h-20 justify-center bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0"
    >
        <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            <Link
                v-if="$page.props.auth.user"
                :href="route('dashboard')"
                class="text-sm text-gray-700 dark:text-gray-500 underline"
                >Dashboard</Link
            >

            <template v-else>
                <Link :href="route('login')" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</Link>

                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline"
                    >Register</Link
                >
            </template>
        </div>
    </div>
    <div>
        <div class="flex-1">
            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <div class="">
                    <div class="">
                        <table class="table-fixed">
                            <thead>
                                <tr>
                                    <th class="w-1/5 border border-slate-600">Name</th>
                                    <th class="w-1/5 border border-slate-600">Date of Exam</th>
                                    <th class="w-1/5 border border-slate-600">Hospital Number</th>
                                    <th class="w-1/5 border border-slate-600">Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="visit in visits">
                                    <td class="p-2 border border-slate-600">{{ visit.patient.name }}</td>
                                    <td class="p-2 border border-slate-600">{{ visit.date_of_exam }}</td>
                                    <td class="p-2 border border-slate-600">{{ visit.hospital_number }}</td>
                                    <td class="p-2 border border-slate-600">
                                        <Link :href="`/visit/${ visit.id }`">View / Edit</Link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <button type="button" @click="Add">Add</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    props: {
        canLogin: Boolean,
        canRegister: Boolean,
        laravelVersion: String,
        phpVersion: String,
    },
    data() {
        return {
            visits: [
                {
                    id: 1,
                    patient: {
                        name: 'Amit Singh',
                    },
                    date_of_exam: '2023-01-17',
                    hospital_number: '20',
                },
                {
                    id: 1,
                    patient: {
                        name: 'Amit Singh Amit Singh',
                    },
                    date_of_exam: '2023-01-17',
                    hospital_number: '20',
                },
                {
                    patient: {
                        name: 'Amit Singh',
                    },
                    date_of_exam: '2023-01-17',
                    hospital_number: '20',
                },
                {
                    patient: {
                        name: 'Amit Singh',
                    },
                    date_of_exam: '2023-01-17',
                    hospital_number: '20',
                },
                {
                    patient: {
                        name: 'Amit Singh',
                    },
                    date_of_exam: '2023-01-17',
                    hospital_number: '20',
                },
                {
                    patient: {
                        name: 'Amit Singh',
                    },
                    date_of_exam: '2023-01-17',
                    hospital_number: '20',
                },
                {
                    patient: {
                        name: 'Amit Singh',
                    },
                    date_of_exam: '2023-01-17',
                    hospital_number: '20',
                }
            ]
        }
    },
    methods: {
        editModal(visit) {
            window.location='/visit/' . visit.id
        }
    }
};
</script>
