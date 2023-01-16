<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import axios from 'axios';
</script>

<template>

    <Head title="Add Visit Log" />

    <div class="relative flex items-top h-20 justify-center bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</Link>

            <template v-else>
                <Link :href="route('login')" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</Link>

                <Link v-if="canRegister" :href="route('register')"
                    class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</Link>
            </template>
        </div>
    </div>
    <div class="min-h-screen p-6 bg-gray-100 flex items-center justify-center">
        <div class="container max-w-screen-lg mx-auto">
            <div>
                <h2 class="font-semibold text-xl text-gray-600">Add a Visit log</h2>

                <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                        <div class="text-gray-600">
                            <p class="font-medium text-lg">Visit Details</p>
                            <p>Please fill out all the fields.</p>
                        </div>

                        <div class="lg:col-span-2">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                                <div class="md:col-span-5">
                                    <label for="full_name">Patient Full Name</label>
                                    <input type="text" name="full_name" id="full_name"
                                        class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                        v-model="visit.patient" />
                                </div>

                                <div class="md:col-span-3">
                                    <label for="date_of_exam">Date of Exam</label>
                                    <input type="text" name="date_of_exam" id="date_of_exam"
                                        class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                        v-model="visit.date_of_exam" />
                                </div>
                                <div class="md:col-span-2"></div>

                                <div class="md:col-span-3">
                                    <label for="hospital_number">Hospital Number</label>
                                    <input type="text" name="hospital_number" id="hospital_number"
                                        class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                        v-model="visit.hospital_number" placeholder="" />
                                </div>
                                <div class="md:col-span-2"></div>

                                <div class="md:col-span-5">
                                    <p class="text-base">Was the FAST negative or positive?</p>
                                </div>

                                <div class="md:col-span-2">
                                    <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
                                        <input id="bordered-radio-2" type="radio" value="positive" name="bordered-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" v-model="visit.fast">
                                        <label for="bordered-radio-2" class="w-full py-4 ml-2 text-sm font-medium text-gray-900">Positive</label>
                                    </div>
                                </div>
                                <div class="md:col-span-2">
                                    <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
                                        <input id="bordered-radio-1" type="radio" value="negative" name="bordered-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" v-model="visit.fast">
                                        <label for="bordered-radio-1" class="w-full py-4 ml-2 text-sm font-medium text-gray-900">Negative</label>
                                    </div>
                                </div>
                                <div class="md:col-span-1"></div>

                                <div class="md:col-span-5" v-if="visit.fast === 'positive'">
                                    <p class="text-base">FAST Area</p>
                                </div>
                                <div class="md:col-span-2" v-if="visit.fast === 'positive'">
                                    <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
                                        <input id="bordered-checkbox-1" type="checkbox" value="subxiphoid" name="bordered-checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" v-model="visit.selection">
                                        <label for="bordered-checkbox-1" class="w-full py-4 ml-2 text-sm font-medium text-gray-900">Subxiphoid</label>
                                    </div>
                                    <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
                                        <input checked id="bordered-checkbox-2" type="checkbox" value="right upper quadrant" name="bordered-checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" v-model="visit.selection">
                                        <label for="bordered-checkbox-2" class="w-full py-4 ml-2 text-sm font-medium text-gray-900">Right Upper Quadrant</label>
                                    </div>
                                </div>
                                <div class="md:col-span-2" v-if="visit.fast === 'positive'">
                                    <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
                                        <input checked id="bordered-checkbox-2" type="checkbox" value="left upper quadrant" name="bordered-checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" v-model="visit.selection">
                                        <label for="bordered-checkbox-2" class="w-full py-4 ml-2 text-sm font-medium text-gray-900">Left Upper Quadrant</label>
                                    </div>
                                    <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
                                        <input checked id="bordered-checkbox-2" type="checkbox" value="pelvis" name="bordered-checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" v-model="visit.selection">
                                        <label for="bordered-checkbox-2" class="w-full py-4 ml-2 text-sm font-medium text-gray-900">Pelvis</label>
                                    </div>
                                </div>
                                <div class="md:col-span-1"></div>

                                <div class="md:col-span-5">
                                    <p class="text-base">Did the CT result correlate with the FAST?</p>
                                </div>

                                <div class="md:col-span-2">
                                    <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
                                        <input id="correlation-2" type="radio" value="1" name="correlation" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" v-model="visit.correlation">
                                        <label for="correlation-2" class="w-full py-4 ml-2 text-sm font-medium text-gray-900">Yes</label>
                                    </div>
                                </div>
                                <div class="md:col-span-2">
                                    <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
                                        <input id="correlation-1" type="radio" value="0" name="correlation" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" v-model="visit.correlation">
                                        <label for="correlation-1" class="w-full py-4 ml-2 text-sm font-medium text-gray-900">No</label>
                                    </div>
                                </div>
                                <div class="md:col-span-1"></div>

                                <div class="md:col-span-5">
                                    <p class="text-base">Was the resident counseled?</p>
                                </div>

                                <div class="md:col-span-2">
                                    <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
                                        <input id="patient_conselled-2" type="radio" value="1" name="patient_conselled" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" v-model="visit.patient_conselled">
                                        <label for="patient_conselled-2" class="w-full py-4 ml-2 text-sm font-medium text-gray-900">Yes</label>
                                    </div>
                                </div>
                                <div class="md:col-span-2">
                                    <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
                                        <input id="patient_conselled-1" type="radio" value="0" name="patient_conselled" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" v-model="visit.patient_conselled">
                                        <label for="patient_conselled-1" class="w-full py-4 ml-2 text-sm font-medium text-gray-900">No</label>
                                    </div>
                                </div>
                                <div class="md:col-span-1"></div>


                                <div class="md:col-span-5 text-right">
                                    <div class="inline-flex items-end">
                                        <button
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                            @click="submit()"
                                        >
                                            Submit
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            visit: {
                id: null,
                patient: '',
                date_of_exam: '',
                hospital_number: '',
                fast: '',
                correlation: '',
                patient_conselled: '',
                selection: [],
            }
        }
    },
    methods: {
        submit() {
            axios.post('/visit/submit-add', this.visit).then((response) => {
                window.location = '/';
            })
        }
    }
}
</script>
