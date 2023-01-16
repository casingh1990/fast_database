<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import axios from 'axios';
</script>

<template>
    <Head title="Visits" />

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
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full">
                        <thead class="border-b">
                            <tr>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Name</th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Date of Exam</th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Hospital Number</th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr :class="getClass(visit)" v-for="visit in visits">
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ visit.patient_name }}</td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ visit.date_of_exam }}</td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ visit.hospital_number }}</td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    <Link
                                        :href="`/visit/edit/${ visit.id }`"
                                        class="inline-block px-6 py-2 border-2 border-blue-600 text-blue-600 font-medium text-xs leading-tight uppercase rounded-full hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out"
                                    >
                                        View / Edit
                                    </Link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <Link
                        type="button"
                        data-mdb-ripple="true"
                        data-mdb-ripple-color="light"
                        class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                        :href="`/visit/add`"
                        >
                        Add
                    </Link>
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
            visits: []
        }
    },
    mounted() {
        axios.get('/visit/visits').then((response) => {
            this.visits = response.data;
        });
    },
    methods: {
        getClass(visit) {
            console.log('border-b ' + ((visit.id%2)?'bg-gray-100':'bg-white'));
            return 'border-b ' + ((visit.id%2)?'bg-gray-100':'bg-white');
        },
        editModal(visit) {
            window.location='/visit/' . visit.id
        }
    }
};
</script>
