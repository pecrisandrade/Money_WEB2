<script setup>
import { useForm } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

const props = defineProps({
    money: {},
});

const form = useForm({
    describe: props.money.describe,
    value: props.money.value,
    date: props.money.date,
});

const updateMoney = () => {
    form.patch(route("money.update", props.money.id), {
        onFinish: () => {
            alert("Success! Money Updated.");
        },
    });
};
</script>

<template>
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <h1 class="p-6 text-gray-900">Update the Money</h1>

                    <form @submit.prevent="updateMoney" class="p-6">
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

                        <SecondaryButton class="my-2" type="submit"
                            >Save</SecondaryButton
                        >
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>