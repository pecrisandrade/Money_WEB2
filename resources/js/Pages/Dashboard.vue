<script setup>
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";

defineProps({
    moneys: {},
});

const showForm = ref(false);

const form = useForm({
    describe: "",
    value: "",
    date: "",
});

const addMoney = () => {
    form.post(route("money.store"), {
        onFinish: () => {
            form.describe = "";
            form.value = "";
            form.date = "";
        },
    });
};

const removeMoney = (id) => {
    if (!confirm("Please, confirm to delete.")) return;
    useForm({}).delete(route("money.destroy", id), {
        onFinish: () => {
            alert("Success! Expense Removed.");
        },
    });
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">My Moneys</div>

                    <button
                        class="w-full bg-green-200 p-2 font-bold my-2 border-2 border-green-200 hover:bg-green-300 rounded"
                        @click="showForm = !showForm"
                        v-if="!showForm"
                    >
                        Add new Money
                    </button>

                    <form
                        v-if="showForm"
                        @submit.prevent="addMoney"
                        class="p-2 m-2"
                    >
                    <div class="justify-between items-center">
                            <label>describe</label>
                            <TextInput
                                class="block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                v-model="form.describe"
                            />

                            <label>value</label>
                            <TextInput
                                class="block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                v-model="form.value"
                            />
                    
                            <label>date</label>
                            <p class="text-xs text-gray-500">Ex: yyyy-mm-dd</p>
                            <TextInput
                                class="block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                v-model="form.date"
                            />
                        
                        </div>
                        <SecondaryButton class="m-2" type="submit"
                            >Save</SecondaryButton
                        >
                         <div
                            @click="showForm = !showForm"
                            class="cursor-pointer font-bold block w-full text-right"
                        >
                            Close
                        </div>
                    </form>

                    <table>
                        <tr>
                            <th>Describe</th>
                            <th>Value</th>
                            <th>Date</th>
                        </tr>
                        <tr v-for="money of moneys" :key="money.id">
                            <td>{{ money.describe }}</td>
                            <td>{{ money.value }}</td>
                            <td>{{ money.date }}</td>
                            <td>
                                <button @click="removeMoney(money.id)">
                                _-_-|Remove|
                                </button>
                                <Link :href="route('money.edit', money.id)"
                                    >_-_-|Edit|</Link
                                >
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>