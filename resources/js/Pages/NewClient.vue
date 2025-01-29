<template>
    <Head title="New Client" />
    <AuthenticatedLayout>
        <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md mt-5">
            <h2 class="text-xl font-semibold mb-4">Input Client Data</h2>
            <form @submit.prevent="submit" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium">Name</label>
                    <input
                        v-model="form.name"
                        type="text"
                        class="w-full mt-1 p-2 border rounded-md"
                        required
                    />
                </div>
                <div>
                    <label class="block text-sm font-medium">Email</label>
                    <input
                        v-model="form.email"
                        type="email"
                        class="w-full mt-1 p-2 border rounded-md"
                        required
                    />
                </div>

                <button
                    type="submit"
                    class="w-full bg-blue-500 text-white py-2 rounded-md"
                >
                    Submit
                </button>
            </form>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

const form = useForm({
    name: "",
    email: "",
});

const submit = () => {
    form.post("/client/store", {
        onSuccess: () => {
            alert("Client data submitted successfully!");
            form.reset();
        },
    });
};
</script>
