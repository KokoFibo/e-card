<template>
    <Head title="Update Profile" />
    <AuthenticatedLayout>
        <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md mt-5">
            <h2 class="text-xl font-semibold mb-4">Edit Profile</h2>
            <form
                @submit.prevent="submit"
                class="space-y-4"
                enctype="multipart/form-data"
            >
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
                        type="text"
                        class="w-full mt-1 p-2 border rounded-md"
                        required
                    />
                    <span v-if="errors.email">
                        {{ errors.email }}
                    </span>
                </div>

                <div>
                    <label class="block text-sm font-medium">Phone</label>
                    <input
                        v-model="form.phone"
                        type="text"
                        class="w-full mt-1 p-2 border rounded-md"
                    />
                </div>
                <div>
                    <label class="block text-sm font-medium">Link ID</label>
                    <input
                        v-model="form.link_id"
                        type="text"
                        class="w-full mt-1 p-2 border rounded-md"
                    />
                </div>

                <!-- Upload Profile Picture -->
                <div>
                    <label class="block text-sm font-medium"
                        >Profile Picture</label
                    >
                    <input
                        type="file"
                        @change="handleProfilePicture"
                        class="w-full mt-1 p-2 border rounded-md"
                    />
                    <span v-if="errors.foto_profile">
                        {{ errors.foto_profile }}
                    </span>
                    <progress
                        v-if="form.progress"
                        :value="form.progress.percentage"
                        max="100"
                    >
                        {{ form.progress.percentage }}%
                    </progress>
                </div>
                <img
                    v-if="user.foto_profile || previewFotoProfile"
                    :src="previewFotoProfile || `/storage/${user.foto_profile}`"
                    class="w-32 h-32 rounded-full mb-2 object-cover"
                />
                <img
                    v-else
                    src="/storage/default-avatar.png"
                    class="w-32 h-32 rounded-full mb-2 object-cover"
                />

                <div>
                    <label class="block text-sm font-medium">Company</label>
                    <input
                        v-model="form.company"
                        type="text"
                        class="w-full mt-1 p-2 border rounded-md"
                    />
                </div>

                <div>
                    <label class="block text-sm font-medium">Job Title</label>
                    <input
                        v-model="form.job_title"
                        type="text"
                        class="w-full mt-1 p-2 border rounded-md"
                    />
                </div>

                <div>
                    <label class="block text-sm font-medium">Industry</label>
                    <input
                        v-model="form.industry"
                        type="text"
                        class="w-full mt-1 p-2 border rounded-md"
                    />
                </div>
                <div>
                    <label class="block text-sm font-medium">Address</label>
                    <input
                        v-model="form.address"
                        type="text"
                        class="w-full mt-1 p-2 border rounded-md"
                    />
                </div>
                <div>
                    <label class="block text-sm font-medium">Tagline</label>
                    <input
                        v-model="form.tag_line"
                        type="text"
                        class="w-full mt-1 p-2 border rounded-md"
                    />
                </div>
                <div>
                    <label class="block text-sm font-medium">Website</label>
                    <input
                        v-model="form.website"
                        type="text"
                        class="w-full mt-1 p-2 border rounded-md"
                    />
                </div>
                <!-- Upload Company Logo -->
                <div>
                    <label class="block text-sm font-medium"
                        >Company Logo</label
                    >
                    <input
                        type="file"
                        @change="handleCompanyLogo"
                        class="w-full mt-1 p-2 border rounded-md"
                    />
                    <span v-if="errors.company_logo">
                        {{ errors.company_logo }}
                    </span>
                    <progress
                        v-if="form.progress"
                        :value="form.progress.percentage"
                        max="100"
                    >
                        {{ form.progress.percentage }}%
                    </progress>
                    <img
                        v-if="user.company_logo || previewCompanyLogo"
                        :src="
                            previewCompanyLogo ||
                            `/storage/${user.company_logo}`
                        "
                        class="w-32 h-32 mb-2 object-contain"
                    />
                    <img
                        v-else
                        src="/storage/default-logo.png"
                        class="w-32 h-32 mb-2 object-contain"
                    />
                </div>

                <!-- Media Sosial -->
                <div>
                    <h3 class="text-lg font-semibold mt-4">Social Media</h3>
                    <div v-for="(platform, key) in socialMedia" :key="key">
                        <label class="block text-sm font-medium">{{
                            platform
                        }}</label>
                        <input
                            v-model="form[key]"
                            type="text"
                            class="w-full mt-1 p-2 border rounded-md"
                            :placeholder="`Enter ${platform} profile link`"
                        />
                    </div>
                </div>

                <button
                    type="submit"
                    class="w-full bg-blue-500 text-white py-2 rounded-md"
                >
                    Update
                </button>
            </form>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import { defineProps, ref } from "vue";
import { Head } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
const previewFotoProfile = ref(null);
const previewCompanyLogo = ref(null);

const props = defineProps({
    user: Object,
    errors: Object,
});

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    phone: props.user.phone,
    link_id: props.user.link_id,
    // foto_profile: null,
    foto_profile: props.user.foto_profile,
    company: props.user.company,
    job_title: props.user.job_title,
    address: props.user.address,
    industry: props.user.industry,
    tag_line: props.user.tag_line,
    website: props.user.website,
    // company_logo: null,
    company_logo: props.user.company_logo,
    LinkedIn: props.user.LinkedIn,
    Facebook: props.user.Facebook,
    Instagram: props.user.Instagram,
    Youtube: props.user.Youtube,
    Whatsapp: props.user.Whatsapp,
    Line: props.user.Line,
    Tiktok: props.user.Tiktok,
});

// List platform media sosial
const socialMedia = {
    LinkedIn: "LinkedIn",
    Facebook: "Facebook",
    Instagram: "Instagram",
    Youtube: "YouTube",
    Whatsapp: "WhatsApp",
    Line: "LINE",
    Tiktok: "TikTok",
};

const handleProfilePicture = (event) => {
    // form.foto_profile = event.target.files[0];
    const file = event.target.files[0];
    if (file) {
        form.foto_profile = file; // New file
        previewFotoProfile.value = URL.createObjectURL(file); // Preview new image
    } else {
        form.foto_profile = props.user.foto_profile; // Keep existing
    }
};

const handleCompanyLogo = (event) => {
    // form.company_logo = event.target.files[0];
    const file = event.target.files[0];
    if (file) {
        form.company_logo = file;
        previewCompanyLogo.value = URL.createObjectURL(file); // Preview new image
    } else {
        form.company_logo = props.user.company_logo; // Keep existing
    }
};

const submit = () => {
    form.post(route("clientUpdate"), {
        forceFormData: true,
        onSuccess: () => {
            alert("Profile updated successfully!");
        },
    });
};
</script>
